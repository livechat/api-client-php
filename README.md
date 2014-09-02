api-client-php
==============

PHP library with ready-to-use LiveChat API implementation.

Quick example
=============

    // When not using a PSR-0 compliant autoloader, only the API file needs to be
    // included. If you are using a PSR-0 autoloader, it should be configured to
    // load the LiveChat namespace from the lib/LiveChat folder or whichever
    // directory you choose to move the LiveChat folder to.
    require_once('lib/LiveChat/API.php');

    try {
        $LiveChatAPI = new \LiveChat\API(/* login name */, /* API key */);
        var_dump($LiveChatAPI->agents->get());
    }
    catch (Exception $e) {
        die($e->getCode().' '.$e->getMessage());
    }
