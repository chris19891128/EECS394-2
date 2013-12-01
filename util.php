<?php
require_once 'lib/all_error.php';
require_once 'lib/google-api-php-client/src/Google_Client.php';
require_once 'lib/session.php';

session_start ();
$accessToken = getAccessToken ();
echo $accessToken;


// $JAVA_HOME = "/System/Library/Frameworks/JavaVM.framework/Versions/1.6.0/Home";
$JAVA_HOME = '/usr/lib/jvm/java-1.7.0-openjdk-amd64/';
$PATH = "$JAVA_HOME/bin:/usr/local/bin:/usr/bin:/bin";
putenv ( "JAVA_HOME=$JAVA_HOME" );
putenv ( "PATH=$PATH" );

$exe = 'java -jar ./java/SMTP/out/send_email.jar chris19891128@gmail.com ' . $accessToken . ' chris1989apply@gmail.com "my subject" "my content"';
echo exec ( $exe . ' 2>&1', $out );
echo var_dump ( $out );

?>