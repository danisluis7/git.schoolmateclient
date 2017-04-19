<div id="sidebar-wrapper">
    <div class="row" id="avatar">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <center><img src="{{URL::asset('resources/assets/images/avatar.png')}}" class="img-circle img-responsive" alt="avatar"> </center>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <center>
                <h4 align="left">Lorence <br>& Philip</h4>
                <p align="left">Danang University</p>
            </center>
        </div>
    </div>
    <div class="row" id="menu">
        <ul class="list-group">
            <li class="title list-group-item active">User Management</li>
            <li class="list-group-item" id="UserManagement">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>User Management</span></a>
                <span class="badge badge-success">3</span>
                <ul class="subMenu" id="UserManagementOk">
                    <li><a href="{{route('user.index')}}">User Account</a></li>
                    <li><a href="{{route('teacher.index')}}">Teacher Management</a></li>
                    <li><a href="{{route('parent.index')}}">Parent Management</a></li>
                    <li><a href="{{route('student.index')}}">Student Management</a></li>
                    <li><a href="{{route('announcement.index')}}">Announcement Management</a></li>
                    <li><a href="#">Bus Driver Management</a></li>
                    <li><a href="#">Bus Management</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="TimeTable">
                <a href="#" title="TimeTable"><span class="a"><i class="fa fa-calendar"></i></span>	<span>TimeTable</span></a>
                <ul class="subMenu" id="TimeTableOk">
                    <li><a href="{{route('timetable.index')}}">View TimeTable</a></li>
                    <li><a href="{{route('timetable.create')}}">Create New TimeTable</a></li>
                    <li><a href="{{route('timetable.reset')}}">Reset</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="UIElements">
                <a href="#"><span class="a"><i class="fa fa-id-card-o"></i></span>	<span>Learning Outcome</span></a>
                <span class="badge badge-warning badge-pill">2</span>
                <ul class="subMenu" id="UIElementsOk">
                    <li><a href="{{route('result.index')}}">View Learning Outome</a></li>
                    <li><a href="{{route('result.create')}}">Create new for Student</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="Widgets">
                <a href="#"><span class="a"><i class="fa fa-commenting-o"></i></span>	<span>Widgets</span></a>
                <span class="badge badge-info badge-pill">9</span>
                <ul class="subMenu" id="WidgetsOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="Pages">
                <a href="#"><span class="a"><i class="fa fa-cog"></i></span>	<span>Pages</span></a>
                <span class="badge badge-inverse badge-pill">14</span>
                <ul class="subMenu" id="PagesOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="title list-group-item active">Setting</li>
            <li class="list-group-item" id="Charts">
                <a href="#"><span class="a"><i class="fa fa-users"></i></span>	<span>Charts</span></a>
                <span class="badge badge-default badge-pill">11</span>
                <ul class="subMenu" id="ChartsOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="Tables">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>Tables</span></a>
                <span class="badge badge-default badge-pill">14</span>
                <ul class="subMenu" id="TablesOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="Maps">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>Maps</span></a>
                <span class="badge badge-error badge-pill">6</span>
                <ul class="subMenu" id="MapsOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="Typography">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>Typography</span></a>
                <span class="badge badge-success badge-pill">14</span>
                <ul class="subMenu" id="TypographyOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="MenuLevels">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>Menu Levels</span></a>
                <span class="badge badge-success badge-pill">10</span>
                <ul class="subMenu" id="MenuLevelsOk">
                    <li><a>Template Level 1</a></li>
                    <li><a>Template Level 2</a></li>
                    <li><a>Template Level 3</a></li>
                    <li><a>Template Level 4</a></li>
                </ul>
            </li>
            <li class="list-group-item" id="MenuLevels">
                <a href="#"><span class="a"><i class="fa fa-user"></i></span>	<span>Menu Levels</span></a>
                <span class="badge badge-success badge-pill">10</span>
                <ul class="subMenu" id="MenuLevelsOk">
                    <li><a>Template Level 1</a></li>
                    </li>
                </ul>
    </div>
</div><!-- sidebar-wrapper -->