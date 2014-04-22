@section('content')
<style>
.ui-dialog-buttonset {
	margin: 0 auto;
	width: 152px;
}
.ui-button-text-only{
	width: 70px;
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
						<div class="w-box-header">
							<div class="pull-left">List of Month-Year Files</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">

									<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr style="height: 32px; background: #fbfbfb;background: -moz-linear-gradient(top,  #fbfbfb 0%, #f1f1f1 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fbfbfb), color-stop(100%,#f1f1f1));background: -webkit-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -o-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -ms-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);            background: linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#f1f1f1',GradientType=0 );">
												<td colspan="8"></td>
											</tr>
											<tr>
												<th style="width: 20px;">No.</th>
												<th>File Name</th>
												<th style="width: 45px;">Status</th>
												<th style="width: 30px;">Year</th>
												<th style="width: 85px;">Month</th>
												<th style="width: 45px;">Week</th>
												<th style="width: 225px;">Created Date/Time</th>
												<th style="width: 123px;">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$num=0;
												$batchYear = CsdbCustomerMonthYearRaw::max('batchYear');
												$batchMonth = CsdbCustomerMonthYearRaw::where('batchYear', $batchYear)->max('batchMonth');
												
												$monthNum = sprintf("%02s", $batchMonth);
												$timestamp = mktime(0, 0, 0, $monthNum, 10);

												$cnt = CsdbCustomerMonthYearRaw::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->orderby('batchWeek', 'desc')->groupby('batchID')->count(); 
											?>
											@if($cnt>0)	
											@foreach(CsdbCustomerMonthYearRaw::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->orderby('batchWeek', 'desc')->groupby('batchID')->get() as $file)

											<tr>
												<td style="text-align:center">{{++$num}}</td>
												<td>
													<a href="{{ URL::route('viewMonthYearFile', $file->batchID) }}">
														{{$file->batchName}}
													</a>
												</td>
												<td>{{$file->batchStatus}}</td>
												<td>{{ ($file->batchYear=="")  ? "-" : $file->batchYear}}</td>
												<td>{{ ($file->batchMonth=="") ? "-" : date( 'F', $timestamp ) }}</td>
												<td>{{ ($file->batchWeek=="") ? "-" : $file->batchWeek}}</td>

												<td>{{$file->updated_at}}</td>
												<td style="text-align:center">
													<a href="#" class="btn btn-default confirmButton" id="" data-batchid="{{$file->batchID}}" style="padding-right: 12px;">
														<i class="icon-check" style="margin-top: 1px;"></i> Confirm Week
													</a>
												</td>
											</tr>
											@endforeach
											<tr>
												<td colspan="6"></td>
												<td colspan="2">
													<span style="line-height: 30px; font-weight:bold; text-shadow: 1px 1px 0 #fff;"> Confirm all weeks as a Month batch </span>
													<a href="#" class="btn btn-default" id="confirmMonthButton" data-batchid="{{$file->batchID}}" style="float: right;">
														<i class="icon-check" style="margin-top: 1px;"></i> Confirm Month
													</a>
												</td>
											</tr>
											@else
												<tr>
													<td colspan="8"> There is no file in the system. </td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<!-- confirm modal -->
<div class="hidden">
<div id="dialog-confirm" title="">
	<p >
		<div class="pull-left" style="margin-right: 12px;">
				<span class="ui-icon ui-icon-alert " style="float: left; margin: 0 0px 0 8px;"></span>
		</div>
		Are you sure?
	</p>
	<img src="/img/loaderSmall.gif" style="display:none;" class="deleteLoader">
</div>
</div>
<!-- end of confirm modal -->

<!-- confirm modal -->
<div class="hidden">
<div id="dialog-monthConfirm" title="">
	<p >
		<div class="pull-left" style="margin-right: 12px;">
				<span class="ui-icon ui-icon-alert " style="float: left; margin: 0 0px 0 8px;"></span>
		</div>
		Are you sure?
	</p>
	<img src="/img/loaderSmall.gif" style="display:none;" class="deleteLoader">
</div>
</div>
<!-- end of confirm modal -->


<script type="text/javascript">

	$(document).ready(function(){

		$('.confirmButton').on('click',function(){	
			batchid =  $(this).data('batchid') ;	
			$('#dialog-confirm').dialog({
				title:'<span class="pull-left">Week Confirm</span>',
				resizable: false,
				modal:true,
				buttons: {
					"No": function() {
						$( this ).dialog( "close" );
					},
					'Yes': function() {
						//$('.deleteLoader').show();
						$(location).attr('href', '/user/confirmmonthyearfile/'+batchid );
					}
				}}
			);
		});
		
		$('#confirmMonthButton').on('click',function(){	
			batchid =  $(this).data('batchid') ;	
			$('#dialog-monthConfirm').dialog({
				title:'<span class="pull-left">Month Confirm</span>',
				resizable: false,
				modal:true,
				buttons: {
					"No": function() {
						$( this ).dialog( "close" );
					},
					'Yes': function() {
						//$('.deleteLoader').show();
						$(location).attr('href', '/user/confirmAllWeeksAsMonthBatch/'+batchid );
					}
				}}
			);
		});
	}); 

</script>
@stop
