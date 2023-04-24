<?php

require 'header.php';
include 'config.php';

$mac = $_SESSION["id"];
$apmac = $_SESSION["ap"];
$user_type = $_SESSION["user_type"];
$last_updated = date("Y-m-d H:i:s");

if ($user_type == "new") {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  mysqli_query($con, "
    CREATE TABLE IF NOT EXISTS `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `firstname` varchar(45) NOT NULL,
    `lastname` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `phone` varchar(45) NOT NULL,
    `mac` varchar(45) NOT NULL,
    `last_updated` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (mac)
    )");

  mysqli_query($con,"INSERT INTO `$table_name` (firstname, lastname, email, phone, mac, last_updated) VALUES ('$fname', '$lname', '$email', '$phone', '$mac', '$last_updated')");

//  $client_id = $_SERVER['CLIENT_ID'];
//  $client_secret = $_SERVER['CLIENT_SECRET'];
//  $app_id_user = (int)$_SERVER['APP_ID_USER'];
//  $app_token_user = $_SERVER['APP_TOKEN_USER'];
//  $app_id_session = (int)$_SERVER['APP_ID_SESSION'];
//  $app_token_session = $_SERVER['APP_TOKEN_SESSION'];
//  $location = (int)$_SERVER['LOCATION'];
//
//  # Create session
//
//  Podio::setup($client_id, $client_secret);
//  Podio::authenticate_with_app($app_id_session, $app_token_session);
//
//  $fields = new PodioItemFieldCollection(array(
//    new PodioAppItemField(array("external_id" => "location", "values" => array(
//      'item_id' => $location
//    ))),
//    new PodioDateItemField(array("external_id" => "login-time", "values" => array(
//      "start" => $last_updated
//    ))),
//    new PodioTextItemField(array("external_id" => "mac-address", "values" => $mac))
//  ));
//
//  $item = new PodioItem(array(
//    'app' => new PodioApp($app_id_session),
//    'fields' => $fields
//  ));
//
//  $new_item_placeholder = $item->save();
//  $item->item_id = $new_item_placeholder->item_id;
//
//  # Create user and add session reference
//
//  Podio::authenticate_with_app($app_id_user, $app_token_user);
//
//  $fields = new PodioItemFieldCollection(array(
//    new PodioTextItemField(array("external_id" => "first-name", "values" => $fname)),
//    new PodioTextItemField(array("external_id" => "family-name", "values" => $lname)),
//    new PodioTextItemField(array("external_id" => "mobile-phone-number", "values" => $phone)),
//    new PodioEmailItemField(array("external_id" => "email", "values" => array(
//      'type' => "work",
//      'value' => $email
//    ))),
//    new PodioAppItemField(array("external_id" => "relationship-3", "values" => array(
//      'item_id' => $item->item_id
//    ))),
//  ));
//
//  $item_2 = new PodioItem(array(
//    'app' => new PodioApp($app_id_user),
//    'fields' => $fields
//  ));
//
//  $new_item_placeholder_2 = $item_2->save();
}

$controlleruser = $_SERVER['CONTROLLER_USER'];
$controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
$controllerurl = $_SERVER['CONTROLLER_URL'];
$controllerversion = $_SERVER['CONTROLLER_VERSION'];
$duration = $_SERVER['DURATION'];

$debug = false;

$site_id = $_SERVER['SITE_ID'];

$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $apmac);

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>
      <?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="../assets/styles/bulma.min.css"/>
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css"/>
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon.png"/>
    <link rel="stylesheet" href="../assets/styles/style.css"/>
    <meta http-equiv="refresh" content="5;url=https://www.google.com" />
</head>

<body>
<div class="page">

    <div class="head">
        <br>
        <figure id="logo">
            <img src="../assets/images/logo.png">
        </figure>
    </div>

   <div class="main">
       <seection class="section">
           <div id="margin_zero" class="content has-text-centered is-size-6">Dankjewel. Je hebt </div>
           <div id="margin_zero" class="content has-text-centered is-size-6">nu gratis WiFi.</div>
       </seection>
    </div>

</div>
</body>
</html>