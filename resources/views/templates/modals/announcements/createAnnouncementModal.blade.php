<div id="modal-create-announce" class="modal-create">
    {!! Form::open([ 'url' => 'announcement', 'method'=>'post', 'id' => 'formCreateAnnounce','enctype' => "multipart/form-data",
                        'file'=>true, 'class' => "modal-content animate"]) !!}
        <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
            <div>
                <h3>Post Announcement</h3>
                <span onclick="document.getElementById('modal-create-announce').style.display='none'" class="close">&times;</span>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <!-- Row -->
            <div class="row">
                <!-- Assigned Event button for every tab bar -->
                <div class="tabBar">
                    <a class="tabBarChild" onclick="openCity('SchoolFees')">School Fees</a>
                    <a class="tabBarChild" onclick="openCity('Examination')">Examination</a>
                    <a class="tabBarChild" onclick="openCity('Conferences')">Conferences</a>
                    <a class="tabBarChild" onclick="openCity('SchoolActivities')">School Activities</a>
                </div>
                <!-- Tab Navigation Bar -->
                <div id="SchoolFees" class="tabannouncement specialform" style="width:100%;height:auto; margin-left: 14px;">
                    <label for="example-text-input" class="col-form-label">Please choose which class's group</label>
                    {{ Form::select('gradeName', [
                        'grade6' => 'Grade 6',
                        'grade7' => 'Grade 7',
                        'grade8' => 'Grade 8',
                        'grade9' => 'Grade 9'
                    ], null, array('id'=>'gradeName','class'=>'form-control')) }}
                    <label for="example-text-input" class="col-form-label">Please confirm send announcement</label>
                    {{ Form::checkbox('agreeschoolfee', 'yes') }}
                </div>

                <div id="Examination" class="tabannouncement" style="width:100%;height:auto; display: none;">
                    <div class="row">
                        <div class="col-md-3" style="margin-top: 0px;">
                            <label for="example-text-input" class="col-form-label">Class:</label>
                            {!! Form::select('classID', array(), null, array('id'=>'classID','class'=>'form-control')) !!}
                        </div>
                        <div class="col-md-3" style="margin-top: 0px;">
                            <label for="example-text-input" class="col-form-label">Subject:</label>
                            {!! Form::select('subjectName', array(), null, array('id'=>'subjectName','class'=>'form-control')) !!}
                        </div>
                        <div class="col-md-3" style="margin-top: 10px;">
                            <label for="example-text-input" class="col-form-label">Time:</label>
                            {{ Form::select('time', [
                                'a' => '15 Minutes',
                                'b' => '30 Minutes',
                                'c' => '45 Minutes',
                                'd' => 'Midterm',
                                'e' => 'Final examination'
                            ], null, array('id'=>'time','class'=>'form-control')) }}
                        </div>
                        <div class="col-md-3" style="margin-top: 10px;">
                            <label for="example-text-input" class="col-form-label">Teacher:</label>
                            {!! Form::select('teacherName', array(), null, array('id'=>'teacherName','class'=>'form-control')) !!}
                        </div>
                        <label for="example-text-input" class="col-form-label">Please confirm send announcement</label>
                        {{ Form::checkbox('agreeschoolexam', 'yes') }}
                    </div>
                </div>
                <div id="Conferences" class="tabannouncement" style="width:100%;height:auto; display: none;">
                    <div class="row">
                        <div class="col-md-12 specialform" style="margin-top: 0px; margin-left: 12px;">
                            <label for="example-text-input" class="col-form-label">Class:</label>
                            {{ Form::select('groupClassName', [
                                'grade6' => 'Grade 6',
                                'grade7' => 'Grade 7',
                                'grade8' => 'Grade 8',
                                'grade9' => 'Grade 9'
                            ], null, array('id'=>'groupClassName','class'=>'form-control')) }}
                        </div>
                    </div>
                    <label for="example-text-input" class="col-form-label">Please confirm send announcement</label>
                    {{ Form::checkbox('agreeschoolconference', 'yes') }}
                </div>
                <div id="SchoolActivities" class="tabannouncement" style="width:100%;height:auto; display: none;">
                </div>

                <!-- These informations need to fill in in this form -->
                <div id="announcementOfForm" style="width:100%;height:auto">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Title</label>
                        <div class="col-10">
                            {!! Form::text('announcementTitle', "", array('id'=>'announceTitleCreate', 'required'=>'required', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Description</label>
                        <div class="col-10">
                            {!! Form::text('announcementDescription', "", array('id'=>'announceDescriptionCreate', 'required'=>'required', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group row specialform">
                        <label for="example-text-input" class="col-2 col-form-label">Content</label>
                        <div class="col-10">
                            {{ Form::textarea('announcementContent', null, array('size' => '30x5', 'id'=>'announcementContentCreate', 'required'=>'required', 'class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group row specialform">
                        <button class="form-control btn btn-primary  glyphicion glyphicon-plus" type="submit" id="createAnnounce"> Add</button>
                    </div>
                </div>

            </div><!-- End Row -->
    </div>
    {!! Form::close() !!}
</div>