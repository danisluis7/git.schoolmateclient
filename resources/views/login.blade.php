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
    <!-- Fonts google -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i" rel="stylesheet">
</head>
<body class="login">
<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
</div>
<div id="login" class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <div class="avatar">
        <img class="img-responsive" src="{{URL::asset('resources/assets/images/avatar_login.png')}}" alt="logo">
    </div>

    {!! Form::open(['url' => 'login', 'method' => 'post']) !!}
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {!! Form::email('email', null, array('id'=>'email','required'=>'required','class' => 'form-control', 'placeholder' => 'Enter Email')) !!}
        {!! Form::password('password', array('id' => 'password', 'required'=>'required','class' => 'form-control', 'placeholder' => 'Enter Password')) !!}
        {!! Form::checkbox('keepSignIn', '', false) !!}Keep me signed in
        <br>{!! Form::submit('Log in', array('class' => 'btn btn-default')) !!}
    {!! Form::close() !!}

    {{--<form class="form-horizontal">
        <p>Welcome you to Management Student's Academic Progress</p>
        <input type="text" class="form-control" id="pwd" placeholder="Enter username">
        <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        <input type="checkbox"><span style="color:#009688; font-size: 16px;">Keep me signed in</span>
        <br><button class="btn" type="submit" class="btn btn-default">Submit</button>
    </form>--}}
</div>
</body>
</html>