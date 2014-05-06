@section('content')
<style>
	a[title='New Messages'], #stopwatch{ display:none; }
</style>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header" style="position:static; border-right:1px solid #ddd">
							<div class="pull-left">Profile</div> 
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12 ">
									<div class="row-fluid" >
									<div class="center loader" style="width: 80px; margin: 0px auto; display: none;" id="registerLoader1">
											<p style="padding-right: 26px;"><img src="/img/loaderSmall.gif" style="width:25px"></p>
											<p class="loaderMessage" style="font-size: 12px;">loading</p>
									</div>
									
									<?php if( Session::has('msg-success')){ ?>
									<div class="alert alert-success" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; line-height: 25px;" id="msg-success1"> 
										{{Session::get('msg-success')}} 
									</div>
									<?php }
									if( Session::has('msg')){										
									?>
										<div class="alert alert-error" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 8px;" id="msg-error1">
											{{Session::get('msg')}} 
										</div>    
									<?php } ?>
    



										{{Form::open(array('class'=>'form-horizontal','url'=>URL::route("storeCallerProfile") , 'files' => true))}}
										<div class="span6" style="float:left; width:460px; margin-top:60px;">	
											<div class="control-group">
												{{Form::label('first_name','First Name *',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('first_name', $user->first_name ,array('placeholder'=>'','autocomplete'=>"off"))}}
												</div>
											</div>

											<div class="control-group">
												{{Form::label('last_name','Last Name *',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('last_name', $user->last_name ,array('placeholder'=>''))}}
												</div>
											</div>


											<div class="control-group">
												{{Form::label('email','Email *',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('email',$user->email ,array('placeholder'=>'', 'autocomplete'=>"off"))}}
												</div>
											</div>

											<div class="pull-right" style="margin:0px 80px 30px 0px;">
												{{form::submit('Update',array('class'=>'btn btn-primary', 'style'=>'' ))}}												
											</div>

										</div>

										{{Form::close()}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
