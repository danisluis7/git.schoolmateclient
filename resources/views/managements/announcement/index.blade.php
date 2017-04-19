@extends('templates.master')
@section('content')
    <h2 class="page-header">Announcement Management</h2>

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

            <button class="btn btn-primary" name="btnCreateAnnounce"><span class="glyphicon glyphicon-plus"></span> New Announcement</button>
            <table id="announceTable" class="table table-responsive table-condensed" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Type</th>
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
            @include('templates.modals.announcements.viewAnnouncementModal')

            {{--Modal Create Teacher--}}
            @include('templates.modals.announcements.createAnnouncementModal')

            {{--Modal Edit Teacher--}}
            @include('templates.modals.announcements.editAnnouncementModal')

            {{--Modal Delete Teacher--}}
            @include('templates.modals.announcements.deleteAnnouncementModal')

            {{--Modal Loading--}}
            @include('templates.modals.loadingModal')

            @endsection

            @section('js')  <!-- yield() -->
                <script type="text/javascript">
                    /** VIEW
                     *  get Concern Object: GroupAnnouncement, Announcement
                     *  call Server(not AnnouncementController) http://localhost:8000/announcement
                     * **/
                    $(document).ready(function(){
                        $('#announceTable').dataTable({
                            ajax:'{!! route('announcementDataTables') !!}',
                            lengthMenu:[[5,10,15,-1],[5,10,15,'All']]
                        });
                    });
                    function showViewAnnouncement(announcementID){
                        $.ajax({
                            url:'{!! url('/announcement')!!}'+'/'+announcementID,
                            data:{announcementID:announcementID},
                            dataType: 'json',
                            type:"GET",
                            beforeSend: function(){
                                $('#modal-loading').css('display', 'block');
                            }

                        })
                            .done(function(data){
                                if(data != null){
                                    console.log(data);
                                    $('#announcementTitle').text(data['announcementTitle']);
                                    $('#announcementDescription').text(data['announcementDescription']);
                                    $('#announcementContent').text(data['announcementContent']);
                                    $('#announcementDate').text(data['announcementDateCreated']);
                                    $('#groupAnnouncementID').text(data['groupAnnouncementID']);
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-view').css('display', 'block');
                                }else {
                                    $('#modal-loading').css('display', 'none');
                                    $('#modal-not-found').css('display', 'block');
                                }
                            });
                    };
                    // VIEW

                    /** VIEW
                     *  VIEW CHILD [FORM, PAGE CHILD]
                     *  GET OBJECT: GroupAnnouncement
                     *  CALL OBJECT: AnnouncementController() by route('objectsRelativeToAnnouncement')
                     * **/
                    $('button[name="btnCreateAnnounce"]').click(function(){
                        $.ajax({
                            url:'{!! route('class.index') !!}',
                            type:'GET',
                            dataType: 'json',
                            beforeSend: function () {
                                $('#modal-loading').css('display', 'block');
                            }
                        })
                            .done(function (data) {
                                console.log(data);
                                $('#classID').empty();
                                listClasses = '';
                                $.each(data['classes'], function (index, group) {
                                    listClasses += "<option value='" + group['className'] + "'>" + group['className'] + "</option>";
                                });
                                $('#classID').append(listClasses);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-create-announce').css('display', 'block');
                            });

                        $.ajax({
                            url:'{!! route('subject.index') !!}',
                            type:'GET',
                            dataType: 'json',
                            beforeSend: function () {
                                $('#modal-loading').css('display', 'block');
                            }
                        })
                            .done(function (data) {
                                console.log(data);
                                $('#subjectName').empty();
                                listSubjects = '';
                                $.each(data['subjects'], function (index, group) {
                                    listSubjects += "<option value='" + group['subjectName'] + "'>" + group['subjectName'] + "</option>";
                                });
                                $('#subjectName').append(listSubjects);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-create-announce').css('display', 'block');
                            });

                        $.ajax({
                            url:'{!! route('comboboxteacher') !!}',
                            type:'GET',
                            dataType: 'json',
                            beforeSend: function () {
                                $('#modal-loading').css('display', 'block');
                            }
                        })
                            .done(function (data) {
                                console.log(data);
                                $('#teacherName').empty();
                                listTeachers = '';
                                $.each(data['teachers'], function (index, group) {
                                    listTeachers += "<option value='" + group['teacherName'] + "'>" + group['teacherName'] + "</option>";
                                });
                                $('#teacherName').append(listTeachers);

                                $('#modal-loading').css('display', 'none');
                                $('#modal-create-announce').css('display', 'block');
                            });
                    });
                    /** Process view in form **/
                    function openCity(cityName) {
                        var i;
                        var x = document.getElementsByClassName("tabannouncement");
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = "none";
                        }
                        document.getElementById(cityName).style.display = "block";
                        /**
                         * Check jquery
                         */
                        $(".tabBarChild").on("click", function(event){
                            event.preventDefault();
                            $(".tabBarChild").removeClass("active");
                            $(this).addClass("active");
                        });
                    }

                    /** VALIDATE
                     *  VALIDATE JQUERY CLIENT:
                     *  YOU: Custom validate: required or maxlenght,....
                     * **/
                    $('#createAnnounce').click(function () {
                        $('#formCreateAnnounce').valid();
                    });
                    // VALIDATE

                    /** VALIDATE
                     *  VALIDATE JQUERY CLIENT:
                     *  YOU: Custom validate: required or maxlenght,....
                     * **/
                    $('#formCreateAnnounce').validate({
                        rules: {
                            announceTitle: {
                                required: true,
                                maxlength:50
                            },
                            announceDescription: {
                                required:true,
                                maxlength: 255
                            },
                            announceContent:{
                                required:true,
                            }
                        },
                        messages:{
                            announceTitle: {
                                required:"The title cannot be blank"
                            },
                            announceDescription: {
                                required:"The description cannot be blank",
                                maxlength:"The description is required less than 255 characters"
                            },
                            announceContent:{
                                required:"The content cannot be blank"
                            }
                        },
                        success:function() {
                            /** Post data into AnnouncementController()
                             * Method: POST
                             * Return Succesfully
                             * */
                        }
                    });
                    /**
                     * GOTO CONTROLLER: Continue validation value of announcement before go to server.
                     * @param teacherID
                     */


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
                </script>
@endsection