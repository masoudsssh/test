<!-- sidebar -->

<div class="sidebar pa">

	<div >
		<div >
			<div class="">

				<div class="sidebar_inner">

					<div id="side_accordion" class="accordion">



						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="{{URL::route('clientAdmin')}}" data-parent="#side_accordion" data-toggle="" class="accordion-toggle">
									<i class="icon-list-alt"></i> Dashboard
								</a>
							</div>                            
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
									<i class="icon-list-alt"></i> Display All Files
								</a>
							</div>     
							<div class="accordion-body  collapse" id="collapseOne">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="{{URL::route('viewFiles')}}">Uploaded Records</a></li>
                                        <li><a href="{{URL::route('viewDuplicatedFiles')}}">Duplicated Records</a></li>                                       
                                        <li><a href="{{URL::route('viewMonthYearFiles')}}">Month-Year Records</a></li> 
                                        <li><a href="{{URL::route('viewMasterFiles')}}">Master Records</a></li> 
                                    </ul>

                                </div>
                            </div>                       
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="{{URL::route('importFile')}}" data-parent="#side_accordion" data-toggle="" class="accordion-toggle">
									<i class="icon-list-alt"></i> Import File
								</a>
							</div>                            
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="{{URL::route('viewExportFile')}}" data-parent="#side_accordion" data-toggle="" class="accordion-toggle">
									<i class="icon-list-alt"></i> Export File
								</a>
							</div>                            
						</div>

						<div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#collapseFive" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                <i class="icon-user"></i> Users
                                </a>
                            </div>
                            <div class="accordion-body  collapse" id="collapseFive">
                                <div class="accordion-inner">
                                    <ul class="nav nav-list">
                                        <li><a href="{{URL::route('newuser')}}">Create New User</a></li>
                                        <li><a href="{{URL::route('viewusers')}}">List of Users</a></li>                                       
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="{{URL::route('viewSystemLog')}}" data-parent="#side_accordion" data-toggle="" class="accordion-toggle">
                                <i class="icon-tasks"></i> System Log
                                </a>
                            </div>
                        </div>


					</div>

					<div class="push"></div>
				</div>

				

			</div>
		</div>
	</div>

	<div style="background-color:white; width:31px; float:right; height: 100%; position: absolute; top: 0px; left: 240px;"></div>
</div>
