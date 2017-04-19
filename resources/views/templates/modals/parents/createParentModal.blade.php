<div id="modal-create-parent" class="modal-create">
    {!! Form::open([ 'url' => 'parent', 'method'=>'post', 'id' => 'formCreateParent', 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>New Parent</h3>
            <span onclick="document.getElementById('modal-create-parent').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Name</label>
            <div class="col-10">
                {!! Form::text('parentName', "", array('id'=>'parentNameCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Email</label>
            <div class="col-10">
                {!! Form::email('parentEmail', "", array('id'=>'parentEmailCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
            <div class="col-10">
                {!! Form::text('parentPhone', null, array('id'=>'parentPhoneCreate', 'required'=>'required', 'pattern'=>".{10,}", 'maxlength'=>13,
                                                            'title'=>"Please enter phone number has between 10 - 13 characters", 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Birth Date</label>
            <div class="col-10">
                {!! Form::date('parentBirthDate', "", array('id'=>'parentBirthDateCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Address</label>
            <div class="col-10">
                {!! Form::text('parentAddress', "", array('id'=>'parentAddressCreate', 'required'=>'required', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <button class="form-control btn btn-primary glyphicion glyphicon-plus" type="submit" id="createParent"> Add</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>