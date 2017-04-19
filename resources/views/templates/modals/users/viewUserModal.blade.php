<div id="modal-view" class="modal-view">
    <div class="modal-content animate" style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h2 class="page-header">User Information</h2>
            <span onclick="document.getElementById('modal-view').style.display='none'" class="close">&times;</span>
            <div class="row">
                <div class="col-md-3">
                    <img id="userAvatar" src="" style="width: 100%; margin-right: 10px;" />
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8" id="userEmail">{{--{{$user->email}}--}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Phone Number:</div>
                        <div class="col-md-8" id="userPhoneNumber">{{--{{$user->phoneNumber}}--}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Group User:</div>
                        <div class="col-md-8" id="groupUserName">{{--{{$user->group_user->groupUserName}}--}}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>