@section('content')

<?php 
if( isset($msgSuccess) ){ 
?>
<div class="alert alert-success" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; line-height: 25px;" id="msg-success1"> 
	{{ $msgSuccess }} 
</div>
<?php } 

if( isset($msgError) ){										
?>
	<div class="alert alert-error" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 8px;" id="msg-error1">
		{{ $msgError }} 
	</div>    
<?php } ?>

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header">
							<div class="pull-left">Master Records [Batch Name: {{ $batchName }} - {{ $batchYear.'/'.$batchMonth.'/'.$batchWeek }}]</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">

									<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr style="height: 32px; background: #fbfbfb;background: -moz-linear-gradient(top,  #fbfbfb 0%, #f1f1f1 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fbfbfb), color-stop(100%,#f1f1f1));background: -webkit-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -o-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);background: -ms-linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);            background: linear-gradient(top,  #fbfbfb 0%,#f1f1f1 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#f1f1f1',GradientType=0 );">
												<td colspan="120"></td>
											</tr>
											<tr>
												<th style="width: 20px;">No.</th>
												<th>Title</th>
												<th style="">customer Name </th>
												<th style="">customer ID </th>
												<th style="">customer Type </th>
												<th style="">customer Group </th>
												<th style="">gender </th>
												<th style="">age </th>
												<th style="">age Group </th>
												<th style="">dob </th>
												<th style="">year DOB </th>
												<th style="">month DOB </th>
												<th style="">day DOB </th>
												<th style="">race </th>
												<th style="">religion </th>
												<th style="">industry </th>
												<th style="">occupation </th>
												<th style="">address 1 </th>
												<th style="">address 2 </th>						
												<th style="">address 3 </th>

												<th style="">post code </th>
												<th style="">city Code </th>
												<th style="">city </th>
												<th style="">state Code </th>
												<th style="">state </th>
												<th style="">country </th>
												<th style="">tel No </th>
												<th style="">mobile No </th>
												<th style="">fax No </th>
												<th style="">email </th>
												<th style="">contact Person </th>
												<th style="">personal Income </th>
												<th style="">household Income </th>
												<th style="">status </th>
												<th style="">vso No </th>
												<th style="">vso Date </th>
												<th style="">reg No </th>
												<th style="">reg Date </th>
												<th style="">reg State </th>
												<th style="">chassis No </th>
												<th style="">engine No </th>
												<th style="">vehicle Registration Month </th>
												<th style="">vehicle Registration Year </th>


												<th style="">brand </th>
												<th style="">model </th>
												<th style="">model Code </th>
												<th style="">model Group </th>
												<th style="">model Group Code </th>
												<th style="">model Variant </th>
												<th style="">model Variant Code </th>
												<th style="">model Color </th>
												<th style="">model Color Code </th>
												<th style="">MFG Code </th>


												<th style="">model Year </th>
												<th style="">engine No </th>
												<th style="">warranty Expiry Date </th>
												<th style="">warranty Expiry Mileage </th>
												<th style="">program Code </th>
												<th style="">coupon No </th>
												<th style="">outlet Name </th>
												<th style="">outlet Code </th>
												<th style="">sales Person </th>
												<th style="">outlet Manager </th>


												<th style="">outlet Region </th>
												<th style="">outlet State </th>
												<th style="">outlet City </th>
												<th style="">email Notification </th>
												<th style="">postal Notification </th>
												<th style="">phone Notification </th>
												<th style="">sms Notification </th>
												<th style="">fax Notification </th>
												<th style="">not Interested </th>
												<th style="">marital Status </th>


												<th style="">ads/articles In Newspaper Or Magazines </th>
												<th style="">ads In Tv/radio </th>
												<th style="">ads On Billboard </th>
												<th style="">internet Websites Blogs </th>
												<th style="">friends & Family </th>
												<th style="">show room Visit </th>
												<th style="">road show Events </th>
												<th style="">others </th>
												<th style="">N/A </th>
												<th style="">design </th>

												<th style="">performance </th>
												<th style="">price </th>
												<th style="">brand Image </th>
												<th style="">promotion </th>
												<th style="">vehicle Accessories </th>
												<th style="">vehicle Reliability </th>
												<th style="">after Sales Service </th>
												<th style="">mitsubishi Repeat Customer </th>
												<th style="">others </th>
												<th style="">N/A </th>

												<th style="">private Daily Transportation </th>
												<th style="">private Leisure Activities </th>
												<th style="">private Others </th>
												<th style="">commercial Site Visit </th>
												<th style="">commercial Transport Goods Items </th>
												<th style="">commercial To Carry People </th>
												<th style="">commercial To Support Client Usage </th>
												<th style="">commercial Others </th>
												<th style="">commercial N/A </th>
												<th style="">compare With Other Brands </th>

												<th style="">brand Name </th>
												<th style="">nature Of Purchase </th>
												<th style="">no Of Years Use For Previous Car </th>
												<th style="">model Name Previous Car </th>
												<th style="">cargo Usage Applicable For Triton Model </th>
												<th style="">sales Persons Personality </th>
												<th style="">how Satisfied Are You With The Product Knowledge </th>
												<th style="">promotion Activities By Dealer </th>
												<th style="">handling Time </th>
												<th style="">ability To Deliver Vehicle </th>

												<th style="">sales Person Explained </th>
												<th style="">overall Satisfaction </th>
												<th style="">cleansing Status </th>
												<th style="">address Validity </th>
												<th style="">remarks </th>



												<th style="width: 165px;">Date</th>											
											</tr>
										</thead>
										<tbody>
											<?php $num=0; ?>
											<?php // $cnt = CsdbCustomerRaw::where('batchID',$_GET['batchID'])->count(); ?>
											<!-- @ // if($cnt>0)	 -->

											<?php
											if( isset($CsdbCustomerMaster) ){
												foreach( $CsdbCustomerMaster  as $file){
											?>											

											<tr style="cursor:pointer">
												<td style="text-align:center">{{++$num}}</td>
												<td>{{$file->title}}</td>

												<td>{{$file->customerName }} </td>
												<td>{{$file->customerID }}</td>
												<td>{{$file->customerType }}</td>
												<td>{{$file->customerGroup }}</td>
												<td>{{$file->gender }}</td>
												<td>{{$file->age }}</td>
												<td>{{$file->ageGroup }}</td>
												<td>{{$file->dob }}</td>
												<td>{{$file->yearDOB }}</td>
												<td>{{$file->monthDOB }}</td>
												<td>{{$file->dayDOB }}</td>
												<td>{{$file->race }}</td>
												<td>{{$file->religion }}</td>
												<td>{{$file->industry }}</td>
												<td>{{$file->occupation }}</td>
												<td>{{$file->address1 }}</td>
												<td>{{$file->address2 }}</td>						
												<td>{{$file->address3 }}</td>

												<td>{{$file->postcode }}</td>
												<td>{{$file->cityCode }}</td>
												<td>{{$file->city }}</td>
												<td>{{$file->stateCode }}</td>
												<td>{{$file->state }}</td>
												<td>{{$file->country }}</td>
												<td>{{$file->telNo }}</td>
												<td>{{$file->mobileNo }}</td>
												<td>{{$file->faxNo }}</td>
												<td>{{$file->email }}</td>
												<td>{{$file->contactPerson }}</td>
												<td>{{$file->personalIncome }}</td>
												<td>{{$file->householdIncome }}</td>
												<td>{{$file->status }}</td>
												<td>{{$file->vsoNo }}</td>
												<td>{{$file->vsoDate }}</td>
												<td>{{$file->regNo }}</td>
												<td>{{$file->regDate }}</td>
												<td>{{$file->regState }}</td>
												<td>{{$file->chassisNo }}</td>
												<td>{{$file->engineNo }}</td>
												<td>{{$file->vehicleRegistrationMonth }}</td>
												<td>{{$file->vehicleRegistrationYear }}</td>


												<td>{{$file->brand }}</td>
												<td>{{$file->model }}</td>
												<td>{{$file->modelCode }}</td>
												<td>{{$file->modelGroup }}</td>
												<td>{{$file->modelGroupCode }}</td>
												<td>{{$file->modelVariant }}</td>
												<td>{{$file->modelVariantCode }}</td>
												<td>{{$file->modelColor }}</td>
												<td>{{$file->modelColorCode }}</td>
												<td>{{$file->mfgCode }}</td>


												<td>{{$file->modelYear }}</td>
												<td>{{$file->engineNo1 }}</td>
												<td>{{$file->warrantyExpiryDate }}</td>
												<td>{{$file->warrantyExpiryMileage }}</td>
												<td>{{$file->programCode }}</td>
												<td>{{$file->couponNo }}</td>
												<td>{{$file->outletName }}</td>
												<td>{{$file->outletCode }}</td>
												<td>{{$file->salesPerson }}</td>
												<td>{{$file->outletManager }}</td>


												<td>{{$file->outletRegion }}</td>
												<td>{{$file->outletState }}</td>
												<td>{{$file->outletCity }}</td>
												<td>{{$file->emailNotification }}</td>
												<td>{{$file->postalNotification }}</td>
												<td>{{$file->phoneNotification }}</td>
												<td>{{$file->smsNotification }}</td>
												<td>{{$file->faxNotification }}</td>
												<td>{{$file->notInterested }}</td>
												<td>{{$file->maritalStatus }}</td>


												<td>{{$file->ads_articlesInNewspaperOrMagazines }}</td>
												<td>{{$file->adsInTv_radio }}</td>
												<td>{{$file->adsOnBillboard }}</td>
												<td>{{$file->internetWebsitesBlogs }}</td>
												<td>{{$file->friendsFamily }}</td>
												<td>{{$file->showroomVisit }}</td>
												<td>{{$file->roadshowEvents }}</td>
												<td>{{$file->others }}</td>
												<td>{{$file->na }}</td>
												<td>{{$file->design }}</td>

												<td>{{$file->performance }}</td>
												<td>{{$file->price }}</td>
												<td>{{$file->brandImage }}</td>
												<td>{{$file->promotion }}</td>
												<td>{{$file->vehicleAccessories }}</td>
												<td>{{$file->vehicleReliability }}</td>
												<td>{{$file->afterSalesService }}</td>
												<td>{{$file->mitsubishiRepeatCustomer }}</td>
												<td>{{$file->others1 }}</td>
												<td>{{$file->na1 }}</td>

												<td>{{$file->privateDailyTransportation }}</td>
												<td>{{$file->privateLeisureActivities }}</td>
												<td>{{$file->privateOthers }}</td>
												<td>{{$file->commercialSiteVisit }}</td>
												<td>{{$file->commercialTransportGoodsItems }}</td>
												<td>{{$file->commercialToCarryPeople }}</td>
												<td>{{$file->commercialToSupportClientUsage }}</td>
												<td>{{$file->commercialOthers }}</td>
												<td>{{$file->commercialNA }}</td>
												<td>{{$file->compareWithOtherBrands }}</td>

												<td>{{$file->brandName }}</td>
												<td>{{$file->natureOfPurchase }}</td>
												<td>{{$file->noOfYearsUseForPreviousCar }}</td>
												<td>{{$file->modelNamePreviousCar }}</td>
												<td>{{$file->cargoUsageApplicableForTritonModel }}</td>
												<td>{{$file->salesPersonsPersonality }}</td>
												<td>{{$file->howSatisfiedAreYouWithTheProductKnowledge }}</td>
												<td>{{$file->promotionActivitiesByDealer }}</td>
												<td>{{$file->handlingTime }}</td>
												<td>{{$file->abilityToDeliverVehicle }}</td>

												<td>{{$file->salesPersonExplained }}</td>
												<td>{{$file->overallSatisfaction }}</td>
												<td>{{$file->cleansingStatus }}</td>
												<td>{{$file->addressValidity }}</td>
												<td>{{$file->remarks }}</td>

												<td>{{$file->updated_at}}</td>
											</tr>
											<?php
												}
											}else{
											?>	
												<tr>
													<td colspan="4"> There is no duplicated record in this batch. </td>
												</tr>
											<?php } ?>
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
@stop