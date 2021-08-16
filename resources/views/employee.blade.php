@extends('layouts.app')
@section('content')
<h1>Employee</h1>


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



<div class="card-header">
    <h4>Employee
        <a href="#" data-bs-toggle="modal" data-bs-target="#AddEmployeeModal" class="btn btn-primary float-end btn-sm">Add Employee</a>
    </h4>
</div>

@endsection