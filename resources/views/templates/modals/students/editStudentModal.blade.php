<div id="modal-edit-student" class="modal-edit">
    {!! Form::open(['method'=>'put', 'id' => 'formEditStudent', 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>Edit Student</h3>
            <span onclick="document.getElementById('modal-edit-student').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" id="hiddenEditStudentID">


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Name</label>
            <div class="col-10">
                {!! Form::text('studentName', "", array('id'=>'studentNameEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                {!! Form::email('studentEmail', "", array('id'=>'studentEmailEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
            <div class="col-10">
                {!! Form::text('studentPhone', null, array('id'=>'studentPhoneEdit', 'required'=>'required', 'pattern'=>".{10,}", 'maxlength'=>13,
                                                            'title'=>"Please enter phone number has between 10 - 13 characters", 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Birth Date</label>
            <div class="col-10">
                {!! Form::date('studentBirthDate', "", array('id'=>'studentBirthDateEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Address</label>
            <div class="col-10">
                {!! Form::text('studentAddress', "", array('id'=>'studentAddressEdit', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>


        <div class="form-group row">
            <button class="form-control btn btn-primary" type="button" id="updateStudent">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>