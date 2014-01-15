@section('content')

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header">
							<div class="pull-left">List of New Uploaded Files</div>								
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
												<th>Year</th>
												<th>Month</th>
												<th>Week</th>
												<th style="width: 165px;">Created Date/Time</th>
												<th style="width: 85px;">Action</th>
											</td>
										</thead>
										<tbody>
											<?php $num=0; ?>
											<?php $cnt = CsdbCustomerRaw::groupby('batchID')->count(); ?>
											@if($cnt>0)	
											@foreach(CsdbCustomerRaw::orderby('batchID', 'desc')->groupby('batchID')->get() as $file)

											<tr>
												<td style="text-align:center">{{++$num}}</td>
												<td>
													<a href="{{ URL::route('readExcelFile', array('batchID'=>$file->batchID)) }}">
														{{$file->batchName}}
													</a>
												</td>
												<td>{{ ($file->batchYear=="")  ? "-" : $file->batchYear}}</td>
												<td>{{ ($file->batchMonth=="") ? "-" : $file->batchMonth}}</td>
												<td>{{ ($file->batchWeek=="") ? "-" : $file->batchWeek}}</td>

												<td>{{$file->updated_at}}</td>
												<td style="text-align:center">
													<button class="btn btn-default confirmUploadedFile" data-batchid="{{$file->batchID}}">
														<i class="icon-check" style="margin-top: 1px;"></i> Confirm
													</button>
													<!-- <button class="btn btn-danger">
														<i class="icon-trash" style="margin-top: 2px;"></i> Remove
													</button> -->
												</td>
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




<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header">
							<div class="pull-left">List of New Users</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">
										<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr style="height: 32px; background: #fbfbfb;background: -moz-linear-gradient(top,  #fbfbfb 0%, #f1f1f1 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fbfbfb), color-stop(100%,#f1f1f1));background: -webkit-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -o-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -ms-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);            background: linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#f1f1f1',GradientType=0 );">
												<td colspan="4"></td>
											</tr>
											<tr>
												<th>No.</th>
												<th>Username</th>
												<th>Full Name</th>
												<th>Date</th>											
										    </tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="4">Nothing found as a new user.</td>
											</tr>
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

		$(".confirmUploadedFile").on("click", function(){
			batchID = $(this).data('batchid');
			//alert(batchID);
			$(location).attr('href','/user/confirmuploadedfile/'+batchID);
		});

	}); 

</script>

@stop

