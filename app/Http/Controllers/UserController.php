<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $data = User::orderBy('name','asc')->paginate();
        return view('users.index',compact('data'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->email_verified_at = now();
        $data->is_superadmin = 0;
        if($data->save()){
            return redirect()->route('admin.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('users.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->email_verified_at = now();
        if($data->update()){
            return redirect()->route('admin.index');
        }
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if($data->delete()){
            return back();
        }
    }
}
