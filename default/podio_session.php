<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id_user = $_SERVER['APP_ID_USER'];
$app_token_user = $_SERVER['APP_TOKEN_USER'];
$app_id_session = $_SERVER['APP_ID_SESSION'];
$app_token_session = $_SERVER['APP_TOKEN_SESSION'];

//$app_id = $app_id_user;
//$app_token = $app_token_user;

$app_id = $app_id_session;
$app_token = $app_token_session;

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
//  new PodioTextItemField(array("external_id" => "first-name", "values" => "John")),
//  new PodioTextItemField(array("external_id" => "family-name", "values" => "Doe")),
//  new PodioTextItemField(array("external_id" => "mobile-phone-number", "values" => "123456789")),
//  new PodioEmailItemField(array("external_id" => "email", "values" => array(
//    'type' => "home",
//    'value' => "abc@xyz.com"
//  )))
//));
//
//$item = new PodioItem(array(
//  'app' => new PodioApp($app_id),
//  'fields' => $fields
//));
//
//$item->save();