<?php

/**
 * Advance Internet Development A
 *
 * @author Tony Ampomah
 * @link   http://www.itechytony.com/aida
 */

/**
 * AIDAItem.
 */
class AIDAItem {

    /**
     * @var ID of item represented by this class
     */
    private $itemId;

    /**
     * @var Instance of AIDADatabase class
     */
    private $db = null;

    /**
     * Class constructor
     * @param $userId ID of user that will be represented by this class
     */
    function __construct($itemId) {
        //update local user id with given user id
        $this->itemId = $itemId;

        //connect to database
        $this->db = AIDADatabase::getInstance();
    }

    /**
     * Get all user details including email, username and last_login
     * @return User details or null if user with given id doesn't exist.
     */
    public function getAll() {
        $query = "SELECT `as_users`.`email`, `as_users`.`username`,`as_users`.`last_login`, `as_user_details`.*
                    FROM `as_users`, `as_user_details`
                    WHERE `as_users`.`user_id` = :id
                    AND `as_users`.`user_id` = `as_user_details`.`user_id`";

        $result = $this->db->select($query, array( 'id' => $this->userId ));

        if ( count ( $result ) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
     * Add new user using data provided by administrator from admin panel.
     * @param $postData All data filled in administrator's "Add User" form
     * @return array Result that contain status (error or success) and message.
     */
    public function add( $postData ) {

        // prepare required objects and arrays
        $result = array();
        $reg = new AIDARegister();
        $errors = $reg->validateUser($postData, false);

        // if count ( $errors ) > 0 means that validation didn't passed and that there are errors
        if ( count ($errors) > 0 )
            $result = array(
                "status" => "error",
                "errors" => $errors
            );
        else {
            //validation passed
            $data = $postData['userData'];

            // insert user login info
            $this->db->insert('as_users',  array (
                'email'         => $data['email'],
                'username'      => $data['username'],
                'password'      => $reg->hashPassword($data['password']),
                'confirmed'     => 'Y',
                'register_date' => date('Y-m-d H:i:s')
            ));

            // get user id
            $id = $this->db->lastInsertId();

            // insert users details
            $this->db->insert('as_user_details', array (
                'user_id'    => $id,
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'phone'      => $data['phone'],
                'address'    => $data['address']
            ) );

            // generate response
            $result = array (
                "status" => "success",
                "msg"    => AIDALang::get("user_added_successfully")
            );
        }

        return $result;
    }

    /**
     * Update user's details
     * @param $data User data from admin's "edit user" form
     */
    public function updateUser($data) {

        // validate data
        $errors = $this->_validateUserUpdate($data);

        if ( count ( $errors ) > 0 )
            echo json_encode(array(
                "status" => "error",
                "errors" => $errors
            ));
        else
        {
            // validation passed, update user

            $userData = $data['userData'];
            $currInfo = $this->getInfo();

            $userInfo = array();

            // update user's email and username only if they are changed, skip them otherwise
            if ( $currInfo['email'] != $userData['email'] )
                $userInfo['email'] = $userData['email'];

            if ( $currInfo['username'] != $userData['username'] )
                $userInfo['username'] = $userData['username'];

            // update password only if "password" field is filled
            // and password is different than current password
            if ( $userData['password'] != hash('sha512','') ) {
                $password = $this->_hashPassword($userData['password']);
                if ( $currInfo['password'] != $password )
                    $userInfo['password'] = $password;
            }

            if ( count($userInfo) > 0 )
                $this->updateInfo($userInfo);

            $this->updateDetails(array(
                'first_name' => $userData['first_name'],
                'last_name'  => $userData['last_name'],
                'phone'      => $userData['phone'],
                'address'    => $userData['address']
            ));

            echo json_encode(array(
                "status" => "success",
                "msg" => AIDALang::get("user_updated_successfully")
            ));
        }
    }
    
    /**
     * Set user id if new one is provided, return old one otherwise.
     * @param int $newId New user id.
     * @return int Returns new user id if it is provided, old user id otherwise.
     */
    public function id($newId = null) {
        if($newId != null)
            $this->userId = $newId;
        return $this->userId;
    }






    /**
     * Get current user's role.
     * @return string Current user's role.
     */
    public function getRole() {
        $result = $this->db->select(
                      "SELECT `as_user_roles`.`role` as role 
                       FROM `as_user_roles`,`as_users`
                       WHERE `as_users`.`user_role` = `as_user_roles`.`role_id`
                       AND `as_users`.`user_id` = :id",
                       array( "id" => $this->userId)
                    );

        return $result[0]['role'];
    }



    /**
     * Updates user info.
     * @param array $updateData Associative array where keys are database fields that need
     * to be updated and values are new values for provided database fields.
     */
    public function updateInfo($updateData) {
        $this->db->update(
                    "as_users", 
                    $updateData, 
                    "`user_id` = :id",
                    array( "id" => $this->userId )
               );
    }

    
    /**
     * Get user details (First Name, Last Name, Address and Phone)
     * @return array User details array.
     */
    public function getDetails() {
        $result = $this->db->select(
                    "SELECT * FROM `as_user_details` WHERE `user_id` = :id",
                    array ("id" => $this->userId)
                  );

        if(count($result) == 0)
            return array(
                "first_name" => "",
                "last_name"  => "",
                "address"    => "",
                "phone"      => "",
                "empty"      => true
            );

        return $result[0];
    }

    
    /**
     * Updates user details.
     * @param array $details Associative array where keys are database fields that need
     * to be updated and values are new values for provided database fields.
     */


    
    /**
     * Delete user, all his comments and connected social accounts.
     */
    public function deleteUser() {
        $this->db->delete("as_users", "user_id = :id", array( "id" => $this->userId ));
        $this->db->delete("as_user_details","user_id = :id", array( "id" => $this->userId ));
        $this->db->delete("as_comments","posted_by = :id", array( "id" => $this->userId ));
        $this->db->delete("as_social_logins","user_id = :id", array( "id" => $this->userId ));
    }



}
