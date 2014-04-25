@section('content')
<style>
.tab{
	float: left; 
	width: 33.1%; 
	cursor: pointer; 
	border-right: 1px solid #dfdfdf; 
	padding: 10px 0px 10px 0px;
	font-weight:bold;
	color: #666;
}
.active{
	background-color:#ededed;
}
.tab:hover{
	background-color:#f5f5f5;
}
.ssi, .survey {display:none;}
</style>

<?php 
if( Session::has('msgSuccess') or isset($msgSuccess) ){ 
?>
	<div class="alert alert-success" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; line-height: 25px;" id="msg-success1"> 
		{{Session::get('msgSuccess')}} 
		{{ (isset($msgSuccess))? $msgSuccess:'' }}
	</div>
<?php } 
if( Session::has('msgError') or isset($msgError)){										
?>
	<div class="alert alert-error" style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; padding: 8px;" id="msg-error1">
		{{Session::get('msgError')}} 
		{{ (isset($msgError))? $msgError:'' }}
	</div>    
<?php } ?>


<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<div class="box12 block ">
					<div class="w-box">
						<div class="w-box-header" style="position:static; border-right:1px solid #ddd; padding-right: 0px !important;">
							<?php								
								//$file = CsdbCustomerRaw::where('id',$_GET['batchID'])->get()->first();
							?>
							<div class="pull-left">Edit Record [Batch Name: {{ $batchName }} - {{ $batchYear.'/'.$batchMonth.'/'.$batchWeek }}]</div>
							<br/>
							<div style="margin: 1px 0px 0px -11px;">
								<div class="tab active" id="cleansing" style="border-left:1px solid #ddd"><span style="padding-left: 20px;">Cleansing</span></div>
								<div class="tab" id="survey" ><span style="padding-left: 20px;">Survey</span></div>
								<div class="tab" id="ssi" style="width:33.14%" ><span style="padding-left: 20px;">SSI</span></div>
							</div>
						</div>
						<div class="w-box-content">
							<div class="row-fluid">
								<div class="span12">
									{{ Form::open(array('url' => URL::route('storeEditUploadedRecordByCaller') )) }}
									<input type="hidden" name="id" value="{{$file->id  }}" />
									<table cellpadding="10px" class="table table-striped table-bordered mediaTable ">
										<thead>
											<tr class="cleansing">
												<th style="width: 33.3%;">Title</th>
												<td> <input type="text" name="title" value="{{$file->title}}" /> </td>
												<td>{{$originalFile->title}}</td>
											</tr>
											<tr class="cleansing">
												<th style="">customer Name </th> 
												<td> <lable name="customerName">{{$file->customerName  }}</lable></td>
												<td>{{$originalFile->customerName}}</td>
											</tr>
											<tr class="cleansing">
												<th style="">customer ID </th> 
												<td> <lable name="customerID"> {{$file->customerID  }} </lable></td>
												<td>{{$originalFile->customerID}}</td>
											</tr>
											<tr class="cleansing">
												<th style="">customer Type </th>
												<td> <lable name="customerType">{{$file->customerType }}</lable></td>
												<td>{{$originalFile->customerType}}</td>
											</tr>
											<!--
												<tr class="cleansing">
												<th style="">customer Group </th> <td> <lable name="customerGroup" >{{$file->customerGroup  }}</lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">gender </th> <td> <lable name="gender">{{$file->gender  }}</lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">age </th> <td> <lable name="age"> {{$file->age }}</lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">age Group </th> <td> <lable name="ageGroup"> {{$file->ageGroup  }} </lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">dob </th> <td> <lable name="dob">{{$file->dob }} </lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">year DOB </th> <td> <lable name="yearDOB "> {{$file->yearDOB }}</lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">month DOB </th> <td> <lable name="monthDOB ">{{$file->monthDOB }} </lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">day DOB </th> <td> <lable name="dayDOB "> {{$file->dayDOB  }}</lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">race </th> <td> <lable name="race "> {{$file->race  }} </lable></td>
											</tr>
											<tr class="cleansing">
												<th style="">religion </th> <td> <lable name="religion "> {{$file->religion  }} </lable></td>
											</tr>
											-->
											<tr class="cleansing">
												<th style="">industry </th> 
												<td> 
													<select id="industry" {{ (strpos($file->industry,'other') !== false)? 'name="industry1"': 'name="industry"' }}> 
														<option value="Account/Admin" {{ ($file->industry=='Account/Admin')? 'selected="selected"': '' }} >Account/Admin</option>
														<option value="Advisory & Consultation" {{ ($file->industry=='Advisory & Consultation')? 'selected="selected"': '' }} > Advisory & Consultation</option>
														<option value="Architect & Designer" {{ ($file->industry=='Architect & Designer')? 'selected="selected"': '' }} >Architect & Designer</option>
														<option value="Automotive" {{ ($file->industry=='Automotive')? 'selected="selected"': '' }} >Automotive </option>
														<option value="Aircraft" {{ ($file->industry=='Aircraft')? 'selected="selected"': '' }} >Aircraft</option>
														<option value="Advertising & Promotion" {{ ($file->industry=='Advertising & Promotion')? 'selected="selected"': '' }} >Advertising & Promotion</option>
														<option value="Business" {{ ($file->industry=='')? 'selected="selected"': 'Business' }} >Business</option>
														<option value="Construction/Real Estate" {{ ($file->industry=='Construction/Real Estate')? 'selected="selected"': '' }} >Construction/Real Estate</option>
														<option value="Education" {{ ($file->industry=='Education')? 'selected="selected"': '' }} >Education</option>
														<option value="Entertainment" {{ ($file->industry=='Entertainment')? 'selected="selected"': '' }} >Entertainment</option>
														<option value="Factory/Manufacturing" {{ ($file->industry=='Factory/Manufacturing')? 'selected="selected"': '' }} >Factory/Manufacturing</option>
														<option value="Finance/Banking" {{ ($file->industry=='Finance/Banking')? 'selected="selected"': '' }} >Finance/Banking</option>
														<option value="Food & Beverage" {{ ($file->industry=='Food & Beverage')? 'selected="selected"': '' }} >Food & Beverage</option>
														<option value="Government" {{ ($file->industry=='Government')? 'selected="selected"': '' }} >Government</option>
														<option value="Hospitality" {{ ($file->industry=='Hospitality')? 'selected="selected"': '' }} >Hospitality</option>
														<option value="Housewife/Student" {{ ($file->industry=='Housewife/Student')? 'selected="selected"': '' }} >Housewife/Student</option>
														<option value="Human Resources" {{ ($file->industry=='Human Resources')? 'selected="selected"': '' }} >Human Resources</option>
														<option value="Insurance" {{ ($file->industry=='Insurance')? 'selected="selected"': '' }} >Insurance</option>
														<option value="IT & Telecommunication" {{ ($file->industry=='IT & Telecommunication')? 'selected="selected"': '' }} >IT & Telecommunication</option>
														<option value="Management" {{ ($file->industry=='Management')? 'selected="selected"': '' }} >Management</option>
														<option value="Medication" {{ ($file->industry=='Medication')? 'selected="selected"': '' }} >Medication</option>
														<option value="Oil & Gas" {{ ($file->industry=='Oil & Gas')? 'selected="selected"': '' }} >Oil & Gas</option>
														<option value="Professional" {{ ($file->industry=='Professional')? 'selected="selected"': '' }} >Professional</option>
														<option value="Plantation & Agriculture" {{ ($file->industry=='Plantation & Agriculture')? 'selected="selected"': '' }} >Plantation & Agriculture</option>
														<option value="Police/Army" {{ ($file->industry=='Police/Army')? 'selected="selected"': '' }} >Police/Army</option>
														<option value="Sales/Marketing" {{ ($file->industry=='Sales/Marketing')? 'selected="selected"': '' }} >Sales/Marketing </option>
														<option value="Shipping/Logistic" {{ ($file->industry=='Shipping/Logistic')? 'selected="selected"': '' }} >Shipping/Logistic</option>
														<option value="Social/Non-Profit Organization" {{ ($file->industry=='Social/Non-Profit Organization')? 'selected="selected"': '' }} >Social/Non-Profit Organization </option>
														<option value="Sport" {{ ($file->industry=='Sport')? 'selected="selected"': '' }} >Sport </option>
														<option value="Technical/Engineering" {{ ($file->industry=='Technical/Engineering')? 'selected="selected"': '' }} >Technical/Engineering</option>
														<option value="Tourism" {{ ($file->industry=='Tourism')? 'selected="selected"': '' }} >Tourism</option>
														<option value="Wholesale/Retail" {{ ($file->industry=='Wholesale/Retail')? 'selected="selected"': '' }} >Wholesale/Retail</option>
														<option value="Workshop/Service Center" {{ ($file->industry=='Workshop/Service Center')? 'selected="selected"': '' }} >Workshop/Service Center </option>													 
														<option value="other" {{ (strpos($file->industry,'other') !== false)? 'selected="selected"': '' }} >Other</option>
													</select>
													<?php
														if(strpos($file->industry,'other') !== false){
															$industry = explode('(', $file->industry);
															$industry = explode(')', $industry[1]);
														}
													?>
													<input type="text" id="industry1" {{ (strpos($file->industry,'other') !== false)? 'style="display:inline-block" name="industry"': 'style="display:none" name="industry1"' }} placeholder="Please specify" value="<?php echo (strpos($file->industry,'other') !== false) ? $industry[0] : '' ?>" />
												</td>
												<td>{{$originalFile->industry}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">occupation </th> 
												<td> 
													<select id="occupation" {{ (strpos($file->occupation,'other') !== false)? 'name="occupation1"': 'name="occupation"' }} > 
														<option value="Professionals (e.g. Lawyer,Engineer,Doctor,Architect)" {{ ($file->occupation=='Professionals (e.g. Lawyer,Engineer,Doctor,Architect)')? 'selected="selected"': '' }} >Professionals (e.g. Lawyer,Engineer,Doctor,Architect)</option>													 
														<option value="Upper / Senior Management(e.g. CEO,MD,Director)" {{ ($file->occupation=='Upper / Senior Management(e.g. CEO,MD,Director)')? 'selected="selected"': '' }} >Upper / Senior Management(e.g. CEO,MD,Director)</option>
														<option value="Middle Management (e.g. Manager)" {{ ($file->occupation=='Middle Management (e.g. Manager)')? 'selected="selected"': '' }} >Middle Management (e.g. Manager)</option>
														<option value="Executive" {{ ($file->occupation=='Executive')? 'selected="selected"': '' }} >Executive</option>
														<option value="Goverment Officer / Civil Servant" {{ ($file->occupation=='Goverment Officer / Civil Servant')? 'selected="selected"': '' }} >Goverment Officer / Civil Servant</option>
														<option value="Non-executive(e.g. Skilled/semi-skilled worker,Labourer)" {{ ($file->occupation=='Non-executive(e.g. Skilled/semi-skilled worker,Labourer)')? 'selected="selected"': '' }} >Non-executive(e.g. Skilled/semi-skilled worker,Labourer)</option>
														<option value="Self-employed / Businessman" {{ ($file->occupation=='Self-employed / Businessman')? 'selected="selected"': '' }} >Self-employed / Businessman</option>
														<option value="Unemployed" {{ ($file->occupation=='Unemployed')? 'selected="selected"': '' }} >Unemployed</option>
														<option value="Retired" {{ ($file->occupation=='Retired')? 'selected="selected"': '' }} >Retired</option>
														<option value="Student" {{ ($file->occupation=='Student')? 'selected="selected"': '' }} >Student</option>
														<option value="other" {{ (strpos($file->occupation,'other') !== false)? 'selected="selected"': '' }} >Other</option>
													</select>
													<?php
														if(strpos($file->occupation,'other') !== false){
															$occupation = explode('(', $file->occupation);
															$occupation = explode(')', $occupation[1]);
														}
													?>
													<input type="text" id="occupation1" {{ (strpos($file->occupation,'other') !== false)? 'style="display:inline-block" name="occupation"': 'style="display:none" name="occupation1"' }} placeholder="Please specify" value="<?php echo (strpos($file->occupation,'other') !== false) ? $occupation[0] : '' ?>" />
												</td>
												<td>{{$originalFile->occupation}}</td>
											</tr>
											<tr class="cleansing">
												<th style="">address 1 </th> 
												<td> <input type="text" name="address1" value="{{$file->address1  }} " /></td>
												<td>{{$originalFile->address1}}</td>
											</tr>
											<tr class="cleansing">
												<th style="">address 2 </th> 
												<td> <input type="text" name="address2" value="{{$file->address2  }} " /></td>
												<td>{{$originalFile->address2}}</td>
											</tr>

											<tr class="cleansing">					
												<th style="">address 3 </th>
												<td> <input type="text" name="address3" value="{{$file->address3 }} " /></td>
												<td>{{$originalFile->address3}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">post code </th>
												<td> <input type="text" name="postcode" value="{{$file->postcode  }} " /></td>
												<td>{{$originalFile->postcode}}</td>

											</tr>
											<!--
												<tr class="cleansing">
													<th style="">city Code </th><td> <lable name="cityCode"> {{$file->cityCode  }} </lable></td>
												</tr>
											-->
											<tr class="cleansing">
												<th style="">city </th>
												<td> <input type="text" name="city" value="{{$file->city  }} " /></td>
												<td>{{$originalFile->city}}</td>

											</tr>
											<!--
												<tr class="cleansing">
													<th style="">state Code </th><td> <lable name="stateCode" > {{$file->stateCode  }} </lable></td>
												</tr>
											-->
											<tr class="cleansing">
												<th style="">state </th>
												<td> <input type="text" name="state" value="{{$file->state  }} " /></td>
												<td>{{$originalFile->state}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">country </th>
												<td> <input type="text" name="country" value="{{$file->country  }} " /></td>
												<td>{{$originalFile->country}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">tel No </th> 
												<td> <input type="text" name="telNo" value="{{$file->telNo  }} " /></td>
												<td>{{$originalFile->telNo}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">mobile No </th> 
												<td> <input type="text" name="mobileNo" value="{{$file->mobileNo  }} " /></td>
												<td>{{$originalFile->mobileNo}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">fax No </th> 
												<td> <input type="text" name="faxNo" value="{{$file->faxNo  }} " /></td>
												<td>{{$originalFile->faxNo}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">email </th> 
												<td> <input type="text" name="email" value="{{$file->email  }} " /></td>
												<td>{{$originalFile->email}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">contact Person </th> 
												<td> <input type="text" name="contactPerson" value="{{$file->contactPerson  }} " /></td>
												<td>{{$originalFile->contactPerson}}</td>

											</tr>
											<tr class="cleansing">
												<th style="">personal Income </th> 
												<td> 
													<select name="personalIncome" />
														<option value="NOT APPLICABLE" {{ ($file->personalIncome=='NOT APPLICABLE')? 'selected="selected"': '' }} >NOT APPLICABLE</option>
														<option value="BELOW RM 2,501" {{ ($file->personalIncome=='BELOW RM 2,501')? 'selected="selected"': '' }} >BELOW RM 2,501</option>
														<option value="RM 2,501 - RM 5,000" {{ ($file->personalIncome=='RM 2,501 - RM 5,000')? 'selected="selected"': '' }} >RM 2,501 - RM 5,000</option>
														<option value="RM 5,001 - RM 7,500" {{ ($file->personalIncome=='RM 5,001 - RM 7,500')? 'selected="selected"': '' }} >RM 5,001 - RM 7,500</option>
														<option value="RM 7,501 - RM 10,000" {{ ($file->personalIncome=='RM 7,501 - RM 10,000')? 'selected="selected"': '' }} >RM 7,501 - RM 10,000</option>
														<option value="RM 10,001 - RM 12,500" {{ ($file->personalIncome=='RM 10,001 - RM 12,500')? 'selected="selected"': '' }} >RM 10,001 - RM 12,500</option>
														<option value="RM 12,501 - RM 15,000" {{ ($file->personalIncome=='RM 12,501 - RM 15,000')? 'selected="selected"': '' }} >RM 12,501 - RM 15,000</option>
														<option value="RM 15,001 - RM 17,500" {{ ($file->personalIncome=='RM 15,001 - RM 17,500')? 'selected="selected"': '' }} >RM 15,001 - RM 17,500</option>
														<option value="RM 17,501 - RM 20,000" {{ ($file->personalIncome=='RM 17,501 - RM 20,000')? 'selected="selected"': '' }} >RM 17,501 - RM 20,000</option>
														<option value="RM 20,001 - RM 22,500" {{ ($file->personalIncome=='RM 20,001 - RM 22,500')? 'selected="selected"': '' }} >RM 20,001 - RM 22,500</option>
														<option value="RM 22,501 - RM 25,000" {{ ($file->personalIncome=='RM 22,501 - RM 25,000')? 'selected="selected"': '' }} >RM 22,501 - RM 25,000</option>
														<option value="RM 25,001 - RM 27,500" {{ ($file->personalIncome=='RM 25,001 - RM 27,500')? 'selected="selected"': '' }} >RM 25,001 - RM 27,500</option>
														<option value="RM 27,501 - RM 30,000" {{ ($file->personalIncome=='RM 27,501 - RM 30,000')? 'selected="selected"': '' }} >RM 27,501 - RM 30,000</option>
														<option value="ABOVE RM 30,000" {{ ($file->personalIncome=='ABOVE RM 30,000')? 'selected="selected"': '' }} >ABOVE RM 30,000</option>														
													</select>
												</td>
												<td>{{$originalFile->personalIncome}}</td>
											</tr>
											<!--
												<tr class="cleansing">
													<th style="">household Income </th> <td> <lable name="householdIncome"> {{$file->householdIncome  }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">status </th> <td> <lable name="status"> {{$file->status  }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">vso No </th> <td> <lable name="vsoNo">{{$file->vsoNo }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">vso Date </th> <td> <lable name="vsoDate">{{$file->vsoDate  }} </lable></td>
												</tr>
											-->
											<tr class="cleansing">
												<th style="">reg No </th> 
												<td> <lable name="regNo"> {{$file->regNo  }} </lable></td>
												<td>{{$originalFile->reNo}}</td>

											</tr>
											<!--
												<tr class="cleansing">
													<th style="">reg Date </th> <td> <lable name="regDate">{{$file->regDate  }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">reg State </th> <td> <lable name="regState"> {{$file->regState  }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">chassis No </th>  <td> <lable name="chassisNo">{{$file->chassisNo  }} </lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">engine No </th>  <td> <lable name="engineNo">{{$file->engineNo  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">vehicle Registration Month </th>  <td> <lable name="vehicleRegistrationMonth">{{$file->vehicleRegistrationMonth  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">vehicle Registration Year </th>  <td> <lable name="vehicleRegistrationYear">{{$file->vehicleRegistrationYear  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">brand </th>  <td> <lable name="brand">{{$file->brand  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model </th>  <td> <lable name="regState">{{$file->regState  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Code </th>  <td> <lable name="modelCode">{{$file->modelCode  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Group </th>  <td> <lable name="modelGroup">{{$file->modelGroup  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Group Code </th>  <td> <lable name="modelGroupCode">{{$file->modelGroupCode  }}</lable></td>
												</tr>

												<tr class="cleansing">
													<th style="">model Variant </th>  <td> <lable name="modelVariant">{{$file->modelVariant  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Variant Code </th>  <td> <lable name="modelVariantCode">{{$file->modelVariantCode }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Color </th>  <td> <lable name="modelColor">{{$file->modelColor  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Color Code </th>  <td> <lable name="modelColorCode">{{$file->modelColorCode  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">MFG Code </th>  <td> <lable name="mfgCode">{{$file->mfgCode  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">model Year </th>  <td> <lable name="modelYear">{{$file->modelYear  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">engine No </th>  <td> <lable name="engineNo1">{{$file->engineNo1  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">warranty Expiry Date </th>  <td> <lable name="warrantyExpiryDate">{{$file->warrantyExpiryDate  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">warranty Expiry Mileage </th>  <td> <lable name="warrantyExpiryMileage">{{$file->warrantyExpiryMileage  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">program Code </th>  <td> <lable name="programCode">{{$file->programCode  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">coupon No </th>  <td> <lable name="couponNo">{{$file->couponNo  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet Name </th>  <td> <lable name="outletName">{{$file->outletName  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet Code </th> <td> <lable name="outletCode">{{$file->outletCode  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">sales Person </th> <td> <lable name="salesPerson">{{$file->salesPerson }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet Manager </th> <td> <lable name="outletManager">{{$file->outletManager  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet Region </th> <td> <lable name="outletRegion">{{$file->outletRegion  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet State </th> <td> <lable name="outletState">{{$file->outletState  }}</lable></td>
												</tr>
												<tr class="cleansing">
													<th style="">outlet City </th> <td> <lable name="outletCity">{{$file->outletCity  }}</lable></td>
												</tr>
											-->


											<tr class="survey">
												<th colspan="2">Preferred Contact Channel</th>
											</tr>
											<tr class="survey">
												<th style="width: 33.3%;">email Notification </th> 
												<td> 
													<select name="emailNotification">
														<option value="y" {{($file->emailNotification=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->emailNotification=='n')? 'selected="selected"': '' }}  >N</option>
													</select>
												</td>
												<td>{{$originalFile->emailNotification}}</td>
											</tr>
											<tr class="survey">
												<th style="">postal Notification </th> 
												<td>
													<select name="postalNotification">
														<option value="y" {{($file->postalNotification=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->postalNotification=='n')? 'selected="selected"': '' }}  >N</option>
													</select> 
												</td>
												<td>{{$originalFile->postalNotification}}</td>
											</tr>
											<tr class="survey">
												<th style="">phone Notification </th> 
												<td> 
													<select name="phoneNotification">
														<option value="y" {{($file->phoneNotification=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->phoneNotification=='n')? 'selected="selected"': '' }}  >N</option>
													</select> 													
												</td>
												<td>{{$originalFile->phoneNotification}}</td>
											</tr>
											<tr class="survey">
												<th style="">sms Notification </th> 
												<td> 
													<select name="smsNotification">
														<option value="y" {{($file->smsNotification=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->smsNotification=='n')? 'selected="selected"': '' }}  >N</option>
													</select> 
												</td>
												<td>{{$originalFile->smsNotification}}</td>
											</tr>
											<tr class="survey">
												<th style="">fax Notification </th> 
												<td> 
													<select name="faxNotification">
														<option value="y" {{($file->faxNotification=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->faxNotification=='n')? 'selected="selected"': '' }}  >N</option>
													</select> 
												</td>
												<td>{{$originalFile->faxNotification}}</td>
											</tr>
											<tr class="survey">
												<th style="">not Interested </th> 
												<td> 
													<select name="notInterested">
														<option value="y" {{($file->notInterested=='y')? 'selected="selected"': '' }} >Y</option>
														<option value="n" {{($file->notInterested=='n')? 'selected="selected"': '' }}  >N</option>
													</select> 
												</td>
												<td>{{$originalFile->notInterested}}</td>
											</tr>
											

											<tr class="survey" style="height: 50px;">
												<td colspan="2"></td>
											</tr>
											<tr class="survey">
												<th colspan="2">Source of information when purchasing a car</th>
											</tr>
											<tr class="survey">
												<th style="">ads/articles In Newspaper Or Magazines </th>   
												<td> 
													<select name="ads_articlesInNewspaperOrMagazines">
														<option value="" {{($file->ads_articlesInNewspaperOrMagazines=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->ads_articlesInNewspaperOrMagazines=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select> 
												</td>
												<td>{{$originalFile->ads_articlesInNewspaperOrMagazines}}</td>

											</tr>
											<tr class="survey">
												<th style="">ads In Tv/radio </th>  
												<td> 
													<select name="adsInTv_radio">
														<option value="" {{($file->adsInTv_radio=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->adsInTv_radio=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select> 
												</td>
												<td>{{$originalFile->adsInTv_radio}}</td>
											</tr>
											<tr class="survey">
												<th style="">ads On Billboard </th>  
												<td> 
													<select name="adsOnBillboard">
														<option value="" {{($file->adsOnBillboard=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->adsOnBillboard=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select> 
												</td>
												<td>{{$originalFile->adsOnBillboard}}</td>
											</tr>
											<tr class="survey">
												<th style="">internet Websites Blogs </th>  
												<td> 
													<select name="internetWebsitesBlogs">														
														<option value="" {{($file->internetWebsitesBlogs=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->internetWebsitesBlogs=='yes')? 'selected="selected"': '' }} >Yes</option>
													</select>
												</td>
												<td>{{$originalFile->internetWebsitesBlogs}}</td>

											</tr>
											<tr class="survey">
												<th style="">friends & Family </th>  
												<td> 
													<select name="friendsFamily">
														<option value="" {{($file->friendsFamily=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->friendsFamily=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
											    <td>{{$originalFile->friendsFamily}}</td>

											</tr>
											<tr class="survey">
												<th style="">show room Visit </th> 
												<td> 
													<select name="showroomVisit">
														<option value="" {{($file->showroomVisit=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->showroomVisit=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->showroomVisit}}</td>

											</tr>
											<tr class="survey">
												<th style="">road show Events </th>  
												<td> 
													<select name="roadshowEvents">														
														<option value="" {{($file->roadshowEvents=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->roadshowEvents=='yes')? 'selected="selected"': '' }} >Yes</option>
													</select>
												</td>
												<td>{{$originalFile->roadshowEvents}}</td>

											</tr>
											<tr class="survey">
												<th style="">others </th>  
												<td> 
													<input type="text" name="others" />
												</td>
												<td>{{$originalFile->others}}</td>
											</tr>
											<tr class="survey">
												<th style="">N/A </th>  
												<td> 
													<select name="na">
														<option value="" {{($file->na=='')? 'selected="selected"': '' }}  > </option>
														<option value="yes" {{($file->na=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->na}}</td>

											</tr>

											<tr class="survey" style="height: 50px;">
												<td colspan="2"></td>
											</tr>
											<tr class="survey">
												<th colspan="2">Why do you choose Mitsubishi as your preferred vehicle</th>
											</tr>
											<tr class="survey">
												<th style="">design </th>  
												<td> 
													<select name="design">
														<option value="" {{($file->design=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->design=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->design}}</td>

											</tr>
											<tr class="survey">
												<th style="">performance </th>  
												<td> 
													<select name="performance">														
														<option value="" {{($file->performance=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->performance=='yes')? 'selected="selected"': '' }} >Yes</option>
													</select>
												</td>
												<td>{{$originalFile->performance}}</td>

											</tr>
											<tr class="survey">
												<th style="">price </th>  
												<td> 
													<select name="price">
														<option value="" {{($file->price=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->price=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->price}}</td>

											</tr>
											<tr class="survey">
												<th style="">brand Image </th>  
												<td> 
													<select name="brandImage">
														<option value="" {{($file->brandImage=='')? 'selected="selected"': '' }} ></option>
														<option value="yes" {{($file->brandImage=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->brandImage}}</td>

											</tr>
											<tr class="survey">
												<th style="">promotion </th>  
												<td> 
													<select name="promotion">
														<option value="" {{($file->promotion=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->promotion=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->promotion}}</td>

											</tr>
											<tr class="survey">
												<th style="">vehicle Accessories </th>  
												<td> 
													<select name="vehicleAccessories">
														<option value="" {{($file->vehicleAccessories=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->vehicleAccessories=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->vehicleAccessories}}</td>

											</tr>
											<tr class="survey">
												<th style="">vehicle Reliability </th>  
												<td> 
													<select name="vehicleReliability">
														<option value="" {{($file->vehicleReliability=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->vehicleReliability=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->vehicleReliability}}</td>

											</tr>
											<tr class="survey">
												<th style="">after Sales Service </th>  
												<td> 
													<select name="afterSalesService">
														<option value="" {{($file->afterSalesService=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->afterSalesService=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->afterSalesService}}</td>

											</tr>
											<tr class="survey">
												<th style="">mitsubishi Repeat Customer </th>  
												<td> 
													<select name="mitsubishiRepeatCustomer">
														<option value="" {{($file->mitsubishiRepeatCustomer=='')? 'selected="selected"': '' }}  ></option>
														<option value="yes" {{($file->mitsubishiRepeatCustomer=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->mitsubishiRepeatCustomer}}</td>

											</tr>
											<tr class="survey">
												<th style="">others </th>  
												<td> 
													<input type="text" name="others1" />
												</td>
												<td>{{$originalFile->others1}}</td>

											</tr>
											<tr class="survey">
												<th style="">N/A </th>  
												<td> 
													<select name="na1">
														<option value="" {{($file->na1=='')? 'selected="selected"': '' }}  > </option>
														<option value="yes" {{($file->na1=='yes')? 'selected="selected"': '' }} >Yes</option>														
													</select>
												</td>
												<td>{{$originalFile->na1}}</td>

											</tr>				

											<tr class="survey" style="height: 50px;">
												<td colspan="2"></td>
											</tr>
											<tr class="survey">
												<th style="">marital Status </th>  
												<td> 
													<select name="maritalStatus">
														<option value="single" {{($file->maritalStatus=='single')? 'selected="selected"': '' }} >Single</option>
														<option value="married without children" {{($file->maritalStatus=='married without children')? 'selected="selected"': '' }}  >Married without children</option>
														<option value="married with children" {{($file->maritalStatus=='married with children')? 'selected="selected"': '' }} >Married with children</option>
														<option value="others" {{($file->maritalStatus=='others')? 'selected="selected"': '' }} >Others</option>
														<option value="n/a" {{($file->maritalStatus=='n/a')? 'selected="selected"': '' }} >N/A</option>
													</select> 
												</td>
												<td>{{$originalFile->maritalStatus}}</td>

											</tr>
											<tr class="survey">
												<th style="">compare With Other Brands </th>  
												<td> 
													<select name="compareWithOtherBrands">
														<option value="yes" 	{{($file->compareWithOtherBrands=='yes')? 'selected="selected"': '' }} >Yes</option>
														<option value="no" 		{{($file->compareWithOtherBrands=='no')?  'selected="selected"': '' }}  >No</option>
														<option value="" {{($file->compareWithOtherBrands=='')? 'selected="selected"': '' }}  ></option>
													</select>
												</td>
												<td>{{$originalFile->compareWithOtherBrands}}</td>

											</tr>
											<tr class="survey">
												<th style="">brand Name </th> 
												 <td> <input type="text" name="brandName" value="{{$file->brandName  }} " /></td>
												 <td>{{$originalFile->brandName}}</td>

											</tr>
											<tr class="survey">
												<th style="">model Name </th>  
												<td> <input type="text" name="modelName" value="{{$file->modelName  }} " /></td>
												 <td>{{$originalFile->modelName}}</td>

											</tr>
											<tr class="survey">
												<th style="">nature Of Purchase </th>  
												<td> 
													<select name="natureOfPurchase">
														<option value="First vehicle" 	{{($file->natureOfPurchase=='First vehicle')? 'selected="selected"': '' }} >First vehicle</option>
														<option value="Replacement vehicle (already owning Mitsubishi vehicle)"  {{($file->natureOfPurchase=='Replacement vehicle (already owning Mitsubishi vehicle)')?  'selected="selected"': '' }} >Replacement vehicle (already owning Mitsubishi vehicle)</option>
														<option value="Replacement vehicle (not owning any Mitsubishi vehicle)" {{($file->natureOfPurchase=='Replacement vehicle (not owning any Mitsubishi vehicle)')? 'selected="selected"': '' }}   >Replacement vehicle (not owning any Mitsubishi vehicle)</option>
														<option value="Additional vehicle (already owning Mitsubishi vehicle)" {{($file->natureOfPurchase=='Additional vehicle (already owning Mitsubishi vehicle)')? 'selected="selected"': '' }}     >Additional vehicle (already owning Mitsubishi vehicle)</option>
														<option value="Additional vehicle (not owning any Mitsubishi vehicle)" {{($file->natureOfPurchase=='Additional vehicle (not owning any Mitsubishi vehicle)')? 'selected="selected"': '' }}     >Additional vehicle (not owning any Mitsubishi vehicle)</option>
														<option value="N/A" {{($file->natureOfPurchase=='N/A')? 'selected="selected"': '' }}  >N/A</option>
													</select>
												</td>	
												 <td>{{$originalFile->natureOfPurchase}}</td>
	
											</tr>
											<tr class="survey">
												<th style="">no Of Years Use For Previous Car </th>  
												<td> 
													<select name="noOfYearsUseForPreviousCar">
														<option value="<=1"  {{($file->noOfYearsUseForPreviousCar=='<=1')? 'selected="selected"': '' }} ><=1</option>
														<option value="2" 	 {{($file->noOfYearsUseForPreviousCar=='2')?  'selected="selected"': '' }}  >2</option>
														<option value="3" 	 {{($file->noOfYearsUseForPreviousCar=='3')?  'selected="selected"': '' }}  >4</option>
														<option value="4-5"  {{($file->noOfYearsUseForPreviousCar=='4-5')?  'selected="selected"': '' }}  >4-5</option>
														<option value="6-7"	 {{($file->noOfYearsUseForPreviousCar=='6-7')?  'selected="selected"': '' }}  >6-7</option>
														<option value="8-10" {{($file->noOfYearsUseForPreviousCar=='8-10')?  'selected="selected"': '' }}  >8-10</option>
														<option value=">10"  {{($file->noOfYearsUseForPreviousCar=='>10')?  'selected="selected"': '' }}  >>10</option>
														<option value="N/A"  {{($file->noOfYearsUseForPreviousCar=='N/A')? 'selected="selected"': '' }}  >N/A</option>
													</select>
												</td>
												<td>{{$originalFile->noOfYearsUseForPreviousCar}}</td>

											</tr>
											<tr class="survey">
												<th style="">model Name Previous Car </th>  
												<td> 
													<select id="modelNamePreviousCar" {{ (strpos($file->modelNamePreviousCar,'other') !== false)? 'name="modelNamePreviousCar1"': 'name="modelNamePreviousCar"' }}> >														
														<option value="Proton" {{ ($file->modelNamePreviousCar=='Proton')? 'selected="selected"': '' }} >Proton</option>
														<option value="Perodua" {{ ($file->modelNamePreviousCar=='Perodua')? 'selected="selected"': '' }} >Perodua</option>
														<option value="Toyota" {{ ($file->modelNamePreviousCar=='Toyota')? 'selected="selected"': '' }} >Toyota</option>
														<option value="Honda" {{ ($file->modelNamePreviousCar=='Honda')? 'selected="selected"': '' }} >Honda</option>
														<option value="Nissan" {{ ($file->modelNamePreviousCar=='Nissan')? 'selected="selected"': '' }} >Nissan</option>
														<option value="Suzuki" {{ ($file->modelNamePreviousCar=='Suzuki')? 'selected="selected"': '' }} >Suzuki</option>
														<option value="Subaru" {{ ($file->modelNamePreviousCar=='Subaru')? 'selected="selected"': '' }} >Subaru</option>
														<option value="Isuzu" {{ ($file->modelNamePreviousCar=='Isuzu')? 'selected="selected"': '' }} >Isuzu</option>
														<option value="Mazda" {{ ($file->modelNamePreviousCar=='Mazda')? 'selected="selected"': '' }} >Mazda</option>
														<option value="Ford" {{ ($file->modelNamePreviousCar=='Ford')? 'selected="selected"': '' }} >Ford</option>
														<option value="Naza Kia" {{ ($file->modelNamePreviousCar=='Naza Kia')? 'selected="selected"': '' }} >Naza Kia</option>
														<option value="Hyundai Inokom" {{ ($file->modelNamePreviousCar=='Hyundai Inokom')? 'selected="selected"': '' }} >Hyundai Inokom</option>
														<option value="Peugeot" {{ ($file->modelNamePreviousCar=='Peugeot')? 'selected="selected"': '' }} >Peugeot</option>
														<option value="Volkswagen" {{ ($file->modelNamePreviousCar=='Volkswagen')? 'selected="selected"': '' }} >Volkswagen</option>
														<option value="Hicom" {{ ($file->modelNamePreviousCar=='Hicom')? 'selected="selected"': '' }} >Hicom</option>
														<option value="other" {{ (strpos($file->modelNamePreviousCar,'other') !== false)? 'selected="selected"': '' }} >Other</option>
													</select>
													<?php
														if(strpos($file->modelNamePreviousCar,'other') !== false){
															$modelNamePreviousCar = explode('(', $file->modelNamePreviousCar);
															$modelNamePreviousCar = explode(')', $modelNamePreviousCar[1]);
														}
													?>
													<input type="text" id="modelNamePreviousCar1" {{ (strpos($file->modelNamePreviousCar,'other') !== false)? 'style="display:inline-block" name="modelNamePreviousCar"': 'style="display:none" name="modelNamePreviousCar1"' }} placeholder="Please specify" value="<?php echo (strpos($file->modelNamePreviousCar,'other') !== false) ? $modelNamePreviousCar[0] : '' ?>" />
												</td>
												<td>{{$originalFile->modelNamePreviousCar}}</td>

											</tr>
											<tr class="survey">
												<th style="">cargo Usage Applicable For Triton Model </th>  
												<td>
													<select name="cargoUsageApplicableForTritonModel">
														<?php 
															if (strpos($file->modelVariant,'TRITON') !== false) {
														?>
															<option value="Do not use at all" {{($file->cargoUsageApplicableForTritonModel=='Do not use at all')? 'selected="selected"': '' }} >Do not use at all</option>
															<option value="Rarely use (once in 6 months)" {{($file->cargoUsageApplicableForTritonModel=='Rarely use (once in 6 months)')? 'selected="selected"': '' }}  >Rarely use (once in 6 months)</option>
															<option value="Moderate use (once a month)" {{($file->cargoUsageApplicableForTritonModel=='Moderate use (once a month)')? 'selected="selected"': '' }} >Moderate use (once a month)</option>
															<option value="Often use (once a week)" {{($file->cargoUsageApplicableForTritonModel=='Often use (once a week)')? 'selected="selected"': '' }}  >Often use (once a week)</option>
															<option value="Daily use" {{($file->cargoUsageApplicableForTritonModel=='Daily use')? 'selected="selected"': '' }} >Daily use</option>
															<option value="N/A" {{($file->cargoUsageApplicableForTritonModel=='N/A')? 'selected="selected"': '' }}  >N/A</option>
														<?php }else{ ?>
															<option value="N/A" {{($file->cargoUsageApplicableForTritonModel=='N/A')? 'selected="selected"': '' }}  >N/A</option>
														<?php } ?>
													</select>
												</td>
												<td>{{$originalFile->cargoUsageApplicableForTritonModel}}</td>

											</tr>

											
											<tr class="ssi">
												<th colspan="2">Sales Consultant Rating</th>
											</tr>
											<tr class="ssi">
												<th style="width: 33.3%;">Sales Persons Personality </th>  
												<td> 
													<select name="salesPersonsPersonality">
														<option value="5" {{($file->salesPersonsPersonality=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->salesPersonsPersonality=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->salesPersonsPersonality=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->salesPersonsPersonality=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->salesPersonsPersonality=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>													
												</td>		
											</tr>
											<tr class="ssi">
												<th style="">How satisfied are you with the  product knowledge</th>  
												<td> 
													<select name="howSatisfiedAreYouWithTheProductKnowledge">
														<option value="5" {{($file->howSatisfiedAreYouWithTheProductKnowledge=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->howSatisfiedAreYouWithTheProductKnowledge=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->howSatisfiedAreYouWithTheProductKnowledge=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->howSatisfiedAreYouWithTheProductKnowledge=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->howSatisfiedAreYouWithTheProductKnowledge=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
											</td>
											</tr>
											<tr class="ssi">
												<th style="">Promotion Activities by Dealer </th>  
												<td> 
													<select name="promotionActivitiesByDealer">
														<option value="5" {{($file->promotionActivitiesByDealer=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->promotionActivitiesByDealer=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->promotionActivitiesByDealer=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->promotionActivitiesByDealer=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->promotionActivitiesByDealer=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">How satisfied are you with the handling time regarding to Product Finance and Purchase </th>  
												<td> 
													<select name="handlingTime">
														<option value="5" {{($file->handlingTime=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->handlingTime=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->handlingTime=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->handlingTime=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->handlingTime=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">Ability to deliver vehicle at promised time </th>  
												<td> 
													<select name="abilityToDeliverVehicle">
														<option value="5" {{($file->abilityToDeliverVehicle=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->abilityToDeliverVehicle=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->abilityToDeliverVehicle=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->abilityToDeliverVehicle=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->abilityToDeliverVehicle=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">How clearly the salesperson explained you the delivery document? </th>  
												<td> 
													<select name="salesPersonExplained">
														<option value="5" {{($file->salesPersonExplained=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->salesPersonExplained=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->salesPersonExplained=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->salesPersonExplained=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->salesPersonExplained=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">Overall satisfaction with the Dealer </th>  
												<td> 
													<select name="overallSatisfaction">
														<option value="5" {{($file->overallSatisfaction=='5')? 'selected="selected"': '' }}  >Very Satisfied</option>
														<option value="4" {{($file->overallSatisfaction=='3')? 'selected="selected"': '' }}  >Satisfied</option>
														<option value="3" {{($file->overallSatisfaction=='2')? 'selected="selected"': '' }}  >Neutral</option>
														<option value="2" {{($file->overallSatisfaction=='1')? 'selected="selected"': '' }}  >Dissatisfied</option>
														<option value="1" {{($file->overallSatisfaction=='0')? 'selected="selected"': '' }}  >Very Dissatisfied</option>
													</select>
												</td>
											</tr>
											<tr class="ssi" style="height: 50px;">
												<td colspan="2"></td>
											</tr>

											<tr class="ssi">
												<th style="">cleansing Status </th> 
												<td> 
													<select name="cleansingStatus"/>
														<option value="No contact" {{ ($file->cleansingStatus=='No contact')? 'selected="selected"': '' }} >No contact</option>
														<option value="No Pick up" {{ ($file->cleansingStatus=='No Pick up')? 'selected="selected"': '' }} >No Pick up</option>
														<option value="Voicemail/Line Engaged" {{ ($file->cleansingStatus=='Voicemail/Line Engaged')? 'selected="selected"': '' }} >Voicemail/Line Engaged</option>
														<option value="Call Back" {{ ($file->cleansingStatus=='Call Back')? 'selected="selected"': '' }} >Call Back</option>
														<option value="Not Willing to Entertain" {{ ($file->cleansingStatus=='Not Willing to Entertain')? 'selected="selected"': '' }} >Not Willing to Entertain</option>
														<option value="Invalid Number" {{ ($file->cleansingStatus=='Invalid Number')? 'selected="selected"': '' }} >Invalid Number</option>
														<option value="Wrong Number" {{ ($file->cleansingStatus=='Wrong Number')? 'selected="selected"': '' }} >Wrong Number</option>
														<option value="Demo Car" {{ ($file->cleansingStatus=='Demo Car')? 'selected="selected"': '' }} >Demo Car</option>
														<option value="Company No" {{ ($file->cleansingStatus=='Company No')? 'selected="selected"': '' }} >Company No</option>
														<option value="Dealer No" {{ ($file->cleansingStatus=='Dealer No')? 'selected="selected"': '' }} >Dealer No</option>
														<option value="Called Before" {{ ($file->cleansingStatus=='Called Before')? 'selected="selected"': '' }} >Called Before</option>
														<option value="Cleansed with changes with survey" {{ ($file->cleansingStatus=='Cleansed with changes with survey')? 'selected="selected"': '' }} >Cleansed with changes with survey</option>
														<option value="Cleansed with changes without survey" {{ ($file->cleansingStatus=='Cleansed with changes without survey')? 'selected="selected"': '' }} >Cleansed with changes without survey</option>
														<option value="Cleansed without changes with survey" {{ ($file->cleansingStatus=='Cleansed without changes with survey')? 'selected="selected"': '' }} >Cleansed without changes with survey</option>
														<option value="Cleansed without changes without survey" {{ ($file->cleansingStatus=='Cleansed without changes without survey')? 'selected="selected"': '' }} >Cleansed without changes without survey</option>
														<option value="other" {{ ($file->cleansingStatus=='other')? 'selected="selected"': '' }} >Other</option>

													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">address Validity </th>  
												<td> 
													<select name="addressValidity">
														<option value="Change of Address"  {{($file->addressValidity=='Change of Address')? 'selected="selected"': '' }} >Change of Address</option>
														<option value="Wrong Address" 	   {{($file->addressValidity=='Wrong Address')?  'selected="selected"': '' }}  >Wrong Address</option>
														<option value="Correct Address"    {{($file->addressValidity=='Correct Address')? 'selected="selected"': '' }}  >Correct Address</option>
														<option value="Unverified Address" {{($file->addressValidity=='Unverified Address')? 'selected="selected"': '' }}  >Unverified Address</option>
													</select>
												</td>
											</tr>
											<tr class="ssi">
												<th style="">remarks </th>  <td> <input type="text" name="remarks" value="{{$file->remarks  }} " /></td>
											</tr>								
											<tr>
												<th style="">Action</th> 
												<td style="text-align:center">
													<button class="btn btn-primary">
														Save
													</button>
													<a class="btn btn-primary" href="">
														Cancel
													</a>
												</td>
											</tr>
										</thead>
									</table>
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

<script>
	$(document).ready(function(){
		
		$('#cleansing').on('click', function(){
			$(this).addClass('active');
			$('#ssi').removeClass('active');
			$('#survey').removeClass('active');

			$('.cleansing').delay(500).slideDown();
			$('.ssi').slideUp();
			$('.survey').slideUp();
		});

		$('#survey').on('click', function(){
			$(this).addClass('active');
			$('#ssi').removeClass('active');
			$('#cleansing').removeClass('active');

			$('.cleansing').slideUp();
			$('.ssi').slideUp();
			$('.survey').delay(500).slideDown();
		});

		$('#ssi').on('click', function(){
			$(this).addClass('active');
			$('#survey').removeClass('active');
			$('#cleansing').removeClass('active');

			$('.cleansing').slideUp();
			$('.ssi').delay(500).slideDown();
			$('.survey').slideUp();
		});

		$('#industry').on('change', function(){
			if( $('#industry').val()=='other' ){
				$('#industry1').val("").css({ 'display' : 'inline-block'});
				$('#industry1').attr('name', 'industry');
				$('#industry').attr('name', 'industry1');
			}else{
				$('#industry1').css({ 'display' : 'none'});
				$('#industry1').attr('name', 'industry1');
				$('#industry').attr('name', 'industry');
			}
		});

		$('#occupation').on('change', function(){
			if( $('#occupation').val()=='other' ){
				$('#occupation1').val("").css({ 'display' : 'inline-block'});
				$('#occupation1').attr('name', 'occupation');
				$('#occupation').attr('name', 'occupation1');
			}else{
				$('#occupation1').css({ 'display' : 'none'});
				$('#occupation1').attr('name', 'occupation1');
				$('#occupation').attr('name', 'occupation');
			}
		});

		$('#modelNamePreviousCar').on('change', function(){
			if( $('#modelNamePreviousCar').val()=='other' ){
				$('#modelNamePreviousCar1').val("").css({ 'display' : 'inline-block'});
				$('#modelNamePreviousCar1').attr('name', 'modelNamePreviousCar');
				$('#modelNamePreviousCar').attr('name', 'modelNamePreviousCar1');
			}else{
				$('#modelNamePreviousCar1').css({ 'display' : 'none'});
				$('#modelNamePreviousCar1').attr('name', 'modelNamePreviousCar1');
				$('#modelNamePreviousCar').attr('name', 'modelNamePreviousCar');
			}
		});

	}); 
</script>

@stop