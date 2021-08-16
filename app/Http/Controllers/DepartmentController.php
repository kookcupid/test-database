<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department.index');
    }
//ตรวจสอบข้อมูล
    public function store(Request $request){
        $request->validate(
            [
                'department_name'=>'required|unique:departments|max:255 '
            ],

             [
                'department_name.required'=>"กรุณาป้อนชื่อแผนก",
                'department_name.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
                'department_name.unique'=>"มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว"

             ]
        );
        //บันทึกข้อมูล
        // $department = new Department;
        // $department->department_name = $request ->department_name;
        // $department->user_id = Auth::user()->id;
        // $department->save();
        $data = array();
        $data["department_name"] = $request->department_name;
        $data["user_id"] = Auth::user()->id;

        //query builder
        DB::table('departments')->insert($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
}
