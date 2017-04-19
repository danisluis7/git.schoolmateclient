<div id="modal-create" class="modal-create">
    {!! Form::open([ 'url' => 'user', 'method'=>'post', 'id' => 'formCreateUser','enctype' => "multipart/form-data",
                        'file'=>true,'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>New User</h3>
            <span onclick="document.getElementById('modal-create').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                {!! Form::email('email', "", array('id'=>'emailCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
            <div class="col-10">
                {!! Form::text('phoneNumber', null, array('id'=>'phoneNumberCreate', 'required'=>'required', 'pattern'=>".{10,}", 'maxlength'=>13,
                                                            'title'=>"Please enter phone number has between 10 - 13 characters", 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-2 col-form-label">Password</label>
            <div class="col-10">
                {!! Form::password('password', array('id'=>'passwordCreate', 'required'=>'required', 'class' => 'form-control', 'placeholder' => 'Enter your password')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-2 col-form-label">Confirm Password</label>
            <div class="col-10">
                {!! Form::password('confirmPassword', array('required'=>'required', 'class' => 'form-control', 'placeholder' => 'Retype your password')) !!}
            </div>
        </div>


        <div class="form-group row">
            <label for="exampleInputFile">Avatar</label>
            {!! Form::file('avatar', array('id'=>'avatarCreate','required'=>'required', 'class' => 'form-control-file', 'aria-describedby'=>'fileHelp')) !!}
            <small id="fileHelp" class="form-text text-muted">This is picture will be your profile picture</small>
        </div>


        <div class="form-group row">
            <label for="exampleSelect1">Group User</label>
            {!! Form::select('groupUserID', array(), null, array('id'=>'groupUserIDCreate','class'=>'form-control')) !!}
        </div>
{{--
        <div class="form-group row">
            <label for="exampleSelect2"  class="col-2 col-form-label">Permission</label>
            <div class="col-10" id="listPermissionsCreate" style="display:inline-block">
            </div>
        </div>--}}


        <div class="form-group row">
            <button class="form-control btn btn-primary glyphicion glyphicon-plus" type="submit" id="createUser"> Add</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>