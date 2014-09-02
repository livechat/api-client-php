<?php

require_once('lib/LiveChat_API.php');

try {
	$LiveChatAPI = new LiveChat_API();
    var_dump($LiveChatAPI->agents->get());
}
catch (Exception $e) {
	die($e->getCode().' '.$e->getMessage());
}
