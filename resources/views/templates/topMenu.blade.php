<div class="row" id="topMenu">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div align="left" id="drawer-btn">
                <!-- Todo something -->
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <ul align="left" class="nav navbar-nav">
                <div class="inner-addon right-addon">
                    <i class="glyphicon glyphicon-search" style="color: rgb(206, 240, 234);"></i>
                    {!! Form::open(['url' => '/search', 'method' => 'post', 'id'=>'searchForm']) !!}
                        {!! Form::text('search', null, array('class' => 'form-control', 'placeholder' => 'Search')) !!}
                    {!! Form::close() !!}
                </div>
            </ul>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="rightTopMenu">
        <div align="right">
            <i class="fa fa-comment" aria-hidden="true"></i>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <i class="fa fa-power-off" aria-hidden="true"></i>
        </div>
    </div>
</div>