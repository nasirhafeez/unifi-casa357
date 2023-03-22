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
  foreach ($item->fields as $field) {
    // You can now work on each individual field object:
    print "This field has the external_id: ".$field->external_id;

    $collection = $field->values;
    foreach ($collection as $referenced_item) {
      print "Referenced item: ".$referenced_item->title;
    }
  }
}

//$item = new PodioItem();
//$item->fields['app-reference']->values = array('user' => 250138701);
//$item->fields['app-reference']->values = array('location' => 250138701);
//$item->fields['date']->start = "2011-12-31 11:27:10";
//$item->fields['text']->values = '12:e5:10:47:b9:72';
//$item->save();