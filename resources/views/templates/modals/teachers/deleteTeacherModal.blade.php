<div id="modal-del-teacher" class="modal-del">
    <form class="modal-content animate" action="" method="post">
        <div style="padding-left: 46px; padding-right: 46px; padding-bottom: 46px;">
            <div>
                <h3>Do you want to delete this teacher?</h3>
                <span onclick="document.getElementById('modal-del-teacher').style.display='none'" class="close">&times;</span>
            </div>

            <div class="modal-footer">
                {!! Form::open(['method'=>'delete', 'id' => 'formDeleteTeacher']) !!}
                <input type="hidden" id="hiddenTeacherID">
                <button type="button" onclick="deleteTeacher();" class= "btn btn-info">Accept</button>
                <button type="button" class="btn btn-danger" id="close-deleteModal">Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </form>
</div>