@section('content')

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header">
							<div class="pull-left">System Log</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">
										<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr style="height: 32px; background: #fbfbfb;background: -moz-linear-gradient(top,  #fbfbfb 0%, #f1f1f1 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fbfbfb), color-stop(100%,#f1f1f1));background: -webkit-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -o-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -ms-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);            background: linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#f1f1f1',GradientType=0 );">
												<td colspan="7"></td>
											</tr>
											<tr>
												<th>No.</th>
												<th>Username</th>
												<th>Fullname</th>
												<th>Batch Name</th>
												<th>Record ID</th>
												<th>Open At</th>
												<th>Close At</th>																							
										    </tr>
										</thead>
										<tbody>
											<?php $num=0; ?>
											<?php 
												$cnt = CsdbCustomerMonthYearRaw::where('updated_at', 'LIKE' , '%'.date('Y-m-d').'%' )
												  					  ->where('close_at','!=','')->count(); 
											?>
											@if($cnt>0)	
												@foreach(CsdbCustomerMonthYearRaw::leftJoin('users', 'users.id', '=', 'callerID')->where('customer_monthyear_raw.close_at','!=','')->where('customer_monthyear_raw.updated_at', 'LIKE' , '%'.date('Y-m-d').'%' )->orderby('customer_monthyear_raw.updated_at', 'desc')->select('*', 'customer_monthyear_raw.id AS rid')->get() as $file)
												<tr>
													<td>{{++$num}}</td>
													<td>{{$file->email}}</td>
													<td>{{$file->first_name.' '.$file->last_name}}</th>
													<td>{{$file->batchName}}</td>
													<td>
														<a href="{{ URL::action('ClientController@editUploadedRecord', array($file->rid)) }}"> {{$file->rid}} </a> 
													</td>
													<td>{{$file->open_at}}</td>
													<td>{{$file->close_at}}</td>																						
											    </tr>
												@endforeach
											@else
											<tr>
												<td colspan="7">There is no data in system log.</td>
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
<div id="dialog-uploadedconfirm" title="">
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

		$(".confirmUploadedFile").on("click", function(){
			batchID = $(this).data('batchid');
			$('#dialog-uploadedconfirm').dialog({
				title:'<span class="pull-left">Uploaded Confirm</span>',
				resizable: false,
				modal:true,
				buttons: {
					"No": function() {
						$( this ).dialog( "close" );
					},
					'Yes': function() {
						//$('.deleteLoader').show();
					$(location).attr('href','/user/confirmuploadedfile/'+batchID);
					}
				}}
			);
		});

	}); 

</script>

@stop

