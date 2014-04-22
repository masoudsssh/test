@extends('layouts.clientAdmin.master')
@section('content')
<style>
	input{
		padding: 2px;
	}
	.w-box-content {
		padding:20px;

	}
	.mediaTable th,.mediaTable td{
		text-align: right;
		direction: rtl;
	}
	.errorStyle{
		margin-top: 5px;
		margin-left: 10px;
		color:red;
		font-weight: bold;
	}
	.form-horizontal.pa .control-label {
		float: left;
		width: 105px;
		text-align: left;
	}
</style>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header"  style="position:static; border-right:1px solid #ddd">

							<div class="pull-left">Users List</div>
						</div>
						<div class="w-box-content">

							<div class="row-fluid">
								<div class="span12">
									<table class="table table-striped table-bordered  mediaTable "   >
										<thead>
											<tr>
												<th class="essential" ></th>
												<th class="essential"  style="text-align:left">First Name</th>
												<th class="optional"  style="text-align:left" >Last Name</th>
												<th class="optional"  style="text-align:left" >Email</th>
												<th class="optional"  style="text-align:left" >Last Login</th>
												<th class="essential" style="text-align:center">Password</th>
												<th class="essential" style="text-align:center">Remove</th>
											</tr>
										</thead>
										<tbody>
											@foreach(User::where('activated','<>','0')->orderBy('created_at','desc')->get() as $index => $user)
											<tr>	
												<td  class="essential"  style="text-align:left">{{$index +1}}</td>
												<td  class="optional"  style="text-align:left">{{$user->first_name}}</td>
												<td  class="optional firstname"  style="text-align:left">{{$user->last_name}}</td>
												<td  class="optional lastName"  style="text-align:left">{{$user->email}}</td>
												<td  class="optional email"  style="text-align:left">{{$user->last_login}}</td>
												<td  class="essential keepcenter" style="text-align:center">													
													<a data-toggle="modal" href="#changePasswordModal" title="Remove"  class="changePasswordButton"
														data-clientID={{$user->id}}>
															<li title="Click to change user password" style="cursor: pointer;list-style:none"><i class="splashy-lock_large_locked"></i></li>
													</a>
												</td>
												<td class="keepcenter" style="text-align:center">
													<button class="btn btn-danger deleteClientButton"  data-clientID={{$user->id}} >Remove <i class="icon-trash" style="margin-top: 2px;"></i> </button>
												</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>

						</div>
						<div class="w-box-footer center">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
<div id="changePasswordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">

		<h3 id="myModalLabel" class="pa">Change Password </h3>
	</div>
	<div class="modal-body">
		{{Form::open(array('class'=>'form-horizontal pa','url' => URL::route('updatePassword'), 'id'=>'changePasswordForm'))}}

		{{Form::hidden('clientID')}}
		<div class="control-group">
			{{Form::label('password','New Password',array('class'=>'control-label'))}}
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
			{{Form::label('passwordConfirm','Password Confirm',array('class'=>'control-label'))}}
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


	</div>
	<div class="modal-footer">
		<span class="response">
			<p class="pa alert alert-success" style="display:none;"></p>
			<img src="/img/loaderSmall.gif" style="display:none;">
		</span>
		<button class="btn closeModal" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<input type="submit" class="btn btn-primary" value="Update" />
		{{Form::close()}}
	</div>
</div>


<!-- delete modal -->
<div class="hidden">
<div class="pa" id="dialog-confirm" title="">
	<p >
		<div class="pull-right"><span class="ui-icon ui-icon-alert " style="float: left; margin: 0 0px 0 8px;"></span></div>
		Are you sure?
	</p>
	<img src="/img/loaderSmall.gif" style="display:none;" class="deleteLoader">
</div>
</div>

@stop

@section('scripts')	
<script>
	$(function() {
		$('.confirmClient').on('click',function(){
			clientID = $(this).data('clientid');
			//alert( clientID );
			confirmTD = $(this).parent();
			$(this).fadeOut('fast');
			confirmTD.find('img').fadeIn('slow');

			$.post('{{URL::route('updatePassword')}}' , {userID : clientID }) //confirmUserPost
				.done(function(data){
					confirmTD.delay('2000').html('<span style="color: #08c;">Confirm</span>');
				})
				.fail(function(data){
					alert('Something wrong!');
					confirmTD.find('img').fadeOut('fast');
					confirmTD.find('a').fadeIn('slow');
					
				});

		});


		$('.changePasswordButton').on('click',function(){
			name =  $(this).parents('tr').find('.first_name').text();
			lastName =  $(this).parents('tr').find('.last_name').text();
			email =  $(this).parents('tr').find('.email').text();
			$('#fullNameLabel').text(name + ' ' + lastName);
			$('#emailAddressLabel').text(email);
			$('input[name="clientID"]').val($(this).data('clientid'));
		})


		$('#fullName').bind('change', function() {
			isoCode = $('#fullName option:selected').data("code");
			$('#shortName').val(isoCode);
		});

		$("#changePasswordForm").validate({
			debug:true,
			errorClass : 'errorStyle',
			rules: {
				password: {
					required: true,
					minlength: 6
				},

				passwordConfirm: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				}
			},
			messages: {

				password: {
					required: "Please enter password.",
					minlength: "Password must be greater than 6 character."
				},
				passwordConfirm: {
					required: "Please enter password.",
					minlength: "Password must be greater than 6 character.",
					equalTo: 'Password and Confirm Password must be the same.'
				}
			},
			highlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').addClass('error');

			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');

			},
			submitHandler : function(form){
				url = $(form).attr('action');
				$('.response img').show();
				$.post(url,$(form).serialize())
				.done(function(data){
					$('.response p').show().text('Password is updated successfuly.');
				})
				.fail(function(data){
					alert('Something wrong!');
					$('.response p').hide();
				})
				.always(function(){
					$('.response img').hide()
				});
			}
		});

$('.closeModal').on('click',function(){$('.response p').hide();})

$('.deleteClientButton').on('click',function(){
	clientID = $(this).data('clientid');
	row = $(this).parents('tr');

	$('#dialog-confirm').dialog(
	{
		title:'<span class="pa pull-right">Remove User</span>',
		resizable: false,
		modal:true,
		buttons: {
			"No": function() {
				$( this ).dialog( "close" );
			},
			'Yes': function() {
				$('.deleteLoader').show();
				$.post('{{URL::route('deleteUser')}}' , {clientid : clientID })
				.done(function(data){
					$('.deleteLoader').hide();
					row.fadeOut('slow');
					$('#dialog-confirm').dialog( "close" );
				})
				.fail(function(data){
					alert('Something wrong!');
					$('.deleteLoader').hide();
				})
				.always(function(){
					$('.deleteLoader').hide();
				});
				
			}
		}}
		);
})


});
</script>
@stop

@section('scriptFiles')
<script src="/js/jqueryValidation.js" />
@stop