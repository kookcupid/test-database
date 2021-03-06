<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดีคุณ {{Auth::user()->name}}          
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">  
                    @if(session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลแผนก</div>
                        <table class="table table-bordered">
                         <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อแผนก</th>
                                <th scope="col">ชื่อพนักงาน</th>
                                <th scope="col">Create_at</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                         <tbody>
                            @php($i=1)
                            @foreach($departments as $row)
                            <tr>
                                <th>{{$departments->firstItem()+$loop->index}}</th>
                                <td>{{$row->department_name}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    @if($row->created_at == NULL)
                                        ไม่ถูกนิยาม
                                    @else
                                    {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a>
                                </td>
                                <td>
                                    <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-danger">ลบข้อมูล</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{$departments->links()}}
                    </div>
                </div>
                <div class="col-md-4"> 
                    <div class="card"> 
                    <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">
                        <form action="{{route('addDepartment')}}" method="post">
                            @csrf
                            <div class="=form-group">
                            <label for="department_name">ชื่อแผนก</label>
                            <input type="text" class="form-control" name="department_name">
                            </div>
                            @error('department_name')
                                <div class="my-2">
                                <span class="text-danger my-2">{{$message}}</span>
                                </div>
                            @enderror
                            <br>
                            <input type="submit" value="บันทึก" class="btn btn-primary"> 
                        </form>
                    </div>
                </div>       
            </div>
        </div>
    </div>
</x-app-layout>
