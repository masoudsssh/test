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
								<div class="pull-left">Export File</div>
							</div>
							<div class="w-box-content">
								<div class="row-fluid">
									<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
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
												<td>{{$file->batchName}}</td>
												<td>{{$file->batchStatus}}</td>
												<td>{{ ($file->batchYear=="")  ? "-" : $file->batchYear}}</td>
												<td>{{ ($file->batchMonth=="") ? "-" : date( 'F', $timestamp ) }}</td>
												<td>{{ ($file->batchWeek=="") ? "-" : $file->batchWeek}}</td>

												<td>{{$file->updated_at}}</td>
												<td style="text-align:center">
													<a href="{{ URL::route('exportFile', $file->batchID) }}" class="btn btn-default" id="" data-batchid="{{$file->batchID}}" style="padding-right: 12px;">
														<i class="icon-folder-open" style="margin-top: 1px;"></i> Export File
													</a>
												</td>
											</tr>
											@endforeach
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

	@stop