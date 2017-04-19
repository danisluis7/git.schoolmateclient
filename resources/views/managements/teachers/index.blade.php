@extends('templates.master')
@section('content')
    <h2 class="page-header">Teacher Management</h2>

    @if(isset($status))
        @if($status == 'OK')<div class="alert alert-success alert-dismissable fade in">
            @else <div class="alert alert-danger alert-dismissable fade in">
                @endif
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>
                    @foreach($description as $des)
                        {{$des}}<br>
                    @endforeach
                </strong>
            </div>
            @endif

            <button class="btn btn-primary" name="btnCreateTeacher"><span class="glyphicon glyphicon-plus"></span> New Teacher</button>
            <table id="teachersTable" class="table table-responsive table-condensed" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>


            <button class="btn btn-primary" name="btnCreateTeacher"><span class="glyphicon glyphicon-plus"></span> New Teacher</button>

            {{--Modal Create Teacher--}}
            @include('templates.modals.teachers.viewTeacherModal')

            {{--Modal Create Teacher--}}
            @include('templates.modals.teachers.createTeacherModal')

            {{--Modal Edit Teacher--}}
            @include('templates.modals.teachers.editTeacherModal')

            {{--Modal Delete Teacher--}}
            @include('templates.modals.teachers.deleteTeacherModal')

            {{--Modal Loading--}}
            @include('templates.modals.loadingModal')

            @endsection

            @section('js')
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#teachersTable').dataTable({
                            ajax:'{!! route('teacherDataTables') !!}',
                            lengthMenu:[[5,10,15,-1],[5,10,15,'All']]
                        });
                    });
                    function showViewTeacher(teacherID){
                        $.ajax({
                            url:'{!! url('/teacher')!!}'+'/'+teacherID,
                            data:{teacherID:teacherID},
                            dataType: 'json',
                            type:"GET",
                            beforeSend: function(){
                                $('#modal-loading').css('display', 'block');
                            }

                        })
                            .done(function(data){
                                if(data != null){
                                    console.log(data);
                                    $('#teacherEmail').text(data['teacherEmail']);
                                    $('#teacherPhoneNumber').text(data['teacherPhone']);
                                    $('#groupTeacherName').text(data['teacherName']);
                                    $('#teacherBirthDate').text(data['teacherBirthDate']);
                                    $('#teacherAddress').text(data['teacherAddress']);
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-view').css('display', 'block');
                                }else {
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-not-found').css('display', 'block');
                                }

                            });
                    };

                    $('button[name="btnCreateTeacher"]').click(function(){
                        $('#modal-create-teacher').css('display', 'block');
                    });

                    $('#createTeacher').click(function () {
                        /*form = document.getElementById('formCreateTeacher');
                         form.submit();*/
                        $('#formCreateTeacher').valid();
                    });

                    function showDeleteTeacher(teacherID){
                        $('#hiddenTeacherID').val(teacherID);
                        $('#modal-del-teacher').css('display', 'block');
                    }

                    function showEditTeacher(teacherID){
                        $.ajax({
                            url:'{!! url('/teacher')!!}'+'/'+teacherID+"/edit",
                            data:{teacherID:teacherID},
                            dataType: 'json',
                            type:"GET",
                            beforeSend: function(){
                                $('#modal-loading').css('display', 'block');
                            }

                        })
                            .done(function(data){
                                //console.log(data);
                                $('#teacherNameEdit').val([data['teacherName']])
                                $('#teacherEmailEdit').val(data['teacherEmail']);
                                $('#teacherPhoneEdit').val(data['teacherPhone']);
                                $('#teacherBirthDateEdit').val(data['teacherBirthDate']);
                                $('#teacherAddressEdit').val(data['teacherAddress']);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-edit-teacher').css('display', 'block');


                            });
                    }

                    $('#updateTeacher').click(function () {
                        form = document.getElementById('formEditTeacher');
                        var teacherID =  document.getElementById('hiddenEditTeacherID').value;
                        form.action = 'teacher/'+teacherID;
                        form._method.value = 'PUT';
                        form.submit();
                    });

                    function deleteTeacher(){
                        form = document.getElementById('formDeleteTeacher');
                        var teacherID =  document.getElementById('hiddenTeacherID').value;
                        form.action = 'teacher/'+teacherID;
                        form._method.value = 'DELETE';
                        form.submit();
                    }


                    $('#close-deleteModal').click(function(){
                        $('#modal-del-teacher').css('display', 'none');
                    });

                    /*Validate form create*/
                    $('#formCreateTeacher').validate({
                        rules: {
                            teacherName: {
                                required: true,
                                lettersOnly: true   //This call from validation.js

                            },
                            teacherEmail: {
                                email:true,
                                required:true
                            },
                            teacherPhone:{
                                required:true,
                                phoneNumber: true,  //This call from validation.js
                                minlength:10,
                                maxlength:13
                            },
                            teacherBirthDate:{
                                required: true
                            },
                            teacherAddress: {
                                required: true
                            }

                        },
                        messages:{
                            teacherName: {
                                lettersOnly:"Letters only please",
                                required:"This field is required"
                            },
                            teacherEmail: {
                                email:"Please enter a right email format",
                                required:"This field is required"
                            },
                            teacherPhone:{
                                required:"This field is required",
                                minlength:"This field must be more than 10 characters",
                                maxlength:"This fiels must be less than 13 character",
                                phoneNumber: "This is not phone number format"
                            },
                            teacherBirthDate:{
                                required:"This field is required",
                            },
                            teacherAddress:{
                                required:"This field is required",
                            }
                        },
                        success:function() {
                            /*form = document.getElementById('formCreateTeacher');
                             form.submit();*/
                        }
                    });

                </script>
@endsection