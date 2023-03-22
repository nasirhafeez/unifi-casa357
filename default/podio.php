<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id = $_SERVER['APP_ID'];
$app_token = $_SERVER['APP_TOKEN'];

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id, $app_token);
//$items = PodioItem::filter($app_id);
//
//foreach ($items as $item) {
//  foreach ($item->fields as $field) {
//    // You can now work on each individual field object:
//    print "This field has the id: ".$field->field_id;
//    echo "<br>";
//    print "This field has the external_id: ".$field->external_id;
//    echo "<br>";
//  }
//}

$fields = new PodioItemFieldCollection(array(
  new PodioAppItemField(array("external_id" => "user", "values" => "250138701")),
  new PodioAppItemField(array("external_id" => "location", "values" => "250139336")),
  new PodioDateItemField(array("external_id" => "login-time", "values" => array(
    "start" => "2011-12-31 11:27:10"
  ))),
  new PodioTextItemField(array("external_id" => "mac-address", "values" => "12:e5:10:47:b9:72"))
));

$item = new PodioItem(array(
  'app' => new PodioApp($app_id), // Attach to app with app_id=123
  'fields' => $fields
));

// Save the new item
$item->save();