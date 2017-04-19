<div id="modal-edit-grade" class="modal-edit">
    <div class="modal-content animate">
        <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
            <div>
                <h3 id="titleOfGrade"></h3>
                <span onclick="document.getElementById('modal-edit-grade').style.display='none'" class="close">&times;</span>
            </div>

            <input type="hidden" id="rowIndex">
            <input type="hidden" id="colIndex">

            <div class="form-group row">
                <label class="col-md-2">Subject: </label>
                <span id="subjectName" style="font-weight: bold" class="col-md-4">    </span>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Grade</label>
                <div class="col-10">
                    {!! Form::number('grade', "", array('id'=>'grade', 'required'=>'required', 'min' => 0, 'max' =>10, 'class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group row">
                <button class="form-control btn btn-primary" type="button" id="updateGrade">Update</button>
            </div>
        </div>
    </div>
</div>