@section('content')

<style>
.control-label{
	float: left;
	line-height: 27px;
	width:178px;
}
</style>

<?php 
if( Session::has('msgSuccess')){ ?>
<div class="alert alert-success" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; line-height: 25px;" id="msg-success1"> 
	{{Session::get('msgSuccess')}} 
</div>
<?php } 
if( Session::has('msgError')){										
	?>
	<div class="alert alert-error" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 8px;" id="msg-error1">
		{{Session::get('msgError')}} 
	</div>    
	<?php } ?>

	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span12">
					<div class="box12 block ">
						<div class="w-box">
							<div class="w-box-header" style="position:static; border-right:1px solid #ddd">
								<div class="pull-left">Import File</div>
							</div>
							<div class="w-box-content">
								<div class="row-fluid">
									<div class="span6" style="padding:30px">


										{{ Form::open(array('url' => URL::route('storeFileIntoDB'), 'files' => true )) }}
										<p>An Excel file's name must end in .xls or .xlsx</p>									

										<div class="control-group">
											{{Form::label('file',"Browse your computer:",array("class" =>"control-label"))}}
											<div class="controls">
												{{Form::file('file', array("style"=>"line-height: 22px; margin-top: 3px;"))}}		
											</div>
										</div>
							
										<div class="control-group">
											{{Form::label('batchName','Batch Name:',array('class'=>'control-label'))}}
											<div class="controls">
												{{Form::text('batchName', '' ,array('placeholder'=>''))}}
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Date</label>
											<div class="controls">
												<div class="row-fluid">
													<div class="span2">
														<select class="input-block-level" name="year">
															@for($i=2013; $i<2021; $i++)
																<option value="{{$i}}">{{$i}}</option>
															@endfor
														</select>
														<span style="position:relative; top: -10px; left: 0px; font-size: 10px;">Year</span>
													</div>
													<div class="span4">
														<select class="input-block-level" name="month">
															<option value="1">January</option>
															<option value="2">February</option>
															<option value="3">March</option>
															<option value="4">April</option>
															<option value="5">May</option>
															<option value="6">June</option>
															<option value="7">July</option>
															<option value="8">August</option>
															<option value="9">September</option>
															<option value="10">October</option>
															<option value="11">November</option>
															<option value="12">December</option>
														</select>
														<span style="position:relative; top: -10px; left: 0px; font-size: 10px;">Month</span>
													</div>
													
												</div>
											</div>
										</div>

										<div class="control-group">
											{{Form::label('week','week:',array('class'=>'control-label'))}}
											<div class="controls ">
												<div class="span6">
													<select class="input-block-level" name="week">
														<option>week 1</option>
														<option>week 2</option>
														<option>week 3</option>
														<option>week 4</option>
														<option>week 5</option>
													</select>
												</div>
											</div>
										</div>

										<div class="control-group">										
											<div class="pull-right" style="margin-right: 52px;">
												{{Form::submit('Submit', array('class'=>'btn-danger', 'style'=>'width: 75px') )}}		
											</div>
										</div>
										{{ Form::close() }}

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