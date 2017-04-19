<div id="modal-edit-teacher" class="modal-edit">
    {!! Form::open(['method'=>'put', 'id' => 'formEditTeacher', 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>Edit Teacher</h3>
            <span onclick="document.getElementById('modal-edit-teacher').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" id="hiddenEditTeacherID">


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Name</label>
            <div class="col-10">
                {!! Form::text('teacherName', "", array('id'=>'teacherNameEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                {!! Form::email('teacherEmail', "", array('id'=>'teacherEmailEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
            <div class="col-10">
                {!! Form::text('teacherPhone', null, array('id'=>'teacherPhoneEdit', 'required'=>'required', 'pattern'=>".{10,}", 'maxlength'=>13,
                                                            'title'=>"Please enter phone number has between 10 - 13 characters", 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Birth Date</label>
            <div class="col-10">
                {!! Form::date('teacherBirthDate', "", array('id'=>'teacherBirthDateEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Address</label>
            <div class="col-10">
                {!! Form::text('teacherAddress', "", array('id'=>'teacherAddressEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>


        <div class="form-group row">
            <button class="form-control btn btn-primary" type="button" id="updateTeacher">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>