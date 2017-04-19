@extends('templates.master')
@section('content')
    <h2 class="page-header">Time Table Management</h2>
    {!! Form::open(array('class' => 'form-inline')) !!}
    <div class="row form-group">
            {!! Form::label('listClasses', 'Choose Class:') !!}
            {!! Form::select('listClasses', array(),null, array('id'=>'listClassesID', 'class' => 'form-control', 'style' =>'margin-right:15px') ) !!}

            {!! Form::label('listClasses', 'Choose Week:') !!}
            {!! Form::select('listWeeks', array(),null, array('id'=>'listWeeksID', 'class' => 'form-control', 'style' =>'margin-right:15px') ) !!}

            {!! Form::button('', array('id' => 'viewTimeTable', 'class' => 'btn btn-success form-control glyphicon glyphicon-search')) !!}
    </div>

    <div class="table-responsive" id="timetableContent">
        <table id="timetable" class="table table-hover table-bordered table-condensed table-striped">
            <thead>
                <th></th> <!--lesson title -->
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </thead>
            <tbody id="timetableBody">

            </tbody>


        </table>
    </div>

    {!! Form::close() !!}


    {{--Modal Loading--}}
    @include('templates.modals.loadingModal')
@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function(){
            //Load listClasses
           $.ajax({
               url:'{!! route('class.index') !!}',
               type:'GET',
               dataType:'json',
               success: function (data) {
                   $('#listClassesID').empty();
                   $('#listClassesID').append("<option value>Please choose class</option>");
                   $.each(data, function(index, classObject){
                       $('#listClassesID').append("<option value='"+classObject['classID']+"'>"+classObject['className']+"</option>");
                   })

               }
           });

            //Load listWeeks
            $.ajax({
                url:'{!! route('weeksOfYear') !!}',
                type:'GET',
                dataType:'json',
                success: function (data) {
                    $('#listWeeksID').empty();
                    $('#listWeeksID').append("<option value>Please choose Week of Year</option>");
                    $.each(data['weeksOfYear'], function(index, weekObject){
                        $('#listWeeksID').append("<option value='"+weekObject['weekOfYear']+"'>"+weekObject['weekOfYear']+"</option>");
                    })

                }
            });
        });

        $('button#viewTimeTable').on('click', function () {
            classID = $('select#listClassesID option:selected').val();
            date = $('select#listWeeksID option:selected').val();
            if(classID && date){
                /*TODO*/
                $.ajax({
                    url: '{!! url('/timetableDataTables')!!}'+"?classID="+classID+"&date="+date,
                    type:'GET',
                    dataType:'json',
                    beforeSend: function () {
                        $('#modal-loading').css('display', 'block');
                    }
                }).done(function (data) {
                    //console.log(data);
                    $('#timetableBody').empty();
                    $.each(data['lessons'], function(index, lesson){
                        if(index == 5 ){
                            $('#timetableBody').append(
                                "<tr style='height:50px; background:#b1e3e5'>" +
                                "<td>" + lesson['lessonTime'] + "</td>" +
                                "<td colspan='6' style='text-align: center'>Lunch Time</td>" +
                                "</tr>"
                            );
                        }
                        else {
                            $('#timetableBody').append(
                                "<tr>" +
                                    "<td>" + lesson['lessonTime'] + "</td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                "</tr>"
                            );
                        }
                    });

                    $.each(data['timetables'], function (index, timetable){
                        rowIndex = timetable['lesson']['lessonID'];
                        //1console.log(rowIndex);
                        // DayOfWeek from 0:Sunday to 6:Saturday
                        colIndex = (new Date(timetable['plan_for_day']['date']).getDay()); //get DateOfWeek
                        //add timetable has lessonID  to table(row, colIndex)
                        element = "<input name='timetableID' type='hidden' value='"+timetable['timetableID']+"'> <p>"+timetable['subject']['subjectName']+"</p>"+
                            ((timetable['teacher'] != null)?
                                ("<p class='timetable-teacherName'> ("+timetable['teacher']['teacherName']+")</p>")
                                :"");
                        if(timetable['subject']['subjectName'] == "Vacation"){
                            $('table#timetable').find('tr').eq(rowIndex).find('td').eq(colIndex).append(element);
                        }else
                            $('table#timetable').find('tr').eq(rowIndex).find('td').eq(colIndex).append(element);

                    });

                    $('#modal-loading').css('display', 'none');
                });
            }else alert("Please choose both class and date");
        });

        //Set onClick for each cell
        $('table#timetable tbody').on('click', 'tr td',function (subject){
            timetableID = $(this).find('input').val();
           alert(timetableID);
        });
    </script>
@endsection