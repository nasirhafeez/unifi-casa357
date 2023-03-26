<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id_user = (int)$_SERVER['APP_ID_USER'];
$app_token_user = $_SERVER['APP_TOKEN_USER'];
$app_id_session = (int)$_SERVER['APP_ID_SESSION'];
$app_token_session = $_SERVER['APP_TOKEN_SESSION'];

$app_id = $app_id_user;
$app_token = $app_token_user;

///////////////////////////////////////////////////////////////////////////////////////////

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id_session, $app_token_session);

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
  'app' => new PodioApp($app_id_session),
  'fields' => $fields
));

$new_item_placeholder = $item->save();
$item->item_id = $new_item_placeholder->item_id;
print $item->item_id;

///////////////////////////////////////////////////////////////////////////////////////////

Podio::authenticate_with_app($app_id_user, $app_token_user);

$fields = new PodioItemFieldCollection(array(
  new PodioTextItemField(array("external_id" => "first-name", "values" => "John")),
  new PodioTextItemField(array("external_id" => "family-name", "values" => "Doe")),
  new PodioTextItemField(array("external_id" => "mobile-phone-number", "values" => "123456789")),
  new PodioEmailItemField(array("external_id" => "email", "values" => array(
    'type' => "work",
    'value' => "abc@xyz.com"
  ))),
  new PodioAppItemField(array("external_id" => "relationship-3", "values" => array(
    'item_id' => $item->item_id
  ))),
));

$item_2 = new PodioItem(array(
  'app' => new PodioApp($app_id_user),
  'fields' => $fields
));

$new_item_placeholder_2 = $item_2->save();
$item_2->item_id = $new_item_placeholder_2->item_id;
print $item_2->item_id;