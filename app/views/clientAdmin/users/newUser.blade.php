@extends('layouts.clientAdmin.master')
@section('content')
<style>
	input{
		padding: 2px;
	}
	.w-box-content {
		padding:20px;

	}
	.form-horizontal.pa .control-label {
		float: left;
		width: 80px;
		text-align: left;
	}
	.form-horizontal.pa input {
		padding-right: 15px;
	}
</style>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header" style="position:static; border-right:1px solid #ddd">

							<div class="pull-left">User Registeration</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">
									@if(Session::has('message'))
									<div class="alert alert-success pa" >
										{{Session::get('message')}}
									</div>
									@endif
									@if(Session::has('errorMessage'))
									<div class="alert alert-error pa">
										{{Session::get('errorMessage')}}
									</div>
									@endif
									<div class="heading">
										<h4 class="form-heading pa" >User Information</h4>
									</div>

									<div class="row-fluid">
										<div class="span6">

											{{Form::open(array('class'=>'form-horizontal pa','url'=> URL::route('newuserPost')))}}

											<div class="control-group">
												{{Form::label('first_name','First Name',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('first_name','',array('placeholder'=>'','autocomplete'=>"off"))}}
													@if($errors->has('first_name'))
													<div class="formErrors">
														<ul>
															@foreach($errors->get('first_name') as $message)
															<li>
																{{$message}}
															</li>
															@endforeach
														</ul>
													</div>
													@endif
												</div>
											</div>

											<div class="control-group">
												{{Form::label('last_name','Last Name',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('last_name','',array('placeholder'=>''))}}
													@if($errors->has('last_name'))
													<div class="formErrors">
														<ul>
															@foreach($errors->get('last_name') as $message)
															<li>
																{{$message}}
															</li>
															@endforeach
														</ul>
													</div>
													@endif
												</div>
											</div>
										

											<div class="control-group">
												{{Form::label('email','Email',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::text('email','',array('placeholder'=>''))}}
													@if($errors->has('email'))
													<div class="formErrors">
														<ul>
															@foreach($errors->get('email') as $message)
															<li>
																{{$message}}
															</li>
															@endforeach
														</ul>
													</div>
													@endif
												</div>
											</div>

											<div class="control-group">
												{{Form::label('password','Password',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::password('password',array('placeholder'=>''))}}
													@if($errors->has('password'))
													<div class="formErrors">
														<ul>
															@foreach($errors->get('password') as $message)
															<li>
																{{$message}}
															</li>
															@endforeach
														</ul>
													</div>
													@endif
												</div>
											</div>

											<div class="control-group">
												{{Form::label('passwordConfirm','passwordConfirm',array('class'=>'control-label'))}}
												<div class="controls">
													{{Form::password('passwordConfirm',array('placeholder'=>''))}}
													@if($errors->has('passwordConfirm'))
													<div class="formErrors">
														<ul>
															@foreach($errors->get('passwordConfirm') as $message)
															<li>
																{{$message}}
															</li>
															@endforeach
														</ul>
													</div>
													@endif
												</div>
											</div>

									


											<div class="pull-right" style="padding-right: 102px;">
												
												{{form::submit('Submit',array('class'=>'btn-danger btn-large '))}}
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

@section('scripts')
<script type="text/javascript">
$(function() {
   $('input').bind('keydown',function(){
       if($(this).next('.formErrors').length){
           $(this).next('.formErrors').hide();
       }
   });

});
</script>
@stop