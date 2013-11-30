<?php
session_start ();
$token = json_decode ( $_SESSION ['token'] );
$access = $token->{'access_token'};
$access = substr ( $access, 0, strlen ( $access ) - 1 ) . 'x';
$token->{'access_token'} = $access;
$_SESSION ['token'] = json_encode ( $token );
?>