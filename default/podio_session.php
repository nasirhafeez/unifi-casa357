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

$item = PodioItem::get_basic(2422645833);
$item->fields[250138701]->values = new PodioItem(array('item_id' => 2422645835));