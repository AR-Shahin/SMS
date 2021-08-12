<?php

namespace App\Http\Controllers\Department;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\CourseSemester;
use App\Http\Controllers\Controller;

class CourseSemesterController extends Controller
{

    public function index()
    {
        $semesters = Semester::with('session')->get();
        $courses = Course::get();
        return view('department.course.index', compact('semesters', 'courses'));
    }
    function CourseSemesterFetch()
    {
        return CourseSemester::whereHas('department')->with('department')->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
            'semester_id' => ['required']
        ]);

        CourseSemester::create($request->all());
    }

    public function destroy($department_admin)
    {
        CourseSemester::find($department_admin)->delete();
    }
    public function show($department_admin)
    {
        return CourseSemester::find($department_admin);
    }
    public function update(Request $request, CourseSemester $CourseSemester)
    {
        if (!$this->checkExistsCourseSemesterCodeWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $CourseSemester->update($request->all());
    }



    protected function checkExistsCourseSemesterCodeWhenUpdate($request): bool
    {
        $CourseSemester = CourseSemester::whereCode($request->code)
            ->where('id', '!=', $request->id)
            ->first();
        if ($CourseSemester) {
            return false;
        }

        return true;
    }
}
