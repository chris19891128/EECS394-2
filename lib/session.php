<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/client.php';

/**
 * Function to return the json for user info
 *
 * @return multitype: false if the accessToken does not exist or
 */
function getFullUserInfo() {
	global $client;
	if (isset ( $_SESSION ['token'] )) {
		$accessToken = getAccessToken ();
		$response = @file_get_contents ( 'https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . $accessToken );
		if (! strpos ( $http_response_header [0], "200" )) {
			return false;
		}
		$json = json_decode ( $response, true );
		return $json;
	}
	return false;
}

/**
 * Function to return the json for all contacts
 *
 * @return multitype:multitype:string |multitype:
 */
function getAllContacts() {
	global $client;
	if (isset ( $_SESSION ['token'] )) {
		$accessToken = getAccessToken ();
		$client->setAccessToken ( $_SESSION ['token'] );
		$req = new Google_HttpRequest ( "https://www.google.com/m8/feeds/contacts/default/full?&max-results=2000" );
		$req->setRequestHeaders ( array (
				'GData-Version' => '3.0',
				'content-type' => 'application/atom+xml; charset=UTF-8; type=feed' 
		) );
		
		$val = $client->getIo ()->authenticatedRequest ( $req );
		
		$response = $val->getResponseBody ();
		
		$xml = simplexml_load_string ( $response );
		
		$all_email = array ();
		
		foreach ( $xml->entry as $entry ) {
			foreach ( $entry->xpath ( 'gd:email' ) as $email ) {
				$all_email [] = array (
						( string ) $entry->title,
						( string ) $email->attributes ()->address 
				);
			}
		}
		
		return $all_email;
	}
	return array ();
}

/**
 * Return the access token
 *
 * @return NULL if it is not logged in
 */
function getAccessToken() {
	if (isset ( $_SESSION ['token'] )) {
		$token = json_decode ( $_SESSION ['token'] );
		return $token->{'access_token'};
	}
	return null;
}
?>