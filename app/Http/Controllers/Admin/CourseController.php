<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        return view('admin.course.index', compact('departments'));
    }
    function courseFetch()
    {
        return Course::with('department')->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'department_id' => ['required'],
            'code' => ['required', 'unique:courses,code'],
            'credit' => ['required', 'numeric'],
        ]);

        Course::create($request->all());
    }

    public function destroy(Course $Course)
    {
        $Course->delete();
    }
    public function show(Course $Course)
    {
        return $Course;
    }
    public function update(Request $request, Course $Course)
    {
        if (!$this->checkExistsCourseCodeWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $Course->update($request->all());
    }



    protected function checkExistsCourseCodeWhenUpdate($request): bool
    {
        $Course = Course::whereCode($request->code)
            ->where('id', '!=', $request->id)
            ->first();
        if ($Course) {
            return false;
        }

        return true;
    }
}
