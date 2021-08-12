<?php

namespace App\Http\Controllers\Department;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\CourseSemester;
use App\Http\Controllers\Controller;
use Whoops\Run;

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
        //return  $dept =  auth('dept_admin')->user()->department->name;
        $deptId =  auth('dept_admin')->user()->department_id;

        return CourseSemester::with(['course.department', 'semester.session'])
            // ->whereHas('course', function ($q) use ($deptId) {
            //     $q->whereDepartmentId($deptId);
            // })
            ->whereDepartmentId($deptId)
            ->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
            'semester_id' => ['required']
        ]);

        $data = $request->all();
        $data['department_id'] = auth('dept_admin')->user()->department_id;
        CourseSemester::create($data);
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
