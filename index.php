<?php

require_once('lib/API.php');

try {
	$LiveChatAPI = new \LiveChat\API();
	var_dump($LiveChatAPI->agents->get());
}
catch (Exception $e) {
	die($e->getCode().' '.$e->getMessage());
}
