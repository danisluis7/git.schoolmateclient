@extends('templates.master')
@section('content')
    <h2 class="page-header">Parent Management</h2>

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

    <button class="btn btn-primary" name="btnCreateParent"><span class="glyphicon glyphicon-plus"></span> New Parent</button>
    <table id="parentsTable" class="table table-responsive table-condensed" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
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


    <button class="btn btn-primary" name="btnCreateParent"><span class="glyphicon glyphicon-plus"></span> New Parent</button>

    {{--Modal Create Parent--}}
    @include('templates.modals.parents.viewParentModal')

    {{--Modal Create Parent--}}
    @include('templates.modals.parents.createParentModal')

    {{--Modal Edit Parent--}}
    @include('templates.modals.parents.editParentModal')

    {{--Modal Delete Parent--}}
    @include('templates.modals.parents.deleteParentModal')

    {{--Modal Loading--}}
    @include('templates.modals.loadingModal')

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#parentsTable').dataTable({
                ajax:'{!! route('parentDataTables') !!}',
                lengthMenu:[[5,10,15,-1],[5,10,15,'All']]
            });
        });
        function showViewParent(parentID){
            $.ajax({
                url:'{!! url('/parent')!!}'+'/'+parentID,
                data:{parentID:parentID},
                dataType: 'json',
                type:"GET",
                beforeSend: function(){
                    $('#modal-loading').css('display', 'block');
                }

            })
                .done(function(data){
                    if(data != null){
                        console.log(data);
                        $('#parentEmail').text(data['parentEmail']);
                        $('#parentPhoneNumber').text(data['parentPhone']);
                        $('#groupParentName').text(data['parentName']);
                        $('#parentBirthDate').text(data['parentBirthDate']);
                        $('#parentAddress').text(data['parentAddress']);
                        $('#modal-loading').css('display', 'none');
                        $('#modal-view').css('display', 'block');
                    }else {
                        $('#modal-loading').css('display', 'none');
                        $('#modal-not-found').css('display', 'block');
                    }

                });
        };

        $('button[name="btnCreateParent"]').click(function(){
            $('#modal-create-parent').css('display', 'block');
        });

        $('#createParent').click(function () {
            /*form = document.getElementById('formCreateParent');
            form.submit();*/
            $('#formCreateParent').valid();
        });

        function showDeleteParent(parentID){
            $('#hiddenParentID').val(parentID);
            $('#modal-del-parent').css('display', 'block');
        }

        function showEditParent(parentID){
            $.ajax({
                url:'{!! url('/parent')!!}'+'/'+parentID+"/edit",
                data:{parentID:parentID},
                dataType: 'json',
                type:"GET",
                beforeSend: function(){
                    $('#modal-loading').css('display', 'block');
                }

            })
            .done(function(data){
                //console.log(data);
                $('#parentNameEdit').val([data['parentName']])
                $('#parentEmailEdit').val(data['parentEmail']);
                $('#parentPhoneEdit').val(data['parentPhone']);
                $('#parentBirthDateEdit').val(data['parentBirthDate']);
                $('#parentAddressEdit').val(data['parentAddress']);

                $('#modal-loading').css('display', 'none');
                $('#modal-edit-parent').css('display', 'block');


            });
        }

        $('#updateParent').click(function () {
            form = document.getElementById('formEditParent');
            var parentID =  document.getElementById('hiddenEditParentID').value;
            form.action = 'parent/'+parentID;
            form._method.value = 'PUT';
            form.submit();
        });

        function deleteParent(){
            form = document.getElementById('formDeleteParent');
            var parentID =  document.getElementById('hiddenParentID').value;
            form.action = 'parent/'+parentID;
            form._method.value = 'DELETE';
            form.submit();
        }


        $('#close-deleteModal').click(function(){
            $('#modal-del-parent').css('display', 'none');
        });

        /*Validate form create*/
        $('#formCreateParent').validate({
            rules: {
                parentName: {
                  required: true,
                    lettersOnly: true   //This call from validation.js

                },
                parentEmail: {
                    email:true,
                    required:true
                },
                parentPhone:{
                    required:true,
                    phoneNumber: true,  //This call from validation.js
                    minlength:10,
                    maxlength:13
                },
                parentBirthDate:{
                    required: true
                },
                parentAddress: {
                    required: true
                }

            },
            messages:{
                parentName: {
                    lettersOnly:"Letters only please",
                    required:"This field is required"
                },
                parentEmail: {
                    email:"Please enter a right email format",
                    required:"This field is required"
                },
                parentPhone:{
                    required:"This field is required",
                    minlength:"This field must be more than 10 characters",
                    maxlength:"This fiels must be less than 13 character",
                    phoneNumber: "This is not phone number format"
                },
                parentBirthDate:{
                    required:"This field is required",
                },
                parentAddress:{
                    required:"This field is required",
                }
            },
            success:function() {
                /*form = document.getElementById('formCreateParent');
                form.submit();*/
            }
        });

    </script>
@endsection