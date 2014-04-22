@section('content')

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header">
							<div class="pull-left">List of New Files for the current month</div>								
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
												<th style="width: 20px;">No.</th>
												<th>File Name</th>
												<th style="width: 45px;">Status</th>
												<th style="width: 30px;">Year</th>
												<th style="width: 85px;">Month</th>
												<th style="width: 45px;">Week</th>
												<th style="width: 225px;">Created Date/Time</th>
											</td>
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
													@if($file->batchStatus!='confirm' and $file->batchStatus!='confirmMonth')
														<a href="{{ URL::route('viewMonthYearFileByCaller', $file->batchID) }}">
															{{$file->batchName}}
														</a>
													@else
														{{$file->batchName}}
													@endif
												</td>
												<td>{{$file->batchStatus}}</td>
												<td>{{ ($file->batchYear=="")  ? "-" : $file->batchYear}}</td>
												<td>{{ ($file->batchMonth=="") ? "-" : date( 'F', $timestamp ) }}</td>
												<td>{{ ($file->batchWeek=="") ? "-" : $file->batchWeek}}</td>

												<td>{{$file->updated_at}}</td>
											</tr>
											@endforeach
											@else
												<tr>
													<td colspan="7"> There is no file in the system. </td>
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

