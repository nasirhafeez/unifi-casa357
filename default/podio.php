<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id = $_SERVER['APP_ID'];
$app_token = $_SERVER['APP_TOKEN'];

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id, $app_token);
$items = PodioItem::filter($app_id);
$field_id = 'app-reference';
//print "My app has " . count($items) . " items";
foreach ($items as $item) {
  $collection = $item->fields[$field_id]->values;
  foreach ($collection as $referenced_item) {
    print "Referenced item: ".$referenced_item->title;
  }
}