@extends('templates.master')
@section('content')
    <h2 class="page-header">Student Management</h2>

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

            <button class="btn btn-primary" name="btnCreateStudent"><span class="glyphicon glyphicon-plus"></span> New Student</button>
            <table id="studentsTable" class="table table-responsive table-condensed" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Birth Date</th>
                    <th>Avatar</th>
                    <th>Parent Name</th>
                    <th>Class Name</th>
                    <th>Bus Number</th>
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
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>


            <button class="btn btn-primary" name="btnCreateStudent"><span class="glyphicon glyphicon-plus"></span> New Student</button>

            {{--Modal Create Student--}}
            @include('templates.modals.students.viewStudentModal')

            {{--Modal Create Student--}}
            @include('templates.modals.students.createStudentModal')

            {{--Modal Edit Student--}}
            @include('templates.modals.students.editStudentModal')

            {{--Modal Delete Student--}}
            @include('templates.modals.students.deleteStudentModal')

            {{--Modal Loading--}}
            @include('templates.modals.loadingModal')

            @endsection

            @section('js')
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#studentsTable').dataTable({
                            ajax:'{!! route('studentDataTables') !!}',
                            lengthMenu:[[5,10,15,-1],[5,10,15,'All']]
                        });
                    });
                    function showViewStudent(studentID){
                        $.ajax({
                            url:'{!! url('/student')!!}'+'/'+studentID,
                            data:{studentID:studentID},
                            dataType: 'json',
                            type:"GET",
                            beforeSend: function(){
                                $('#modal-loading').css('display', 'block');
                            }

                        })
                            .done(function(data){
                                if(data != null){
                                    console.log(data);
                                    $('#studentEmail').text(data['studentEmail']);
                                    $('#studentPhoneNumber').text(data['studentPhone']);
                                    $('#groupStudentName').text(data['studentName']);
                                    $('#studentBirthDate').text(data['studentBirthDate']);
                                    $('#studentAddress').text(data['studentAddress']);
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-view').css('display', 'block');
                                }else {
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-not-found').css('display', 'block');
                                }

                            });
                    };

                    $('button[name="btnCreateStudent"]').click(function(){
                        $.ajax({
                            url:'{!! route('objectsRelativeToStudent') !!}',
                            type:'GET',
                            dataType: 'json',
                            beforeSend: function () {
                                $('#modal-loading').css('display', 'block');
                            }
                        })
                            .done(function (data) {
                                console.log(data);
                                $('#parentID').empty();
                                $('#classIDCreate').empty();
                                $('#busID').empty();
                                listParents = '';
                                $.each(data['parents'], function (index, parent) {
                                    listParents += "<option value='" + parent['parentID'] + "'>" + parent['parentName'] + "</option>";
                                });
                                $('#parentIDCreate').append(listParents);

                                listClasses = '';
                                $.each(data['classes'], function (index, classObject) {
                                    listClasses += "<option value='" + classObject['classID'] + "'>" + classObject['className'] + "</option>";
                                });
                                $('#classIDCreate').append(listClasses);

                                listBuses = '';
                                $.each(data['buses'], function (index, bus) {
                                    listBuses += "<option value='" + bus['busID'] + "'>" + bus['busNumber'] + "</option>";
                                });
                                $('#busIDCreate').append(listBuses);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-create-student').css('display', 'block');
                            });
                    });

                    $('#createStudent').click(function () {
                        /*form = document.getElementById('formCreateStudent');
                         form.submit();*/
                        $('#formCreateStudent').valid();
                    });

                    function showDeleteStudent(studentID){
                        $('#hiddenStudentID').val(studentID);
                        $('#modal-del-student').css('display', 'block');
                    }

                    function showEditStudent(studentID){
                        $.ajax({
                            url:'{!! url('/student')!!}'+'/'+studentID+"/edit",
                            data:{studentID:studentID},
                            dataType: 'json',
                            type:"GET",
                            beforeSend: function(){
                                $('#modal-loading').css('display', 'block');
                            }

                        })
                            .done(function(data){
                                //console.log(data);
                                $('#studentNameEdit').val([data['studentName']])
                                $('#studentEmailEdit').val(data['studentEmail']);
                                $('#studentPhoneEdit').val(data['studentPhone']);
                                $('#studentBirthDateEdit').val(data['studentBirthDate']);
                                $('#studentAddressEdit').val(data['studentAddress']);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-edit-student').css('display', 'block');


                            });
                    }

                    $('#updateStudent').click(function () {
                        form = document.getElementById('formEditStudent');
                        var studentID =  document.getElementById('hiddenEditStudentID').value;
                        form.action = 'student/'+studentID;
                        form._method.value = 'PUT';
                        form.submit();
                    });

                    function deleteStudent(){
                        form = document.getElementById('formDeleteStudent');
                        var studentID =  document.getElementById('hiddenStudentID').value;
                        form.action = 'student/'+studentID;
                        form._method.value = 'DELETE';
                        form.submit();
                    }


                    $('#close-deleteModal').click(function(){
                        $('#modal-del-student').css('display', 'none');
                    });

                    /*Validate form create*/
                    $('#formCreateStudent').validate({
                        rules: {
                            studentName: {
                                required: true,
                                lettersOnly: true   //This call from validation.js

                            },
                            studentEmail: {
                                email:true,
                                required:true
                            },
                            studentPhone:{
                                required:true,
                                phoneNumber: true,  //This call from validation.js
                                minlength:10,
                                maxlength:13
                            },
                            studentBirthDate:{
                                required: true
                            },
                            studentAddress: {
                                required: true
                            }

                        },
                        messages:{
                            studentName: {
                                lettersOnly:"Letters only please",
                                required:"This field is required"
                            },
                            studentEmail: {
                                email:"Please enter a right email format",
                                required:"This field is required"
                            },
                            studentPhone:{
                                required:"This field is required",
                                minlength:"This field must be more than 10 characters",
                                maxlength:"This fiels must be less than 13 character",
                                phoneNumber: "This is not phone number format"
                            },
                            studentBirthDate:{
                                required:"This field is required",
                            },
                            studentAddress:{
                                required:"This field is required",
                            }
                        },
                        success:function() {
                            /*form = document.getElementById('formCreateStudent');
                             form.submit();*/
                        }
                    });

                </script>
@endsection