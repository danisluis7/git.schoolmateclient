<div id="modal-view-parent" class="modal-view">
    <div class="modal-content animate" style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h2 class="page-header">Parent Information</h2>
            <span onclick="document.getElementById('modal-view-parent').style.display='none'" class="close">&times;</span>
            <div class="row">
                <div class="col-md-4">Name:</div>
                <div class="col-md-8" id="parentName">{{--{{$parent->email}}--}}</div>
            </div>
                <div class="row">
                    <div class="col-md-4">Email:</div>
                    <div class="col-md-8" id="parentEmail">{{--{{$parent->email}}--}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Phone Number:</div>
                    <div class="col-md-8" id="parentPhoneNumber">{{--{{$parent->phoneNumber}}--}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Birth Date:</div>
                    <div class="col-md-8" id="parentBirthDate">{{--{{$parent->group_parent->groupParentName}}--}}</div>
                </div>
            <div class="row">
                <div class="col-md-4">Address:</div>
                <div class="col-md-8" id="parentAddress">{{--{{$parent->phoneNumber}}--}}</div>
            </div>
        </div>
    </div>
</div>