<!DOCTYPE html>
<html>
<head>
    <title>Admin Template Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Favicon Zone -->
    <link rel="stylesheet" type="text/css" href="favicon.ico">
    <!-- Style && Bootstrap import -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('resources/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('resources/assets/css/style.css')}}">
    <!-- Use DataTables -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('resources/assets/css/jquery.dataTables.min.css')}}">
    <!-- Fonts google -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i" rel="stylesheet">
</head>

<body>
    <div id="wrapper" class="toggled">
        <!-- Side Bar Left -->
        @include('templates.sideBar')

        <!-- Content -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <!-- Top Menu -->
                @include('templates.topMenu')

                <!-- Main Content -->
                <div class="row" id="content" style="background-color: white;">
                    @yield('content')
                </div>
            </div>
        </div>

    </div> <!-- end wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Validation -->
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.validate.min.js')}}"></script>
    {{--Use Validation me customized--}}
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/validation.js')}}"></script>
    <!-- Use DataTables -->
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.dataTables.min.js')}}"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/bootstrap.min.js')}}"></script>
    <script src="https://use.fontawesome.com/71b5e27098.js"></script>

    <!-- Tutorial for instruction -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#drawer-btn').click(function(e){
                /** Todo **/
                e.preventDefault();
                $('#wrapper').toggleClass('toggled');
            });

            $('#btn-display-add').click(function(event) {
                event.preventDefault();
                $('#modal').css('display', 'block');
            });

            $('#btn-display-edit').click(function(event) {
                event.preventDefault();
                $('#modal-edit').css('display', 'block');
            });

            $('#btn-display-del').click(function(event) {
                event.preventDefault();
                $('#modal-del').css('display', 'block');
            });

        });

        $(document).ready(function(){
            $('#UserManagement').click(function(){
                /** Todo **/
                $('#UserManagementOk').slideToggle();
            });

            $('#TimeTable').click(function(){
                /** Todo **/
                $('#TimeTableOk').slideToggle();
            });

            $('#UIElements').click(function(){
                /** Todo **/
                $('#UIElementsOk').slideToggle();
            });

            $('#Widgets').click(function(){
                /** Todo **/
                $('#WidgetsOk').slideToggle();
            });

            $('#Pages').click(function(){
                /** Todo **/
                $('#PagesOk').slideToggle();
            });

            $('#Charts').click(function(){
                /** Todo **/
                $('#ChartsOk').slideToggle();
            });

            $('#Tables').click(function(){
                /** Todo **/
                $('#TablesOk').slideToggle();
            });

            $('#Maps').click(function(){
                /** Todo **/
                $('#MapsOk').slideToggle();
            });

            $('#Typography').click(function(){
                /** Todo **/
                $('#TypographyOk').slideToggle();
            });

            $('#MenuLevels').click(function(){
                /** Todo **/
                $('#MenuLevelsOk').slideToggle();
            });
        });

        // Get the modal
        var modal = document.getElementById('modal');
        var modaledit = document.getElementById('modal-edit');
        var modaldel = document.getElementById('modal-del');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modaledit) {
                modaledit.style.display = "none";
            }
            if (event.target == modaldel) {
                modaldel.style.display = "none";
            }
        }
    </script>

    @yield('js')

</body>
</html>