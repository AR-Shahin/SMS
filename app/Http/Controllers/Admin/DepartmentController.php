<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.department.index');
    }
    function departmentFetch()
    {
        return Department::latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:departments']
        ]);
        Department::create($request->all());
    }

    public function destroy(Department $department)
    {
        $department->delete();
    }
    public function show(Department $department)
    {
        return $department;
    }
    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
    }
}
