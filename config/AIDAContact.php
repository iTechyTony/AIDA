<?php

/**
 * Advance Internet Development A
 *
 * @author Tony Ampomah
 * @link   http://www.itechytony.com/aida
 */

/**
 * Contact class.
 *
 */
class AIDAContact {

    /**
     * @var Instance of AIDAEmail class
     */
    private $mailer;

    /**
     * @var Instance of AIDADatabase class
     */
    private $db = null;

    /**
     * Class constructor
     */
    function __construct() {
       
        //get database class instance
        $this->db = AIDADatabase::getInstance();

        //create new object of AIDAEmail class
        $this->mailer = new AIDAEmail();
    }

    public function botProtection() {
    	AIDASession::set("bot_first_number", rand(1,9));
    	AIDASession::set("bot_second_number", rand(1,9));
    }
    
    
    public function validateContactForm($data, $botProtection = true) {
    	$id     = $data['fieldId'];
    	$contact   = $data['contactData'];
    	$errors = array();
    	$validator = new AIDAValidator();
    
    	//check if name is not empty
    	if( $validator->isEmpty($contact['name']) )
    		$errors[] = array(
    				"id"    => $id['name'],
    				"msg"   => AIDALang::get('username_required')
    		);
    	
    	//check if email is not empty
    	if( $validator->isEmpty($contact['email']) )
    		$errors[] = array(
    				"id"    => $id['email'],
    				"msg"   =>"Your name is required"
    		);
    
 			//check if phone is not empty
    			if( $validator->isEmpty($contact['phone']) )
    				$errors[] = array(
    						"id"    => $id['phone'],
    						"msg"   => "Your Phone is required"
    				);
    				
    				//check if message is not empty
    				if( $validator->isEmpty($contact['message']) )
    					$errors[] = array(
    							"id"    => $id['message'],
    							"msg"   => "Your message is required"
    					);
    				
    
    					//check if email format is correct
    					if( ! $validator->emailValid($contact['email']) )
    						$errors[] = array(
    								"id"    => $id['email'],
    								"msg"   => AIDALang::get('email_wrong_format')
    						);
    
    						
    								if ( $botProtection )
    								{
    									//bot protection
    									$sum = AIDASession::get("bot_first_number") + AIDASession::get("bot_second_number");
    									if($sum != intval($contact['bot_sum']))
    										$errors[] = array(
    												"id"    => $id['bot_sum'],
    												"msg"   => AIDALang::get('wrong_sum')
    										);
    								}
    
    								return $errors;
    }
    
    public function sendContact($data) {
    	$contact = $data['contactData'];
    
    	//validate provided data
    	$errors = $this->validateUser($data);
    
    	if(count($errors) == 0) {
    		//no validation errors
    
    		//generate email confirmation key
    		$key = $this->_generateKey();
    
    		MAIL_CONFIRMATION_REQUIRED === true ? $confirmed = 'N' : $confirmed = 'Y';
    
    		//insert new contact to database
    		$this->db->insert('contact', array(
    				"name"     => $contact['email'],
    				"email"  => $contact['email'],
    				"phone" => $contact['email'],
    				"message"  => $contact['email'],
    				"phone" => $contact['email']
    		));
    
    		
    
    		//send confirmation email if needed
    		if ( MAIL_CONFIRMATION_REQUIRED ) {
    			$this->mailer->confirmationEmail($contact['email'], $key);
    			$msg = AIDALang::get('success_registration_with_confirm');
    		}
    		else
    			$msg = AIDALang::get('success_registration_no_confirm');
    
    		//prepare and output success message
    		$result = array(
    				"status" => "success",
    				"msg"    => $msg
    		);
    
    		echo json_encode($result);
    	}
    	else {
    		//there are validation errors
    
    		//prepare result
    		$result = array(
    				"status" => "error",
    				"errors" => $errors
    		);
    
    		//output result
    		echo json_encode ($result);
    	}
    }
    
    
}
