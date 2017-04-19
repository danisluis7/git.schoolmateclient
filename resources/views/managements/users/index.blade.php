@extends('templates.master')
@section('content')
    <h2 class="page-header">User Management</h2>

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

    <button class="btn btn-primary" name="btnCreateUser"><span class="glyphicon glyphicon-plus"></span> New User</button>
    <table id="usersTable" class="table table-responsive table-condensed" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
        <thead>
        <tr>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Avatar</th>
            <th>Group</th>
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
        </tr>
        </tbody>
    </table>


    <button class="btn btn-primary" name="btnCreateUser"><span class="glyphicon glyphicon-plus"></span> New User</button>

    {{--Modal Create User--}}
    @include('templates.modals.users.viewUserModal')

    {{--Modal Create User--}}
    @include('templates.modals.users.createUserModal')

    {{--Modal Edit User--}}
    @include('templates.modals.users.editUserModal')

    {{--Modal Delete User--}}
    @include('templates.modals.users.deleteUserModal')

    {{--Modal Loading--}}
    @include('templates.modals.loadingModal')

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#usersTable').dataTable({
                ajax:'{!! route('userDataTables') !!}',
                lengthMenu:[[5,10,15,-1],[5,10,15,'All']]
            });
        });
        function showViewUser(userID){
            $.ajax({
                url:'{!! url('/user')!!}'+'/'+userID,
                data:{userID:userID},
                dataType: 'json',
                type:"GET",
                beforeSend: function(){
                    $('#modal-loading').css('display', 'block');
                }

            })
                .done(function(data){
                    if(data != null){
                        //console.log(data);
                        $('#userAvatar').attr('src', 'http://localhost:8000/resources/assets/images/'+data['avatar']);
                        $('#userEmail').text(data['email']);
                        $('#userPhoneNumber').text(data['phoneNumber']);
                        $('#groupUserName').text(data['group_user']['groupUserName']);
                        $('#modal-loading').css('display', 'none');
                        $('#modal-view').css('display', 'block');
                    }else {
                        $('#modal-loading').css('display', 'none');
                        $('#modal-not-found').css('display', 'block');
                    }

                });
        }

        $('button[name="btnCreateUser"]').click(function(){
            $.ajax({
                url:'{!! route('allGroupUser') !!}',
                type:'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('#modal-loading').css('display', 'block');
                }
            })
            .done(function (data) {
                //console.log(data);
                console.log(data['groupUser']);
                $('#groupUserIDCreate').empty();
                listGroup = '';
                $.each(data['groupUser'], function(index, groupUser){
                    listGroup+= "<option value='"+groupUser['groupUserID']+"'>"+groupUser['groupUserName']+"</option>";
                });
                $('#groupUserIDCreate').append(listGroup);

/*
                listPermissions = "";
                $.each(data['permissions'], function(key, value){
                    isChecked = false;
                   /!* $.each(data['groupUser']['permissions'], function(permissionIndex, permission){
                        if(permission['permissionID'] == value['permissionID']){
                            console.log(permission['permissionID']+" --- "+ value['permissionID']);
                            isChecked = true;
                            return;
                        }
                    });*!/
                    input = "<span class='col-md-4'><input type='checkbox' name='permissions' value='"+value['permissionID']+"' "+((isChecked)?'checked':'')+">"+value['permissionDescription']+"</span>";
                    listPermissions+=input;
                });
                $('#listPermissionsCreate').empty();
                $('#listPermissionsCreate').append(listPermissions);*/

                $('#modal-loading').css('display', 'none');
                $('#modal-create').css('display', 'block');
            });
        });

        $('#createUser').click(function () {
            form = document.getElementById('formCreateUser');
            form.submit();
        });

        function showDeleteUser(userID){
            $('#hiddenUserID').val(userID);
            $('#modal-del').css('display', 'block');
        }

        function showEditUser(userID){
            $.ajax({
                url:'{!! url('/user')!!}'+'/'+userID+"/edit",
                data:{userID:userID},
                dataType: 'json',
                type:"GET",
                beforeSend: function(){
                    $('#hiddenEditUserID').val(userID);
                    $('#modal-loading').css('display', 'block');
                }

            })
            .done(function(data){
                //console.log(data);
                $('#emailEdit').val(data['user']['email']);
                $('#phoneNumberEdit').val(data['user']['phoneNumber']);
                $('select[id="groupUserIDEdit"]').empty();
                $('select[id="groupUserIDEdit"]').append("<option value='"+data['user']['group_user']['groupUserID']+"'>"+data['user']['group_user']['groupUserName']+"</option>");

                listPermissions = "";
                $.each(data['permissions'], function(key, value){
                    isChecked = false;
                    $.each(data['user']['group_user']['permissions'], function(permissionIndex, permission){
                        if(permission['permissionID'] == value['permissionID']){
                            console.log(permission['permissionID']+" --- "+ value['permissionID']);
                            isChecked = true;
                            return;
                        }
                    });
                    input = "<span class='col-md-4'><input type='checkbox' name='permissions' value='"+value['permissionID']+"' "+((isChecked)?'checked':'')+">"+value['permissionDescription']+"</span>";
                    listPermissions+=input;
                });
                $('#listPermissionsEdit').empty();
                $('#listPermissionsEdit').append(listPermissions);

                $('#modal-loading').css('display', 'none');
                $('#modal-edit').css('display', 'block');

                //$('.ajax-loading').hide(); //hide loading animation once data is received

            });
        }

        $('#updateUser').click(function () {
            form = document.getElementById('formEditUser');
            var userID =  document.getElementById('hiddenEditUserID').value;
            form.action = form.action+"/"+userID;
            form._method.value = "PUT";
            form.submit();
        });

        function deleteUser(){
            form = document.getElementById('formDeleteUser');
            var userID =  document.getElementById('hiddenUserID').value;
            form.action = 'user/'+userID;
            form._method.value = 'DELETE';
            form.submit();
        }

        $('#close-deleteModal').click(function(){
            $('#modal-del').css('display', 'none');
        });

        /*Validate form create*/
        $('#formCreateUser').validate({
            rules: {
                email: {
                    email:true,
                    required:true
                },
                phoneNumber:{
                    required:true,
                    minlength:10,
                    maxlength:13
                },
                password:{
                    required:true,
                    minlength:6
                },
                confirmPassword:{
                    required:true,
                    equalTo: '#passwordCreate'
                }
            },
            messages:{
                email: {
                    email:"Please enter a right email format",
                    required:"This field is required"
                },
                phoneNumber:{
                    required:"This field is required",
                    minlength:"This field must be more than 10 characters",
                    maxlength:"This fiels must be less than 13 character"
                },
                password:{
                    required:"This field is required",
                    minlength:"This field must be more than 6 characters"
                },
                confirmPassword:{
                    required:"This field is required",
                    equalTo: 'Password is not equal'
                }
            },
            success:function() {
                /*form = document.getElementById('formCreateUser');
                form.submit();*/
            }
        });

    </script>
@endsection