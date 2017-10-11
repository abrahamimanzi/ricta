<?php
class ExhibitorController  
{
    
	public static function add($form='Admin'){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
        $error_msg = '';
        
        if($form=='Admin'){
            $prfx = 'participant-';
            foreach($_POST as $index=>$val){
                $ar = explode($prfx,$index);
                if(count($ar)){
                    $_SUBMIT[end($ar)] = $val;
                }
            }
        }elseif($form=='API'){
            $prfx = 'register-';
            foreach($_POST as $index=>$val){
                $ar = explode($prfx,$index);
                if(count($ar)){
                    $_SUBMIT[end($ar)] = $val;
                }
            }
        }
        
        $str = new \Str();
        
        $categ = firstUC(@$_GET['categ']);
        $category = $categ;
        $pass_type = $category;

        if ($category=='exhibitorsildisc') {
            $category='Exhibitor-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='exhibitorgoldisc'){
            $category='Exhibitor-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='exhibitorpladisc'){
            $category='Exhibitor-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='exhibitorsilcomp'){
            $category='Exhibitor-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='exhibitorgoldcomp'){
            $category='Exhibitor-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='exhibitorplacomp'){
            $category='Exhibitor-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif($category=='Exhibitor-Silver-Discounted'){
            $category='Exhibitor-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Exhibitor-Gold-Discounted'){
            $category='Exhibitor-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Exhibitor-Platinum-Discounted'){
            $category='Exhibitor-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='Exhibitor-Silver-Complimentary'){
            $category='Exhibitor-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Exhibitor-Gold-Complimentary'){
            $category='Exhibitor-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Exhibitor-Platinum-Complimentary'){
            $category='Exhibitor-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif($category=='Sponsor-Silver-Discounted'){
            $category='Sponsor-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Sponsor-Gold-Discounted'){
            $category='Sponsor-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Sponsor-Platinum-Discounted'){
            $category='Sponsor-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='Sponsor-Silver-Complimentary'){
            $category='Sponsor-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Sponsor-Gold-Complimentary'){
            $category='Sponsor-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Sponsor-Platinum-Complimentary'){
            $category='Sponsor-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif($category=='Smart-Africa-Member-Silver-Discounted'){
            $category='Smart-Africa-Member-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Smart-Africa-Member-Gold-Discounted'){
            $category='Smart-Africa-Member-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Face-the-Gorillas-Silver-Discounted'){
            $category='Face-the-Gorillas-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Face-the-Gorillas-Gold-Discounted'){
            $category='Face-the-Gorillas-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Face-the-Gorillas-Platinum-Discounted'){
            $category='Face-the-Gorillas-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='Face-the-Gorillas-Silver-Complimentary'){
            $category='Face-the-Gorillas-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Face-the-Gorillas-Gold-Complimentary'){
            $category='Face-the-Gorillas-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Face-the-Gorillas-Platinum-Complimentary'){
            $category='Face-the-Gorillas-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif($category=='Ms-Geek-2017-Silver-Discounted'){
            $category='Ms-Geek-2017-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Ms-Geek-2017-Gold-Discounted'){
            $category='Ms-Geek-2017-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Ms-Geek-2017-Platinum-Discounted'){
            $category='Ms-Geek-2017-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='Ms-Geek-2017-Silver-Complimentary'){
            $category='Ms-Geek-2017-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Ms-Geek-2017-Gold-Complimentary'){
            $category='Ms-Geek-2017-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Ms-Geek-2017-Platinum-Complimentary'){
            $category='Ms-Geek-2017-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif($category=='Government-Silver-Complimentary'){
            $category='Government-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Government-Gold-Complimentary'){
            $category='Government-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Government-Platinum-Complimentary'){
            $category='Government-Platinum-Complimentary';
            $pass_type='Platinum';
        }else{
            $category = $categ;
        }
        
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
                    'gender' => array(
                        'name' => 'Gender',
                        'required' => true
                    ),
                    'email' => array(
                        'name' => 'Email',
                        'matches'=>'confirm_email',
                        'unique'=>'events_participant',
                        'required' => true
                    ),
                    'telephone' => array(
                        'name' => 'Telephone',
                        'required' => true
                    ),
                    'residence_country' => array(
                        'name' => 'Residence Country',
                        'required' => true
                    ),
                    'residence_city' => array(
                        'name' => 'Residence City',
                        'required' => true
                    ),
                    'citizenship_country' => array(
                        'name' => 'Country of Citizenship',
                        'required' => true
                    ),
                    'document_type' => array(
                        'name' => 'Document type',
                        'required' => true
                    ),
                    'document_number' => array(
                        'name' => 'Document number',
                        'unique'=>'events_participant',
                        'required' => true
                    ),
                    'category' => array(
                        'name' => 'Category',
                        'required' => true
                    ),
                    'org_country' => array(
                        'name' => 'Country',
                        'string' => true,
                        'required' => true
                    ),
                    'org_city' => array(
                        'name' => 'City',
                        'string' => true,
                        'required' => true
                    ),
                    'company' => array(
                        'name' => 'Organization name',
                        'string' => true,
                        'required' => true
                    ),
                    'jobtitle' => array(
                        'name' => 'Job title',
                        'alt' => 'jobtitle1',
                        'string' => true,
                        'required' => true
                    ),
                    'orgcategory' => array(
                        'name' => 'Organisation Category',
                        'alt' => 'orgcategory1',
                        'string' => true,
                        'required' => true
                    ),
                    'industry' => array(
                        'name' => 'Organization Industry',
                        'alt' => 'industry1',
                        'string' => true,
                        'required' => true
                    ),
                    'orgaddress' => array(
                        'name' => 'Organization Physical address',
                        'string' => true,
                        'required' => true
                    ),
                    'exhibition_type' => array(
                        'name' => 'Exhibition type',
                        'string' => true,
                        'required' => true
                    ),
                    'exhibition_rownum' => array(
                        'name' => 'Row number',
                        'required' => true
                    ),
                    'exhibition_numbooth' => array(
                        'name' => 'Number of booths',
                        'required' => true
                    ),
                    'exhibition_boothname' => array(
                        'name' => 'Bbooth name'
                    ),
                    'special_request' => array(
                        'name' => 'Short Summary',
                        'string' => true,
                        'required' => true
                    ),
                    'payment_method' => array(
                        'name' => 'Payment method',
                        'required' => true
                    )
                );
           
        $validate_array = array_merge($validate_array_0,$validate_array_2);

        $validation = $validate->check($_SUBMIT, $validate_array);

        if($validation->passed()){
            
            $participantTable = new \Participant();
            
            $title = $str->sanAsName(@$_SUBMIT['title']);
            $firstname = $str->sanAsName(@$_SUBMIT['firstname']);
            $lastname = $str->sanAsName(@$_SUBMIT['lastname']);
            $othername = $str->sanAsName(@$_SUBMIT['othername']);
            
            $email= $str->data_in(@$_SUBMIT['email']);
            $telephone= $str->data_in(@$_SUBMIT['telephone']);
            $telephone_office= $str->data_in(@$_SUBMIT['telephone_office']);
            
            $gender = $str->data_in(@$_SUBMIT['gender']);
            
            $company_name = $str->data_in(@$_SUBMIT['company']);

            $company_category = $str->data_in(@$_SUBMIT['orgcategory']);
            if($company_category == 'Other'){
                $company_category = $str->data_in(@$_SUBMIT['orgcategory1']);
            }

            $company_industry = $str->data_in(@$_SUBMIT['industry']);
            if($company_industry == 'Other'){
                $company_industry = $str->data_in(@$_SUBMIT['industry1']);
            }
            
            $jobtitle = $str->data_in(@$_SUBMIT['jobtitle']);
            if($jobtitle == 'Other'){
                $jobtitle = $str->data_in(@$_SUBMIT['jobtitle1']);
            }

            $company_country = $str->data_in(@$_SUBMIT['org_country']);
            $company_city = $str->data_in(@$_SUBMIT['org_city']);
            $company_address = $str->data_in(@$_SUBMIT['orgaddress']);

            $website= $str->data_in(@$_SUBMIT['website']);
            $residence_country= trim($str->data_in(@$_SUBMIT['residence_country']));
            $residence_city= $str->data_in(@$_SUBMIT['residence_city']);
            $citizenship_country = $str->data_in(@$_SUBMIT['citizenship_country']);

            $document_type = $str->data_in(@$_SUBMIT['document_type']);
            $document_number= $str->data_in(@$_SUBMIT['document_number']);
            
            $special_request= $str->data_in(@$_SUBMIT['special_request']);

            $registration_type = $str->data_in(@$_SUBMIT['registration_type']);
            $group_size = $str->data_in(@$_SUBMIT['group_size']);

            // $payment_method = $str->data_in(@$_SUBMIT['payment_method']);
            
            $payment_method = $str->data_in(@$_SUBMIT['payment_method']);
            if ($payment_method=='Complimentary') {
                $payment_method= '';
            }
            $amount = $str->data_in(@$_SUBMIT['pass_price']);

            $exhibition_type = $str->data_in(@$_SUBMIT['exhibition_type']);
            $exhibition_rownum = $str->data_in(@$_SUBMIT['exhibition_rownum']);
            $exhibition_numbooth = $str->data_in(@$_SUBMIT['exhibition_numbooth']);
            $exhibition_boothname = $str->data_in(@$_SUBMIT['exhibition_boothname']);

            $package_type = $exhibition_rownum;
            
            $amount = $residence_country == 'Rwanda' ? Functions::passPrice($package_type,'Local') : Functions::passPrice($package_type,'Other');
            
            $payment_state = 'Pending';

            $company_ID = $str->data_in(@$_SUBMIT['company_id']);
            $event_ID = $str->data_in(@$_SUBMIT['event_id']);

            $seconds = \Config::get('time/seconds');
            $token_hash = md5($seconds.$event_ID);
            $participant_token = $validation->autoUniqueMaker('events_participant','token',$token_hash);

            if($diagnoArray[0] == 'NO_ERRORS'){

                try{
                    $participantTable->insert(array(
                        'company_ID' => $company_ID,
                        'event_ID' => $event_ID,

                        'title' => $title,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'othername' => $othername,
                        'gender' => $gender,

                        'company_name' => $company_name,
                        'company_category' => $company_category,
                        'company_industry' => $company_industry,
                        'company_address' => $company_address,
                        'company_country' => $company_country,
                        'company_city' => $company_city,

                        'jobtitle' => $jobtitle,
                        'telephone' => $telephone,
                        'telephone_office' => $telephone_office,
                        'email' => $email,

                        'residence_country' => $residence_country,
                        'residence_city' => $residence_city,
                        'citizenship_country' => $citizenship_country,
                        'document_type' => $document_type,
                        'document_number' => $document_number,

                        'special_request' => $special_request,
                        'exhibition_type' => $exhibition_type,
                        'exhibition_row_number' => $exhibition_rownum,
                        'exhibition_booth_number' => $exhibition_numbooth,
                        'exhibition_booth_name' => $exhibition_boothname,
                        
                        'category' => $category,
                        'pass_type' => $pass_type,
                        'package_type' => $package_type,

                        'payment_method' => $payment_method,
                        'amount' => $amount,
                        'payment_state' => $payment_state,

                        'added_date' => Dates::get('d-m-Y',$seconds),
                        'added_date_to' => Dates::get('d-m-Y',$seconds),
                        'added_temp' => $seconds,
                        'token' => $participant_token,
                        
                        'State' => "Pending",
                        'form' => $form
                    ));

                    $participantTable->selectQuery("SELECT* FROM `events_participant` WHERE `state`=? AND `email`=? ORDER BY `ID` DESC LIMIT 1",array('Pending',$email));

                    if($participantTable->count() && $participantTable->first()->email == $email){
                        $participant_data = $participantTable->first();

                        $participant_ID = $participant_data->ID;

                        $cur_digit = strlen($participant_ID);
                        $total_digit = 6;
                        $code_string = $participant_ID;

                        if($cur_digit < $total_digit){
                            while(strlen($code_string) < $total_digit){
                                $code_string = '0'.$code_string;
                            }
                        }

                        $categ_code = "EXH";

                        $participant_code = 'TAS-'.$categ_code.'-'.$code_string;

                        $reference_number = $participant_code;

                        // UPDATE reference numbers

                        $file_path = "";
                        $file_uploaded = false;
                        if($category == 'Speaker' || $category == 'Exhibitor'){
                            // Uploading proposal
                            $dir = 'data_user/docs';
                            $fileName = $_FILES["register-file"]["name"]; 
                            $fileTmpLoc = $_FILES["register-file"]["tmp_name"]; 
                            $fileType = $_FILES["register-file"]["type"]; 
                            $fileSize = $_FILES["register-file"]["size"];
                            $fileErrorMsg = $_FILES["register-file"]["error"]; 
                            $kaboom = explode(".", $fileName); 
                            $fileExt = strtolower(end($kaboom)); 
                            $newfilename = $participant_code.'.'.$fileExt; 
                            $upload_path = Config::get('url/bk_dir')."/$dir/$newfilename";
                            $file_path = "$dir/$newfilename";

                            if($fileName){
                                if(in_array($fileExt,array('pdf'))){
                                    $moveResult = move_uploaded_file($fileTmpLoc, $upload_path);
                                    if($moveResult){
                                        $file_uploaded = true;
                                    }
                                }
                            }
                        }

                        $photo_field = @$_SUBMIT['photo'];
                        $photo_db = '';

                        if($photo_field){
                            $photo_db = 'data_user/participants/'.$participant_code.'.jpg';
                            $photo_url = 'admin/data_user/participants/'.$participant_code.'.jpg';
                            if(is_file($photo_url) and !empty($photo_field)){
                                unlink($photo_url);
                            }

                            $tmp_array = explode('base64,',$photo_field);
                            $photo_field = $tmp_array[1];
                            $photo_field = base64_decode($photo_field);
                            @file_put_contents($photo_url, $photo_field);
                        }
                        
                        $participantTable->update(array('code'=>$participant_code,'payment_rn'=>$reference_number,'path'=>$file_path,'photo'=>$photo_db),$participant_ID);

                       
                        // IF INVITATION //

                        global $_invitation_source;

                        if($_invitation_source){
                            global $_invitation_data;
                            
                            $invite_data = $_invitation_data['invite'];
                            $subscateg_data = $_invitation_data['subscateg'];
                            $subscriber_data = $_invitation_data['subscriber'];
                            $amount = Functions::discount($participant_data->amount,$subscateg_data->discount);
                            
                            $participantTable->update(array(
                                'host_ID'=>$subscriber_data->group_ID,
                                'host_account_ID'=>$invite_data->subscriber_ID,
                                'invite_ID'=>$invite_data->ID,
                                'amount'=>$amount
                            ),$participant_ID);
                            
                            if($subscateg_data->plan=='Free'){
                                $participantTable->update(array('payment_state'=>'Free'),$participant_ID);
                            }
                            if($subscateg_data->discount){
                                $participantTable->update(array('discount'=>$subscateg_data->discount),$participant_ID);
                            }
                            // Keep log
                            $data_binded = array('invite_ID'=>$invite_data->ID,'participant_ID'=>$participant_ID);
                            SubscriberCategoryController::logAction('ticketUsed',$subscateg_data->ID,$data_binded);
                        }  

                        // END INVITATION //

                        $subject= 'Thank you for your interest to exhibit at the '.EVENT.'';

                        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

                        $messageText_1= 'Thank you for expressing your interest in exhibiting at the '.EVENT.' (Kigali, Rwanda).';

                        $messageText_2= 'Our team will be in touch with you within the next 2 working days.';

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
                                        <br>
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
                        $contactDetails['cc_email'] = EMAIL1;
                        $contactDetails['attach'] = false;

                        if($file_uploaded){
                           if(is_file($upload_path)){
                               $contactDetails['attach'] = $upload_path;
                           }
                        }

                        $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);
        
                        // end EMAIL //

                        // Redirection To Next Page

                        Redirect::to(DN.'/payment/'.$participant_code);

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
    
    public static function participantConfirmedEmail($participant_data){
        $currency = $participant_data->residence_country == 'Rwanda' ? 'RWF' : 'USD';
        $subject= 'Your registration confirmation for '.EVENT.'';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        $messageText_1= 'Your registration for the '.EVENT.' (Kigali, Rwanda) has been confirmed.';

        $messageText_2= 'Your confirmation details are:';
        
        $messageText_3='';
        $messageText_4='';
        $other_data_1 ='';
        
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
    
    public static function paymentConfirmedEmail($participant_data){
        $subject= 'Your payment confirmation for '.EVENT.'';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        if($participant_data->state != "Confirmed"){
            $messageText_1= 'Your payment for the '.EVENT.' (Kigali, Rwanda) has been done successfully. We will review your registration and get back to you within shotly';
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
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            Click here to book your accommodation. You will need your registration ID. <a href="'.DN.'/accomodation">[Click here to  book your accommodation]</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            Click here for travel information including visas. 
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later date with details on the dedicated '.EVENT.' bus network.  You will be able to purchase pre-paid travelcards giving you access to the entire '.EVENT.' bus network during your stay in Kigali.
                        </p>
                        <p style="font-size: 13px;">
                            <b>Car hire:</b><br>
                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'
                        </p>
                        './*
                        <p style="font-size: 13px;">
                            <b>Stay connected</b> <br>
                            <b>Twitter / Facebook:</b> TASummit <br>
                            <b>Connect with our official tag:</b> #TAS2017<br>
                            <b>Youtube:</b> TransformAfricaSummit<br>
                        </p>*/'
                        <br>
                    </section>
                    <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
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
    
}