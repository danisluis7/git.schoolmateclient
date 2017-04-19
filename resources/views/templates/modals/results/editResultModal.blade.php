<div id="modal-edit-result" class="modal-edit">
    {!! Form::open(['method'=>'put', 'id' => 'formEditResult', 'class' => "modal-content animate"]) !!}
    <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
        <div>
            <h3>Edit Result</h3>
            <span onclick="document.getElementById('modal-edit-result').style.display='none'" class="close">&times;</span>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" id="hiddenEditResultDetailID">


        <div class="form-group row">
            <label class="col-md-2">Student: </label>
                <span id="studentName" style="font-weight: bold" class="col-md-4">    </span>
            <label  class="col-md-2">Subject: </label>
                <span id="subjectName" style="font-weight: bold" class="col-md-4">    </span>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Oral Test</label>
            <div class="col-10">
                {!! Form::number('oralTest', "", array('id'=>'oralTest', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">15 mins 1</label>
            <div class="col-10">
                {!! Form::number('15mins1', "", array('id'=>'15mins1', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>


        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">15 mins 2</label>
            <div class="col-10">
                {!! Form::number('15mins2', "", array('id'=>'15mins2', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">45 mins 1</label>
            <div class="col-10">
                {!! Form::number('45mins1', "", array('id'=>'45mins1', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">45 mins 2</label>
            <div class="col-10">
                {!! Form::number('45mins2', "", array('id'=>'45mins2', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Final</label>
            <div class="col-10">
                {!! Form::number('final', "", array('id'=>'final', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group row">
            <button class="form-control btn btn-primary" type="button" id="updateResult">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>