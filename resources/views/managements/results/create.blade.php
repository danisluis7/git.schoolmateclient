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

    {!! Form::open(['route' =>'result.store', 'method' => 'POST','id' => 'createResultForm']) !!}
        <input type="hidden" name="_token" value="{{csrf_token()}}">
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
            {!! Form::button('', array('id' => 'createResult', 'class' => 'btn btn-primary glyphicon glyphicon-plus')) !!}
        </div>
    </div>

    {!! Form::close() !!}

    <div class="row">
        <button class="btn btn-primary" id="updateResult" name="updateResult" style="display: none;">
            <span class="glyphicon glyphicon-check"></span>
            Update all
        </button>
    </div>
    <hr>
    <table id="resultsTable" class="table table-responsive table-condensed table-bordered" style="font-size: 10px;margin: 0 auto; width: 100% !important;">
        <thead>
        <tr>
            <th style="text-align: center">Subject</th>
            <th style="display: none">subjectID</th>
            <th style="text-align: center">Teacher</th>
            <th style="display: none">teacherID</th>
            <th>Oral Test</th>
            <th>15 mins 1</th>
            <th>15 mins 2</th>
            <th>45 mins 1</th>
            <th>45 mins 2</th>
            <th>Final</th>
        </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
    <hr>
    <div class="row">
        <button class="btn btn-primary" id="updateResult" name="updateResult" style="display: none;">
            <span class="glyphicon glyphicon-check"></span>
            Update all
        </button>
    </div>

    {{--Modal Edit Grade--}}
    @include('templates.modals.results.editGradeModel')

    {{--Modal Loading--}}
    @include('templates.modals.loadingModal')

@endsection

@section('js')
    {{--Convert Table to JSON--}}
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.tabletojson.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.tabletojson.min.js')}}"></script>
    <script type="text/javascript">
        $('#createResult').on('click', function(){
            studentID = $('#listStudentsID').val();
            semesterID = $('#listSemestersID').val();
            if(studentID && semesterID){
                $.ajax({
                    url:'{!! route('getDataResultCreate')!!}',
                    data:{"classID":classID, "studentID":studentID , "semesterID":semesterID},
                    type:"GET",
                    beforeSend: function(){
                        $('#modal-loading').css('display', 'block');
                    }
                }).done(function(data){
                    $('table#resultsTable tbody').empty();
                    $('table#resultsTable tbody').append(data);
                    $('#modal-loading').css('display', 'none');
                    $('button[name="updateResult"]').css('display', 'block');
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


        //Set onClick for each cell
        $('table#resultsTable tbody').on('click', 'tr td.grade',function (subject){
            colIndex = $(this).index();
                $('#colIndex').val(colIndex);
            rowIndex = $(this).parent('tr').index();
                $('#rowIndex').val(rowIndex);
            grade = $(this).html();
            subjectName = $(this).parent('tr').find('td').eq(0).html();
                $('span#subjectName').text(subjectName);
            titleOfGrade = $('table#resultsTable thead').find('th').eq(colIndex).html();
                $('h3#titleOfGrade').text(titleOfGrade);
            $('#grade').val(grade);
            $('#modal-edit-grade').css('display', 'block');
            $('#grade').focus();
        });

        $('button#updateGrade').on('click', function(){
            rowIndex = $('#rowIndex').val();
            colIndex = $('#colIndex').val();
            gradeUpdate = $('#grade').val();
            $('table#resultsTable tbody').find('tr').eq(rowIndex).find('td').eq(colIndex).text(gradeUpdate);
            $('#modal-edit-grade').css('display', 'none');
        });

        /*Convert table to JSON and Update all result of table*/
        $('button#updateResult').on('click', function(){
            table = $('#resultsTable').tableToJSON({ignoreColumns:[0,2]});
            $.ajax({
                url: '{!! url('result') !!}',
                dataType: 'json',
                type:"POST",
                data:{  '_token':$('input[name="_token"]').val(),
                        'studentID': $('#listStudentsID').val(),
                        'semesterID':$('#listSemestersID').val(),
                        'tableJSON': JSON.stringify(table)
                    }
            }).done(function(data){
                if(data['message']['status'] == 'OK'){
                    alert("Update Result success");
                    window.location.href = '{!! route('result.index') !!}';
                }else
                    alert(data['message']['description'])
            })
        });

        $(document).on('change', 'select.teacherName', function(){
            $(this).parent('td').parent('tr').find('td.teacherID').html($(this).val());
        });

    </script>
@endsection