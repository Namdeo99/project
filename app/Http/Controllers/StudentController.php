<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Validator;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('student.index');
    }
    
    public function fetchstudents()
    {
        $students = Student::all();
        return response()->json([
            'students'=>$students,
        ]);
        //return view('student.index');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'course' => 'required|max:191',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $student = new Student;
            $student->name = $req->input('name');
            $student->email = $req->input('email');
            $student->phone = $req->input('phone');
            $student->course = $req->input('course');
            $student->save();
            return response()->json([
                'status'=>200,
                'message'=>'Student Added Successfully',
            ]);
        }
        
    }

    public function edit($id)
    {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Student Not Found',
            ]);
        }
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'course' => 'required|max:191',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $student = Student::find($id);

            if($student){
                $student->name = $req->input('name');
                $student->email = $req->input('email');
                $student->phone = $req->input('phone');
                $student->course = $req->input('course');
                $student->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Student Update Successfully',
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Student Not Found',
                ]);
            }

            
        }
    }
}
