<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id_user = $_SERVER['APP_ID_USER'];
$app_token_user = $_SERVER['APP_TOKEN_USER'];
$app_id_session = $_SERVER['APP_ID_SESSION'];
$app_token_session = $_SERVER['APP_TOKEN_SESSION'];

$app_id = (int)$app_id_session;
$app_token = $app_token_session;

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id, $app_token);
//$items = PodioItem::filter($app_id);
//
//foreach ($items as $item) {
//  foreach ($item->fields as $field) {
//    if ($field->external_id == "location") {
//      print $field->field_id;
//      $collection = $field->values;
//      var_dump($collection);
//      foreach ($collection as $referenced_item) {
//        print "Referenced item: ".$referenced_item->title;
//        echo "<br>";
//        print "Referenced item: ".$referenced_item->item_id;
//      }
//    }
//  }
//}

$fields = new PodioItemFieldCollection(array(
  new PodioAppItemField(array("external_id" => "location", "values" => array(
    'item_id' => 2412221775
  ))),
  new PodioDateItemField(array("external_id" => "login-time", "values" => array(
    "start" => "2023-03-19 06:29:00"
  ))),
  new PodioTextItemField(array("external_id" => "mac-address", "values" => "12:e5:10:47:b9:72"))
));

$item = new PodioItem(array(
  'app' => new PodioApp($app_id),
  'fields' => $fields
));

$new_item_placeholder = $item->save();
$item->item_id = $new_item_placeholder->item_id;
print $item->item_id;