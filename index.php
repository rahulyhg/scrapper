<?php
session_start(); 
?>
<?php 
// Load SDK Assets
require_once __DIR__ . '/vendor/autoload.php';
// Minimum required

$fb = new Facebook\Facebook([
  'app_id' => '1687233988161207',
  'app_secret' => '15c0aa4edbd65f6a01ee26a9c07575c6',
  'default_graph_version' => 'v2.5',
]);
$app_id = '1687233988161207';
$app_secret = '15c0aa4edbd65f6a01ee26a9c07575c6';
$app_namespace = 'cusatodap';
$app_scope = 'user_location,email';

 echo "Hello";
$canvasHelper = $fb->getCanvasHelper();

try {
  $accessToken = $canvasHelper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
  // Logged in.
	// Lets save fb_token for later authentication through saved $_SESSION
	$_SESSION['fb_token'] = $accessToken;
	
	// Logged in
	$fb_me = (new FacebookRequest(
	  $accessToken, 'GET', '/me'
	))->execute()->getGraphObject();
	var_dump($fb_me);
	// We can get some info about the user
	$fb_location_name = $fb_me->getProperty('location')->getProperty('name');
	$fb_email = $fb_me->getProperty('email');
	$fb_uuid = $fb_me->getProperty('id');
	echo $fb_uuid;
}
 ?>
