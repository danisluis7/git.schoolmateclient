<div id="modal-view-teacher" class="modal-view">
    <div class="modal-content animate" style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h2 class="page-header">Teacher Information</h2>
            <span onclick="document.getElementById('modal-view-teacher').style.display='none'" class="close">&times;</span>
            <div class="row">
                <div class="col-md-4">Name:</div>
                <div class="col-md-8" id="teacherName">{{--{{$teacher->email}}--}}</div>
            </div>
                <div class="row">
                    <div class="col-md-4">Email:</div>
                    <div class="col-md-8" id="teacherEmail">{{--{{$teacher->email}}--}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Phone Number:</div>
                    <div class="col-md-8" id="teacherPhone">{{--{{$teacher->phoneNumber}}--}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Birth Date:</div>
                    <div class="col-md-8" id="teacherBirthDate">{{--{{$teacher->group_teacher->groupTeacherName}}--}}</div>
                </div>
            <div class="row">
                <div class="col-md-4">Address:</div>
                <div class="col-md-8" id="teacherAddress">{{--{{$teacher->phoneNumber}}--}}</div>
            </div>
        </div>
    </div>
</div>