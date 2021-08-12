<?php

namespace App\Http\Controllers\Department;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\CourseSemester;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        return view('department.teacher.index', compact('departments'));
    }
    function teacherFetch()
    {
        $deptId =  auth('dept_admin')->user()->department_id;
        return Teacher::with('department')->whereHas('department', function ($q) use ($deptId) {
            $q->whereDepartmentId($deptId);
        })->latest()->get();
        // return CourseSemester::with(['course.department', 'semester.session'])
        //     ->whereHas('course', function ($q) use ($deptId) {
        //         $q->whereDepartmentId($deptId);
        //     })->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'department_id' => ['required'],
            'email' => ['required', 'email', 'unique:teachers,email'],
            'password' => ['required']
        ]);

        Teacher::create($request->all());
    }

    public function destroy($department_admin)
    {
        Teacher::find($department_admin)->delete();
    }
    public function show($department_admin)
    {
        return Teacher::find($department_admin);
    }
    public function update(Request $request, Teacher $Teacher)
    {
        if (!$this->checkExistsTeacherCodeWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $Teacher->update($request->all());
    }



    protected function checkExistsTeacherCodeWhenUpdate($request): bool
    {
        $Teacher = Teacher::whereCode($request->code)
            ->where('id', '!=', $request->id)
            ->first();
        if ($Teacher) {
            return false;
        }

        return true;
    }
}
