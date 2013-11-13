<!--
 * Copyright 2012 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Sample code for authenticating to Gmail with OAuth2. See
 * https://code.google.com/p/google-mail-oauth2-tools/wiki/PhpSampleCode
 * for documentation.
 * -->
<?php
require_once 'lib/all_error.php';
session_start ();

if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}
?>
<html>
<head>
<title>Home Page for Users</title>
</head>
<body>

<?php
//echo var_dump ( $_SESSION ['google_user'] );
"<h1> Welcome $_SESSION['google_user']['name'] ($_SESSION['google_user']['email'])"
?>
</body>
</html>
