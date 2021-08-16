<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments=Department::paginate(5);
        return view('admin.department.index',compact('departments'));
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

    public function edit($id){
        $department = Department::find($id);
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request , $id){
     //ตรวจสอบข้อมูล
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
        $update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('department')->with('success',"อัพเดจข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}
