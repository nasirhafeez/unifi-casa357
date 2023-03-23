<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$app_id_user = $_SERVER['APP_ID_USER'];
$app_token_user = $_SERVER['APP_TOKEN_USER'];
$app_id = $app_id_user;
$app_token = $app_token_user;

Podio::setup($client_id, $client_secret);
Podio::authenticate_with_app($app_id, $app_token);
$items = PodioItem::filter($app_id);

$fields = new PodioItemFieldCollection(array(
  new PodioAppItemField(array("external_id" => "user", "values" => array(
    'item_id' => "2416065557"
  ))),
  new PodioAppItemField(array("external_id" => "location", "values" => array(
    'item_id' => "Casa357"
  ))),
  new PodioDateItemField(array("external_id" => "login-time", "values" => array(
    "start" => "2023-03-19 06:29"
  ))),
  new PodioTextItemField(array("external_id" => "mac-address", "values" => "12:e5:10:47:b9:72"))
));

$item = new PodioItem(array(
  'app' => new PodioApp($app_id),
  'fields' => $fields
));

$item->save();
