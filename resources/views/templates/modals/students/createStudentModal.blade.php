<div id="modal-create-student" class="modal-create">
    {!! Form::open([ 'url' => 'student', 'method'=>'post', 'id' => 'formCreateStudent','enctype' => "multipart/form-data",
                        'file'=>true, 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>New Student</h3>
            <span onclick="document.getElementById('modal-create-student').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Name</label>
            <div class="col-10">
                {!! Form::text('studentName', "", array('id'=>'studentNameCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Sex</label>
            <div class="col-10">
                {!! Form::radio ('studentSex', "Male", array('class' => 'form-control')) !!} Male
                {!! Form::radio ('studentSex', "Female", array('class' => 'form-control')) !!} Female
            </div>
        </div>


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Birth Date</label>
            <div class="col-10">
                {!! Form::date('studentBirthDate', "", array('id'=>'studentBirthDateCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="exampleInputFile">Avatar</label>
            {!! Form::file('avatar', array('id'=>'avatarCreate','required'=>'required', 'class' => 'form-control-file', 'aria-describedby'=>'fileHelp')) !!}
            <small id="fileHelp" class="form-text text-muted">This is picture will be your profile picture</small>
        </div>

        <div class="form-group row">
            <label for="exampleSelect1">Parent</label>
            {!! Form::select('parentID', array(), null, array('id'=>'parentIDCreate','class'=>'form-control')) !!}
        </div>

        <div class="form-group row">
            <label for="exampleSelect1">Class</label>
            {!! Form::select('classID', array(), null, array('id'=>'classIDCreate','class'=>'form-control')) !!}
        </div>

        <div class="form-group row">
            <label for="exampleSelect1">Bus Number</label>
            {!! Form::select('busID', array(), null, array('id'=>'busIDCreate','class'=>'form-control')) !!}
        </div>

        <div class="form-group row">
            <button class="form-control btn btn-primary glyphicion glyphicon-plus" type="submit" id="createStudent"> Add</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>