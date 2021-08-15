@extends('layouts.app')

@section('content')
{{-- Add Student Model --}}
<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student Model</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul id="save_err_list"></ul>
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" class=" name form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="text" class=" email form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Phone</label>
                <input type="text" class=" phone form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Course</label>
                <input type="text" class=" course form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_student">Save</button>
        </div>
      </div>
    </div>
</div>
{{-- End Student Model --}}
{{-- Edit Student Model --}}
<div class="modal fade" id="EditStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit & Update Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <ul id="update_err_list"></ul>
            <input type="hidden" id="edit_stud_id" >

            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" id="edit_name" class="name form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="text" id="edit_email" class="email form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Phone</label>
                <input type="text" id="edit_phone" class="phone form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Course</label>
                <input type="text" id="edit_course" class="course form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_student">Update Student</button>
        </div>
      </div>
    </div>
</div>

{{-- End Edit Student MOdel --}}



<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Students
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal" class="btn btn-primary float-end btn-sm">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            fetchstudent();

            function fetchstudent()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-students",
                    dataType: "json",
                    success: function (response) {
                        //console.log(response.students);
                        $('tbody').html("");
                        $.each(response.students, function (key, item) { 
                            $('tbody').append('<tr>\
                                <td>'+item.id+'</td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.email+'</td>\
                                <td>'+item.phone+'</td>\
                                <td>'+item.course+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                                <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                            </tr>'
                            )
                        });

                    }
                });
            }



            $('document').on('click','.update_student', function (e) {
                e.preventDefault();
                var stud_id = $('#edit_stud_id').val();
                var data = {
                    'name' : $('#edit_name').val(),
                    'email' : $('#edit_email').val(),
                    'phone' : $('#edit_phone').val(),
                    'course' : $('#edit_course').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-student/"+stud_id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        //console.log(response);
                        if(response.status == 400){
                            $('#update_err_list').html('');
                            $('#update_err_list').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) { 
                                $('#update_err_list').append('<li>'+err_value+'</li>');
                            });
                            
                        }else if(response.status == 404){
                            $('#update_err_list').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                        }else{
                            $('#update_err_list').html('');
                            $('#success_message').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);

                            $('#EditStudentModal').modal('hide');
                            fetchstudent();
                        }
                    }
                });
            });




            $(document).on('click','.edit_student', function (e) {
                e.preventDefault();
                var stud_id = $(this).val();
                
                $('#EditStudentModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-student/" + stud_id,
                    success: function (response) {
                       //console.log(response); 
                       if(response.message == 404){
                            $('#success_message').html('');
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                       }else{
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#edit_stud_id').val(stud_id);
                       }
                    }
                });
            });

            $(document).on('click','.add_student', function (e) {
                e.preventDefault();
                
                var data = {
                    'name' : $('.name').val(),
                    'email' : $('.email').val(),
                    'phone' : $('.phone').val(),
                    'course' : $('.course').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: "/student",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        //console.log(response);
                        if(response.status == 400)
                        {   
                            $('#save_err_list').html('');
                            $('#save_err_list').addClass('alert alert-danger');

                            $.each(response.errors, function (key, err_value) { 
                                $('#save_err_list').append('<li>'+err_value+'</li>');
                            });
                        }else{
                            $('#save_err_list').html('');
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#AddStudentModal').modal('hide');
                            $('#AddStudentModal').find('input').val('');
                            fetchstudent();
                        }
                    }
                });
            });
        });
    </script>
@endsection