<div id="modal-edit" class="modal-edit">
    {!! Form::open(['method'=>'PUT', 'id' => 'formEditUser','enctype' => "multipart/form-data",
                        'file'=>true, 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>Edit User</h3>
            <span onclick="document.getElementById('modal-edit').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" id="hiddenEditUserID" name="userID">

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                {!! Form::email('email', "", array('id'=>'emailEdit', 'disabled'=>'disabled', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label">New Password</label>
            <div class="col-10">
                {!! Form::password('password', array( 'class' => 'form-control', 'placeholder' => 'Enter your new Password')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-2 col-form-label">Confirm Password</label>
            <div class="col-10">
                {!! Form::password('confirmPassword', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
            <div class="col-10">
                {!! Form::text('phoneNumber', null, array('id'=>'phoneNumberEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="exampleInputFile">Avatar</label>
            {!! Form::file('avatar', array('id'=>'avatarEdit','required'=>'required', 'class' => 'form-control-file', 'aria-describedby'=>'fileHelp')) !!}
            <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
        </div>


        <div class="form-group row">
            <label for="exampleSelect1">Group User</label>
            {!! Form::select('groupUserIDSelect', array(), null, array('id'=>'groupUserIDEdit', 'class'=>'form-control', 'disabled'=>'disabled')) !!}
        </div>

        <div class="form-group row">
            <label for="exampleSelect2"  class="col-2 col-form-label">Permission</label>
            <div class="col-10" id="listPermissionsEdit" style="display:inline-block">
            </div>
        </div>


        <div class="form-group row">
            <button class="form-control btn btn-primary" type="button" id="updateUser">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>