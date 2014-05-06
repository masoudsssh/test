<?php

class CallerController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Caller Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.caller.master';

	public function callerIndex()
	{
		$this->layout->content = View::make('caller.index');
	}

	public function viewMonthYearFile($batchID){
		$CsdbCustomerMonthYearRaw = CsdbCustomerMonthYearRaw::where('batchID', '=' , $batchID)->get();
		$batchName = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchName');
		$batchYear = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerMonthYearRaw::where('batchID',$batchID)->pluck('batchWeek');
		$this->layout->content = View::make('caller.viewMonthYearRecords', array('csdbCustomerMonthYearRaw'=> $CsdbCustomerMonthYearRaw, 'batchName'=>$batchName, 'batchYear'=>$batchYear, 'batchMonth'=>$batchMonth, 'batchWeek'=>$batchWeek));		
	}

	public function editUploadedRecord($id){		

		$file = CsdbCustomerMonthYearRaw::where('id', '=' , $id)->get()->first();
		$originalFile = CsdbCustomerMonthYearOrginal::where('id', '=' , $id)->get()->first();
		
		if($file->close_at==""){
			CsdbCustomerMonthYearRaw::where('id', $id)->update(array('open_at' => date("Y-m-d H:i:s")));
		}

		$batchName = CsdbCustomerMonthYearRaw::where('id',$id)->pluck('batchName');
		$batchYear = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchWeek');
		$this->layout->content = View::make('caller.editUploadedRecord', array('file'=> $file, 'originalFile'=>$originalFile, 'batchName'=>$batchName, 'batchYear'=>$batchYear, 'batchMonth'=>$batchMonth, 'batchWeek'=>$batchWeek));		
	}

	public function storeEditUploadedRecord(){
		$industry = Input::get('industry');
		if( Input::get('industry1')=='other' ){			
			if( Input::get('industry')=="" ){
				$msg = 'Please specify the industry field.';	
				return Redirect::back()->with('msgError', $msg);
			}				
			$industry = 'other('.Input::get('industry').')';
		}

		$occupation = Input::get('occupation');
		if( Input::get('occupation1')=='other' ){			
			if( Input::get('occupation')=="" ){
				$msg = 'Please specify the occupation field.';	
				return Redirect::back()->with('msgError', $msg);
			}				
			$occupation = 'other('.Input::get('occupation').')';
		}

		$modelNamePreviousCar = Input::get('modelNamePreviousCar');
		if( Input::get('modelNamePreviousCar1')=='other' ){			
			if( Input::get('modelNamePreviousCar')=="" ){
				$msg = 'Please specify the Model Name Previous Car field.';	
				return Redirect::back()->with('msgError', $msg);
			}				
			$modelNamePreviousCar = 'other('.Input::get('modelNamePreviousCar').')';
		}

		CsdbCustomerMonthYearRaw::where('id',Input::get('id'))
			 	->update( array(        
			 		'title' => Input::get('title'),         	
					'industry' => $industry,
					'occupation' => $occupation,
					'address1' => Input::get('address1'),
					'address2' => Input::get('address2'),						
					'address3' => Input::get('address3'),
					'postcode' => Input::get('postcode'),
					'city' => Input::get('city'),
					'state' => Input::get('state'),
					'country' => Input::get('country'),
					'telNo' => Input::get('telNo'),
					'mobileNo' => Input::get('mobileNo'),
					'faxNo' => Input::get('faxNo'),
					'email' => Input::get('email'),
					'contactPerson' => Input::get('contactPerson'),
					'personalIncome' => Input::get('personalIncome'),
					
                    
					'emailNotification' => Input::get('emailNotification'),
					'postalNotification' => Input::get('postalNotification'),
					'phoneNotification' => Input::get('phoneNotification'),
					'smsNotification' => Input::get('smsNotification'),
					'faxNotification' => Input::get('faxNotification'),
					'notInterested' => Input::get('notInterested'),
					'maritalStatus' => Input::get('maritalStatus'),
					'ads_articlesInNewspaperOrMagazines' => Input::get('ads_articlesInNewspaperOrMagazines'),
					'adsInTv_radio' => Input::get('adsInTv_radio'),
					'adsOnBillboard' => Input::get('adsOnBillboard'),
					'internetWebsitesBlogs' => Input::get('internetWebsitesBlogs'),
					'friendsFamily' => Input::get('friendsFamily'),
					'showroomVisit' => Input::get('showroomVisit'),
					'roadshowEvents' => Input::get('roadshowEvents'),
					'others' => Input::get('others'),
					'na' => Input::get('na'),
					'design' => Input::get('design'),
					'performance' => Input::get('performance'),
					'price' => Input::get('price'),
					'brandImage' => Input::get('brandImage'),
					'promotion' => Input::get('promotion'),
					'vehicleAccessories' => Input::get('vehicleAccessories'),
					'vehicleReliability' => Input::get('vehicleReliability'),
					'afterSalesService' => Input::get('afterSalesService'),
					'mitsubishiRepeatCustomer' => Input::get('mitsubishiRepeatCustomer'),
					'others1' => Input::get('others1'),
					'na1' => Input::get('na1'),
					'privateDailyTransportation' => Input::get('privateDailyTransportation'),
					'privateLeisureActivities' => Input::get('privateLeisureActivities'),
					'privateOthers' => Input::get('privateOthers'),
					'commercialSiteVisit' => Input::get('commercialSiteVisit'),
					'commercialTransportGoodsItems' => Input::get('commercialTransportGoodsItems'),
					'commercialToCarryPeople' => Input::get('commercialToCarryPeople'),
					'commercialToSupportClientUsage' => Input::get('commercialToSupportClientUsage'),
					'commercialOthers' => Input::get('commercialOthers'),
					'commercialNA' => Input::get('commercialNA'),
					'compareWithOtherBrands' => Input::get('compareWithOtherBrands'),
					'brandName' => Input::get('brandName'),
					'modelName' => Input::get('modelName'),
					'natureOfPurchase' => Input::get('natureOfPurchase'),
					'noOfYearsUseForPreviousCar' => Input::get('noOfYearsUseForPreviousCar'),
					'modelNamePreviousCar' => $modelNamePreviousCar,
					'cargoUsageApplicableForTritonModel' => Input::get('cargoUsageApplicableForTritonModel'),
                    
                    
					'salesPersonsPersonality' => Input::get('salesPersonsPersonality'),
					'howSatisfiedAreYouWithTheProductKnowledge' => Input::get('howSatisfiedAreYouWithTheProductKnowledge'),
					'promotionActivitiesByDealer' => Input::get('promotionActivitiesByDealer'),
					'handlingTime' => Input::get('handlingTime'),
					'abilityToDeliverVehicle' => Input::get('abilityToDeliverVehicle'),
					'salesPersonExplained' => Input::get('salesPersonExplained'),
					'overallSatisfaction' => Input::get('overallSatisfaction'),
					'cleansingStatus' => Input::get('cleansingStatus'),
					'addressValidity' => Input::get('addressValidity'),
					'remarks' => Input::get('remarks'),
					'close_at' => date("Y-m-d H:i:s"),
					'callerID' => Sentry::getUser()->id
				 ));

		$file = CsdbCustomerMonthYearRaw::where('id', '=' , Input::get('id'))->get()->first();
		$batchName = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchName');
		$batchYear = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchYear');
		$batchMonth = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchMonth');
		$batchWeek = CsdbCustomerMonthYearRaw::where('batchID',$file->batchID)->pluck('batchWeek');
		return Redirect::back()->with( array('file'=> $file, 'batchName'=>$batchName, 'batchYear'=>$batchYear, 'batchMonth'=>$batchMonth, 'batchWeek'=>$batchWeek, 'msgSuccess'=>'The selected record is updated successfully.' ));		
	}
	
	public function profile($userID)
	{
		$this->layout->content = View::make('caller.userProfile')
		    ->with( 
				array( 'user'=>Sentry::findUserById($userID) )
			);
	}	

	public function storeProfile(){		
		$userID = Sentry::getUser()->id;
		$rules = array(					
					'first_name' => 'required',
					'last_name' => 'required',
					'email' => array('required')
					);
		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails()){
			return Redirect::back()->with('msg', 'Please enter the required fields.')->withInput();
		}

		DB::table('users')
		->where('id',$userID)
		->update(array('first_name' => Input::get('first_name'), 'last_name' => Input::get('last_name'), 'email' => Input::get('email') ));

		return Redirect::back()->with('msg-success', 'Your profile is updated successfully.');

	}
}