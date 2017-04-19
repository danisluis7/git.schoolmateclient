@extends('templates.master')
@section('content')
    <h2 class="page-header">Result Management</h2>

    @if(isset($status))
        @if($status == 'OK')<div class="alert alert-success alert-dismissable fade in">
            @else <div class="alert alert-danger alert-dismissable fade in">
                @endif
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>
                        {{$description}}<br>
                </strong>
            </div>
            @endif

            {!! Form::open() !!}
                <div class="row">
                    <div class="col-md-3 form-group">
                        {!! Form::label('listClasses', 'Choose Class:') !!}
                        {!! Form::select('listClasses', $classesCollection,null, array('id'=>'listClassesID', 'class' => 'form-control', 'style' =>'margin-right:15px') ) !!}
                    </div>
                    <div class="col-md-4 form-group">
                        {!! Form::label('listStudents', 'Choose Student:') !!}
                        {!! Form::select('listStudents', array('' => 'Please choose Student'),null, array('id'=>'listStudentsID', 'class' => 'form-control', 'style' =>'margin-right:15px') ) !!}
                    </div>
                    <div class="col-md-4 form-group">
                        {!! Form::label('listSemesters', 'Choose Semester:') !!}
                        {!! Form::select('listSemesters', $semestersCollection,null, array('id'=>'listSemestersID', 'class' => 'form-control','style' =>'margin-right:15px') ) !!}
                    </div>
                    <div class="col-md-1 form-group">
                        {!! Form::button('', array('id' => 'viewResult', 'class' => 'btn btn-primary glyphicon glyphicon-search')) !!}
                    </div>
                </div>

            {!! Form::close() !!}

            <table id="resultsTable" class="table table-responsive table-condensed table-bordered" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
                <thead>
                <tr>
                    <th rowspan="2" style="text-align: center">Subject</th>
                    <th colspan="7" style="text-align: center">Grade</th>
                    <th rowspan="2" style="text-align: center">Teacher</th>
                    <th rowspan="2" style="text-align: center">Evaluation</th>
                    <th rowspan="2" style="text-align: center">Action</th>
                </tr>
                <tr>
                    <th>Oral Test</th>
                    <th>15 mins 1</th>
                    <th>15 mins 2</th>
                    <th>45 mins 1</th>
                    <th>45 mins 2</th>
                    <th>Final</th>
                    <th>Summary</th>
                </tr>
                </tbody>
            </table>

                {{--Modal Edit Result--}}
            @include('templates.modals.results.editResultModal')

            {{--Modal Loading--}}
            @include('templates.modals.loadingModal')

@endsection

            @section('js')
                <script type="text/javascript">
                    $('#viewResult').on('click', function(){
                        studentID = $('#listStudentsID').val();
                        semesterID = $('#listSemestersID').val();
                        if(studentID && semesterID){
                            $('#resultsTable').dataTable({
                                "bDestroy":true,
                                "bProcessing" : true,
                                "bServerSide" : true,
                                ajax:{
                                    type: "GET",
                                    url: '{!! route('resultDataTables') !!}',
                                    data:{"studentID":studentID , "semesterID":semesterID}
                                },
                                "language": {
                                    "zeroRecords": ""
                                    ,"emptyTable":     "No record for this semester"
                                },
                                lengthMenu:[[5,10,15,-1],[5,10,15,'All']],
                            });
                        }
                    });

                    $('#listClassesID').on('change', function(){
                       classID = $('#listClassesID').val();
                        if(classID != null){
                            $.ajax({
                                url:'{!! url('/studentByClass')!!}'+'/'+classID,
                                dataType: 'json',
                                type:"GET",
                                beforeSend: function(){
                                    $('#modal-loading').css('display', 'block');
                                }
                            }).done(function(data){
                                $('#listStudentsID').empty();
                                $('#listStudentsID').append("<option value>Please choose Student</option>");
                                $.each(data['students'], function(index, student){
                                    $('#listStudentsID').append("<option value='"+student['studentID']+"'>"+student['studentName']+"</option>")
                                });
                                $('#modal-loading').css('display', 'none');
                            });
                        }
                    });

                    function showEditResultDetail(resultDetailID){
                        $.ajax({
                                url:'{!! url('/result')!!}'+'/'+resultDetailID+"/edit",
                                dataType: 'json',
                                type:"GET",
                                beforeSend: function(){
                                    $('#modal-loading').css('display', 'block');
                                }

                            })
                            .done(function(data){
                                //console.log(data);
                                $('#hiddenEditResultDetailID').val(data['resultDetailID']);
                                $('#studentName').text(data['result']['student']['studentName']);
                                $('#subjectName').text(data['subject']['subjectName']);
                                $('#oralTest').val(data['oralTest']);
                                $('#15mins1').val(data['15 mins 1']);
                                $('#15mins2').val(data['15 mins 2']);
                                $('#45mins1').val(data['45 mins 1']);
                                $('#45mins2').val(data['45 mins 2']);
                                $('#final').val(data['final']);
                                $('#modal-loading').css('display', 'none');
                                $('#modal-edit-result').css('display', 'block');
                            });
                    }

                    $('#updateResult').click(function () {
                        form = document.getElementById('formEditResult');
                        var resultID =  $('#hiddenEditResultDetailID').val();
                        form.action = 'result/'+resultID;
                        form._method.value = 'PUT';
                        form.submit();
                    });

                </script>
@endsection