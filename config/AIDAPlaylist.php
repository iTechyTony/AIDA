<?php

/**
 * Advance Internet Development A
 *
 * @author Tony Ampomah
 * @link   http://www.itechytony.com/aida
 */

/**
 * User class.
 */
class AIDAPlaylist {

    /**
     * @var ID of user represented by this class
     */
    private $playlistId;

    /**
     * @var Instance of AIDADatabase class
     */
    private $db = null;

    /**
     * Class constructor
     * @param $playlistId ID of user that will be represented by this class
     */
    function __construct($playlistId) {
        //update local user id with given user id
        $this->playlistId = $playlistId;

        //connect to database
        $this->db = AIDADatabase::getInstance();
    }

    /**
     * Get all user details including email, username and last_login
     * @return User details or null if user with given id doesn't exist.
     */
    public function getAll() {
        $query = "SELECT * FROM `playlist`
                    WHERE id = :id ";

        $result = $this->db->select($query, array( 'id' => $this->playlistId ));

        if ( count ( $result ) > 0 )
            return $result[0];
        else
            return null;
    }

    
    
    public function getDetails() {
        $result = $this->db->select(
                    "SELECT * FROM `as_user_details` WHERE `user_id` = :id",
                    array ("id" => $this->playlistId)
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


}
