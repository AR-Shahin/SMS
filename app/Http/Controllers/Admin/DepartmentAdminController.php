<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentAdmin;
use App\Http\Controllers\Controller;

class DepartmentAdminController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        return view('admin.d-admin.index', compact('departments'));
    }
    function departmentAdminFetch()
    {
        return DepartmentAdmin::whereHas('department')->with('department')->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'department_id' => ['required'],
            'email' => ['required', 'email', 'unique:department_admins,email'],
            'password' => ['required']
        ]);

        DepartmentAdmin::create($request->all());
    }

    public function destroy($department_admin)
    {
        DepartmentAdmin::find($department_admin)->delete();
    }
    public function show($department_admin)
    {
        return DepartmentAdmin::find($department_admin);
    }
    public function update(Request $request, DepartmentAdmin $DepartmentAdmin)
    {
        if (!$this->checkExistsDepartmentAdminCodeWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $DepartmentAdmin->update($request->all());
    }



    protected function checkExistsDepartmentAdminCodeWhenUpdate($request): bool
    {
        $DepartmentAdmin = DepartmentAdmin::whereCode($request->code)
            ->where('id', '!=', $request->id)
            ->first();
        if ($DepartmentAdmin) {
            return false;
        }

        return true;
    }
}
