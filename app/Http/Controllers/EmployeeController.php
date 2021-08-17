<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result['data'] = Employee::all();
        return view('employee', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        $emp = new Employee;

        $emp->name = $req->input('name');
        $emp->email = $req->input('email');
        $emp->phone = $req->input('phone');
        $emp->course = $req->input('course');
        $emp->save();

        //return redirect('/employee');
        return redirect()->back()->with('status','added');
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $employee = Employee::find($id);
        return response()->json([
            'status' => 200,
            'employee' => $employee,
        ]);

    }

    /**
     * Update the specified resource in storeturnrage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        //
        $emp_id = $req->input('emp_id');

        $emp = Employee::find($emp_id);

        $emp->name = $req->input('name');
        $emp->email = $req->input('email');
        $emp->phone = $req->input('phone');
        $emp->course = $req->input('course');
        $emp->update();

        //return redirect('/employee');
        return redirect()->back()->with('status','update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        //
        $emp_id = $req->input('emp_delete_id');

        $emp = Employee::find($emp_id);
        $emp->delete();
        return redirect()->back()->with('status','delete');
    }
}
