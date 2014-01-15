<?php

class ClientController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.clientAdmin.master';

	public function clientIndex()
	{
		$this->layout->content = View::make('clientAdmin.index');
	}

	public function readExcelFile()
	{
		$this->layout->content = View::make('clientAdmin.viewExcelFile');
	}

	public function viewFiles()
	{
		$this->layout->content = View::make('clientAdmin.viewFiles' );
	}

	public function importFile()
	{
		$this->layout->content = View::make('clientAdmin.importFile' );
	}


	public function storeFileIntoDB()
	{
		try {

			$rules = array(
				'file' => 'required',
				'batchName' => 'required'
				);
			$validator = Validator::make(Input::all(),$rules);
			if ($validator->fails())
			{
				$errors = $validator->messages();
				if( $errors->has('file') ){
					$msg = 'Please select a file.';	
				}else if( $errors->has('batchName') ){
					$msg = 'Please enter a value for batch name.';						
				}
				return Redirect::back()->with('msgError', $msg);
			}


			if (strpos($_FILES['file']['type'],'officedocument.spreadsheet') === false and strpos($_FILES['file']['type'],'excel') === false) {
				return Redirect::back()->with('msgError','Wrong file format. Please select an excel file.');
			}

			$batchYear = CsdbCustomerMonthYearRaw::max('batchYear');
			$batchMonth = CsdbCustomerMonthYearRaw::where('batchYear', $batchYear)->max('batchMonth');
			$lastWeekBatchStatus = CsdbCustomerMonthYearRaw::where('batchYear', $batchYear)->where('batchMonth', $batchMonth)->orderby('batchWeek', 'desc')->pluck('batchStatus');
			
			if($lastWeekBatchStatus != 'confirm'){
				return Redirect::back()->with('msgError',$batchYear.' '.$batchMonth.' '.$lastWeekBatchStatus);
			}
												

			if (Input::hasFile('file') )
			{

				$destinationPath = public_path().'/excelFiles/';
				$fileName = Input::file('file')->getClientOriginalName();
				Input::file('file')->move($destinationPath, $fileName); 


				//$fileName = 'batch3.xlsx';
				$inputFileType = PHPExcel_IOFactory::identify( $destinationPath.$fileName );
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load( $destinationPath.$fileName  );
				$sheet = $objPHPExcel->getSheet(0); 
				$highestRow = $sheet->getHighestRow(); 

				$batchID = CsdbCustomerRaw::max('batchID') + 1;

				//  Loop through each row of the worksheet in turn
				for ($row = 3; $row <= $highestRow; $row++){ 
					//  Read a row of data into an array
					$rowData = $sheet->rangeToArray('A' . $row . ':' . 'DO' . $row,NULL, TRUE, FALSE);
					//  Insert row data array into your database of choice here
					$num= 0;
					//for( $r=1; $r <= 119; $r++){					

					$csdbCustomerRaw = new CsdbCustomerRaw;					


					$csdbCustomerRaw->title = $rowData[0][$num++];
					$csdbCustomerRaw->batchID = $batchID ;
					$csdbCustomerRaw->batchName = Input::get('batchName') ;
					$csdbCustomerRaw->batchYear = Input::get('year') ;
					$csdbCustomerRaw->batchMonth = Input::get('month') ;
					$csdbCustomerRaw->batchWeek = Input::get('week') ;

					$csdbCustomerRaw->customerName = $rowData[0][$num++];
					$csdbCustomerRaw->customerID = $rowData[0][$num++];
					$csdbCustomerRaw->customerType = $rowData[0][$num++];
					$csdbCustomerRaw->customerGroup = $rowData[0][$num++];
					$csdbCustomerRaw->gender = $rowData[0][$num++];
					$csdbCustomerRaw->age = $rowData[0][$num++];
					$csdbCustomerRaw->ageGroup = $rowData[0][$num++];
					$csdbCustomerRaw->dob = $rowData[0][$num++];
					$csdbCustomerRaw->yearDOB = $rowData[0][$num++];
					$csdbCustomerRaw->monthDOB = $rowData[0][$num++];
					$csdbCustomerRaw->dayDOB = $rowData[0][$num++];
					$csdbCustomerRaw->race = $rowData[0][$num++];
					$csdbCustomerRaw->religion = $rowData[0][$num++];
					$csdbCustomerRaw->industry = $rowData[0][$num++];
					$csdbCustomerRaw->occupation = $rowData[0][$num++];
					$csdbCustomerRaw->address1 = $rowData[0][$num++];
					$csdbCustomerRaw->address2 = $rowData[0][$num++];						
					$csdbCustomerRaw->address3 = $rowData[0][$num++];

					$csdbCustomerRaw->postcode = $rowData[0][$num++];
					$csdbCustomerRaw->cityCode = $rowData[0][$num++];
					$csdbCustomerRaw->city = $rowData[0][$num++];
					$csdbCustomerRaw->stateCode = $rowData[0][$num++];
					$csdbCustomerRaw->state = $rowData[0][$num++];
					$csdbCustomerRaw->country = $rowData[0][$num++];
					$csdbCustomerRaw->telNo = $rowData[0][$num++];
					$csdbCustomerRaw->mobileNo = $rowData[0][$num++];
					$csdbCustomerRaw->faxNo = $rowData[0][$num++];
					$csdbCustomerRaw->email = $rowData[0][$num++];
					$csdbCustomerRaw->contactPerson = $rowData[0][$num++];
					$csdbCustomerRaw->personalIncome = $rowData[0][$num++];
					$csdbCustomerRaw->householdIncome = $rowData[0][$num++];
					$csdbCustomerRaw->status = $rowData[0][$num++];
					$csdbCustomerRaw->vsoNo = $rowData[0][$num++];
					$csdbCustomerRaw->vsoDate = $rowData[0][$num++];
					$csdbCustomerRaw->regNo = $rowData[0][$num++];
					$csdbCustomerRaw->regDate = $rowData[0][$num++];
					$csdbCustomerRaw->regState = $rowData[0][$num++];
					$csdbCustomerRaw->chassisNo = $rowData[0][$num++];
					$csdbCustomerRaw->engineNo = $rowData[0][$num++];
					$csdbCustomerRaw->vehicleRegistrationMonth = $rowData[0][$num++];
					$csdbCustomerRaw->vehicleRegistrationYear = $rowData[0][$num++];


					$csdbCustomerRaw->brand = $rowData[0][$num++];
					$csdbCustomerRaw->model = $rowData[0][$num++];
					$csdbCustomerRaw->modelCode = $rowData[0][$num++];
					$csdbCustomerRaw->modelGroup = $rowData[0][$num++];
					$csdbCustomerRaw->modelGroupCode = $rowData[0][$num++];
					$csdbCustomerRaw->modelVariant = $rowData[0][$num++];
					$csdbCustomerRaw->modelVariantCode = $rowData[0][$num++];
					$csdbCustomerRaw->modelColor = $rowData[0][$num++];
					$csdbCustomerRaw->modelColorCode = $rowData[0][$num++];
					$csdbCustomerRaw->mfgCode = $rowData[0][$num++];


					$csdbCustomerRaw->modelYear = $rowData[0][$num++];
					$csdbCustomerRaw->engineNo1 = $rowData[0][$num++];
					$csdbCustomerRaw->warrantyExpiryDate = $rowData[0][$num++];
					$csdbCustomerRaw->warrantyExpiryMileage = $rowData[0][$num++];
					$csdbCustomerRaw->programCode = $rowData[0][$num++];
					$csdbCustomerRaw->couponNo = $rowData[0][$num++];
					$csdbCustomerRaw->outletName = $rowData[0][$num++];
					$csdbCustomerRaw->outletCode = $rowData[0][$num++];
					$csdbCustomerRaw->salesPerson = $rowData[0][$num++];
					$csdbCustomerRaw->outletManager = $rowData[0][$num++];


					$csdbCustomerRaw->outletRegion = $rowData[0][$num++];
					$csdbCustomerRaw->outletState = $rowData[0][$num++];
					$csdbCustomerRaw->outletCity = $rowData[0][$num++];
					$csdbCustomerRaw->emailNotification = $rowData[0][$num++];
					$csdbCustomerRaw->postalNotification = $rowData[0][$num++];
					$csdbCustomerRaw->phoneNotification = $rowData[0][$num++];
					$csdbCustomerRaw->smsNotification = $rowData[0][$num++];
					$csdbCustomerRaw->faxNotification = $rowData[0][$num++];
					$csdbCustomerRaw->notInterested = $rowData[0][$num++];
					$csdbCustomerRaw->maritalStatus = $rowData[0][$num++];


					$csdbCustomerRaw->ads_articlesInNewspaperOrMagazines = $rowData[0][$num++];
					$csdbCustomerRaw->adsInTv_radio = $rowData[0][$num++];
					$csdbCustomerRaw->adsOnBillboard = $rowData[0][$num++];
					$csdbCustomerRaw->internetWebsitesBlogs = $rowData[0][$num++];
					$csdbCustomerRaw->friendsFamily = $rowData[0][$num++];
					$csdbCustomerRaw->showroomVisit = $rowData[0][$num++];
					$csdbCustomerRaw->roadshowEvents = $rowData[0][$num++];
					$csdbCustomerRaw->others = $rowData[0][$num++];
					$csdbCustomerRaw->na = $rowData[0][$num++];
					$csdbCustomerRaw->design = $rowData[0][$num++];

					$csdbCustomerRaw->performance = $rowData[0][$num++];
					$csdbCustomerRaw->price = $rowData[0][$num++];
					$csdbCustomerRaw->brandImage = $rowData[0][$num++];
					$csdbCustomerRaw->promotion = $rowData[0][$num++];
					$csdbCustomerRaw->vehicleAccessories = $rowData[0][$num++];
					$csdbCustomerRaw->vehicleReliability = $rowData[0][$num++];
					$csdbCustomerRaw->afterSalesService = $rowData[0][$num++];
					$csdbCustomerRaw->mitsubishiRepeatCustomer = $rowData[0][$num++];
					$csdbCustomerRaw->others1 = $rowData[0][$num++];
					$csdbCustomerRaw->na1 = $rowData[0][$num++];

					$csdbCustomerRaw->privateDailyTransportation = $rowData[0][$num++];
					$csdbCustomerRaw->privateLeisureActivities = $rowData[0][$num++];
					$csdbCustomerRaw->privateOthers = $rowData[0][$num++];
					$csdbCustomerRaw->commercialSiteVisit = $rowData[0][$num++];
					$csdbCustomerRaw->commercialTransportGoodsItems = $rowData[0][$num++];
					$csdbCustomerRaw->commercialToCarryPeople = $rowData[0][$num++];
					$csdbCustomerRaw->commercialToSupportClientUsage = $rowData[0][$num++];
					$csdbCustomerRaw->commercialOthers = $rowData[0][$num++];
					$csdbCustomerRaw->commercialNA = $rowData[0][$num++];
					$csdbCustomerRaw->compareWithOtherBrands = $rowData[0][$num++];

					$csdbCustomerRaw->brandName = $rowData[0][$num++];
					$csdbCustomerRaw->natureOfPurchase = $rowData[0][$num++];
					$csdbCustomerRaw->noOfYearsUseForPreviousCar = $rowData[0][$num++];
					$csdbCustomerRaw->modelNamePreviousCar = $rowData[0][$num++];
					$csdbCustomerRaw->cargoUsageApplicableForTritonModel = $rowData[0][$num++];
					$csdbCustomerRaw->salesPersonsPersonality = $rowData[0][$num++];
					$csdbCustomerRaw->howSatisfiedAreYouWithTheProductKnowledge = $rowData[0][$num++];
					$csdbCustomerRaw->promotionActivitiesByDealer = $rowData[0][$num++];
					$csdbCustomerRaw->handlingTime = $rowData[0][$num++];
					$csdbCustomerRaw->abilityToDeliverVehicle = $rowData[0][$num++];

					$csdbCustomerRaw->salesPersonExplained = $rowData[0][$num++];
					$csdbCustomerRaw->overallSatisfaction = $rowData[0][$num++];
					$csdbCustomerRaw->cleansingStatus = $rowData[0][$num++];
					$csdbCustomerRaw->addressValidity = $rowData[0][$num++];
					$csdbCustomerRaw->remarks = $rowData[0][$num++];	

					$csdbCustomerRaw->save();
				}		
			} 
		} catch(Exception $e) {
			die('Error loading file : '.$e->getMessage());
		}


		return Redirect::back()->with('msgSuccess','Your file is imported successfuly.');

	}

	public function confirmUploadedFile($batchID){
		$csdbCustomerRaw = DB::table('customer_uploaded_raw')->Join('customer_monthyear_raw', function($join){ 
													$join->on('customer_monthyear_raw.customerID', '=', 'customer_uploaded_raw.customerID')
													->On( 'customer_monthyear_raw.regNo', '=' , 'customer_uploaded_raw.regNo')
													->On( 'customer_monthyear_raw.chassisNo', '=' , 'customer_uploaded_raw.chassisNo')
													->On( 'customer_monthyear_raw.vehicleRegistrationMonth', '=' , 'customer_uploaded_raw.vehicleRegistrationMonth')
													->On( 'customer_monthyear_raw.vehicleRegistrationYear', '=' , 'customer_uploaded_raw.vehicleRegistrationYear');
												})->where('customer_uploaded_raw.batchID',$batchID)->get();
		$batchName = CsdbCustomerRaw::where('batchID',$batchID)->pluck('batchName');
		$batchYear = CsdbCustomerRaw::where('batchID',$batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerRaw::where('batchID',$batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerRaw::where('batchID',$batchID)->pluck('batchWeek');

		$cnt = CsdbCustomerRaw::where('batchID', $batchID)->where('batchStatus', '!=', 'confirm')->count();
		
		if($cnt>0){			

				foreach($csdbCustomerRaw as $row){
					$csdbCustomerDuplicatedRaw = new CsdbCustomerDuplicatedRaw;			

					$csdbCustomerDuplicatedRaw->title = $row->title;
					$csdbCustomerDuplicatedRaw->batchID = $batchID ;
					$csdbCustomerDuplicatedRaw->batchName = $batchName;
					$csdbCustomerDuplicatedRaw->batchYear = $batchYear;
					$csdbCustomerDuplicatedRaw->batchMonth = $batchMonth;
					$csdbCustomerDuplicatedRaw->batchWeek = $batchWeek;

					$csdbCustomerDuplicatedRaw->customerName = $row->customerName;
					$csdbCustomerDuplicatedRaw->customerID = $row->customerID;
					$csdbCustomerDuplicatedRaw->customerType = $row->customerType;
					$csdbCustomerDuplicatedRaw->customerGroup = $row->customerGroup;
					$csdbCustomerDuplicatedRaw->gender = $row->gender;
					$csdbCustomerDuplicatedRaw->age = $row->age;
					$csdbCustomerDuplicatedRaw->ageGroup = $row->ageGroup;
					$csdbCustomerDuplicatedRaw->dob = $row->dob;
					$csdbCustomerDuplicatedRaw->yearDOB = $row->yearDOB;
					$csdbCustomerDuplicatedRaw->monthDOB = $row->monthDOB;
					$csdbCustomerDuplicatedRaw->dayDOB = $row->dayDOB;
					$csdbCustomerDuplicatedRaw->race = $row->race;
					$csdbCustomerDuplicatedRaw->religion = $row->religion;
					$csdbCustomerDuplicatedRaw->industry = $row->industry;
					$csdbCustomerDuplicatedRaw->occupation = $row->occupation;
					$csdbCustomerDuplicatedRaw->address1 = $row->address1;
					$csdbCustomerDuplicatedRaw->address2 = $row->address2 ;						
					$csdbCustomerDuplicatedRaw->address3 = $row->address3 ;

					$csdbCustomerDuplicatedRaw->postcode = $row->postcode;
					$csdbCustomerDuplicatedRaw->cityCode = $row->cityCode;
					$csdbCustomerDuplicatedRaw->city = $row->city;
					$csdbCustomerDuplicatedRaw->stateCode = $row->stateCode;
					$csdbCustomerDuplicatedRaw->state = $row->state;
					$csdbCustomerDuplicatedRaw->country = $row->country;
					$csdbCustomerDuplicatedRaw->telNo = $row->telNo;
					$csdbCustomerDuplicatedRaw->mobileNo = $row->mobileNo;
					$csdbCustomerDuplicatedRaw->faxNo = $row->faxNo;
					$csdbCustomerDuplicatedRaw->email = $row->email;
					$csdbCustomerDuplicatedRaw->contactPerson = $row->contactPerson;
					$csdbCustomerDuplicatedRaw->personalIncome = $row->personalIncome;
					$csdbCustomerDuplicatedRaw->householdIncome = $row->householdIncome;
					$csdbCustomerDuplicatedRaw->status = $row->status;
					$csdbCustomerDuplicatedRaw->vsoNo = $row->vsoNo;
					$csdbCustomerDuplicatedRaw->vsoDate = $row->vsoDate;
					$csdbCustomerDuplicatedRaw->regNo = $row->regNo;
					$csdbCustomerDuplicatedRaw->regDate = $row->regDate;
					$csdbCustomerDuplicatedRaw->regState = $row->regState;
					$csdbCustomerDuplicatedRaw->chassisNo = $row->chassisNo;
					$csdbCustomerDuplicatedRaw->engineNo = $row->engineNo;
					$csdbCustomerDuplicatedRaw->vehicleRegistrationMonth = $row->vehicleRegistrationMonth;
					$csdbCustomerDuplicatedRaw->vehicleRegistrationYear = $row->vehicleRegistrationYear;

					$csdbCustomerDuplicatedRaw->brand = $row->brand;
					$csdbCustomerDuplicatedRaw->model = $row->model;
					$csdbCustomerDuplicatedRaw->modelCode = $row->modelCode;
					$csdbCustomerDuplicatedRaw->modelGroup = $row->modelGroup;
					$csdbCustomerDuplicatedRaw->modelGroupCode = $row->modelGroupCode;
					$csdbCustomerDuplicatedRaw->modelVariant = $row->modelVariant;
					$csdbCustomerDuplicatedRaw->modelVariantCode = $row->modelVariantCode ;
					$csdbCustomerDuplicatedRaw->modelColor = $row->modelColor;
					$csdbCustomerDuplicatedRaw->modelColorCode = $row->modelColorCode;
					$csdbCustomerDuplicatedRaw->mfgCode = $row->mfgCode;

					$csdbCustomerDuplicatedRaw->modelYear = $row->modelYear;
					$csdbCustomerDuplicatedRaw->engineNo1 = $row->engineNo1 ;
					$csdbCustomerDuplicatedRaw->warrantyExpiryDate = $row->warrantyExpiryDate ;
					$csdbCustomerDuplicatedRaw->warrantyExpiryMileage = $row->warrantyExpiryMileage ;
					$csdbCustomerDuplicatedRaw->programCode = $row->programCode ;
					$csdbCustomerDuplicatedRaw->couponNo = $row->couponNo ;
					$csdbCustomerDuplicatedRaw->outletName = $row->outletName ;
					$csdbCustomerDuplicatedRaw->outletCode = $row->outletCode ;
					$csdbCustomerDuplicatedRaw->salesPerson = $row->salesPerson ;
					$csdbCustomerDuplicatedRaw->outletManager = $row->outletManager ;

					$csdbCustomerDuplicatedRaw->outletRegion = $row->outletRegion ;
					$csdbCustomerDuplicatedRaw->outletState = $row->outletState ;
					$csdbCustomerDuplicatedRaw->outletCity = $row->outletCity ;
					$csdbCustomerDuplicatedRaw->emailNotification = $row->emailNotification ;
					$csdbCustomerDuplicatedRaw->postalNotification = $row->postalNotification ;
					$csdbCustomerDuplicatedRaw->phoneNotification = $row->phoneNotification ;
					$csdbCustomerDuplicatedRaw->smsNotification = $row->smsNotification ;
					$csdbCustomerDuplicatedRaw->faxNotification = $row->faxNotification ;
					$csdbCustomerDuplicatedRaw->notInterested = $row->notInterested ;
					$csdbCustomerDuplicatedRaw->maritalStatus = $row->maritalStatus ;

					$csdbCustomerDuplicatedRaw->ads_articlesInNewspaperOrMagazines = $row->ads_articlesInNewspaperOrMagazines ;
					$csdbCustomerDuplicatedRaw->adsInTv_radio = $row->adsInTv_radio ;
					$csdbCustomerDuplicatedRaw->adsOnBillboard = $row->adsOnBillboard ;
					$csdbCustomerDuplicatedRaw->internetWebsitesBlogs = $row->internetWebsitesBlogs ;
					$csdbCustomerDuplicatedRaw->friendsFamily = $row->friendsFamily ;
					$csdbCustomerDuplicatedRaw->showroomVisit = $row->showroomVisit ;
					$csdbCustomerDuplicatedRaw->roadshowEvents = $row->roadshowEvents ;
					$csdbCustomerDuplicatedRaw->others = $row->others ;
					$csdbCustomerDuplicatedRaw->na = $row->na ;
					$csdbCustomerDuplicatedRaw->design = $row->design ;

					$csdbCustomerDuplicatedRaw->performance = $row->performance ;
					$csdbCustomerDuplicatedRaw->price = $row->price ;
					$csdbCustomerDuplicatedRaw->brandImage = $row->brandImage ;
					$csdbCustomerDuplicatedRaw->promotion = $row->promotion ;
					$csdbCustomerDuplicatedRaw->vehicleAccessories = $row->vehicleAccessories ;
					$csdbCustomerDuplicatedRaw->vehicleReliability = $row->vehicleReliability ;
					$csdbCustomerDuplicatedRaw->afterSalesService = $row->afterSalesService ;
					$csdbCustomerDuplicatedRaw->mitsubishiRepeatCustomer = $row->mitsubishiRepeatCustomer ;
					$csdbCustomerDuplicatedRaw->others1 = $row->others1 ;
					$csdbCustomerDuplicatedRaw->na1 = $row->na1 ;

					$csdbCustomerDuplicatedRaw->privateDailyTransportation = $row->privateDailyTransportation ;
					$csdbCustomerDuplicatedRaw->privateLeisureActivities = $row->privateLeisureActivities ;
					$csdbCustomerDuplicatedRaw->privateOthers = $row->privateOthers ;
					$csdbCustomerDuplicatedRaw->commercialSiteVisit = $row->commercialSiteVisit ;
					$csdbCustomerDuplicatedRaw->commercialTransportGoodsItems = $row->commercialTransportGoodsItems ;
					$csdbCustomerDuplicatedRaw->commercialToCarryPeople = $row->commercialToCarryPeople ;
					$csdbCustomerDuplicatedRaw->commercialToSupportClientUsage = $row->commercialToSupportClientUsage ;
					$csdbCustomerDuplicatedRaw->commercialOthers = $row->commercialOthers ;
					$csdbCustomerDuplicatedRaw->commercialNA = $row->commercialNA ;
					$csdbCustomerDuplicatedRaw->compareWithOtherBrands = $row->compareWithOtherBrands ;

					$csdbCustomerDuplicatedRaw->brandName = $row->brandName ;
					$csdbCustomerDuplicatedRaw->natureOfPurchase = $row->natureOfPurchase ;
					$csdbCustomerDuplicatedRaw->noOfYearsUseForPreviousCar = $row->noOfYearsUseForPreviousCar ;
					$csdbCustomerDuplicatedRaw->modelNamePreviousCar = $row->modelNamePreviousCar ;
					$csdbCustomerDuplicatedRaw->cargoUsageApplicableForTritonModel = $row->cargoUsageApplicableForTritonModel ;
					$csdbCustomerDuplicatedRaw->salesPersonsPersonality = $row->salesPersonsPersonality ;
					$csdbCustomerDuplicatedRaw->howSatisfiedAreYouWithTheProductKnowledge = $row->howSatisfiedAreYouWithTheProductKnowledge ;
					$csdbCustomerDuplicatedRaw->promotionActivitiesByDealer = $row->promotionActivitiesByDealer ;
					$csdbCustomerDuplicatedRaw->handlingTime = $row->handlingTime ;
					$csdbCustomerDuplicatedRaw->abilityToDeliverVehicle = $row->abilityToDeliverVehicle ;

					$csdbCustomerDuplicatedRaw->salesPersonExplained = $row->salesPersonExplained ;
					$csdbCustomerDuplicatedRaw->overallSatisfaction = $row->overallSatisfaction ;
					$csdbCustomerDuplicatedRaw->cleansingStatus = $row->cleansingStatus ;
					$csdbCustomerDuplicatedRaw->addressValidity = $row->addressValidity ;
					$csdbCustomerDuplicatedRaw->remarks = $row->remarks ;	

					$csdbCustomerDuplicatedRaw->save();
				}	

				

				/*--------------------------  New Data as Orginal -------------------------- */
				$csdbCustomerNewRaw =	DB::table('customer_uploaded_raw as t1')->where('batchID',$batchID)->whereRaw('NOT EXISTS(SELECT NULL
								                         FROM `csdb_customer_monthyear_raw` as t2
								                         WHERE 	t2.customerID = t1.customerID and
																t2.regNo = t1.regNo and 
																t2.chassisNo = t1.chassisNo and
																t2.vehicleRegistrationMonth = t1.vehicleRegistrationMonth and
																t2.vehicleRegistrationYear = t1.vehicleRegistrationYear)')->get();
				foreach($csdbCustomerNewRaw as $row){
					$csdbCustomerMonthYearRaw = new CsdbCustomerMonthYearOrginal;			

					$csdbCustomerMonthYearRaw->title = $row->title;
					$csdbCustomerMonthYearRaw->batchID = $batchID ;
					$csdbCustomerMonthYearRaw->batchName = $batchName;
					$csdbCustomerMonthYearRaw->batchYear = $row->batchYear;
					$csdbCustomerMonthYearRaw->batchMonth = $row->batchMonth;
					$csdbCustomerMonthYearRaw->batchWeek = $row->batchWeek;

					$csdbCustomerMonthYearRaw->customerName = $row->customerName;
					$csdbCustomerMonthYearRaw->customerID = $row->customerID;
					$csdbCustomerMonthYearRaw->customerType = $row->customerType;
					$csdbCustomerMonthYearRaw->customerGroup = $row->customerGroup;
					$csdbCustomerMonthYearRaw->gender = $row->gender;
					$csdbCustomerMonthYearRaw->age = $row->age;
					$csdbCustomerMonthYearRaw->ageGroup = $row->ageGroup;
					$csdbCustomerMonthYearRaw->dob = $row->dob;
					$csdbCustomerMonthYearRaw->yearDOB = $row->yearDOB;
					$csdbCustomerMonthYearRaw->monthDOB = $row->monthDOB;
					$csdbCustomerMonthYearRaw->dayDOB = $row->dayDOB;
					$csdbCustomerMonthYearRaw->race = $row->race;
					$csdbCustomerMonthYearRaw->religion = $row->religion;
					$csdbCustomerMonthYearRaw->industry = $row->industry;
					$csdbCustomerMonthYearRaw->occupation = $row->occupation;
					$csdbCustomerMonthYearRaw->address1 = $row->address1;
					$csdbCustomerMonthYearRaw->address2 = $row->address2 ;						
					$csdbCustomerMonthYearRaw->address3 = $row->address3 ;

					$csdbCustomerMonthYearRaw->postcode = $row->postcode;
					$csdbCustomerMonthYearRaw->cityCode = $row->cityCode;
					$csdbCustomerMonthYearRaw->city = $row->city;
					$csdbCustomerMonthYearRaw->stateCode = $row->stateCode;
					$csdbCustomerMonthYearRaw->state = $row->state;
					$csdbCustomerMonthYearRaw->country = $row->country;
					$csdbCustomerMonthYearRaw->telNo = $row->telNo;
					$csdbCustomerMonthYearRaw->mobileNo = $row->mobileNo;
					$csdbCustomerMonthYearRaw->faxNo = $row->faxNo;
					$csdbCustomerMonthYearRaw->email = $row->email;
					$csdbCustomerMonthYearRaw->contactPerson = $row->contactPerson;
					$csdbCustomerMonthYearRaw->personalIncome = $row->personalIncome;
					$csdbCustomerMonthYearRaw->householdIncome = $row->householdIncome;
					$csdbCustomerMonthYearRaw->status = $row->status;
					$csdbCustomerMonthYearRaw->vsoNo = $row->vsoNo;
					$csdbCustomerMonthYearRaw->vsoDate = $row->vsoDate;
					$csdbCustomerMonthYearRaw->regNo = $row->regNo;
					$csdbCustomerMonthYearRaw->regDate = $row->regDate;
					$csdbCustomerMonthYearRaw->regState = $row->regState;
					$csdbCustomerMonthYearRaw->chassisNo = $row->chassisNo;
					$csdbCustomerMonthYearRaw->engineNo = $row->engineNo;
					$csdbCustomerMonthYearRaw->vehicleRegistrationMonth = $row->vehicleRegistrationMonth;
					$csdbCustomerMonthYearRaw->vehicleRegistrationYear = $row->vehicleRegistrationYear;

					$csdbCustomerMonthYearRaw->brand = $row->brand;
					$csdbCustomerMonthYearRaw->model = $row->model;
					$csdbCustomerMonthYearRaw->modelCode = $row->modelCode;
					$csdbCustomerMonthYearRaw->modelGroup = $row->modelGroup;
					$csdbCustomerMonthYearRaw->modelGroupCode = $row->modelGroupCode;
					$csdbCustomerMonthYearRaw->modelVariant = $row->modelVariant;
					$csdbCustomerMonthYearRaw->modelVariantCode = $row->modelVariantCode ;
					$csdbCustomerMonthYearRaw->modelColor = $row->modelColor;
					$csdbCustomerMonthYearRaw->modelColorCode = $row->modelColorCode;
					$csdbCustomerMonthYearRaw->mfgCode = $row->mfgCode;

					$csdbCustomerMonthYearRaw->modelYear = $row->modelYear;
					$csdbCustomerMonthYearRaw->engineNo1 = $row->engineNo1 ;
					$csdbCustomerMonthYearRaw->warrantyExpiryDate = $row->warrantyExpiryDate ;
					$csdbCustomerMonthYearRaw->warrantyExpiryMileage = $row->warrantyExpiryMileage ;
					$csdbCustomerMonthYearRaw->programCode = $row->programCode ;
					$csdbCustomerMonthYearRaw->couponNo = $row->couponNo ;
					$csdbCustomerMonthYearRaw->outletName = $row->outletName ;
					$csdbCustomerMonthYearRaw->outletCode = $row->outletCode ;
					$csdbCustomerMonthYearRaw->salesPerson = $row->salesPerson ;
					$csdbCustomerMonthYearRaw->outletManager = $row->outletManager ;

					$csdbCustomerMonthYearRaw->outletRegion = $row->outletRegion ;
					$csdbCustomerMonthYearRaw->outletState = $row->outletState ;
					$csdbCustomerMonthYearRaw->outletCity = $row->outletCity ;
					$csdbCustomerMonthYearRaw->emailNotification = $row->emailNotification ;
					$csdbCustomerMonthYearRaw->postalNotification = $row->postalNotification ;
					$csdbCustomerMonthYearRaw->phoneNotification = $row->phoneNotification ;
					$csdbCustomerMonthYearRaw->smsNotification = $row->smsNotification ;
					$csdbCustomerMonthYearRaw->faxNotification = $row->faxNotification ;
					$csdbCustomerMonthYearRaw->notInterested = $row->notInterested ;
					$csdbCustomerMonthYearRaw->maritalStatus = $row->maritalStatus ;

					$csdbCustomerMonthYearRaw->ads_articlesInNewspaperOrMagazines = $row->ads_articlesInNewspaperOrMagazines ;
					$csdbCustomerMonthYearRaw->adsInTv_radio = $row->adsInTv_radio ;
					$csdbCustomerMonthYearRaw->adsOnBillboard = $row->adsOnBillboard ;
					$csdbCustomerMonthYearRaw->internetWebsitesBlogs = $row->internetWebsitesBlogs ;
					$csdbCustomerMonthYearRaw->friendsFamily = $row->friendsFamily ;
					$csdbCustomerMonthYearRaw->showroomVisit = $row->showroomVisit ;
					$csdbCustomerMonthYearRaw->roadshowEvents = $row->roadshowEvents ;
					$csdbCustomerMonthYearRaw->others = $row->others ;
					$csdbCustomerMonthYearRaw->na = $row->na ;
					$csdbCustomerMonthYearRaw->design = $row->design ;

					$csdbCustomerMonthYearRaw->performance = $row->performance ;
					$csdbCustomerMonthYearRaw->price = $row->price ;
					$csdbCustomerMonthYearRaw->brandImage = $row->brandImage ;
					$csdbCustomerMonthYearRaw->promotion = $row->promotion ;
					$csdbCustomerMonthYearRaw->vehicleAccessories = $row->vehicleAccessories ;
					$csdbCustomerMonthYearRaw->vehicleReliability = $row->vehicleReliability ;
					$csdbCustomerMonthYearRaw->afterSalesService = $row->afterSalesService ;
					$csdbCustomerMonthYearRaw->mitsubishiRepeatCustomer = $row->mitsubishiRepeatCustomer ;
					$csdbCustomerMonthYearRaw->others1 = $row->others1 ;
					$csdbCustomerMonthYearRaw->na1 = $row->na1 ;

					$csdbCustomerMonthYearRaw->privateDailyTransportation = $row->privateDailyTransportation ;
					$csdbCustomerMonthYearRaw->privateLeisureActivities = $row->privateLeisureActivities ;
					$csdbCustomerMonthYearRaw->privateOthers = $row->privateOthers ;
					$csdbCustomerMonthYearRaw->commercialSiteVisit = $row->commercialSiteVisit ;
					$csdbCustomerMonthYearRaw->commercialTransportGoodsItems = $row->commercialTransportGoodsItems ;
					$csdbCustomerMonthYearRaw->commercialToCarryPeople = $row->commercialToCarryPeople ;
					$csdbCustomerMonthYearRaw->commercialToSupportClientUsage = $row->commercialToSupportClientUsage ;
					$csdbCustomerMonthYearRaw->commercialOthers = $row->commercialOthers ;
					$csdbCustomerMonthYearRaw->commercialNA = $row->commercialNA ;
					$csdbCustomerMonthYearRaw->compareWithOtherBrands = $row->compareWithOtherBrands ;

					$csdbCustomerMonthYearRaw->brandName = $row->brandName ;
					$csdbCustomerMonthYearRaw->natureOfPurchase = $row->natureOfPurchase ;
					$csdbCustomerMonthYearRaw->noOfYearsUseForPreviousCar = $row->noOfYearsUseForPreviousCar ;
					$csdbCustomerMonthYearRaw->modelNamePreviousCar = $row->modelNamePreviousCar ;
					$csdbCustomerMonthYearRaw->cargoUsageApplicableForTritonModel = $row->cargoUsageApplicableForTritonModel ;
					$csdbCustomerMonthYearRaw->salesPersonsPersonality = $row->salesPersonsPersonality ;
					$csdbCustomerMonthYearRaw->howSatisfiedAreYouWithTheProductKnowledge = $row->howSatisfiedAreYouWithTheProductKnowledge ;
					$csdbCustomerMonthYearRaw->promotionActivitiesByDealer = $row->promotionActivitiesByDealer ;
					$csdbCustomerMonthYearRaw->handlingTime = $row->handlingTime ;
					$csdbCustomerMonthYearRaw->abilityToDeliverVehicle = $row->abilityToDeliverVehicle ;

					$csdbCustomerMonthYearRaw->salesPersonExplained = $row->salesPersonExplained ;
					$csdbCustomerMonthYearRaw->overallSatisfaction = $row->overallSatisfaction ;
					$csdbCustomerMonthYearRaw->cleansingStatus = $row->cleansingStatus ;
					$csdbCustomerMonthYearRaw->addressValidity = $row->addressValidity ;
					$csdbCustomerMonthYearRaw->remarks = $row->remarks ;	

					$csdbCustomerMonthYearRaw->save();
				}	
				/*--------------------------  End of New Data as Orginal -------------------------- */



				/*--------------------------  New Data  -------------------------- */
				$csdbCustomerNewRaw =	DB::table('customer_uploaded_raw as t1')->where('batchID',$batchID)->whereRaw('NOT EXISTS(SELECT NULL
								                         FROM `csdb_customer_monthyear_raw` as t2
								                         WHERE 	t2.customerID = t1.customerID and
																t2.regNo = t1.regNo and 
																t2.chassisNo = t1.chassisNo and
																t2.vehicleRegistrationMonth = t1.vehicleRegistrationMonth and
																t2.vehicleRegistrationYear = t1.vehicleRegistrationYear)')->get();
				foreach($csdbCustomerNewRaw as $row){
					$csdbCustomerMonthYearRaw = new CsdbCustomerMonthYearRaw;			

					$csdbCustomerMonthYearRaw->title = $row->title;
					$csdbCustomerMonthYearRaw->batchID = $batchID ;
					$csdbCustomerMonthYearRaw->batchName = $batchName;
					$csdbCustomerMonthYearRaw->batchYear = $row->batchYear;
					$csdbCustomerMonthYearRaw->batchMonth = $row->batchMonth;
					$csdbCustomerMonthYearRaw->batchWeek = $row->batchWeek;

					$csdbCustomerMonthYearRaw->customerName = $row->customerName;
					$csdbCustomerMonthYearRaw->customerID = $row->customerID;
					$csdbCustomerMonthYearRaw->customerType = $row->customerType;
					$csdbCustomerMonthYearRaw->customerGroup = $row->customerGroup;
					$csdbCustomerMonthYearRaw->gender = $row->gender;
					$csdbCustomerMonthYearRaw->age = $row->age;
					$csdbCustomerMonthYearRaw->ageGroup = $row->ageGroup;
					$csdbCustomerMonthYearRaw->dob = $row->dob;
					$csdbCustomerMonthYearRaw->yearDOB = $row->yearDOB;
					$csdbCustomerMonthYearRaw->monthDOB = $row->monthDOB;
					$csdbCustomerMonthYearRaw->dayDOB = $row->dayDOB;
					$csdbCustomerMonthYearRaw->race = $row->race;
					$csdbCustomerMonthYearRaw->religion = $row->religion;
					$csdbCustomerMonthYearRaw->industry = $row->industry;
					$csdbCustomerMonthYearRaw->occupation = $row->occupation;
					$csdbCustomerMonthYearRaw->address1 = $row->address1;
					$csdbCustomerMonthYearRaw->address2 = $row->address2 ;						
					$csdbCustomerMonthYearRaw->address3 = $row->address3 ;

					$csdbCustomerMonthYearRaw->postcode = $row->postcode;
					$csdbCustomerMonthYearRaw->cityCode = $row->cityCode;
					$csdbCustomerMonthYearRaw->city = $row->city;
					$csdbCustomerMonthYearRaw->stateCode = $row->stateCode;
					$csdbCustomerMonthYearRaw->state = $row->state;
					$csdbCustomerMonthYearRaw->country = $row->country;
					$csdbCustomerMonthYearRaw->telNo = $row->telNo;
					$csdbCustomerMonthYearRaw->mobileNo = $row->mobileNo;
					$csdbCustomerMonthYearRaw->faxNo = $row->faxNo;
					$csdbCustomerMonthYearRaw->email = $row->email;
					$csdbCustomerMonthYearRaw->contactPerson = $row->contactPerson;
					$csdbCustomerMonthYearRaw->personalIncome = $row->personalIncome;
					$csdbCustomerMonthYearRaw->householdIncome = $row->householdIncome;
					$csdbCustomerMonthYearRaw->status = $row->status;
					$csdbCustomerMonthYearRaw->vsoNo = $row->vsoNo;
					$csdbCustomerMonthYearRaw->vsoDate = $row->vsoDate;
					$csdbCustomerMonthYearRaw->regNo = $row->regNo;
					$csdbCustomerMonthYearRaw->regDate = $row->regDate;
					$csdbCustomerMonthYearRaw->regState = $row->regState;
					$csdbCustomerMonthYearRaw->chassisNo = $row->chassisNo;
					$csdbCustomerMonthYearRaw->engineNo = $row->engineNo;
					$csdbCustomerMonthYearRaw->vehicleRegistrationMonth = $row->vehicleRegistrationMonth;
					$csdbCustomerMonthYearRaw->vehicleRegistrationYear = $row->vehicleRegistrationYear;

					$csdbCustomerMonthYearRaw->brand = $row->brand;
					$csdbCustomerMonthYearRaw->model = $row->model;
					$csdbCustomerMonthYearRaw->modelCode = $row->modelCode;
					$csdbCustomerMonthYearRaw->modelGroup = $row->modelGroup;
					$csdbCustomerMonthYearRaw->modelGroupCode = $row->modelGroupCode;
					$csdbCustomerMonthYearRaw->modelVariant = $row->modelVariant;
					$csdbCustomerMonthYearRaw->modelVariantCode = $row->modelVariantCode ;
					$csdbCustomerMonthYearRaw->modelColor = $row->modelColor;
					$csdbCustomerMonthYearRaw->modelColorCode = $row->modelColorCode;
					$csdbCustomerMonthYearRaw->mfgCode = $row->mfgCode;

					$csdbCustomerMonthYearRaw->modelYear = $row->modelYear;
					$csdbCustomerMonthYearRaw->engineNo1 = $row->engineNo1 ;
					$csdbCustomerMonthYearRaw->warrantyExpiryDate = $row->warrantyExpiryDate ;
					$csdbCustomerMonthYearRaw->warrantyExpiryMileage = $row->warrantyExpiryMileage ;
					$csdbCustomerMonthYearRaw->programCode = $row->programCode ;
					$csdbCustomerMonthYearRaw->couponNo = $row->couponNo ;
					$csdbCustomerMonthYearRaw->outletName = $row->outletName ;
					$csdbCustomerMonthYearRaw->outletCode = $row->outletCode ;
					$csdbCustomerMonthYearRaw->salesPerson = $row->salesPerson ;
					$csdbCustomerMonthYearRaw->outletManager = $row->outletManager ;

					$csdbCustomerMonthYearRaw->outletRegion = $row->outletRegion ;
					$csdbCustomerMonthYearRaw->outletState = $row->outletState ;
					$csdbCustomerMonthYearRaw->outletCity = $row->outletCity ;
					$csdbCustomerMonthYearRaw->emailNotification = $row->emailNotification ;
					$csdbCustomerMonthYearRaw->postalNotification = $row->postalNotification ;
					$csdbCustomerMonthYearRaw->phoneNotification = $row->phoneNotification ;
					$csdbCustomerMonthYearRaw->smsNotification = $row->smsNotification ;
					$csdbCustomerMonthYearRaw->faxNotification = $row->faxNotification ;
					$csdbCustomerMonthYearRaw->notInterested = $row->notInterested ;
					$csdbCustomerMonthYearRaw->maritalStatus = $row->maritalStatus ;

					$csdbCustomerMonthYearRaw->ads_articlesInNewspaperOrMagazines = $row->ads_articlesInNewspaperOrMagazines ;
					$csdbCustomerMonthYearRaw->adsInTv_radio = $row->adsInTv_radio ;
					$csdbCustomerMonthYearRaw->adsOnBillboard = $row->adsOnBillboard ;
					$csdbCustomerMonthYearRaw->internetWebsitesBlogs = $row->internetWebsitesBlogs ;
					$csdbCustomerMonthYearRaw->friendsFamily = $row->friendsFamily ;
					$csdbCustomerMonthYearRaw->showroomVisit = $row->showroomVisit ;
					$csdbCustomerMonthYearRaw->roadshowEvents = $row->roadshowEvents ;
					$csdbCustomerMonthYearRaw->others = $row->others ;
					$csdbCustomerMonthYearRaw->na = $row->na ;
					$csdbCustomerMonthYearRaw->design = $row->design ;

					$csdbCustomerMonthYearRaw->performance = $row->performance ;
					$csdbCustomerMonthYearRaw->price = $row->price ;
					$csdbCustomerMonthYearRaw->brandImage = $row->brandImage ;
					$csdbCustomerMonthYearRaw->promotion = $row->promotion ;
					$csdbCustomerMonthYearRaw->vehicleAccessories = $row->vehicleAccessories ;
					$csdbCustomerMonthYearRaw->vehicleReliability = $row->vehicleReliability ;
					$csdbCustomerMonthYearRaw->afterSalesService = $row->afterSalesService ;
					$csdbCustomerMonthYearRaw->mitsubishiRepeatCustomer = $row->mitsubishiRepeatCustomer ;
					$csdbCustomerMonthYearRaw->others1 = $row->others1 ;
					$csdbCustomerMonthYearRaw->na1 = $row->na1 ;

					$csdbCustomerMonthYearRaw->privateDailyTransportation = $row->privateDailyTransportation ;
					$csdbCustomerMonthYearRaw->privateLeisureActivities = $row->privateLeisureActivities ;
					$csdbCustomerMonthYearRaw->privateOthers = $row->privateOthers ;
					$csdbCustomerMonthYearRaw->commercialSiteVisit = $row->commercialSiteVisit ;
					$csdbCustomerMonthYearRaw->commercialTransportGoodsItems = $row->commercialTransportGoodsItems ;
					$csdbCustomerMonthYearRaw->commercialToCarryPeople = $row->commercialToCarryPeople ;
					$csdbCustomerMonthYearRaw->commercialToSupportClientUsage = $row->commercialToSupportClientUsage ;
					$csdbCustomerMonthYearRaw->commercialOthers = $row->commercialOthers ;
					$csdbCustomerMonthYearRaw->commercialNA = $row->commercialNA ;
					$csdbCustomerMonthYearRaw->compareWithOtherBrands = $row->compareWithOtherBrands ;

					$csdbCustomerMonthYearRaw->brandName = $row->brandName ;
					$csdbCustomerMonthYearRaw->natureOfPurchase = $row->natureOfPurchase ;
					$csdbCustomerMonthYearRaw->noOfYearsUseForPreviousCar = $row->noOfYearsUseForPreviousCar ;
					$csdbCustomerMonthYearRaw->modelNamePreviousCar = $row->modelNamePreviousCar ;
					$csdbCustomerMonthYearRaw->cargoUsageApplicableForTritonModel = $row->cargoUsageApplicableForTritonModel ;
					$csdbCustomerMonthYearRaw->salesPersonsPersonality = $row->salesPersonsPersonality ;
					$csdbCustomerMonthYearRaw->howSatisfiedAreYouWithTheProductKnowledge = $row->howSatisfiedAreYouWithTheProductKnowledge ;
					$csdbCustomerMonthYearRaw->promotionActivitiesByDealer = $row->promotionActivitiesByDealer ;
					$csdbCustomerMonthYearRaw->handlingTime = $row->handlingTime ;
					$csdbCustomerMonthYearRaw->abilityToDeliverVehicle = $row->abilityToDeliverVehicle ;

					$csdbCustomerMonthYearRaw->salesPersonExplained = $row->salesPersonExplained ;
					$csdbCustomerMonthYearRaw->overallSatisfaction = $row->overallSatisfaction ;
					$csdbCustomerMonthYearRaw->cleansingStatus = $row->cleansingStatus ;
					$csdbCustomerMonthYearRaw->addressValidity = $row->addressValidity ;
					$csdbCustomerMonthYearRaw->remarks = $row->remarks ;	

					$csdbCustomerMonthYearRaw->save();
				}	
				/*--------------------------  End of New Data  -------------------------- */
			
			CsdbCustomerRaw::where('batchID',$batchID)
			 	  ->update( array( 'batchStatus' => 'confirm' ));

			$this->layout->content = View::make('clientAdmin.viewDuplicatedRecords', array('csdbCustomerRaw'=> $csdbCustomerRaw, 'batchName'=>$batchName, 'msgSuccess'=>'The uploaded file is confirmed successfuly. The duplicated records are as follows:' ));
		}else{
			$csdbCustomerRaw = DB::table('customer_duplicated_raw')->where('batchID',$batchID)->get();
			$this->layout->content = View::make('clientAdmin.viewDuplicatedRecords', array('csdbCustomerRaw'=> $csdbCustomerRaw, 'batchName'=>$batchName, 'msgError'=>'The uploaded file is already confirmed. The duplicated records are as follows:' ));
		}
		
	}


	public function viewDuplicatedFiles(){
		$this->layout->content = View::make('clientAdmin.viewDuplicatedFiles' );
	}

	public function viewDuplicatedFile($batchID){
		$csdbCustomerRaw = DB::table('customer_duplicated_raw')->where('batchID',$batchID)->get();
		$batchName = CsdbCustomerRaw::where('batchID',$batchID)->pluck('batchName');
		$this->layout->content = View::make('clientAdmin.viewDuplicatedRecords', array('csdbCustomerRaw'=> $csdbCustomerRaw, 'batchName'=>$batchName));		
	}

	public function viewMonthYearFiles(){
		$this->layout->content = View::make('clientAdmin.viewMonthYearFiles' );
	}

	public function viewMonthYearFile($batchID){
		$CsdbCustomerMonthYearRaw = CsdbCustomerMonthYearRaw::where('batchID', '=' , $batchID)->get();
		$batchName = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchName');
		$this->layout->content = View::make('clientAdmin.viewMonthYearRecords', array('csdbCustomerMonthYearRaw'=> $CsdbCustomerMonthYearRaw, 'batchName'=>$batchName));		
	}

	public function editUploadedRecord($id){
		$file = CsdbCustomerMonthYearRaw::where('id', '=' , $id)->get()->first();
		$batchName = CsdbCustomerMonthYearRaw::where('id',$id)->pluck('batchName');
		$this->layout->content = View::make('clientAdmin.editUploadedRecord', array('file'=> $file, 'batchName'=>$batchName));		
	}

	public function confirmMonthYearFile($batchID){
		$batchStatus = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchStatus');
		
		if( $batchStatus=='confirm' ){
			return Redirect::back()->with('msgError','The selected file is already confirmed.');
		}else{
			CsdbCustomerMonthYearRaw::where('batchID',$batchID)
			 	->update( array( 'batchStatus' => 'confirm' ));
		 	return Redirect::back()->with('msgSuccess','The selected file is confirmed successfuly.');
		}		
	}


	public function confirmAllWeeksAsMonthBatch($batchID){
		
		$batchYear = CsdbCustomerMonthYearRaw::max('batchYear');
		$batchMonth = CsdbCustomerMonthYearRaw::where('batchYear', $batchYear)->max('batchMonth');

		foreach(CsdbCustomerMonthYearRaw::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->orderby('batchWeek', 'desc')->groupby('batchID')->get() as $row){
			if($row->batchStatus=='confirmMonth'){
				return Redirect::back()->with('msgError','All weeks already confirmed as a Month batch.');
			}else if($row->batchStatus!='confirm'){
				return Redirect::back()->with('msgError','Please confirm weeks batch and then try again.');
			}
		}

		/*--------------------------  New Data for Master  -------------------------------- */
		foreach(CsdbCustomerMonthYearRaw::where('batchYear', $batchYear )->where('batchMonth', $batchMonth)->where('batchStatus', 'confirm')->get() as $row){				
			CsdbCustomerMonthYearRaw::where('batchID',$row->batchID)
			 	->update( array( 'batchStatus' => 'confirmMonth' ));

			$csdbCustomerMaster = new CsdbCustomerMaster;			

			$csdbCustomerMaster->title = $row->title;
			$csdbCustomerMaster->batchID = $row->batchID ;
			$csdbCustomerMaster->batchName = $row->batchName;
			$csdbCustomerMaster->batchYear = $row->batchYear;
			$csdbCustomerMaster->batchMonth = $row->batchMonth;
			$csdbCustomerMaster->batchWeek = $row->batchWeek;

			$csdbCustomerMaster->customerName = $row->customerName;
			$csdbCustomerMaster->customerID = $row->customerID;
			$csdbCustomerMaster->customerType = $row->customerType;
			$csdbCustomerMaster->customerGroup = $row->customerGroup;
			$csdbCustomerMaster->gender = $row->gender;
			$csdbCustomerMaster->age = $row->age;
			$csdbCustomerMaster->ageGroup = $row->ageGroup;
			$csdbCustomerMaster->dob = $row->dob;
			$csdbCustomerMaster->yearDOB = $row->yearDOB;
			$csdbCustomerMaster->monthDOB = $row->monthDOB;
			$csdbCustomerMaster->dayDOB = $row->dayDOB;
			$csdbCustomerMaster->race = $row->race;
			$csdbCustomerMaster->religion = $row->religion;
			$csdbCustomerMaster->industry = $row->industry;
			$csdbCustomerMaster->occupation = $row->occupation;
			$csdbCustomerMaster->address1 = $row->address1;
			$csdbCustomerMaster->address2 = $row->address2 ;						
			$csdbCustomerMaster->address3 = $row->address3 ;

			$csdbCustomerMaster->postcode = $row->postcode;
			$csdbCustomerMaster->cityCode = $row->cityCode;
			$csdbCustomerMaster->city = $row->city;
			$csdbCustomerMaster->stateCode = $row->stateCode;
			$csdbCustomerMaster->state = $row->state;
			$csdbCustomerMaster->country = $row->country;
			$csdbCustomerMaster->telNo = $row->telNo;
			$csdbCustomerMaster->mobileNo = $row->mobileNo;
			$csdbCustomerMaster->faxNo = $row->faxNo;
			$csdbCustomerMaster->email = $row->email;
			$csdbCustomerMaster->contactPerson = $row->contactPerson;
			$csdbCustomerMaster->personalIncome = $row->personalIncome;
			$csdbCustomerMaster->householdIncome = $row->householdIncome;
			$csdbCustomerMaster->status = $row->status;
			$csdbCustomerMaster->vsoNo = $row->vsoNo;
			$csdbCustomerMaster->vsoDate = $row->vsoDate;
			$csdbCustomerMaster->regNo = $row->regNo;
			$csdbCustomerMaster->regDate = $row->regDate;
			$csdbCustomerMaster->regState = $row->regState;
			$csdbCustomerMaster->chassisNo = $row->chassisNo;
			$csdbCustomerMaster->engineNo = $row->engineNo;
			$csdbCustomerMaster->vehicleRegistrationMonth = $row->vehicleRegistrationMonth;
			$csdbCustomerMaster->vehicleRegistrationYear = $row->vehicleRegistrationYear;

			$csdbCustomerMaster->brand = $row->brand;
			$csdbCustomerMaster->model = $row->model;
			$csdbCustomerMaster->modelCode = $row->modelCode;
			$csdbCustomerMaster->modelGroup = $row->modelGroup;
			$csdbCustomerMaster->modelGroupCode = $row->modelGroupCode;
			$csdbCustomerMaster->modelVariant = $row->modelVariant;
			$csdbCustomerMaster->modelVariantCode = $row->modelVariantCode ;
			$csdbCustomerMaster->modelColor = $row->modelColor;
			$csdbCustomerMaster->modelColorCode = $row->modelColorCode;
			$csdbCustomerMaster->mfgCode = $row->mfgCode;

			$csdbCustomerMaster->modelYear = $row->modelYear;
			$csdbCustomerMaster->engineNo1 = $row->engineNo1 ;
			$csdbCustomerMaster->warrantyExpiryDate = $row->warrantyExpiryDate ;
			$csdbCustomerMaster->warrantyExpiryMileage = $row->warrantyExpiryMileage ;
			$csdbCustomerMaster->programCode = $row->programCode ;
			$csdbCustomerMaster->couponNo = $row->couponNo ;
			$csdbCustomerMaster->outletName = $row->outletName ;
			$csdbCustomerMaster->outletCode = $row->outletCode ;
			$csdbCustomerMaster->salesPerson = $row->salesPerson ;
			$csdbCustomerMaster->outletManager = $row->outletManager ;

			$csdbCustomerMaster->outletRegion = $row->outletRegion ;
			$csdbCustomerMaster->outletState = $row->outletState ;
			$csdbCustomerMaster->outletCity = $row->outletCity ;
			$csdbCustomerMaster->emailNotification = $row->emailNotification ;
			$csdbCustomerMaster->postalNotification = $row->postalNotification ;
			$csdbCustomerMaster->phoneNotification = $row->phoneNotification ;
			$csdbCustomerMaster->smsNotification = $row->smsNotification ;
			$csdbCustomerMaster->faxNotification = $row->faxNotification ;
			$csdbCustomerMaster->notInterested = $row->notInterested ;
			$csdbCustomerMaster->maritalStatus = $row->maritalStatus ;

			$csdbCustomerMaster->ads_articlesInNewspaperOrMagazines = $row->ads_articlesInNewspaperOrMagazines ;
			$csdbCustomerMaster->adsInTv_radio = $row->adsInTv_radio ;
			$csdbCustomerMaster->adsOnBillboard = $row->adsOnBillboard ;
			$csdbCustomerMaster->internetWebsitesBlogs = $row->internetWebsitesBlogs ;
			$csdbCustomerMaster->friendsFamily = $row->friendsFamily ;
			$csdbCustomerMaster->showroomVisit = $row->showroomVisit ;
			$csdbCustomerMaster->roadshowEvents = $row->roadshowEvents ;
			$csdbCustomerMaster->others = $row->others ;
			$csdbCustomerMaster->na = $row->na ;
			$csdbCustomerMaster->design = $row->design ;

			$csdbCustomerMaster->performance = $row->performance ;
			$csdbCustomerMaster->price = $row->price ;
			$csdbCustomerMaster->brandImage = $row->brandImage ;
			$csdbCustomerMaster->promotion = $row->promotion ;
			$csdbCustomerMaster->vehicleAccessories = $row->vehicleAccessories ;
			$csdbCustomerMaster->vehicleReliability = $row->vehicleReliability ;
			$csdbCustomerMaster->afterSalesService = $row->afterSalesService ;
			$csdbCustomerMaster->mitsubishiRepeatCustomer = $row->mitsubishiRepeatCustomer ;
			$csdbCustomerMaster->others1 = $row->others1 ;
			$csdbCustomerMaster->na1 = $row->na1 ;

			$csdbCustomerMaster->privateDailyTransportation = $row->privateDailyTransportation ;
			$csdbCustomerMaster->privateLeisureActivities = $row->privateLeisureActivities ;
			$csdbCustomerMaster->privateOthers = $row->privateOthers ;
			$csdbCustomerMaster->commercialSiteVisit = $row->commercialSiteVisit ;
			$csdbCustomerMaster->commercialTransportGoodsItems = $row->commercialTransportGoodsItems ;
			$csdbCustomerMaster->commercialToCarryPeople = $row->commercialToCarryPeople ;
			$csdbCustomerMaster->commercialToSupportClientUsage = $row->commercialToSupportClientUsage ;
			$csdbCustomerMaster->commercialOthers = $row->commercialOthers ;
			$csdbCustomerMaster->commercialNA = $row->commercialNA ;
			$csdbCustomerMaster->compareWithOtherBrands = $row->compareWithOtherBrands ;

			$csdbCustomerMaster->brandName = $row->brandName ;
			$csdbCustomerMaster->natureOfPurchase = $row->natureOfPurchase ;
			$csdbCustomerMaster->noOfYearsUseForPreviousCar = $row->noOfYearsUseForPreviousCar ;
			$csdbCustomerMaster->modelNamePreviousCar = $row->modelNamePreviousCar ;
			$csdbCustomerMaster->cargoUsageApplicableForTritonModel = $row->cargoUsageApplicableForTritonModel ;
			$csdbCustomerMaster->salesPersonsPersonality = $row->salesPersonsPersonality ;
			$csdbCustomerMaster->howSatisfiedAreYouWithTheProductKnowledge = $row->howSatisfiedAreYouWithTheProductKnowledge ;
			$csdbCustomerMaster->promotionActivitiesByDealer = $row->promotionActivitiesByDealer ;
			$csdbCustomerMaster->handlingTime = $row->handlingTime ;
			$csdbCustomerMaster->abilityToDeliverVehicle = $row->abilityToDeliverVehicle ;

			$csdbCustomerMaster->salesPersonExplained = $row->salesPersonExplained ;
			$csdbCustomerMaster->overallSatisfaction = $row->overallSatisfaction ;
			$csdbCustomerMaster->cleansingStatus = $row->cleansingStatus ;
			$csdbCustomerMaster->addressValidity = $row->addressValidity ;
			$csdbCustomerMaster->remarks = $row->remarks ;	

			$csdbCustomerMaster->save();
		}	
		/*--------------------------  End of New Data for Master -------------------------- */
		return Redirect::back()->with('msgSuccess','All weeks confirmed as a Month batch and stored in Master file successfuly.');
	}

	public function viewMasterFiles(){
		$this->layout->content = View::make('clientAdmin.viewMasterFiles' );
	}

	public function viewMasterWeeksFile($batchID){
		$csdbCustomerMaster = CsdbCustomerMaster::where('batchID', '=' , $batchID)->get();
		$batchName = CsdbCustomerMaster::where('batchID',$batchID)->pluck('batchName');
		$batchYear = CsdbCustomerMaster::where('batchID',$batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerMaster::where('batchID',$batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerMaster::where('batchID',$batchID)->pluck('batchWeek');
		$this->layout->content = View::make('clientAdmin.viewMasterWeeksfile', array('CsdbCustomerMaster'=> $csdbCustomerMaster, 'batchName'=>$batchName, 'batchYear'=>$batchYear, 'batchMonth'=>$batchMonth, 'batchWeek'=>$batchWeek));		
	}

	public function viewExportFile()
	{
		$this->layout->content = View::make('clientAdmin.viewExportFile' );
	}

	public function exportFile($batchID)
	{
		$objPHPExcel = new PHPExcel();
		$sheet = $objPHPExcel->getActiveSheet();	

		//$highestRow = CsdbCustomerMonthYearRaw::where('batchID', $batchID)->count('id');
		$index = 2;
			$sheet->setCellValue('A'.$index, 'Title');
			$sheet->setCellValue('B'.$index, 'Customer Name' );
			$sheet->setCellValue('C'.$index, 'Customer ID' );
			$sheet->setCellValue('D'.$index, 'Customer Type' );
			$sheet->setCellValue('E'.$index, 'Customer Group' );
			$sheet->setCellValue('F'.$index, 'Gender' );
			$sheet->setCellValue('G'.$index, 'Age' );
			$sheet->setCellValue('H'.$index, 'Age Group' );
			$sheet->setCellValue('I'.$index, 'DOB' );
			$sheet->setCellValue('J'.$index, 'Year DOB' );
			$sheet->setCellValue('K'.$index, 'Month DOB' );
			$sheet->setCellValue('L'.$index, 'Day DOB' );
			$sheet->setCellValue('M'.$index, 'Race' );
			$sheet->setCellValue('N'.$index, 'Religion' );
			$sheet->setCellValue('O'.$index, 'Industry' );
			$sheet->setCellValue('P'.$index, 'Occupation' );
			$sheet->setCellValue('Q'.$index, 'Address 1' );						
			$sheet->setCellValue('R'.$index, 'Address 2' );
			$sheet->setCellValue('S'.$index, 'Address 3' );
			$sheet->setCellValue('T'.$index, 'Postcode' );
			$sheet->setCellValue('U'.$index, 'City Code' );
			$sheet->setCellValue('V'.$index, 'City' );
			$sheet->setCellValue('W'.$index, 'State Code' );
			$sheet->setCellValue('X'.$index, 'State' );
			$sheet->setCellValue('Y'.$index, 'Country' );
			$sheet->setCellValue('Z'.$index, 'Tel No' );

			$sheet->setCellValue('AA'.$index, 'Mobile No' );
			$sheet->setCellValue('AB'.$index, 'Fax No' );
			$sheet->setCellValue('AC'.$index, 'Email' );
			$sheet->setCellValue('AD'.$index, 'Contact Person' );
			$sheet->setCellValue('AE'.$index, 'Personal Income' );
			$sheet->setCellValue('AF'.$index, 'Household Income' );
			$sheet->setCellValue('AG'.$index, 'Status' );
			$sheet->setCellValue('AH'.$index, 'VSO No' );
			$sheet->setCellValue('AI'.$index, 'VSO Date' );
			$sheet->setCellValue('AJ'.$index, 'Reg No' );
			$sheet->setCellValue('AK'.$index, 'Reg Date' );
			$sheet->setCellValue('AL'.$index, 'Reg State' );
			$sheet->setCellValue('AM'.$index, 'Chassis No' );
			$sheet->setCellValue('AN'.$index, 'Engine No' );
			$sheet->setCellValue('AO'.$index, 'Vehicle Registration Month' );
			$sheet->setCellValue('AP'.$index, 'Vehicle Registration Year' );
			$sheet->setCellValue('AQ'.$index, 'Brand' );
			$sheet->setCellValue('AR'.$index, 'Model' );
			$sheet->setCellValue('AS'.$index, 'Model Code' );
			$sheet->setCellValue('AT'.$index, 'Model Group' );
			$sheet->setCellValue('AU'.$index, 'Model Group Code' );
			$sheet->setCellValue('AV'.$index, 'Model Variant' );
			$sheet->setCellValue('AW'.$index, 'Model Variant Code' );
			$sheet->setCellValue('AX'.$index, 'Model Color' );
			$sheet->setCellValue('AY'.$index, 'Model Color Code' );
			$sheet->setCellValue('AZ'.$index, 'MFG Code' );


			$sheet->setCellValue('BA'.$index, 'Model Year' );
			$sheet->setCellValue('BB'.$index, 'Engine No' );
			$sheet->setCellValue('BC'.$index, 'Warranty Expiry Date' );
			$sheet->setCellValue('BD'.$index, 'Warranty Expiry Mileage' );
			$sheet->setCellValue('BE'.$index, 'Program Code' );
			$sheet->setCellValue('BF'.$index, 'Coupon No' );
			$sheet->setCellValue('BG'.$index, 'Outlet Name' );
			$sheet->setCellValue('BH'.$index, 'Outlet Code' );
			$sheet->setCellValue('BI'.$index, 'Salesperson' );
			$sheet->setCellValue('BJ'.$index, 'Outlet Manager' );
			$sheet->setCellValue('BK'.$index, 'Outlet Region' );
			$sheet->setCellValue('BL'.$index, 'Outlet State' );
			$sheet->setCellValue('BM'.$index, 'Outlet City' );
			$sheet->setCellValue('BN'.$index, 'Email Notification' );
			$sheet->setCellValue('BO'.$index, 'Postal Notification' );
			$sheet->setCellValue('BP'.$index, 'Phone Notification' );
			$sheet->setCellValue('BQ'.$index, 'SMS Notification' );
			$sheet->setCellValue('BR'.$index, 'Fax Notification' );
			$sheet->setCellValue('BS'.$index, 'Not interested' );
			$sheet->setCellValue('BT'.$index, 'Marital Status' );
			$sheet->setCellValue('BU'.$index, 'No. of Children');
			$sheet->setCellValue('BV'.$index, 'Ads / Articles in newspaper or magazines' );
			$sheet->setCellValue('BW'.$index, 'Ads in TV / Radio' );
			$sheet->setCellValue('BX'.$index, 'Ads on Billboard' );
			$sheet->setCellValue('BY'.$index, 'Internet / Websites / Blogs' );
			$sheet->setCellValue('BZ'.$index, 'Friends & family' );

			$sheet->setCellValue('CA'.$index, 'Showroom visit' );
			$sheet->setCellValue('CB'.$index, 'Roadshow / Events' );
			$sheet->setCellValue('CC'.$index, 'Others' );
			$sheet->setCellValue('CD'.$index, 'N/A' );
			$sheet->setCellValue('CE'.$index, 'Design' );
			$sheet->setCellValue('CF'.$index, 'Performance' );
			$sheet->setCellValue('CG'.$index, 'Price' );
			$sheet->setCellValue('CH'.$index, 'Brand Image' );
			$sheet->setCellValue('CI'.$index, 'Promotion' );
			$sheet->setCellValue('CJ'.$index, 'Vehicle Accessories' );
			$sheet->setCellValue('CK'.$index, 'Vehicle Reliability' );
			$sheet->setCellValue('CL'.$index, 'After Sales Service' );
			$sheet->setCellValue('CM'.$index, 'Mitsubishi Repeat Customer' );
			$sheet->setCellValue('CN'.$index, 'Others' );
			$sheet->setCellValue('CO'.$index, 'N/A' );
			$sheet->setCellValue('CP'.$index, 'Private - Daily transportation' );
			$sheet->setCellValue('CQ'.$index, 'Private - Leisure activities' );
			$sheet->setCellValue('CR'.$index, 'Private - Others' );
			$sheet->setCellValue('CS'.$index, 'Commercial - Site Visit' );
			$sheet->setCellValue('CT'.$index, 'Commercial - Transport goods/items' );
			$sheet->setCellValue('CU'.$index, 'Commercial - To carry people (e.g. Director, Worker)' );
			$sheet->setCellValue('CV'.$index, 'Commercial - To support client usage' );
			$sheet->setCellValue('CW'.$index, 'Commercial - Others' );
			$sheet->setCellValue('CX'.$index, 'N/A' );
			$sheet->setCellValue('CY'.$index, 'Compare with other brands' );
			$sheet->setCellValue('CZ'.$index, 'Brand Name' );

			$sheet->setCellValue('DA'.$index, 'Model Name' );
			$sheet->setCellValue('DB'.$index, 'Nature of purchase' );
			$sheet->setCellValue('DC'.$index, 'No. of years use for previous car' );
			$sheet->setCellValue('DD'.$index, 'Model Name(Previous Car)');
			$sheet->setCellValue('DE'.$index, 'Cargo usage (Applicable for Triton model)' );
			$sheet->setCellValue('DF'.$index, "Salesperson's Personality" );
			$sheet->setCellValue('DG'.$index, 'How satisfied are you with the  product knowledge' );
			$sheet->setCellValue('DH'.$index, 'Promotion Activities by Dealer' );
			$sheet->setCellValue('DI'.$index, 'How satisfied are you with the handling time regarding to Product Finance and Purchase' );
			$sheet->setCellValue('DJ'.$index, 'Ability to deliver vehicle at promised time' );
			$sheet->setCellValue('DK'.$index, 'How clearly the salesperson explained you the delivery document?' );
			$sheet->setCellValue('DL'.$index, 'Overall satisfaction with the Dealer' );
			$sheet->setCellValue('DM'.$index, 'Cleansing Status' );
			$sheet->setCellValue('DN'.$index, 'Address Validity' );
			$sheet->setCellValue('DO'.$index++, 'Remarks' );

			$sheet->mergeCells('BN1:BS1');
			$sheet->setCellValue('BN1', 'Preferred Contact Channel' );
			$sheet->getStyle('BN1:BS1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'ffff00')
							)
						)
					);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$sheet->getStyle('BN1:BS1')->applyFromArray($styleArray);
			$sheet->getStyle('BN1:BS1')->getFont()->setBold(true);
			$sheet->getStyle('BN1:BS1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			$sheet->mergeCells('BV1:CD1');
			$sheet->setCellValue('BV1', 'Source of information when purchasing a car' );
			$sheet->getStyle('BV1:CD1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'ffff00')
							)
						)
					);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$sheet->getStyle('BV1:CD1')->applyFromArray($styleArray);
			$sheet->getStyle('BV1:CD1')->getFont()->setBold(true);
			$sheet->getStyle('BV1:CD1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			$sheet->mergeCells('CE1:CO1');
			$sheet->setCellValue('CE1', 'Why do you choose Mitsubishi as your preferred vehicle' );
			$sheet->getStyle('CE1:CO1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'ffff00')
							)
						)
					);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$sheet->getStyle('CE1:CO1')->applyFromArray($styleArray);
			$sheet->getStyle('CE1:CO1')->getFont()->setBold(true);
			$sheet->getStyle('CE1:CO1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			$sheet->mergeCells('CV1:DD1');
			$sheet->setCellValue('CV1', 'Main Usage of the Vehicle' );
			$sheet->getStyle('CV1:DD1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'ffff00')
							)
						)
					);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$sheet->getStyle('CV1:DD1')->applyFromArray($styleArray);
			$sheet->getStyle('CV1:DD1')->getFont()->setBold(true);
			$sheet->getStyle('CV1:DD1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			$sheet->mergeCells('DF1:DL1');
			$sheet->setCellValue('DF1', 'Sales Consultant Rating' );
			$sheet->getStyle('DF1:DL1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'ffff00')
							)
						)
					);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$sheet->getStyle('DF1:DL1')->applyFromArray($styleArray);
			$sheet->getStyle('DF1:DL1')->getFont()->setBold(true);
			$sheet->getStyle('DF1:DL1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(115);
			$sheet->getStyle('A2:BM2')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'c0c0c0')
						)
					)
				);

			$sheet->getStyle('BN2:DO2')->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'ffff00')
						)
					)
				);

			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
			$objPHPExcel->getActiveSheet()->getStyle('A2:DO2')->applyFromArray($styleArray);
			PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);


		foreach(CsdbCustomerMonthYearRaw::where('batchID', $batchID)->get() as $file){
			$sheet->setCellValue('A'.$index, $file->title);
			$sheet->setCellValue('B'.$index, $file->customerName );
			$sheet->setCellValueExplicit('C'.$index, $file->customerID, PHPExcel_Cell_DataType::TYPE_STRING );
			$sheet->setCellValue('D'.$index, $file->customerType );
			$sheet->setCellValue('E'.$index, $file->customerGroup );
			$sheet->setCellValue('F'.$index, $file->gender );
			$sheet->setCellValue('G'.$index, $file->age );
			$sheet->setCellValue('H'.$index, $file->ageGroup );
			$sheet->setCellValue('I'.$index, $file->dob );
			$sheet->setCellValue('J'.$index, $file->yearDOB );
			$sheet->setCellValue('K'.$index, $file->monthDOB );
			$sheet->setCellValue('L'.$index, $file->dayDOB );
			$sheet->setCellValue('M'.$index, $file->race );
			$sheet->setCellValue('N'.$index, $file->religion );
			$sheet->setCellValue('O'.$index, $file->industry );
			$sheet->setCellValue('P'.$index, $file->occupation );
			$sheet->setCellValue('Q'.$index, $file->address1 );
			$sheet->setCellValue('R'.$index, $file->address2 );						
			$sheet->setCellValue('S'.$index, $file->address3 );
			$sheet->setCellValue('T'.$index, $file->postcode );
			$sheet->setCellValue('U'.$index, $file->cityCode );
			$sheet->setCellValue('V'.$index, $file->city );
			$sheet->setCellValue('W'.$index, $file->stateCode );
			$sheet->setCellValue('X'.$index, $file->state );
			$sheet->setCellValue('Y'.$index, $file->country );
			$sheet->setCellValueExplicit('Z'.$index, $file->telNo, PHPExcel_Cell_DataType::TYPE_STRING ); 

			$sheet->setCellValueExplicit('AA'.$index, $file->mobileNo, PHPExcel_Cell_DataType::TYPE_STRING ); 
			$sheet->setCellValueExplicit('AB'.$index, $file->faxNo, PHPExcel_Cell_DataType::TYPE_STRING ); 
			$sheet->setCellValue('AC'.$index, $file->email );
			$sheet->setCellValue('AD'.$index, $file->contactPerson );
			$sheet->setCellValue('AE'.$index, $file->personalIncome );
			$sheet->setCellValue('AF'.$index, $file->householdIncome );
			$sheet->setCellValue('AG'.$index, $file->status );
			$sheet->setCellValue('AH'.$index, $file->vsoNo );
			$sheet->setCellValue('AI'.$index, $file->vsoDate );
			$sheet->setCellValue('AJ'.$index, $file->regNo );
			$sheet->setCellValue('AK'.$index, $file->regDate );
			$sheet->setCellValue('AL'.$index, $file->regState );
			$sheet->setCellValue('AM'.$index, $file->chassisNo );
			$sheet->setCellValue('AN'.$index, $file->engineNo );
			$sheet->setCellValue('AO'.$index, $file->vehicleRegistrationMonth );
			$sheet->setCellValue('AP'.$index, $file->vehicleRegistrationYear );
			$sheet->setCellValue('AQ'.$index, $file->brand );
			$sheet->setCellValue('AR'.$index, $file->model );
			$sheet->setCellValue('AS'.$index, $file->modelCode );
			$sheet->setCellValue('AT'.$index, $file->modelGroup );
			$sheet->setCellValue('AU'.$index, $file->modelGroupCode );
			$sheet->setCellValue('AV'.$index, $file->modelVariant );
			$sheet->setCellValue('AW'.$index, $file->modelVariantCode );
			$sheet->setCellValue('AX'.$index, $file->modelColor );
			$sheet->setCellValue('AY'.$index, $file->modelColorCode );
			$sheet->setCellValue('AZ'.$index, $file->mfgCode );


			$sheet->setCellValue('BA'.$index, $file->modelYear );
			$sheet->setCellValue('BB'.$index, $file->engineNo1 );
			$sheet->setCellValue('BC'.$index, $file->warrantyExpiryDate );
			$sheet->setCellValue('BD'.$index, $file->warrantyExpiryMileage );
			$sheet->setCellValue('BE'.$index, $file->programCode );
			$sheet->setCellValue('BF'.$index, $file->couponNo );
			$sheet->setCellValue('BG'.$index, $file->outletName );
			$sheet->setCellValue('BH'.$index, $file->outletCode );
			$sheet->setCellValue('BI'.$index, $file->salesPerson );
			$sheet->setCellValue('BJ'.$index, $file->outletManager );
			$sheet->setCellValue('BK'.$index, $file->outletRegion );
			$sheet->setCellValue('BL'.$index, $file->outletState );
			$sheet->setCellValue('BM'.$index, $file->outletCity );
			$sheet->setCellValue('BN'.$index, $file->emailNotification );
			$sheet->setCellValue('BO'.$index, $file->postalNotification );
			$sheet->setCellValue('BP'.$index, $file->phoneNotification );
			$sheet->setCellValue('BQ'.$index, $file->smsNotification );
			$sheet->setCellValue('BR'.$index, $file->faxNotification );
			$sheet->setCellValue('BS'.$index, $file->notInterested );
			$sheet->setCellValue('BT'.$index, $file->maritalStatus );
			$sheet->setCellValue('BU'.$index, '');
			$sheet->setCellValue('BV'.$index, $file->ads_articlesInNewspaperOrMagazines );
			$sheet->setCellValue('BW'.$index, $file->adsInTv_radio );
			$sheet->setCellValue('BX'.$index, $file->adsOnBillboard );
			$sheet->setCellValue('BY'.$index, $file->internetWebsitesBlogs );
			$sheet->setCellValue('BZ'.$index, $file->friendsFamily );

			$sheet->setCellValue('CA'.$index, $file->showroomVisit );
			$sheet->setCellValue('CB'.$index, $file->roadshowEvents );
			$sheet->setCellValue('CC'.$index, $file->others );
			$sheet->setCellValue('CD'.$index, $file->na );
			$sheet->setCellValue('CE'.$index, $file->design );
			$sheet->setCellValue('CF'.$index, $file->performance );
			$sheet->setCellValue('CG'.$index, $file->price );
			$sheet->setCellValue('CH'.$index, $file->brandImage );
			$sheet->setCellValue('CI'.$index, $file->promotion );
			$sheet->setCellValue('CJ'.$index, $file->vehicleAccessories );
			$sheet->setCellValue('CK'.$index, $file->vehicleReliability );
			$sheet->setCellValue('CL'.$index, $file->afterSalesService );
			$sheet->setCellValue('CM'.$index, $file->mitsubishiRepeatCustomer );
			$sheet->setCellValue('CN'.$index, $file->others1 );
			$sheet->setCellValue('CO'.$index, $file->na1 );
			$sheet->setCellValue('CP'.$index, $file->privateDailyTransportation );
			$sheet->setCellValue('CQ'.$index, $file->privateLeisureActivities );
			$sheet->setCellValue('CR'.$index, $file->privateOthers );
			$sheet->setCellValue('CS'.$index, $file->commercialSiteVisit );
			$sheet->setCellValue('CT'.$index, $file->commercialTransportGoodsItems );
			$sheet->setCellValue('CU'.$index, $file->commercialToCarryPeople );
			$sheet->setCellValue('CV'.$index, $file->commercialToSupportClientUsage );
			$sheet->setCellValue('CW'.$index, $file->commercialOthers );
			$sheet->setCellValue('CX'.$index, $file->commercialNA );
			$sheet->setCellValue('CY'.$index, $file->compareWithOtherBrands );
			$sheet->setCellValue('CZ'.$index, $file->brandName );

			$sheet->setCellValue('DA'.$index, $file->modelName );
			$sheet->setCellValue('DB'.$index, $file->natureOfPurchase );
			$sheet->setCellValue('DC'.$index, $file->noOfYearsUseForPreviousCar );
			$sheet->setCellValue('DD'.$index, $file->modelNamePreviousCar );
			$sheet->setCellValue('DE'.$index, $file->cargoUsageApplicableForTritonModel );
			$sheet->setCellValue('DF'.$index, $file->salesPersonsPersonality );
			$sheet->setCellValue('DG'.$index, $file->howSatisfiedAreYouWithTheProductKnowledge );
			$sheet->setCellValue('DH'.$index, $file->promotionActivitiesByDealer );
			$sheet->setCellValue('DI'.$index, $file->handlingTime );
			$sheet->setCellValue('DJ'.$index, $file->abilityToDeliverVehicle );
			$sheet->setCellValue('DK'.$index, $file->salesPersonExplained );
			$sheet->setCellValue('DL'.$index, $file->overallSatisfaction );
			$sheet->setCellValue('DM'.$index, $file->cleansingStatus );
			$sheet->setCellValue('DN'.$index, $file->addressValidity );
			$sheet->setCellValue('DO'.$index++, $file->remarks );
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		$batchYear = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchWeek');
		$monthNum = sprintf("%02s", $batchMonth);
		$timestamp = mktime(0, 0, 0, $monthNum, 10);

		$fileName = 'Cust Info Reg '.date( 'F', $timestamp ).' '.$batchYear.' '.$batchWeek; //str_random(8);
		$objWriter->save(public_path().'/excelFiles/export/'.$fileName.'.xls');
		return Response::download(public_path().'/excelFiles/export/'.$fileName.'.xls', $fileName.'.xls');
	}

}