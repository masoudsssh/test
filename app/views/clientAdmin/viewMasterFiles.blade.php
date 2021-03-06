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
							<div class="pull-left">List of Master Files</div>
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
												<th style="width: 30px;">Year</th>
												<th style="width: 85px;">Month</th>
												<th style="width: 45px;">Week</th>
												<th style="width: 225px;">Created Date/Time</th>
											</td>
										</thead>
										<tbody>
											<?php 
												$num=0;
												$batchYear = CsdbCustomerMaster::max('batchYear');
												$batchMonth = CsdbCustomerMaster::where('batchYear', $batchYear)->max('batchMonth');
												
												$monthNum = sprintf("%02s", $batchMonth);
												$timestamp = mktime(0, 0, 0, $monthNum, 10);

												$cnt = CsdbCustomerMaster::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->orderby('batchMonth', 'desc')->groupby('batchID')->count(); 
											?>
											@if($cnt>0)	
											@foreach(CsdbCustomerMaster::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->orderby('batchMonth', 'desc')->groupby('batchID')->get() as $file)

											<tr>
												<td style="text-align:center">{{++$num}}</td>
												<td>
													<a href="{{ URL::route('viewMasterWeeksFile', $file->batchID) }}">
														{{$file->batchName}}
													</a>
												</td>
												<td>{{ ($file->batchYear=="")  ? "-" : $file->batchYear}}</td>
												<td>{{ ($file->batchMonth=="") ? "-" : date( 'F', $timestamp ) }}</td>
												<td>{{ ($file->batchWeek=="") ? "-" : $file->batchWeek}}</td>
												<td>{{$file->updated_at}}</td>												
											</tr>
											@endforeach

											@else
												<tr>
													<td colspan="6"> There is no file in the system. </td>
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

<script type="text/javascript">

	$(document).ready(function(){

	}); 

</script>
@stop
