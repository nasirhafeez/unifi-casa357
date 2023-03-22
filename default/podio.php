<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id = $_SERVER['APP_ID'];
$app_token = $_SERVER['APP_TOKEN'];

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id, $app_token);
$items = PodioItem::filter($app_id);

foreach ($items as $item) {
  print $item->item_id;
  echo "<br>";
  foreach ($item->fields as $field) {
    print "This field has the external_id: ".$field->external_id;
    echo "<br>";
    $collection = $field->values;
    echo gettype($collection) . "<br>";
    if (gettype($collection) == "object")
    foreach ($collection as $referenced_item) {
      print "Referenced item: ".$referenced_item->title;
      echo "<br>";
    } elseif (gettype($collection) == "array") {
      print $field->humanized_value();
      echo "<br>";
    } else {
      print $collection . "<br>";
    }
  }
}

//$fields = new PodioItemFieldCollection(array(
//  new PodioAppItemField(array("external_id" => "user", "values" => array(
//    'item_id' => "Nasir"
//  ))),
//  new PodioAppItemField(array("external_id" => "location", "values" => array(
//    'item_id' => "Casa357"
//  ))),
//  new PodioDateItemField(array("external_id" => "login-time", "values" => array(
//    "start" => "2023-03-19 06:29"
//  ))),
//  new PodioTextItemField(array("external_id" => "mac-address", "values" => "12:e5:10:47:b9:72"))
//));
//
//$item = new PodioItem(array(
//  'app' => new PodioApp($app_id),
//  'fields' => $fields
//));
//
//$item->save();