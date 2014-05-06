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
                    <a class="brand" href="/user/admin"><i class="icon-home icon-white"></i> Customer Service DB</a>
                    <ul class="nav user_menu pull-right">
                       <!--  <li class="hidden-phone hidden-tablet">
                            <div class="nb_boxes clearfix">
                                <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New Messages">25 <i class="splashy-mail_light"></i></a>
                                <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="Pending Files">10 <i class="splashy-calendar_week"></i></a>
                            </div>
                        </li> -->
                        
                        <li class="divider-vertical hidden-phone hidden-tablet"></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform:capitalize;">{{ Sentry::getUser()->getUserFirstName() }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL::route('Profile', Sentry::getUser()->id )}}">My Profile</a></li>
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
       <!--  <div class="modal hide fade" id="myMail">
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
        <div class="modal hide fade" id="myTasks">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>Pending Files</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info pa">Here you can see list of pending files which are uploaded by staff</div>
                <table class="table table-condensed table-striped" data-rowlink="a">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>staff name</th>
                        <th>date</th>
                        <th>priority</th>
                        <th>status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>P-23</td>
                        <td><a href="javascript:void(0)">Admin should not break if URL&hellip;</a></td>
                        <td>23/05/2012</td>
                        <td class="tac"><span class="label label-important">High</span></td>
                        <td>Open</td>
                    </tr>
                    <tr>
                        <td>P-18</td>
                        <td><a href="javascript:void(0)">Displaying submenus in custom&hellip;</a></td>
                        <td>22/05/2012</td>
                        <td class="tac"><span class="label label-warning">Medium</span></td>
                        <td>Reopen</td>
                    </tr>
                    <tr>
                        <td>P-25</td>
                        <td><a href="javascript:void(0)">Featured image on post types&hellip;</a></td>
                        <td>22/05/2012</td>
                        <td class="tac"><span class="label label-success">Low</span></td>
                        <td>Updated</td>
                    </tr>
                    <tr>
                        <td>P-10</td>
                        <td><a href="javascript:void(0)">Multiple feed fixes and&hellip;</a></td>
                        <td>17/05/2012</td>
                        <td class="tac"><span class="label label-warning">Medium</span></td>
                        <td>Open</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn">Go to task manager</a>
            </div>
        </div> -->
    </header>
	
	@include('layouts.clientAdmin.sideMenuClientAdmin')
	
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