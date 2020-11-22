<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;

class VisitorController extends Controller
{

    public function index()
    {
        $data = Visitor::orderBy('id','desc')->paginate();
        return view('visitor.index',compact('data'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Visitor::findOrFail($id);
        return view('visitor.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Visitor::findOrFail($id);
        $data->status = $request->status;
        if($data->update()){
            return redirect()->route('visitor.index');
        }
    }

    public function destroy($id)
    {
        $data = Visitor::findOrFail($id);
        if($data->delete()){
            return back();
        }
    }
}
