<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Service DataBase</title>


    @section('stylesheets')
    @include('layouts.partials.stylesheets')
    @show


    @include('layouts.partials.scripts')



</head>
<body class="">
<div id="loading_layer" style="display:none"><img src="/img/ajax_loader.gif" alt="" /></div>

<div id="maincontainer" class="clearfix">
    <!-- header -->
    <header>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid"> <!-- {{URL::route('loginPost')}} -->
                    <a class="brand" href="#"><i class="icon-home icon-white"></i> Customer Service DB</a>
                    <ul class="nav user_menu pull-right">
                        <li class="hidden-phone hidden-tablet">
                            <div class="nb_boxes clearfix">
                                <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New Messages">25 <i class="splashy-mail_light"></i></a>
                            </div>
                        </li>
                        
                        <li class="divider-vertical hidden-phone hidden-tablet"></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform:capitalize;">{{ Sentry::getUser()->getUserFirstName() }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">My Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{URL::route('logout')}}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                        <span class="icon-align-justify icon-white"></span>
                    </a>

                </div>
            </div>
        </div>
        <div class="modal hide fade" id="myMail">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3 >New Messages</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info pa">Here, you can see new messages.</div>
                <table class="table table-condensed table-striped" data-rowlink="a">
                    <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Size</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Declan Pamphlett</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>23/05/2012</td>
                        <td>25KB</td>
                    </tr>
                    <tr>
                        <td>Erin Church</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>24/05/2012</td>
                        <td>15KB</td>
                    </tr>
                    <tr>
                        <td>Koby Auld</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2012</td>
                        <td>28KB</td>
                    </tr>
                    <tr>
                        <td>Anthony Pound</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2012</td>
                        <td>33KB</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn">Go to mailbox</a>
            </div>
        </div>
    </header>
	
	@include('layouts.caller.sideMenuCaller')
	
    <!-- main content -->
    <div id="contentwrapper">
        <div class="main_content">

            @include('layouts.partials.breadcrumb')

            @section('content')
            @show


        </div>
    </div>

  

</div>
@section('scripts')
@show
</body>
</html>