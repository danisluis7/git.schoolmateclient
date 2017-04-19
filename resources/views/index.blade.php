@extends('templates.master')
@section('content')
    <div>
        <center>
            <h3 align="left">Dashboard</h3>
            <p align="left">Welcome back <span>Management Student's Academic Progress</span></p>
        </center>
    </div>
    @if(isset($message))
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{$message}}</strong>
        </div>
    @endif
    <div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a id="btn-display-add" class="btn btn-primary" style="color:white; font-weight: bold;" href="#" data-toggle="modal" data-target="">Add new record</a>
            </div>
        </div>
        <table class="table table-responsive table-bordered table-hover">
            <thead>
            <tr>
                <th class="bg-primary">Index</th>
                <th class="bg-primary">First Name</th>
                <th class="bg-primary">Last Name</th>
                <th class="bg-primary">Email</th>
                <th class="bg-primary">Phone</th>
                <th class="bg-primary">Address</th>
                <th class="bg-primary">Username</th>
                <th class="bg-primary">Password</th>
                <th class="bg-primary col-md-1">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a id="btn-display-edit" data-toggle="modal-edit" data-target="" href="#"><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a id="btn-display-del" data-toggle="modal-del" data-target="" href="#"><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a href=""><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a href=""><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a href=""><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a href=""><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a href=""><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a href=""><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a href=""><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a href=""><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Nguyen</td>
                <td>Vuong</td>
                <td>vuongluis@hotmail.com</td>
                <td>+84972248187</td>
                <td>Hoa Khanh Bac Village, Lien Chieu District, Da Nang City</td>
                <td>vuongluis</td>
                <td>••••••••••</td>
                <td class="actionBtn">
                    <a href=""><span class="edit btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
                    <a href=""><span class="delete btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <center>
            <ul class="pagination">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="disabled"><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
        </center>
    </div>
@endsection