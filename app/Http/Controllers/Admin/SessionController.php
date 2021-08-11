<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('admin.session.index');
    }
    function sessionFetch()
    {
        return Session::latest()->get();
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:sessions,name']
        ]);
        Session::create($request->all());
    }

    public function destroy(Session $Session)
    {
        $Session->delete();
    }
    public function show(Session $Session)
    {
        return $Session;
    }
    public function update(Request $request, Session $Session)
    {
        $Session->update($request->all());
    }
}
