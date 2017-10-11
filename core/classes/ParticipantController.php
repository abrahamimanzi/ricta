<?php
class ParticipantController  
{
	public static function edit(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'participant-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_EDIT[end($ar)] = $val;
			}
		}
		$validation = $validate->check($_EDIT, array(
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
			'email' => array(
				'name' => 'Email',
				'required' => true
			),
			'telephone' => array(
				'name' => 'Telephone',
				'required' => true
			)
		));
		
		if($validation->passed()){
			$participantTable = new \Participant();
			
			$str = new \Str();
			$ID = $str->sanAsID($_EDIT['id']);
			$firstname = $str->sanAsName($_EDIT['firstname']);
			$lastname = $str->sanAsName($_EDIT['lastname']);
			$email= $str->data_in($_EDIT['email']);
			$telephone= $str->data_in($_EDIT['telephone']);
			
			$seconds = \Config::get('time/seconds');
			if($diagnoArray[0] == 'NO_ERRORS'){
				try{
					$participantTable->update(array(
						'firstname' => $firstname,
						'lastname' => $lastname,
						'email' => $email,
						'telephone' => $email
					),$ID);
					
				}catch(Exeption $e){
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
				}
			}
		}else{
			$diagnoArray[0] = 'ERRORS_FOUND';
			$error_msg = ul_array($validation->errors());
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
        
        $participantTable = new \Participant();
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
    
    public static function changeCategory($category,$code,$participant_ID,$payment_state){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        
        $ID = $participant_ID;
        
        $seconds = \Config::get('time/seconds');
        
        $participantTable = new \Participant();
        global $session_user_data;
        global $participant_data;
        // $preflix1 = explode('-',$code,0);
        // $preflix2 = explode('-',$code,1);
        // $preflix3 = explode('-',$code,2);
        list($preflix1, $preflix2, $preflix3) = explode('-',$code);
        
        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                switch($category){
                    case 'Exhibition-Visitor';
                        $pass_type = 'Visitor';
                        break;
                    case 'Silver':
                    case 'Individual-Silver':
                    case 'Individual-Silver-Discounted':
                    case 'Individual-Silver-Complimentary':
                    case 'Diplomatic-Mission-Silver-Complimentary':
                    case 'Private-Sector-Federation-Silver-Complimentary':
                    case 'Development-Partners-Silver-Complimentary':
                    case 'Moderator-Silver-Complimentary':
                    case 'Panelist-Silver-Complimentary':
                    case 'Speaker-Silver-Complimentary':
                    case 'Group-Silver':
                    case 'Group-Silver-Discounted':
                    case 'Group-Silver-Complimentary':
                    case 'Exhibitor-Silver-Discounted':
                    case 'Exhibitor-Silver-Complimentary':
                    case 'Sponsor-Silver-Discounted':
                    case 'Sponsor-Silver-Complimentary':
                    case 'Smart-Africa-Member-Silver-Discounted':
                    case 'Face-the-Gorillas-Silver-Discounted':
                    case 'Face-the-Gorillas-Silver-Complimentary':
                    case 'Ms-Geek-2017-Silver-Discounted':
                    case 'Ms-Geek-2017-Silver-Complimentary':
                    case 'Government-Silver-Complimentary':
                        $pass_type = 'Silver';
                        $code=$preflix1.'-SIL-'.$preflix3;
                        break;
                    case 'Gold':
                    case 'Individual-Gold':
                    case 'Individual-Gold-Discounted':
                    case 'Individual-Gold-Complimentary':
                    case 'Diplomatic-Mission-Gold-Complimentary':
                    case 'Private-Sector-Federation-Gold-Complimentary':
                    case 'Development-Partners-Gold-Complimentary':
                    case 'Moderator-Gold-Complimentary':
                    case 'Panelist-Gold-Complimentary':
                    case 'Speaker-Gold-Complimentary':
                    case 'Group-Gold':
                    case 'Group-Gold-Discounted':
                    case 'Group-Gold-Complimentary':
                    case 'Exhibitor-Gold-Discounted':
                    case 'Exhibitor-Gold-Complimentary':
                    case 'Sponsor-Gold-Discounted':
                    case 'Sponsor-Gold-Complimentary':
                    case 'Smart-Africa-Member-Gold-Discounted':
                    case 'Face-the-Gorillas-Gold-Discounted':
                    case 'Face-the-Gorillas-Gold-Complimentary':
                    case 'Ms-Geek-2017-Gold-Discounted':
                    case 'Ms-Geek-2017-Gold-Complimentary':
                    case 'Government-Gold-Complimentary':
                        $pass_type = 'Gold';
                        $code=$preflix1.'-GOL-'.$preflix3;
                        break;
                    case 'Platinum':
                    case 'Individual-Platinum':
                    case 'Individual-Platinum-Discounted':
                    case 'Individual-Platinum-Complimentary':
                    case 'Diplomatic-Mission-Platinum-Complimentary':
                    case 'Private-Sector-Federation-Platinum-Complimentary':
                    case 'Development-Partners-Platinum-Complimentary':
                    case 'Moderator-Platinum-Complimentary':
                    case 'Panelist-Platinum-Complimentary':
                    case 'Speaker-Platinum-Complimentary':
                    case 'Group-Platinum':
                    case 'Group-Platinum-Discounted':
                    case 'Group-Platinum-Complimentary':
                    case 'Exhibitor-Platinum-Discounted':
                    case 'Exhibitor-Platinum-Complimentary':
                    case 'Sponsor-Platinum-Discounted':
                    case 'Sponsor-Platinum-Complimentary':
                    case 'Smart-Africa-Member-Platinum-Discounted':
                    case 'Face-the-Gorillas-Platinum-Discounted':
                    case 'Face-the-Gorillas-Platinum-Complimentary':
                    case 'Ms-Geek-2017-Platinum-Discounted':
                    case 'Ms-Geek-2017-Platinum-Complimentary':
                    case 'Government-Platinum-Complimentary':
                        $pass_type = 'Platinum';
                        $code=$preflix1.'-PLA-'.$preflix3;
                        break;
                    case 'Media':
                        $pass_type = 'Media';
                        $code=$preflix1.'-MDA-'.$preflix3;
                        break;
                    case 'NOC':
                        $pass_type = 'NOC';
                        $code=$preflix1.'-NOC-'.$preflix3;
                        break;
                    case 'Organiser':
                        $pass_type = 'Organiser';
                        $code=$preflix1.'-ORG-'.$preflix3;
                        break;
                    case 'Delegate-Liaison':
                        $pass_type = 'Delegate Liaison';
                        $code=$preflix1.'-LIA-'.$preflix3;
                        break;
                    case 'Armed-Security':
                        $pass_type = 'Armed Security';
                        $code=$preflix1.'-ASC-'.$preflix3;
                        break;
                    case 'Security':
                        $pass_type = 'Security';
                        $code=$preflix1.'-SEC-'.$preflix3;
                        break;
                    case 'Protocal':
                        $pass_type = 'Protocal';
                        $code=$preflix1.'-PTL-'.$preflix3;
                        break;
                    case 'Medical':
                        $pass_type = 'Medical';
                        $code=$preflix1.'-MED-'.$preflix3;
                        break;
                    case 'Catering':
                        $pass_type = 'Catering';
                        $code=$preflix1.'-CTR-'.$preflix3;
                        break;
                    case 'Production-Technician':
                        $pass_type = 'Production Technician';
                        $code=$preflix1.'-TEC-'.$preflix3;
                        break;
                    case 'Contractor':
                        $pass_type = 'Contractor';
                        $code=$preflix1.'-CON-'.$preflix3;
                        break;
                    case 'Face-the-Gorillas':
                        $pass_type = 'No pass';
                        break;
                    case 'Msgeek-Applicant':
                        $pass_type = 'No pass';
                        break;
                    case 'Speaker-Applicant':
                        $pass_type = 'Speaker';
                        break;
                    case 'Face-the-Gorillas-Applicant':
                    case 'Ms-geek-Applicant':
                    case 'Speaker-Applicant':
                        $pass_type = 'No pass';
                        break;
                }
                if ($category=='Individual-Silver-Complimentary' ||
                 $category=='Diplomatic-Mission-Silver-Complimentary' ||
                    $category=='Private-Sector-Federation-Silver-Complimentary' || 
                    $category=='Development-Partners-Silver-Complimentary' || 
                    $category=='Moderator-Silver-Complimentary' || 
                    $category=='Panelist-Silver-Complimentary' || 
                    $category=='Speaker-Silver-Complimentary' || 
                    $category=='Group-Silver-Complimentary' || 
                    $category=='Exhibitor-Silver-Complimentary' || 
                    $category=='Sponsor-Silver-Complimentary' || 
                    $category=='Face-the-Gorillas-Silver-Complimentary' || 
                    $category=='Ms-Geek-2017-Silver-Complimentary' || 
                    $category=='Government-Silver-Complimentary' || 
                    $category=='Individual-Gold-Complimentary' || 
                    $category=='Diplomatic-Mission-Gold-Complimentary' || 
                    $category=='Private-Sector-Federation-Gold-Complimentary' || 
                    $category=='Development-Partners-Gold-Complimentary' || 
                    $category=='Moderator-Gold-Complimentary' || 
                    $category=='Panelist-Gold-Complimentary' || 
                    $category=='Speaker-Gold-Complimentary' || 
                    $category=='Group-Gold-Complimentary' || 
                    $category=='Exhibitor-Gold-Complimentary' || 
                    $category=='Sponsor-Gold-Complimentary' || 
                    $category=='Face-the-Gorillas-Gold-Complimentary' || 
                    $category=='Ms-Geek-2017-Gold-Complimentary' || 
                    $category=='Government-Gold-Complimentary' || 
                    $category=='Individual-Platinum-Complimentary' || 
                    $category=='Diplomatic-Mission-Platinum-Complimentary' || 
                    $category=='Private-Sector-Federation-Platinum-Complimentary' || 
                    $category=='Development-Partners-Platinum-Complimentary' || 
                    $category=='Moderator-Platinum-Complimentary' || 
                    $category=='Panelist-Platinum-Complimentary' || 
                    $category=='Speaker-Platinum-Complimentary' || 
                    $category=='Group-Platinum-Complimentary' || 
                    $category=='Exhibitor-Platinum-Complimentary' || 
                    $category=='Sponsor-Platinum-Complimentary' || 
                    $category=='Face-the-Gorillas-Platinum-Complimentary' || 
                    $category=='Ms-Geek-2017-Platinum-Complimentary' || 
                    $category=='Government-Platinum-Complimentary' ||
                    $category=='Media' || 
                    $category=='NOC' || 
                    $category=='Organiser' || 
                    $category=='Delegate-Liaison' || 
                    $category=='Armed-Security' || 
                    $category=='Security' || 
                    $category=='Protocal' || 
                    $category=='Medical' || 
                    $category=='Catering' || 
                    $category=='Production-Technician' || 
                    $category=='Contractor' 
                  AND $payment_state !='Confirmed') {
                    $payment_state = 'Free';
                }elseif ($payment_state !='Confirmed') {
                    $payment_state = 'Pending';
                }
                $participantTable->update(array(
                    'category'=>$category,
                    'pass_type'=>$pass_type,
                    'code'=>$code,
                    'payment_rn'=>$code,
                    'payment_state'=>$payment_state
                    ),$ID);
                
                
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
    
    
    public static function changeSessions($participant_gala_dinner,
                            $participant_board_meeting,$participant_smart_women,
                            $participant_mayors_lunch,$participant_ceo_lunch,$participant_ID){
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        
        $ID = $participant_ID;
        
        $seconds = \Config::get('time/seconds');
        
        $participantTable = new \Participant();
        global $session_user_data;
        global $participant_data;

        
        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                   
                $participantTable->update(array(
                    'gala_dinner'=>$participant_gala_dinner,
                    'board_meeting'=>$participant_board_meeting,
                    'smart_women'=>$participant_smart_women,
                    'mayors_lunch'=>$participant_mayors_lunch,
                    'ceo_lunch'=>$participant_ceo_lunch
                    ),$ID);
                
                
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

	public static function changePaymentState($state,$participant_ID){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
        
        $ID = $participant_ID;
        
        $seconds = \Config::get('time/seconds');
        
        $participantTable = new \Participant();
        global $session_user_data;
        
        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                switch($state){
                    case 'Pending';
                        $participantTable->update(array(
                            'payment_state' => 'Pending',
                        ),$ID);
                    break;
                    case 'Confirm';
                        $participantTable->update(array(
                            'payment_state' => 'Confirmed'
                        ),$ID);
                    break;
                    case 'Refund';
                        $participantTable->update(array(
                            'payment_state' => 'Refunded'
                        ),$ID);
                    break;
                    case 'Close';
                        $participantTable->update(array(
                            'payment_state' => 'Closed'
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
    
    public static function participantDenyEmail($participant_data){
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';
        $subject= 'Your application status for '.EVENT;

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        $messageText_1= 'We would like to thank you for your interest in '.EVENT.'.';

        $messageText_2= 'We regret to inform you that your media credentials will not be issued for the summit due to an overwhelming number of media applications.';

        $messageText_3= 'Please note that you can follow proceedings via our online platforms and social media.';
        
        
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
                             '.$messageText_3.'
                        </p>

                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> '.FB.' <br>
                            <b>Connect with our official tag:</b> '.TAG.'<br>
                            <b>Youtube:</b> '.YOUTUBE.'<br>
                        </p>
                        <p style="font-size: 13px;">
                            For any further queries, please feel free to contact our media team at '.EMAIL1.'.
                        </p>
                        <p style="font-size: 13px;">
                            We hope to see you in next year’s summit. We will communicate the next years dates in due course. 
                        </p>

                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; position: relative">
                        <div style="text-align: left; border-top: 1px solid #ddd; padding: 10px 5px">
                            Regards,<br><br>


                            '.EVENT.'<br>
                            E:  '.EMAIL1.'<br>
                            T:  '.PHONE1.'<br>
                            '.PHONE2.'<br>
                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                            <a href="'.DN.'/privacy">Privacy Policy</a>
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
    
    
    public static function participantConfirmedEmail($participant_data){
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';
        $subject= 'Your registration confirmation for '.EVENT;

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        $messageText_1= 'Your registration for the '.EVENT.' has been confirmed.';

        $messageText_2= 'Your confirmation details are:';
        
        $messageText_3='';
        $messageText_4='';
        $other_data_1 ='';
        
        if($participant_data->category=='Silver' || $participant_data->category=='Gold' || $participant_data->category=='Platinum'){
            
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
                        './*.'<p style="font-size: 13px;">
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
                            <a href="'.DN.'/accomodation">Click here to book your accommodation. You will need your registration ID.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            <a href="'.DN.'/plan">Click here for travel information including visas requirements.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later 
                            date with details on the dedicated '.EVENT.' bus network.  You will be able 
                            to purchase pre-paid travel cards giving you access to the entire '.EVENT.' 
                            bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'
                        </p>
                        '.@$messageText_3.'
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> '.FB.' <br>
                            <b>Connect with our official tag:</b> '.TAG.'<br>
                            <b>Youtube:</b> '.YOUTUBE.'<br>
                        </p>'.*/'
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; position: relative">
                        './*.'<div style="text-align: left; border-top: 1px solid #ddd; padding: 10px 5px">
                            Regards,<br><br>

                            '.EVENT.'<br>
                            E:  '.EMAIL1.'<br>
                            T:  '.PHONE1.'<br>
                            '.PHONE2.'<br>
                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                            <a href="'.DN.'/privacy">Privacy Policy</a>
                        </div>'.*/'

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
    
    public static function paymentConfirmedEmail($participant_data){
        $subject= 'Your payment confirmation for '.EVENT;
        
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        if($participant_data->state != "Confirmed"){
            $messageText_1= 'Your payment for the '.EVENT.' (Kigali, Rwanda) has been done successfully. We will review your registration and get back to you shortly';
        }else{
            $messageText_1= 'Your payment for the '.EVENT.' (Kigali, Rwanda) has been done successfully.';
        }

        $messageText_2= 'Your Payment details are:';

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
                            Price: '.$currency.' '.$participant_data->amount.'<br>
                            Payment Receipt: <a href="'.DN.'/receipt-single/'.$participant_data->token.'"> [Click here to your Receipt]</a>
                        </p>
                        './*.'
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            <a href="'.DN.'/accomodation">Click here to book your accommodation. You will need your registration ID.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            <a href="'.DN.'/plan">Click here for travel information including visas requirements.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later date with details 
                            on the dedicated '.EVENT.' bus network.  You will be able to purchase pre-paid travelcards 
                            giving you access to the entire '.EVENT.' bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'
                        </p>
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> '.FB.' <br>
                            <b>Connect with our official tag:</b> '.TAG.'<br>
                            <b>Youtube:</b> '.YOUTUBE.'<br>
                        </p>
                        '.*/'
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                        <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
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
    
    public static function editCategoryConfirmationEmail($participant_data){
        $subject= 'Change in status at the '.EVENT.'';
        
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        
        $messageText_1= 'Your new pass details at the '.EVENT.' are now:';
        

        $messageText_2= 'Please contact us at '.EVENT.' if you have any queries related to this message.';

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
                            Registration ID: '.$participant_data->code.'<br>
                            Pass Type: '.$participant_data->pass_type.'<br>
                        </p>

                        <p style="font-size: 13px;">
                             '.$messageText_2.'
                        </p>
                        './*.'
                        
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            <a href="'.DN.'/accomodation">Click here to book your accommodation. You will need your registration ID.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            <a href="'.DN.'/plan">Click here for travel information including visas requirements.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later date with details on the dedicated '.EVENT.' bus network.  You will be able to purchase pre-paid travelcards giving you access to the entire '.EVENT.' bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'
                        </p>
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> '.FB.' <br>
                            <b>Connect with our official tag:</b> '.TAG.'<br>
                            <b>Youtube:</b> '.YOUTUBE.'<br>
                        </p>
                        '.*/'
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                        <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
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

        // $contactDetails['to_email'] = 'accreditation@rg.gov.rw';

        // $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);

        return $email_status;
    }
    
    public static function changeSessionsConfirmationEmail($participant_data){
        $subject= 'Invitation to special session in '.EVENT.'';
        
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        $session = '';
        
        $messageText_1= 'Your have been invited to attend this sessions:';
        
        $gala_dinner = ''; $board_meeting = ''; $smart_women = ''; $mayors_lunch = ''; $ceo_lunch = '';

        if ($participant_data->gala_dinner == 'Confirm') {
            $gala_dinner = 'Gala dinner<br>';
        }
        if ($participant_data->board_meeting == 'Confirm') {
            $board_meeting = 'Board meeting<br>';
        }
        if ($participant_data->smart_women == 'Confirm') {
            $smart_women = 'Smart women&prime; lunch<br>';
        }
        if ($participant_data->mayors_lunch == 'Confirm') {
            $mayors_lunch = 'Mayor&prime; lunch<br>';
        }
        if ($participant_data->ceo_lunch == 'Confirm<br>') {
            $ceo_lunch = 'CEO lunch';
        }

        $messageText_2 = $gala_dinner.''.$board_meeting.''.$smart_women.''.$mayors_lunch.''.$ceo_lunch;

        $messageText_3= 'Please contact us at '.EVENT.' if you have any queries related to this message.';

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
                        </p style="font-size: 13px;">


                        <p style="font-size: 13px;">
                             '.$messageText_3.'
                        </p>
                        
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            <a href="'.DN.'/accomodation">Click here to book your accommodation. You will need your registration ID.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            <a href="'.DN.'/plan">Click here for travel information including visas requirements.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email 
                            at a later date with details on the dedicated '.EVENT.' bus network.  
                            You will be able to purchase pre-paid travelcards giving you access 
                            to the entire '.EVENT.' bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'
                        </p>
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> '.FB.' <br>
                            <b>Connect with our official tag:</b> '.TAG.'<br>
                            <b>Youtube:</b> '.YOUTUBE.'<br>
                        </p>
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                        <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                            Regards,<br><br>

                            '.EVENT.'<br>
                            E:  '.EMAIL1.'<br>
                            T:  '.PHONE1.'<br>
                            '.PHONE2.'<br>
                            <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                            <a href="'.DN.'/privacy">Privacy Policy</a>
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