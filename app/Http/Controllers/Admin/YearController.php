<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YearController extends Controller
{
    public function index()
    {
        $sessions = Session::latest()->get();
        return view('admin.year.index', compact('sessions'));
    }
    function yearFetch()
    {
        return Year::with('session')->latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'session_id' => ['required']
        ]);

        if (!$this->checkExistsYear($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        Year::create($request->all());
    }

    public function destroy(Year $Year)
    {
        $Year->delete();
    }
    public function show(Year $Year)
    {
        return $Year;
    }
    public function update(Request $request, Year $Year)
    {
        if (!$this->checkExistsYearWhenUpdate($request)) {
            return response()->json([
                'flag' => 'EXISTS'
            ]);
        }
        $Year->update($request->all());
    }

    protected function checkExistsYear($request): bool
    {
        $Year = Year::whereSessionId($request->session_id)
            ->whereName($request->name)->first();
        if ($Year) {
            return false;
        }

        return true;
    }

    protected function checkExistsYearWhenUpdate($request): bool
    {
        $Year = Year::whereSessionId($request->session_id)
            ->whereName($request->name)
            ->where('id', '!=', $request->id)
            ->first();
        if ($Year) {
            return false;
        }

        return true;
    }
}
