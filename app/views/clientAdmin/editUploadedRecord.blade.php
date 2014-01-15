@section('content')

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header" style="position:static; border-right:1px solid #ddd">
							<?php								
								//$file = CsdbCustomerRaw::where('id',$_GET['batchID'])->get()->first();
							?>
							<div class="pull-left">Edit Record <?php echo '[Batch Name: '.$file->batchName.']'; ?></div>						
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">
									<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr>
												<th>Title</th><td> <input type="text" name="title" value=" {{$file->title  }} " /></td>
											</tr>
											<tr>
												<th style="">customer Name </th> <td> <input type="text" name="customerName" value=" {{$file->customerName  }} " /></td>
											</tr>
											<tr>
												<th style="">customer ID </th> <td> <input type="text" name="customerID" value=" {{$file->customerID  }} " /></td>
											</tr>
											<tr>
												<th style="">customer Type </th> <td> <input type="text" name="customerType" value=" {{$file->customerType }} " /></td>
											</tr>
											<tr>
												<th style="">customer Group </th> <td> <input type="text" name="customerGroup" value=" {{$file->customerGroup  }} " /></td>
											</tr>
											<tr>
												<th style="">gender </th> <td> <input type="text" name="gender" value=" {{$file->gender  }} " /></td>
											</tr>
											<tr>
												<th style="">age </th> <td> <input type="text" name="age" value=" {{$file->age }} " /></td>
											</tr>
											<tr>
												<th style="">age Group </th> <td> <input type="text" name="ageGroup" value=" {{$file->ageGroup  }} " /></td>
											</tr>
											<tr>
												<th style="">dob </th> <td> <input type="text" name="dob" value=" {{$file->dob }} " /></td>
											</tr>
											<tr>
												<th style="">year DOB </th> <td> <input type="text" name="yearDOB " value=" {{$file->yearDOB }} " /></td>
											</tr>
											<tr>
												<th style="">month DOB </th> <td> <input type="text" name="monthDOB " value=" {{$file->monthDOB }} " /></td>
											</tr>
											<tr>
												<th style="">day DOB </th> <td> <input type="text" name="dayDOB " value=" {{$file->dayDOB  }} " /></td>
											</tr>
											<tr>
												<th style="">race </th> <td> <input type="text" name="race " value=" {{$file->race  }} " /></td>
											</tr>
											<tr>
												<th style="">religion </th> <td> <input type="text" name="religion " value=" {{$file->religion  }} " /></td>
											</tr>
											<tr>
												<th style="">industry </th> <td> <input type="text" name="industry " value=" {{$file->industry  }} " /></td>
											</tr>
											<tr>
												<th style="">occupation </th> <td> <input type="text" name="occupation " value=" {{$file->occupation  }} " /></td>
											</tr>
											<tr>
												<th style="">address 1 </th> <td> <input type="text" name="address1" value=" {{$file->address1  }} " /></td>
											</tr>
											<tr>
												<th style="">address 2 </th> <td> <input type="text" name="address2" value=" {{$file->address2  }} " /></td>
											</tr>
											<tr>					
												<th style="">address 3 </th><td> <input type="text" name="address3" value=" {{$file->address3 }} " /></td>
											</tr>
											<tr>
												<th style="">post code </th><td> <input type="text" name="postCode" value=" {{$file->postcode  }} " /></td>
											</tr>
											<tr>
												<th style="">city Code </th><td> <input type="text" name="cityCode" value=" {{$file->cityCode  }} " /></td>
											</tr>
											<tr>
												<th style="">city </th><td> <input type="text" name="city" value=" {{$file->city  }} " /></td>
											</tr>
											<tr>
												<th style="">state Code </th><td> <input type="text" name="stateCode" value=" {{$file->stateCode  }} " /></td>
											</tr>
											<tr>
												<th style="">state </th><td> <input type="text" name="state" value=" {{$file->state  }} " /></td>
											</tr>
											<tr>
												<th style="">country </th><td> <input type="text" name="country" value=" {{$file->country  }} " /></td>
											</tr>
											<tr>
												<th style="">tel No </th> <td> <input type="text" name="telNo" value=" {{$file->telNo  }} " /></td>
											</tr>
											<tr>
												<th style="">mobile No </th> <td> <input type="text" name="mobileNo" value=" {{$file->mobileNo  }} " /></td>
											</tr>
											<tr>
												<th style="">fax No </th> <td> <input type="text" name="faxNo" value=" {{$file->faxNo  }} " /></td>
											</tr>
											<tr>
												<th style="">email </th> <td> <input type="text" name="email" value=" {{$file->email  }} " /></td>
											</tr>
											<tr>
												<th style="">contact Person </th> <td> <input type="text" name="contactPerson" value=" {{$file->contactPerson  }} " /></td>
											</tr>
											<tr>
												<th style="">personal Income </th> <td> <input type="text" name="personalIncome" value=" {{$file->personalIncome  }} " /></td>
											</tr>
											<tr>
												<th style="">household Income </th> <td> <input type="text" name="householdIncome" value=" {{$file->householdIncome  }} " /></td>
											</tr>
											<tr>
												<th style="">status </th> <td> <input type="text" name="status" value=" {{$file->status  }} " /></td>
											</tr>
											<tr>
												<th style="">vso No </th> <td> <input type="text" name="vsoNo" value=" {{$file->vsoNo }} " /></td>
											</tr>
											<tr>
												<th style="">vso Date </th> <td> <input type="text" name="vsoDate" value=" {{$file->vsoDate  }} " /></td>
											</tr>
											<tr>
												<th style="">reg No </th> <td> <input type="text" name="regNo" value=" {{$file->regNo  }} " /></td>
											</tr>
											<tr>
												<th style="">reg Date </th> <td> <input type="text" name="regDate" value=" {{$file->regDate  }} " /></td>
											</tr>
											<tr>
												<th style="">reg State </th> <td> <input type="text" name="regState" value=" {{$file->regState  }} " /></td>
											</tr>
											<tr>
												<th style="">chassis No </th>  <td> <input type="text" name="chassisNo" value=" {{$file->chassisNo  }} " /></td>
											</tr>
											<tr>
												<th style="">engine No </th>  <td> <input type="text" name="engineNo" value=" {{$file->engineNo  }} " /></td>
											</tr>
											<tr>
												<th style="">vehicle Registration Month </th>  <td> <input type="text" name="vehicleRegistrationMonth" value=" {{$file->vehicleRegistrationMonth  }} " /></td>
											</tr>
											<tr>
												<th style="">vehicle Registration Year </th>  <td> <input type="text" name="vehicleRegistrationYear" value=" {{$file->vehicleRegistrationYear  }} " /></td>
											</tr>
											<tr>
												<th style="">brand </th>  <td> <input type="text" name="brand" value=" {{$file->brand  }} " /></td>
											</tr>
											<tr>
												<th style="">model </th>  <td> <input type="text" name="regState" value=" {{$file->regState  }} " /></td>
											</tr>
											<tr>
												<th style="">model Code </th>  <td> <input type="text" name="modelCode" value=" {{$file->modelCode  }} " /></td>
											</tr>
											<tr>
												<th style="">model Group </th>  <td> <input type="text" name="modelGroup" value=" {{$file->modelGroup  }} " /></td>
											</tr>
											<tr>
												<th style="">model Group Code </th>  <td> <input type="text" name="modelGroupCode" value=" {{$file->modelGroupCode  }} " /></td>
											</tr>
											<tr>
												<th style="">model Variant </th>  <td> <input type="text" name="modelVariant" value=" {{$file->modelVariant  }} " /></td>
											</tr>
											<tr>
												<th style="">model Variant Code </th>  <td> <input type="text" name="modelVariantCode" value=" {{$file->modelVariantCode }} " /></td>
											</tr>
											<tr>
												<th style="">model Color </th>  <td> <input type="text" name="modelColor" value=" {{$file->modelColor  }} " /></td>
											</tr>
											<tr>
												<th style="">model Color Code </th>  <td> <input type="text" name="modelColorCode" value=" {{$file->modelColorCode  }} " /></td>
											</tr>
											<tr>
												<th style="">MFG Code </th>  <td> <input type="text" name="mfgCode" value=" {{$file->mfgCode  }} " /></td>
											</tr>
											<tr>
												<th style="">model Year </th>  <td> <input type="text" name="modelYear" value=" {{$file->modelYear  }} " /></td>
											</tr>
											<tr>
												<th style="">engine No </th>  <td> <input type="text" name="engineNo1" value=" {{$file->engineNo1  }} " /></td>
											</tr>
											<tr>
												<th style="">warranty Expiry Date </th>  <td> <input type="text" name="warrantyExpiryDate" value=" {{$file->warrantyExpiryDate  }} " /></td>
											</tr>
											<tr>
												<th style="">warranty Expiry Mileage </th>  <td> <input type="text" name="warrantyExpiryMileage" value=" {{$file->warrantyExpiryMileage  }} " /></td>
											</tr>
											<tr>
												<th style="">program Code </th>  <td> <input type="text" name="programCode" value=" {{$file->programCode  }} " /></td>
											</tr>
											<tr>
												<th style="">coupon No </th>  <td> <input type="text" name="couponNo" value=" {{$file->couponNo  }} " /></td>
											</tr>
											<tr>
												<th style="">outlet Name </th>  <td> <input type="text" name="outletName" value=" {{$file->outletName  }} " /></td>
											</tr>
											<tr>
												<th style="">outlet Code </th> <td> <input type="text" name="outletCode" value=" {{$file->outletCode  }} " /></td>
											</tr>
											<tr>
												<th style="">sales Person </th> <td> <input type="text" name="salesPerson" value=" {{$file->salesPerson }} " /></td>
											</tr>
											<tr>
												<th style="">outlet Manager </th> <td> <input type="text" name="outletManager" value=" {{$file->outletManager  }} " /></td>
											</tr>
											<tr>
												<th style="">outlet Region </th> <td> <input type="text" name="outletRegion" value=" {{$file->outletRegion  }} " /></td>
											</tr>
											<tr>
												<th style="">outlet State </th> <td> <input type="text" name="outletState" value=" {{$file->outletState  }} " /></td>
											</tr>
											<tr>
												<th style="">outlet City </th> <td> <input type="text" name="outletCity" value=" {{$file->outletCity  }} " /></td>
											</tr>
											<tr>
												<th style="">email Notification </th> <td> <input type="text" name="emailNotification" value=" {{$file->emailNotification  }} " /></td>
											</tr>
											<tr>
												<th style="">postal Notification </th> <td> <input type="text" name="postalNotification" value=" {{$file->postalNotification  }} " /></td>
											</tr>
											<tr>
												<th style="">phone Notification </th> <td> <input type="text" name="phoneNotification" value=" {{$file->phoneNotification  }} " /></td>
											</tr>
											<tr>
												<th style="">sms Notification </th> <td> <input type="text" name="smsNotification" value=" {{$file->smsNotification  }} " /></td>
											</tr>
											<tr>
												<th style="">fax Notification </th> <td> <input type="text" name="faxNotification" value=" {{$file->faxNotification  }} " /></td>
											</tr>
											<tr>
												<th style="">not Interested </th> <td> <input type="text" name="notInterested" value=" {{$file->notInterested  }} " /></td>
											</tr>
											<tr>
												<th style="">marital Status </th>  <td> <input type="text" name="maritalStatus" value=" {{$file->maritalStatus  }} " /></td>
											</tr>
											<tr>
												<th style="">ads/articles In Newspaper Or Magazines </th>   <td> <input type="text" name="ads_articlesInNewspaperOrMagazines" value=" {{$file->ads_articlesInNewspaperOrMagazines  }} " /></td>
											</tr>
											<tr>
												<th style="">ads In Tv/radio </th>  <td> <input type="text" name="adsInTv_radio" value=" {{$file->adsInTv_radio  }} " /></td>
											</tr>
											<tr>
												<th style="">ads On Billboard </th>  <td> <input type="text" name="adsOnBillboard" value=" {{$file->adsOnBillboard  }} " /></td>
											</tr>
											<tr>
												<th style="">internet Websites Blogs </th>  <td> <input type="text" name="internetWebsitesBlogs" value=" {{$file->internetWebsitesBlogs  }} " /></td>
											</tr>
											<tr>
												<th style="">friends & Family </th>  <td> <input type="text" name="friendsFamily" value=" {{$file->friendsFamily  }} " /></td>
											</tr>
											<tr>
												<th style="">show room Visit </th>  <td> <input type="text" name="showRoomVisit" value=" {{$file->showroomVisit }} " /></td>
											</tr>
											<tr>
												<th style="">road show Events </th>  <td> <input type="text" name="roadShowEvents" value=" {{$file->roadshowEvents  }} " /></td>
											</tr>
											<tr>
												<th style="">others </th>  <td> <input type="text" name="others" value=" {{$file->others  }} " /></td>
											</tr>
											<tr>
												<th style="">N/A </th>  <td> <input type="text" name="na" value=" {{$file->na  }} " /></td>
											</tr>
											<tr>
												<th style="">design </th>  <td> <input type="text" name="design" value=" {{$file->design  }} " /></td>
											</tr>
											<tr>
												<th style="">performance </th>  <td> <input type="text" name="performance" value=" {{$file->performance  }} " /></td>
											</tr>
											<tr>
												<th style="">price </th>  <td> <input type="text" name="price" value=" {{$file->price  }} " /></td>
											</tr>
											<tr>
												<th style="">brand Image </th>  <td> <input type="text" name="brandImage" value=" {{$file->brandImage  }} " /></td>
											</tr>
											<tr>
												<th style="">promotion </th>  <td> <input type="text" name="promotion" value=" {{$file->promotion  }} " /></td>
											</tr>
											<tr>
												<th style="">vehicle Accessories </th>  <td> <input type="text" name="vehicleAccessories" value=" {{$file->vehicleAccessories  }} " /></td>
											</tr>
											<tr>
												<th style="">vehicle Reliability </th>  <td> <input type="text" name="vehicleReliability" value=" {{$file->vehicleReliability  }} " /></td>
											</tr>
											<tr>
												<th style="">after Sales Service </th>  <td> <input type="text" name="afterSalesService" value=" {{$file->afterSalesService  }} " /></td>
											</tr>
											<tr>
												<th style="">mitsubishi Repeat Customer </th>  <td> <input type="text" name="mitsubishiRepeatCustomer" value=" {{$file->mitsubishiRepeatCustomer  }} " /></td>
											</tr>
											<tr>
												<th style="">others </th>  <td> <input type="text" name="others" value=" {{$file->others1  }} " /></td>
											</tr>
											<tr>
												<th style="">N/A </th>  <td> <input type="text" name="na1" value=" {{$file->na1  }} " /></td>
											</tr>
											<tr>
												<th style="">private Daily Transportation </th>  <td> <input type="text" name="privateDailyTransportation" value=" {{$file->privateDailyTransportation  }} " /></td>
											</tr>
											<tr>
												<th style="">private Leisure Activities </th>  <td> <input type="text" name="privateLeisureActivities" value=" {{$file->privateLeisureActivities }} " /></td>
											</tr>
											<tr>
												<th style="">private Others </th>  <td> <input type="text" name="privateOthers" value=" {{$file->privateOthers  }} " /></td>
											</tr>
											<tr>
												<th style="">commercial Site Visit </th>  <td> <input type="text" name="commercialSiteVisit" value=" {{$file->commercialSiteVisit  }} " /></td>
											</tr>
											<tr>
												<th style="">commercial Transport Goods Items </th>  <td> <input type="text" name="commercialTransportGoodsItems" value=" {{$file->commercialTransportGoodsItems  }} " /></td>
											</tr>
											<tr>
												<th style="">commercial To Carry People </th>  <td> <input type="text" name="commercialToCarryPeople" value=" {{$file->commercialToCarryPeople }} " /></td>
											</tr>
											<tr>
												<th style="">commercial To Support Client Usage </th>  <td> <input type="text" name="commercialToSupportClientUsage" value=" {{$file->commercialToSupportClientUsage  }} " /></td>
											</tr>
											<tr>
												<th style="">commercial Others </th>  <td> <input type="text" name="commercialOthers" value=" {{$file->commercialOthers  }} " /></td>
											</tr>
											<tr>
												<th style="">commercial N/A </th>  <td> <input type="text" name="commercialNA" value=" {{$file->commercialNA  }} " /></td>
											</tr>
											<tr>
												<th style="">compare With Other Brands </th>  <td> <input type="text" name="compareWithOtherBrands" value=" {{$file->compareWithOtherBrands  }} " /></td>
											</tr>
											<tr>
												<th style="">brand Name </th>  <td> <input type="text" name="brandName" value=" {{$file->brandName  }} " /></td>
											</tr>
											<tr>
												<th style="">nature Of Purchase </th>  <td> <input type="text" name="natureOfPurchase" value=" {{$file->natureOfPurchase  }} " /></td>
											</tr>
											<tr>
												<th style="">no Of Years Use For Previous Car </th>  <td> <input type="text" name="noOfYearsUseForPreviousCar" value=" {{$file->noOfYearsUseForPreviousCar  }} " /></td>
											</tr>
											<tr>
												<th style="">model Name Previous Car </th>  <td> <input type="text" name="modelNamePreviousCar" value=" {{$file->modelNamePreviousCar  }} " /></td>
											</tr>
											<tr>
												<th style="">cargo Usage Applicable For Triton Model </th>  <td> <input type="text" name="cargoUsageApplicableForTritonModel" value=" {{$file->cargoUsageApplicableForTritonModel  }} " /></td>
											</tr>
											<tr>
												<th style="">sales Persons Personality </th>  <td> <input type="text" name="salesPersonsPersonality" value=" {{$file->salesPersonsPersonality  }} " /></td>
											</tr>
											<tr>
												<th style="">how Satisfied Are You With The Product Knowledge </th>  <td> <input type="text" name="howSatisfiedAreYouWithTheProductKnowledge" value=" {{$file->howSatisfiedAreYouWithTheProductKnowledge  }} " /></td>
											</tr>
											<tr>
												<th style="">promotion Activities By Dealer </th>  <td> <input type="text" name="promotionActivitiesByDealer" value=" {{$file->promotionActivitiesByDealer  }} " /></td>
											</tr>
											<tr>
												<th style="">handling Time </th>  <td> <input type="text" name="handlingTime" value=" {{$file->handlingTime  }} " /></td>
											</tr>
											<tr>
												<th style="">ability To Deliver Vehicle </th>  <td> <input type="text" name="abilityToDeliver" value=" {{$file->abilityToDeliverVehicle  }} " /></td>
											</tr>
											<tr>
												<th style="">sales Person Explained </th>  <td> <input type="text" name="salesPersonExplained" value=" {{$file->salesPersonExplained  }} " /></td>
											</tr>
											<tr>
												<th style="">overall Satisfaction </th>  <td> <input type="text" name="overallSatisfaction" value=" {{$file->overallSatisfaction  }} " /></td>
											</tr>
											<tr>
												<th style="">cleansing Status </th> <td> <input type="text" name="cleansingStatus" value=" {{$file->cleansingStatus }} " /></td>
											</tr>
											<tr>
												<th style="">address Validity </th>  <td> <input type="text" name="addressValidity" value=" {{$file->addressValidity  }} " /></td>
											</tr>
											<tr>
												<th style="">remarks </th>  <td> <input type="text" name="remarks" value=" {{$file->remarks  }} " /></td>
											</tr>
											<tr>
												<th style="width: 165px;">Date</th>  <td> <input type="text" name="date" value=" {{$file->updated_at  }} " /></td>
											</tr>								
											<tr>
												<th style="">Action</th> 
												<td style="text-align:center">
													<button class="btn btn-primary">
														Save
													</button>
													<button class="btn btn-primary">
														Cancel
													</button>
												</td>
											</tr>
										</thead>
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