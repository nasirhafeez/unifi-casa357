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
    print "This field has the id: ".$field->field_id;
    echo "<br>";
    print "This field has the external_id: ".$field->external_id;
    echo "<br>";
  }
}