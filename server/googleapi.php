<?php
/**
 * This is the API for all google related service.
 * This script encapsulate all the google api details. 
 * There are two approaches to call this api.
 * 
 * All api calls will return the json encoded string ! Decode it first before usage
 * 
 * (1) BaseUrl/server/googleapi.php?f=user
 * 	   (i) Return full user information if success
 * 			{'name'=> 'xxx', 'email' =>'xxx', 'location'=>'xxx' ...}
 *     (ii) Return false if the user did not login or the login expires
 *  
 * (2) BaseUrl/server/googleapi.php?f=contact
 * 	   (i) Return array of contacts in the pair of name and email 
 * 			[ [ 'chao shi', 'chris19891128@gmail.com'], 
 * 			  [ 'chris shi','chaoshi2012@u.northwestern.edu']
 * 			]
 *     (ii) Return empty array if the user did not login or the login expires
 */

set_include_path ( '..' );
require_once 'lib/client.php';
require_once 'lib/session.php';

session_start ();

if (isset ( $_GET )) {
	if ($_GET ['f'] == 'user') {
		echo json_encode ( getFullUserInfo () );
	} else if ($_GET ['f'] == 'contact') {
		echo json_encode ( getAllContacts () );
	}
}

?>
