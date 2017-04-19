@foreach($resultDetails as $resultDetail)
    @if($resultDetail[0]->subjectName != null)
        <tr name='resultDetail'>
            <td name='subjectName'>{{$resultDetail[0]->subjectName}}</td>
            <td name='subjectID' style="display: none">{{$resultDetail[0]->subjectID}}</td>
            <td name='teacherName'>
                <select class="teacherName">
                    @php
                        foreach ($resultDetail[0]->teacher as $teacher){
                            echo "<option value='".$teacher->teacherID."'>".$teacher->teacherName."</option>";
                        }
                    @endphp
                </select>
            </td>
            <td class="teacherID" style="display: none">{{$resultDetail[0]->teacher[0]->teacherID}}</td>
            <td class="grade" name='oralTest'>{{$resultDetail[0]->oralTest}}</td>
            <td class="grade" name='15mins1'>{{ $resultDetail[0]->{'15mins1'} }}</td>
            <td class="grade" name='15mins2'>{{$resultDetail[0]->{'15mins2'} }}</td>
            <td class="grade" name='45mins1'>{{$resultDetail[0]->{'45mins1'} }}</td>
            <td class="grade" name='45mins2'>{{$resultDetail[0]->{'45mins2'} }}</td>
            <td class="grade" name='final'>{{$resultDetail[0]->final}}</td>
        </tr>
    @endif
@endforeach