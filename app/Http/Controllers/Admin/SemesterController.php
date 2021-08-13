<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Year;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $years = Year::with('session')->get();
        return view('admin.semester.index', compact('years'));
    }
    function semesterFetch()
    {
        return Semester::with('year.session')->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'year_id' => ['required']
        ]);

        if (!$this->checkExistsSemester($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        Semester::create($request->all());
    }

    public function destroy(Semester $Semester)
    {
        $Semester->delete();
    }
    public function show(Semester $Semester)
    {
        return $Semester;
    }
    public function update(Request $request, Semester $Semester)
    {
        if (!$this->checkExistsSemesterWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $Semester->update($request->all());
    }

    protected function checkExistsSemester($request): bool
    {
        $semester = Semester::whereYearId($request->session_id)
            ->whereName($request->name)->first();
        if ($semester) {
            return false;
        }

        return true;
    }

    protected function checkExistsSemesterWhenUpdate($request): bool
    {
        $semester = Semester::whereYearId($request->session_id)
            ->whereName($request->name)
            ->where('id', '!=', $request->id)
            ->first();
        if ($semester) {
            return false;
        }

        return true;
    }
}
