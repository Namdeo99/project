@extends('layouts.app')
@section('content')
<h1>Employee</h1>

{{-- save employee model --}}
<div class="modal fade" id="AddEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('employee.save')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <ul id="save_err_list"></ul>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class=" name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class=" email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class=" phone form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Course</label>
                        <input type="text" name="course" class=" course form-control">
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </div>
            </form>
      </div>
    </div>
</div>

{{-- End save employee model --}}

{{-- edit employee model --}}
<div class="modal fade" id="editModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('update-employee')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="emp_id" id="emp_id">
                <div class="modal-body">
                    <ul id="save_err_list"></ul>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class=" name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class=" email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" class=" phone form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Course</label>
                        <input type="text" name="course" id="course" class=" course form-control">
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Update</button>
                </div>
            </form>
      </div>
    </div>
</div>

{{-- End edit employee model --}}

{{-- delete model --}}
<div class="modal fade" id="DeleteEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('delete-employee')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="emp_delete_id" id="emp_delete_id">
                <p>Confirm to delete data?</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary ">Yes Delete</button>
                </div>
            </form>
      </div>
    </div>
</div>
{{-- end delete model --}}


<div class="card">
    <div class="card-header">
        <h4>Employee
            <a href="#" data-bs-toggle="modal" data-bs-target="#AddEmployeeModal" class="btn btn-primary float-end btn-sm">Add Employee</a>
        </h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->course}}</td>
                            <td><button type="button" value="{{$item->id}}" class="btn btn-primary  btn-sm editbtn">Edit</button></td>
                            <td><button type="button" value="{{$item->id}}" class="btn btn-danger  btn-sm deletebtn">Delete</button></td>
                        </tr>
                    @endforeach
                    
                
            </tbody>
        </table>
    </div>
</div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $(document).on('click','.editbtn', function () {
                var emp_id = $(this).val();
                $('#editModel').modal('show');
                $.ajax({
                    type: "get",
                    url: "edit-employee/"+emp_id,
                    success: function (response) {
                        console.log(response);
                        $('#name').val(response.employee.name);
                        $('#email').val(response.employee.email);
                        $('#phone').val(response.employee.phone);
                        $('#course').val(response.employee.course);
                        $('#emp_id').val(emp_id);
                    }
                });
            });

            $(document).on('click','.deletebtn', function () {
                var emp_id = $(this).val();

                $('#DeleteEmployeeModal').modal('show');
                $('#emp_delete_id').val(emp_id)
            });

        });
    </script>
@endsection