<?php
class AccommadationController  
{
	public static function add($form='Admin'){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
        $error_msg = '';
        
        // if($form=='Admin'){
        //     $prfx = 'register-';
        //     foreach($_POST as $index=>$val){
        //         $ar = explode($prfx,$index);
        //         if(count($ar)){
        //             $_SUBMIT[end($ar)] = $val;
        //         }
        //     }
        // }elseif($form=='API'){
        //     $prfx = 'register-';
        //     foreach($_POST as $index=>$val){
        //         $ar = explode($prfx,$index);
        //         if(count($ar)){
        //             $_SUBMIT[end($ar)] = $val;
        //         }
        //     }
        // }

            $prfx = 'register-';
            foreach($_POST as $index=>$val){
                $ar = explode($prfx,$index);
                if(count($ar)){
                    $_SUBMIT[end($ar)] = $val;
                }
            }

        $str = new \Str();

        // $categ = firstUC(@$_GET['categ']);
        // $category = $categ;
        // $pass_type = $category;

        $validate_array = array();
        $validate_array_1 = array();
        $validate_array_2 = array();

        global $session_subscriber;
        
        if(!$session_subscriber->isLoggedIn()){
            $validate_array_2 = array(
                    'check_capcha' => array(
                        'name' => 'Captcha',
                        'matches' => 'capcha',
                        'required' => true
                    ),
                    // 'check' => array(
                    //     'name' => 'To agree the Terms and Conditions',
                    //     'required' => true
                    // )
                    );
        }

        $validate_array_0 = array(
                    'title' => array(
                        'name' => 'Title',
                        'string' => true,
                        'required' => true
                    ),
                    'firstname' => array(
                        'name' => 'First name',
                        'string' => true,
                        'required' => true
                    ),
                    'lastname' => array(
                        'name' => 'Last name',
                        'string' => true,
                        'required' => true
                    ),
                    'othername' => array(
                        'name' => 'Other name',
                        'string' => true
                    ),
                    'code' => array(
                        'name' => 'Registration ID',
                        'required' => true
                    ),
                    'email' => array(
                        'name' => 'Email',
                        'matches'=>'confirm_email',
                        // 'unique'=>'events_participant',
                        'required' => true
                    ),
                    'rooms' => array(
                        'name' => 'rooms',
                        'required' => true
                    ),

                    'promocode' => array(
                        'name' => 'Promocode'
                    ),
                    'checkin' => array(
                        'name' => 'Check-in date'
                    ),
                    'checkout' => array(
                        'name' => 'Check-out date'
                    ),

                    'hotel' => array(
                        'name' => 'hotel',
                        'string' => true
                    )
                );

        $validate_array = array_merge($validate_array_0,$validate_array_2);

        $validation = $validate->check($_SUBMIT, $validate_array);

        if($validation->passed()){

            // $participantTable = new \Participant();
            $accommadationTable = new \Accommadation();
            // $faceGorillaTable = new \FaceGorilla();


            $title = $str->sanAsName(@$_SUBMIT['title']);
            $firstname = $str->sanAsName(@$_SUBMIT['firstname']);
            $lastname = $str->sanAsName(@$_SUBMIT['lastname']);
            $othername = $str->sanAsName(@$_SUBMIT['othername']);
            $code= $str->data_in(@$_SUBMIT['code']);

            $email= $str->data_in(@$_SUBMIT['email']);


            // COMPANY

            $checkin = $str->data_in(@$_SUBMIT['checkin']);
            $checkout = $str->data_in(@$_SUBMIT['checkout']);
            $rooms = $str->data_in(@$_SUBMIT['rooms']);
            $promocode = $str->data_in(@$_SUBMIT['promocode']);
            $additional_info = $str->data_in(@$_SUBMIT['additional_info']);
            $hotel = $str->data_in(@$_SUBMIT['hotel']);
            // $adults = $str->data_in(@$_SUBMIT['adults']);
            $adults = '';
            $adults_array = @$_SUBMIT['adults'];
            if(count($adults_array)){
                $adults = json_encode($adults_array);
            }
            // $children = $str->data_in(@$_SUBMIT['children']);
            $children = '';
            $children_array = @$_SUBMIT['children'];
            if(count($children_array)){
                $children = json_encode($children_array);
            }


            /*
            $business_model = '';
            $business_model_array = @$_SUBMIT['business_model'];
            if(count($business_model_array)){
                $business_model = json_encode($business_model_array);
            }

            $business_impact = $str->data_in(@$_SUBMIT['business_impact']);

            $business_sectors_array = @$_SUBMIT['business_sectors']; //ARRAY
            $business_sectors = '';
            if(count($business_sectors_array)){
                $business_sectors = json_encode($business_sectors_array);
            }

            $business_tweet = $str->data_in(@$_SUBMIT['business_tweet']);
            $business_products = $str->data_in(@$_SUBMIT['business_products']);

            $target_markets = '';
            $target_markets_array = @$_SUBMIT['target_markets'];
            if(count($target_markets_array)){
                $target_markets = json_encode($target_markets_array);
            }

            $business_client = $str->data_in(@$_SUBMIT['business_client']);

            $business_textmodel = $str->data_in(@$_SUBMIT['business_textmodel']);

            $market_opps = $str->data_in(@$_SUBMIT['market_opps']);
            $business_advantange = $str->data_in(@$_SUBMIT['business_advantange']);
            $business_strategy = $str->data_in(@$_SUBMIT['business_strategy']);
            $previous_award = $str->data_in(@$_SUBMIT['previous_award']);
            $previous_incubator = $str->data_in(@$_SUBMIT['previous_incubator']);

            $request_availability = '';
            $request_availability_array = @$_SUBMIT['request_availability'];
            if(count($request_availability_array)){
                $request_availability = json_encode($request_availability_array);
            }

            $team_experience = $str->data_in(@$_SUBMIT['team_experience']);
            $other_business = $str->data_in(@$_SUBMIT['other_business']);
            $other_investamount  = $str->data_in(@$_SUBMIT['other_investamount']);
            $advisor_experience  = $str->data_in(@$_SUBMIT['advisor_experience']);
            $business_currenttax  = $str->data_in(@$_SUBMIT['business_currenttax']);
            $revenue_build  = $str->data_in(@$_SUBMIT['revenue_build']);
            $business_breakeven  = $str->data_in(@$_SUBMIT['business_breakeven']);
            $business_valuation  = $str->data_in(@$_SUBMIT['business_valuation']);

            $valuation_method  = $str->data_in(@$_SUBMIT['valuation_method']);
            $current_netburn  = $str->data_in(@$_SUBMIT['current_netburn']);
            $previous_netburn  = $str->data_in(@$_SUBMIT['previous_netburn']);
            $capital_require  = $str->data_in(@$_SUBMIT['capital_require']);
            $external_investment  = $str->data_in(@$_SUBMIT['external_investment']);
            $existing_investors  = $str->data_in(@$_SUBMIT['existing_investors']);
            $existing_strategy  = $str->data_in(@$_SUBMIT['existing_strategy']);
            $tas_referrence  = $str->data_in(@$_SUBMIT['tas_referrence']);

            $company_ID = $str->data_in(@$_SUBMIT['company_id']);
            $event_ID = $str->data_in(@$_SUBMIT['event_id']);


            $payment_state = 'Free';
            */
            $event_ID = $str->data_in(@$_SUBMIT['event_id']);

            $seconds = \Config::get('time/seconds');
            $token_hash = md5($seconds.$event_ID);
            // $participant_token = $validation->autoUniqueMaker('events_participant','token',$token_hash);

            if($diagnoArray[0] == 'NO_ERRORS'){

                try{
                    $accommadationTable->insert(array(
                        'event_ID' => $event_ID,
                        'title' => $title, 
                        'firstname' => $firstname, 
                        'lastname' => $lastname, 
                        'othername' => $othername, 
                        'code' => $code, 
                        'email' => $email, 
                        'checkin' => $checkin, 
                        'checkout' => $checkout, 
                        'rooms' => $rooms, 
                        'adults' => $adults, 
                        'children' => $children, 
                        'promocode' => $promocode, 
                        'additional_info' => $additional_info,
                        'hotel' => $hotel,
                        'added_date' => Dates::get('d-m-Y',$seconds),
                        'form' => $form
                    ));

                    /*
                    $participantTable->insert(array(
                        'company_ID' => $company_ID,
                        'event_ID' => $event_ID,

                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'othername' => $othername,
                        'gender' => $gender,

                        'dateOfbirth' => $dateOfbirth,
                        'telephone' => $telephone,
                        'email' => $email,
                        
                        'residence_country' => $residence_country,
                        'residence_city' => $residence_city,
                        'citizenship_country' => $citizenship_country,
                        'document_type' => $document_type,
                        'document_number' => $document_number,

                        'company_name' => $company_name,
                        'website' => $website,
                        'company_country' => $company_country,

                        'category' => $category,
                        'pass_type' => $pass_type,

                        'payment_state' => $payment_state,

                        'added_date' => Dates::get('d-m-Y',$seconds),
                        'added_temp' => $seconds,
                        'token' => $participant_token,

                        'State' => "Pending",
                        'form' => $form
                    ));
                    */
                    // $participantTable->selectQuery("SELECT* FROM `events_participant` WHERE `state`=? AND `email`=? ORDER BY `ID` DESC LIMIT 1",array('Pending',$email));
                    $accommadationTable->selectQuery("SELECT* FROM `accommadation` WHERE `email`=? ORDER BY `ID` DESC LIMIT 1",array($email));

                    // if($participantTable->count() && $participantTable->first()->email == $email){
                    if($accommadationTable->count() && $accommadationTable->first()->email == $email){
                        $accommadation_data = $accommadationTable->first();
                        // $participant_data = $participantTable->first();


                        // $participant_ID = $participant_data->ID;
                        $accommadation_ID = $accommadation_data->ID;

                        /*
                        $cur_digit = strlen($participant_ID);
                        $total_digit = 6;
                        $code_string = $participant_ID;

                        if($cur_digit < $total_digit){
                            while(strlen($code_string) < $total_digit){
                                $code_string = '0'.$code_string;
                            }
                        }

                        $categ_code = "MSGSC";

                        $participant_code = 'TAS-'.$categ_code.'-'.$code_string;

                        $reference_number = $participant_code;

                        $participantTable->update(array('code'=>$participant_code),$participant_ID); 

                        $faceGorillaTable->insert(array(

                            'ID' => $participant_ID,

                            'company_regname' => $company_regname,
                            'company_number' => $company_number,
                            'legal_structure' => $legal_structure,

                            'date_founded' => $date_founded,
                            'employee_number' => $employee_number,
                            'org_stage' => $org_stage,
                            'funding_state' => $funding_state,

                            'investname' => $investname,
                            'investlocation' => $investlocation,
                            'business_model' => $business_model,
                            'business_impact' => $business_impact,
                            'business_sectors' => $business_sectors,
                            'business_tweet' => $business_tweet,
                            'business_products' => $business_products,
                            'target_markets' => $target_markets,

                            'business_client' => $business_client,
                            'business_textmodel' => $business_textmodel,
                            'market_opps' => $market_opps,
                            'business_advantange' => $business_advantange,
                            'business_strategy' => $business_strategy,
                            'previous_award' => $previous_award,
                            'previous_incubator' => $previous_incubator,
                            'request_availability' => $request_availability,
                            'team_experience' => $team_experience,
                            'other_business' => $other_business,
                            'other_investamount' => $other_investamount,
                            'advisor_experience' => $advisor_experience,
                            'business_currenttax' => $business_currenttax,
                            'revenue_build' => $revenue_build,
                            'business_breakeven' => $business_breakeven,
                            'business_valuation' => $business_valuation,
                            'valuation_method' => $valuation_method,
                            'current_netburn' => $current_netburn,
                            'previous_netburn' => $previous_netburn,
                            'capital_require' => $capital_require,
                            'external_investment' => $external_investment,
                            'existing_investors' => $existing_investors,
                            'existing_strategy' => $existing_strategy,
                            'tas_referrence' => $tas_referrence,

                            'added_temp' => $seconds
                        ));
                        
                        // IF INVITATION //

                        global $_invitation_source;

                        if($_invitation_source){
                            global $_invitation_data;
                            
                            $invite_data = $_invitation_data['invite'];
                            $subscateg_data = $_invitation_data['subscateg'];
                            $subscriber_data = $_invitation_data['subscriber'];
                                
                            $participantTable->update(array('host_ID'=>$subscriber_data->group_ID,'host_account_ID'=>$invite_data->subscriber_ID,'invite_ID'=>$invite_data->ID),$participant_ID);
                            
                            if($subscateg_data->plan=='Free'){
                                $participantTable->update(array('payment_state'=>'Free'),$participant_ID);
                            }
                            // Keep log
                            $data_binded = array('invite_ID'=>$invite_data->ID,'participant_ID'=>$participant_ID);
                            SubscriberCategoryController::logAction('ticketUsed',$subscateg_data->ID,$data_binded);
                        }  
                        
                        */

                        // END INVITATION //
                        
                        $subject= 'Hotel reservation query for '.EVENT.'';

                        $messageText_0= 'Dear <b>'.$accommadation_data->firstname.' '.$accommadation_data->lastname.'</b>,';

                        $messageText_1= 'Thank you for submitting your hotel reservation query for the '.EVENT.' in Kigali, Rwanda.';

                        $messageText_2= 'Our team will revert to you shortly with availability and rates whilst also putting you in touch with the hotels reservation team directly.';

                        $messageText_3= 'Please note that all payments are to be made to the hotel directly.';

                        $messageText_4= 'Do not hesitate to contact us if you require any further information.';

                        $message_body = '
                            <body>
                                <div style="padding: 10px; margin-left: 10px margin-right: 10px">

                                    <section>
                                        <p style="margin-bottom: 25px; font-size: 13px;">
                                            '.$messageText_0.'
                                        </p>
                                        <p style="font-size: 13px;">
                                            '.$messageText_1.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_2.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_3.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_4.'
                                        </p>
                                        <br>
                                        './*<p style="font-size: 13px;">
                                            <b>Stay connected</b> <br>
                                            <b>Twitter / Facebook:</b> TASummit <br>
                                            <b>Connect with our official tag:</b> #TAS2017<br>
                                            <b>Youtube:</b> TransformAfricaSummit<br>
                                        </p>*/'
                                        <br>
                                    </section>
                                    <div style="font-size: 13px; padding: 0px; position: relative">
                                        <div style="text-align: left; border-top: 1px solid #ddd; padding: 10px 5px">
                                            Kind regards,<br><br>
                                            Diána Tóth & Tessa Remers<br>
                                            Poultry Africa 2017


                                            './*.'
                                            '.EVENT.' Team<br>
                                            E:  '.EMAIL1.'<br>
                                            T:  '.PHONE1.'<br>
                                            + '.PHONE2.'<br>
                                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                            <a href="'.DN.'/privacy">Privacy Policy</a>'.*/'
                                        </div>
                                    </div>
                                </div>
                            </body>
                        ';

                        $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

                        $contactDetails['from_email'] = EMAIL1;
                        $contactDetails['from_names'] = EVENT;
                        $contactDetails['to_email'] = $accommadation_data->email;

                        $contactDetails['attach'] = false;

                        $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);

                        

                        // Send EMAIL to smartcitiesftg@smartafrica.org//
                        
                        $subject= 'New hotel reservation';

                        $messageText_0= 'Dear reservation team, <b>';

                        $messageText_1= 'We have a new reservation application for the '.$accommadation_data->hotel.': Smartcities edition. Below are the applicants details.';

                        $messageText_2= '<b>APPLICATION DETAILS</b>';

                        $messageText_3= 'Application date: '.Dates::get('d-m-Y',$seconds);

                        $messageText_4= '<b>PERSONAL DETAILS</b>';

                        $messageText_5= 'Registration ID: '.$accommadation_data->code.'<br>Names: '.$accommadation_data->firstname.' '.$accommadation_data->lastname.'<br>
                                        Email: '.$accommadation_data->email.'<br>';

                        $messageText_6= '<b>RESERVATION DETAILS</b>';

                        $messageText_7= '<b>Hotel name:</b> '.$accommadation_data->hotel.'<br>
                                        <b>Check-in date:</b> '.$accommadation_data->checkin.'<br>
                                        <b>Check-out date:</b> '.$accommadation_data->checkout.'<br>
                                        <b>No. of rooms:</b> '.$accommadation_data->rooms.'<br>
                                        <b>No. of adults:</b> '.$accommadation_data->adults.'<br>
                                        <b>No. of children:</b> '.$accommadation_data->children.'<br>
                                        <b>Promocode:</b> '.$accommadation_data->promocode.'<br>
                                        <b>Additional information:</b> '.$accommadation_data->additional_info.'<br>';

                        $message_body = '
                            <body>
                                <div style="padding: 10px; margin-left: 10px margin-right: 10px">

                                    <section>
                                        <p style="margin-bottom: 25px; font-size: 13px;">
                                            '.$messageText_0.'
                                        </p>
                                        <p style="font-size: 13px;">
                                            '.$messageText_1.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_2.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_3.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_4.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_5.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_6.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_7.'
                                        </p>
                                        <br>'./*
                                        <p style="font-size: 13px;">
                                            <b>Stay connected</b> <br>
                                            <b>Twitter / Facebook:</b> TASummit <br>
                                            <b>Connect with our official tag:</b> #TAS2017<br>
                                            <b>Youtube:</b> TransformAfricaSummit<br>
                                        </p>*/'
                                        <br>
                                    </section>
                                    <div style="font-size: 13px; padding: 0px; position: relative">
                                        <div style="text-align: left; border-top: 1px solid #ddd; padding: 10px 5px">
                                            Kind regards,<br><br>
                                            Diána Tóth & Tessa Remers<br>
                                            Poultry Africa 2017


                                            './*.'
                                            '.EVENT.' Team<br>
                                            E:  '.EMAIL1.'<br>
                                            T:  '.PHONE1.'<br>
                                            + '.PHONE2.'<br>
                                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                            <a href="'.DN.'/privacy">Privacy Policy</a>'.*/'
                                        </div>
                                    </div>
                                </div>
                            </body>
                        ';

                        $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

                        $contactDetails['from_email'] = $accommadation_data->email;
                        $contactDetails['from_names'] = EVENT;
                        $contactDetails['to_email'] = EMAIL1;
                        // $contactDetails2['to_email'] = 'kadibra2@gmail.com';

                        $contactDetails['attach'] = false;

                        $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);
                        $contactDetails['to_email'] = 'kadibra2@gmail.com';
                        $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);
                        

                        // end EMAIL //

                        // REdirection To Next Page
                        // Redirect::to(DN.'/success/'.$participant_code.'/registered');
                        Redirect::to(DN.'/success/accommondation');

                    }
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
            }
        }else{
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }
        
		if($diagnoArray[0] == 'ERRORS_FOUND'){
			return (object)[
				'ERRORS'=>true,
				'ERRORS_SCRIPT' => $validate->getErrorLocation()
			];
		}else{
			return (object)[
				'ERRORS'=>false,
				'SUCCESS'=>true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}
    
	public static function changeState($state,$participant_ID){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
        
        $ID = $participant_ID;
        
        $seconds = \Config::get('time/seconds');
        
        $participantTable = new \FaceGorilla();
        global $session_user_data;
        global $participant_data;
        
        
        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                switch($state){
                    case 'Confirm';
                        $participantTable->update(array(
                            'state' => 'Confirmed',
                            'updated_date' => $seconds,
                            'user_ID' => $session_user_data->ID
                        ),$ID);
                        $fields['firstname'] = $participant_data->firstname;
                        $fields['lastname'] = $participant_data->lastname;
                        $fields['telephone'] = $participant_data->telephone;
                        $fields['email'] = $participant_data->email;
                        $fields['code'] = $participant_data->code;
                        $fields['photo'] = $participant_data->photo;
                        SubscriberController::addAccount($fields);
                    break;
                    case 'Pending';
                        $participantTable->update(array(
                            'state' => 'Pending',
                            'updated_date' => $seconds,
                            'user_ID' => $session_user_data->ID
                        ),$ID);
                    break;
                    case 'Deny';
                        $participantTable->update(array(
                            'state' => 'Denied',
                            'updated_date' => $seconds,
                            'user_ID' => $session_user_data->ID
                        ),$ID);
                    break;
                }
            }catch(Exeption $e){
                $diagnoArray[0] = "ERRORS_FOUND";
                $diagnoArray[] = $e->getMessage();
            }
        }
		if($diagnoArray[0] == 'ERRORS_FOUND'){
			return (object)[
				'ERRORS'=>true,
				'ERRORS_SCRIPT' => $diagnoArray
			];
		}else{
			return (object)[
				'ERRORS'=>false,
				'SUCCESS'=>true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}
    
    
    public static function participantConfirmedEmail($participant_data){
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';
        $subject= 'Your registration confirmation for '.EVENT.'';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        $messageText_1= 'Your registration for the '.EVENT.' (Kigali, Rwanda) has been confirmed.';

        $messageText_2= 'Your confirmation details are:';
        
        $messageText_3='';
        $messageText_4='';
        $other_data_1 ='';
        
        if($participant_data->category=='Delegate'){
            
            // $messageText_3 = '<p style="font-size: 13px;">
            //                     <b>Setting up meetings at the Summit – Meet me at TAS</b><br>
            //                     From March 2017, you will be able to log-in to your profile and set-up meetings with other delegates as so will others be able to do the same to meet with you. Your company name will be displayed as well as your job title and so will that of other delegates so you can select who you would like to request a meeting with. You will be notified when the meeting requests start. 
            //                     If you wish to not participate in Meet me @ TAS, click here. 
            //                 </p>';
            $messageText_4 = '
                             Price: '.$currency.' '.$participant_data->amount.'
                            '.$other_data_1;
            if($participant_data->payment_state == 'Pending'){
                $other_data_1 = '<br>Payment link: <a href="'.DN.'/payment/'.$participant_data->code.'">[Click here to the payment form]</a>';
            }
            if($participant_data->payment_state == 'Confirmed'){
                $other_data_1 = '<br>Payment Receipt: <a href="'.DN.'/receipt-single/'.$participant_data->token.'"> [Click here to your Receipt]</a>';
            }
        }
        
        $message_body = '
            <body>
                <div style="padding: 10px; margin-left: 10px margin-right: 10px">

                    <section>
                        <p style="margin-bottom: 25px; font-size: 13px;">
                            '.$messageText_0.'
                        </p>
                        <p style="font-size: 13px;">
                            '.$messageText_1.'
                        </p style="font-size: 13px;">
                        <p style="font-size: 13px;">
                             '.$messageText_2.'
                        </p>
                        <p style="font-size: 13px;">
                            Registration ID: '.$participant_data->code.'<br>
                            Names: '.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'<br>
                            Pass Type: '.$participant_data->pass_type.'<br>
                            '.$messageText_4.'
                        </p>
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            Click here to book your accommodation. You will need your registration ID. <a href="'.DN.'/accomodation">[Click here to  book your accommodation]</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            Click here for travel information including visas requirements.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later date with details on the dedicated '.EVENT.' bus network.  You will be able to purchase pre-paid travel cards giving you access to the entire '.EVENT.' bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay in Kigali, click here [Click here to plan your trip]
                        </p>
                        '.@$messageText_3.'
                        './*
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> TASummit <br>
                            <b>Connect with our official tag:</b> #TAS2017<br>
                            <b>Youtube:</b> TransformAfricaSummit<br>
                        </p>*/'
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; position: relative">
                        <div style="text-align: left; border-top: 1px solid #ddd; padding: 10px 5px">
                            Kind regards,<br><br>
                            Diána Tóth & Tessa Remers<br>
                            Poultry Africa 2017


                            './*.'
                            '.EVENT.' Team<br>
                            E:  '.EMAIL1.'<br>
                            T:  '.PHONE1.'<br>
                            + '.PHONE2.'<br>
                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                            <a href="'.DN.'/privacy">Privacy Policy</a>'.*/'
                        </div>
                    </div>
                </div>
            </body>
        ';

        $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

        $contactDetails['from_email'] = EMAIL1;
        $contactDetails['from_names'] = EVENT;
        $contactDetails['to_email'] = $participant_data->email;

        $contactDetails['attach'] = false;

        $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);
        return $email_status;
    }
    
}