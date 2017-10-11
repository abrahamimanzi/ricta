<?php
class DelegateController  
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

        if ($category=='Silver' OR $category=='silver' OR $category=='Individual-Silver') {
            $category='Individual-Silver';
            $pass_type='Silver';
        }elseif($category=='Gold' OR $category=='gold' OR $category=='Individual-Gold'){
            $category='Individual-Gold';
            $pass_type='Gold';
        }elseif($category=='Platinum' OR $category=='platinum' OR $category=='Individual-Platinum'){
            $category='Individual-Platinum';
            $pass_type='Platinum';
        }elseif($category=='indsildisc' OR $category=='Individual-Silver-Discounted'){
            $category='Individual-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='indgoldisc' OR $category=='Individual-Gold-Discounted'){
            $category='Individual-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='indpladisc' OR $category=='Individual-Platinum-Discounted'){
            $category='Individual-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='indsilcomp' OR $category=='Individual-Silver-Complimentary'){
            $category='Individual-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='indgoldcomp' OR $category=='Individual-Gold-Complimentary'){
            $category='Individual-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='indplacomp' OR $category=='Individual-Platinum-Complimentary'){
            $category='Individual-Platinum-Complimentary';
            $pass_type='Platinum';
        }elseif ($category=='Group-Silver') {
            $category='Group-Silver';
            $pass_type='Silver';
        }elseif($category=='Group-Gold'){
            $category='Group-Gold';
            $pass_type='Gold';
        }elseif($category=='Group-Platinum'){
            $category='Group-Platinum';
            $pass_type='Platinum';
        }elseif($category=='Group-Silver-Discounted'){
            $category='Group-Silver-Discounted';
            $pass_type='Silver';
        }elseif($category=='Group-Gold-Discounted'){
            $category='Group-Gold-Discounted';
            $pass_type='Gold';
        }elseif($category=='Group-Platinum-Discounted'){
            $category='Group-Platinum-Discounted';
            $pass_type='Platinum';
        }elseif($category=='Group-Silver-Complimentary'){
            $category='Group-Silver-Complimentary';
            $pass_type='Silver';
        }elseif($category=='Group-Gold-Complimentary'){
            $category='Group-Gold-Complimentary';
            $pass_type='Gold';
        }elseif($category=='Group-Platinum-Complimentary'){
            $category='Group-Platinum-Complimentary';
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
                        // 'unique'=>'events_participant'
                        'required' => true
                    ),
                    'telephone' => array(
                        'name' => 'Telephone',
                        'required' => true
                    ),
                    // 'residence_country' => array(
                    //     'name' => 'Residence Country',
                    //     'required' => true
                    // ),
                    // 'residence_city' => array(
                    //     'name' => 'Residence City',
                    //     'required' => true
                    // ),
                    // 'citizenship_country' => array(
                    //     'name' => 'Country of Citizenship',
                    //     'required' => true
                    // ),
                    // 'document_type' => array(
                    //     'name' => 'Document type',
                    //     'required' => true
                    // ),
                    // 'document_number' => array(
                    //     'name' => 'Document number',
                    //     'unique'=>'events_participant',
                    //     'required' => true
                    // ),
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
                    // 'industry' => array(
                    //     'name' => 'Organization Industry',
                    //     'alt' => 'industry1',
                    //     'string' => true,
                    //     'required' => true
                    // ),
                    'orgaddress' => array(
                        'name' => 'Organization Physical address',
                        'string' => true,
                        'required' => true
                    ),
                    'referenceby' => array(
                        'name' => 'reference by',
                        'string' => true,
                        'required' => true
                    ),
                    'pass_type' => array(
                        'name' => 'Pass type',
                        'required' => true
                    ),
                    'payment_method' => array(
                        'name' => 'Payment method',
                        'required' => true
                    )
                );
        
        // Combine Validation Arrays 
        $validate_array = array_merge($validate_array_0,$validate_array_2);
        
        // Process Validation 
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

            // $company_industry = $str->data_in(@$_SUBMIT['industry']);
            // if($company_industry == 'Other'){
            //     $company_industry = $str->data_in(@$_SUBMIT['industry1']);
            // }

            $company_industry = '';
            $request_availability_array = @$_SUBMIT['industry'];
            if(count($request_availability_array)){
                $company_industry = json_encode($request_availability_array);
            }
            
            $jobtitle = $str->data_in(@$_SUBMIT['jobtitle']);
            if($jobtitle == 'Other'){
                $jobtitle = $str->data_in(@$_SUBMIT['jobtitle1']);
            }

            $company_country = $str->data_in(@$_SUBMIT['org_country']);
            $company_city = $str->data_in(@$_SUBMIT['org_city']);
            $company_address = $str->data_in(@$_SUBMIT['orgaddress']);


            $website= $str->data_in(@$_SUBMIT['website']);

            $referenceby= $str->data_in(@$_SUBMIT['referenceby']);

            $residence_country= trim($str->data_in(@$_SUBMIT['residence_country']));
            $residence_city= $str->data_in(@$_SUBMIT['residence_city']);
            $citizenship_country = $str->data_in(@$_SUBMIT['citizenship_country']);

            $document_type = $str->data_in(@$_SUBMIT['document_type']);
            $document_number= $str->data_in(@$_SUBMIT['document_number']);

            $payment_method = $str->data_in(@$_SUBMIT['payment_method']);
            if ($payment_method=='Complimentary') {
                $payment_method= '';
            }

            $amount = $residence_country == 'Rwanda' ? Functions::passPrice($pass_type,'Local') : Functions::passPrice($pass_type,'Other'); 

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

                        'category' => $category,
                        'pass_type' => $pass_type,

                        'payment_method' => $payment_method,
                        'amount' => $amount,
                        'payment_state' => $payment_state,

                        'referenceby' => $referenceby,

                        'added_date' => Dates::get('d-m-Y',$seconds),
                        'added_date_to' => Dates::get('d-m-Y',$seconds),
                        'added_temp' => $seconds,
                        'token' => $participant_token,
                        
                        'State' => "Pending",
                        'form' => $form
                    ));

                    // Check data saved
                    $participantTable->selectQuery("SELECT* FROM `events_participant` WHERE `state`=? AND `email`=? ORDER BY `ID` DESC LIMIT 1",array('Pending',$email));

                    if($participantTable->count() && $participantTable->first()->email == $email){
                        $participant_data = $participantTable->first();

                        $participant_ID = $participant_data->ID;

                        // Make participant reference numbers
                        $cur_digit = strlen($participant_ID);
                        $total_digit = 6;
                        $code_string = $participant_ID;

                        if($cur_digit < $total_digit){
                            while(strlen($code_string) < $total_digit){
                                $code_string = '0'.$code_string;
                            }
                        }

                        $categ_code = '';
                        switch($category){
                            case "Silver":
                                $categ_code = "SIL";
                                break;
                            case "Silver-discounted":
                                $categ_code = "SID";
                                break;
                            case "Silver-complimentary":
                                $categ_code = "SIC";
                                break;
                            case "Gold":
                                $categ_code = "GOL";
                                break;
                            case "Gold-discounted":
                                $categ_code = "GOD";
                                break;
                            case "Gold":
                                $categ_code = "GOL";
                                break;
                            case "Platinum":
                                $categ_code = "PLA";
                                break;
                            case "Platinum-discounted":
                                $categ_code = "PLD";
                                break;
                            case "Platinum-complimentary":
                                $categ_code = "PLC";
                                break;


                            case 'Individual-Silver':
                                $categ_code = "SIL";
                                break;
                            case 'Group-Silver':
                                $categ_code = "GSIL";
                                break;

                            case 'Individual-Silver-Discounted':
                                $categ_code = "ISIL";
                                break;
                            case 'Group-Silver-Discounted':
                                $categ_code = "GSILD";
                                break;
                            case 'Exhibitor-Silver-Discounted':
                                $categ_code = "ESILD";
                                break;
                            case 'Sponsor-Silver-Discounted':
                                $categ_code = "SSILD";
                                break;
                            case 'Smart-Africa-Member-Silver-Discounted':
                                $categ_code = "SAMSD";
                                break;
                            case 'Face-the-Gorillas-Silver-Discounted':
                                $categ_code = "FTGSD";
                                break;
                            case 'Ms-Geek-2017-Silver-Discounted':
                                $categ_code = "MSSD";
                                break;

                            case 'Individual-Gold':
                                $categ_code = "GOL";
                                break;
                            case 'Group-Gold':
                                $categ_code = "GGOLD";
                                break;
                            case 'Individual-Gold-Discounted':
                                $categ_code = "IGOL";
                                break;
                            case 'Group-Gold-Discounted':
                                $categ_code = "GGOLD";
                                break;
                            case 'Exhibitor-Gold-Discounted':
                                $categ_code = "EGOLD";
                                break;
                            case 'Sponsor-Gold-Discounted':
                                $categ_code = "SGOLD";
                                break;
                            case 'Face-the-Gorillas-Gold-Discounted':
                                $categ_code = "FTGGD";
                                break;
                            case 'Smart-Africa-Member-Gold-Discounted':
                                $categ_code = "SAMGD";
                                break;
                            case 'Ms-Geek-2017-Gold-Discounted':
                                $categ_code = "MSGD";
                                break;

                            case 'Individual-Platinum':
                                $categ_code = "PLA";
                                break;
                            case 'Group-Platinum':
                                $categ_code = "GPLA";
                                break;
                            case 'Individual-Platinum-Discounted':
                                $categ_code = "IPLA";
                                break;
                            case 'Group-Platinum-Discounted':
                                $categ_code = "GPLAD";
                                break;
                            case 'Exhibitor-Platinum-Discounted':
                                $categ_code = "EPLAD";
                                break;
                            case 'Sponsor-Platinum-Discounted':
                                $categ_code = "SPLAD";
                                break;
                            case 'Smart-Africa-Member-Platinum-Discounted':
                                $categ_code = "SAMPD";
                                break;
                            case 'Face-the-Gorillas-Platinum-Discounted':
                                $categ_code = "FTGPD";
                                break;
                            case 'Ms-Geek-2017-Platinum-Discounted':
                                $categ_code = "MSPD";
                                break;

                            case 'Group-Silver-Complimentary':
                                $categ_code = "GSILC";
                                break;
                            case 'Group-Gold-Complimentary':
                                $categ_code = "GGOLC";
                                break;
                            case 'Group-Platinum-Complimentary':
                                $categ_code = "GPLAC";
                                break;
                            case 'Exhibitor-Silver-Complimentary':
                                $categ_code = "ESILC";
                                break;
                            case 'Exhibitor-Gold-Complimentary':
                                $categ_code = "EGOLC";
                                break;
                            case 'Exhibitor-Platinum-Complimentary':
                                $categ_code = "EPLAC";
                                break;
                            case 'Sponsor-Silver-Complimentary':
                                $categ_code = "SPSC";
                                break;
                            case 'Sponsor-Gold-Complimentary':
                                $categ_code = "SPGC";
                                break;
                            case 'Sponsor-Platinum-Complimentary':
                                $categ_code = "SPPC";
                                break;
                            case 'Face-the-Gorillas-Silver-Complimentary':
                                $categ_code = "FTGSC";
                                break;
                            case 'Face-the-Gorillas-Gold-Complimentary':
                                $categ_code = "FTGGC";
                                break;
                            case 'Face-the-Gorillas-Platinum-Complimentary':
                                $categ_code = "FTGPC";
                                break;
                            case 'Ms-Geek-2017-Silver-Complimentary':
                                $categ_code = "MSGSC";
                                break;
                            case 'Ms-Geek-2017-Gold-Complimentary':
                                $categ_code = "MSGGC";
                                break;
                            case 'Ms-Geek-2017-Platinum-Complimentary':
                                $categ_code = "MSGPC";
                                break;
                            case 'Government-Silver-Complimentary':
                                $categ_code = "GSC";
                                break;
                            case 'Government-Gold-Complimentary':
                                $categ_code = "GGC";
                                break;
                            case 'Government-Platinum-Complimentary':
                                $categ_code = "GPC";
                                break;
                            case 'Media':
                                $categ_code = "MDA";
                                break;
                            case 'NOC':
                                $categ_code = "NOC";
                                break;
                            case 'Organiser':
                                $categ_code = "Organiser";
                                break;
                            case 'Delegate-Liaison':
                                $categ_code = "LIA";
                                break;
                            case 'Armed-Security':
                                $categ_code = "ASC";
                                break;
                            case 'Security':
                                $categ_code = "SEC";
                                break;
                            case 'Protocal':
                                $categ_code = "PTL";
                                break;
                            case 'Medical':
                                $categ_code = "MED";
                                break;
                            case 'Catering':
                                $categ_code = "CTR";
                                break;
                            case 'Production-Technician':
                                $categ_code = "TEC";
                                break;
                            case 'Contractor':
                                $categ_code = "CON";
                                break;
                        }

                        $participant_code = 'PAS-'.$categ_code.'-'.$code_string;

                        $reference_number = $participant_code;
                        
                        // UPDATE reference numbers

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

                        $participantTable->update(array('code'=>$participant_code,'payment_rn'=>$reference_number,'photo'=>$photo_db),$participant_ID);
                        
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

                        // Send Registration Email Nofication
                        
                        $subject= EVENT.' Registration';

                        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

                        $messageText_1= 'Thank you for registering for '.EVENT.'.';

                        //

                        if($subscateg_data->plan!='Free'){
                            $messageText_2= '<b>Payment by Credit card or Debit card</b>';

                            $messageText_3= 'If you have successfully completed your payment by debit or credit card, you will 
                            receive an email with a receipt.';

                            $messageText_4= 'If you have not completed your payment by debit or credit card, kindly note that 
                            your registration will not be processed until payment has been received. You can 
                            complete your payment by card or debit card by <a href="'.DN.'/payment/'.$participant_code.'">clicking here</a>.';

                            $messageText_5='<b>Payment by Bank Transfer or Direct Deposit</b>';

                            $messageText_6='Your invoice for payment will be sent to you momentarily to process your payment 
                            by bank transfer or direct deposit.';

                            $messageText_7= 'Please contact us via '.EMAIL1.', if you have not received your invoice within 48 hours.';

                            $messageText_8= 'You will be notified when we receive your payment via bank transfer or direct deposit.';

                            $messageText_9= 'Please ensure that you follow the instructions on the invoice to ensure your 
                            payment is tracked and credited to your registration.';

                            $messageText_10= 'Kindly note that your registration will be not be complete until full payment for your 
                            delegate pass has been received.';

                        //
                        }elseif ($subscateg_data->plan=='Free') {

                        }

                        $messageText_11= '<b>Confirmation</b>';

                        // $messageText_12= 'You will receive your confirmation to attend the summit via email within 7 working 
                        // days of your registration (which will be complete upon receipt of payment)';

                        $messageText_12= 'You will receive your confirmation to attend the summit via email (which will be complete upon receipt of payment)';

                        $messageText_13= 'Kindly email us on '.EMAIL1.' if you have not received your 
                        confirmation within this period.';

                        $messageText_14= '<b>Collecting your badge</b>';

                        $messageText_15= 'The accreditation center is located on the Kigali Convention Center, day before summit.';

                        // $messageText_15= 'The accreditation center is located on the 2nd floor of Kigali Heights Building, which is located opposite the Kigali Convention Center';

                        // $messageText_16= 'You will be able to collect your badge from the 23rd of April 2017. Ensure that you 
                        // bring the identification document you used in your registration process.';

                        $messageText_17= 'Please note that your badge will only be issued once you have received your confirmation to attend the summit.';






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
                                        <p style="font-size: 13px;">
                                             '.$messageText_8.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_9.'
                                        </p>
                                        <p style="font-size: 13px;">
                                             '.$messageText_10.'
                                        </p>
                                        './*.'
                                        <p style="font-size: 13px;">
                                            <b>Accommodation:</b><br>
                                            Please book your accommodation only when you have received your confirmation to attend.<br>

                                            <a href="'.DN.'/accomodation">Click here</a> to book accommodation and use promotional code 
                                            <b>YAS2017</b> to receive discounted conference rates up till 10 April 2017.

                                        </p>
                                        <p style="font-size: 13px;">
                                            <b>Plan your trip:</b><br>
                                            <a href="'.DN.'/plan">Click here for travel information including visas requirements.</a>
                                        </p>
                                        <p style="font-size: 13px;">
                                            <b>Dedicated Bus Network:</b><br>
                                            To ease your travel around Kigali, you will receive an email at a later date with details 
                                            on the dedicated '.EVENT.' bus network. You will be able to purchase pre-paid 
                                            travelcards giving you access to the entire '.EVENT.' bus network during your 
                                            stay in Kigali.
                                        </p>
                                        <p style="font-size: 13px;">
                                            <b>Car hire:</b><br>
                                            Should you wish to hire a car during your stay here? Please email '.EMAIL1.'.
                                        </p>
                                        <br>
                                        <p style="font-size: 13px;">
                                            <b>Stay connected</b> <br>
                                            <b>Twitter / Facebook:</b> '.FB.' <br>
                                            <b>Connect with our official tag:</b> '.TAG.'<br>
                                            <b>Youtube:</b> '.YOUTUBE.'<br>
                                        </p>
                                        <br>
                                        <p style="font-size: 13px;">
                                            If you have received this email in error, please forward to it '.EMAIL1.'.
                                        </p>
                                        '.*/'
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

                        // end EMAIL //

                        // REdirection To Next Page

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
                            To ease your travel around Kigali, you will receive an email at a later date with details on the dedicated 
                            '.EVENT.' bus network.  You will be able to purchase pre-paid travel cards giving you access 
                            to the entire '.EVENT.' bus network during your stay in Kigali.
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
                        </p>
                        '.*/'
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
    
    public static function paymentConfirmedEmail($participant_data){
        $subject= 'Your payment confirmation for '.EVENT.'';

        $messageText_0= 'Dear <b>'.$participant_data->firstname.' '.$participant_data->lastname.' '.$participant_data->othername.'</b>,';

        if($participant_data->state != "Confirmed"){
            // $messageText_1= 'Your payment for the '.EVENT.' (Kigali, Rwanda) has been done successfully. We will review your registration and get back to you within 7 working days';
            $messageText_1= 'Your payment for the '.EVENT.' (Kigali, Rwanda) has been done successfully.';
        }else{
            $messageText_1= 'Thank you for registration for Africa’s largest Poultry summit, The '.EVENT.' in Kigali Rwanda.<br><br>Your payment has been successfully processed.';
        }

        $messageText_2= 'Your Payment details are:';

        $messageText_3= '<b>Confirmation</b><br>';

        // $messageText_4= 'You will receive your confirmation to attend the summit via email within 7 working 
        // days of your registration (which will be complete upon receipt of payment)';

        $messageText_4= 'You will receive your confirmation to attend the summit via email (which will be complete upon receipt of payment)';

        $messageText_5= 'Kindly email us on '.EMAIL1.', if you have not received your 
        confirmation within this period.';

        $messageText_6= '<b>Collecting your badge</b>';

        $messageText_7= 'The accreditation center is located on the Kigali Convention Center.';

        $messageText_8= 'You will be able to collect your badge a day before summit. Ensure that you 
        bring the identification document you used in your registration process.';

        // $messageText_9= 'Please note that your badge will only be issued once you have received your 
        // confirmation to attend the summit.';


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
                            Payment Receipt: <a href="'.DN.'/receipt-single/'.$participant_data->token.'"> [Click here to download your Receipt]</a>
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
                        <p style="font-size: 13px;">
                             '.$messageText_8.'
                        </p>
                        './*.'
                        <p style="font-size: 13px;">
                             '.$messageText_9.'
                        </p>
                        <p style="font-size: 13px;">
                            <b>Accommodation:</b><br>
                            Please book your accommodation only when you have received your confirmation to attend.<br><br>
                            <a href="'.DN.'/accomodation">Click here</a> to book accommodation and use promotional code <b>YAS2017</b>
                            
                        </p>
                        <p style="font-size: 13px;">
                            <b>Plan your trip:</b><br>
                            <a href="'.DN.'/plan">Click here for travel information including visas.</a>
                        </p>
                        <p style="font-size: 13px;">
                            <b>Dedicated Bus Network:</b><br>
                            To ease your travel around Kigali, you will receive an email at a later date with details on the dedicated 
                            '.EVENT.' bus network.  You will be able to purchase pre-paid travelcards giving you access 
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
    
}