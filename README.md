api-client-php
==============

PHP library with ready-to-use LiveChat API implementation.

Quick example
=============

```php
<?php
require_once('lib/LiveChat_API.php');

try {
  $LiveChatAPI = new LiveChat_API();

  // list all your agents
  var_dump($LiveChatAPI->agents->get());
}
catch (Exception $e) {
  die($e->getCode().' '.$e->getMessage());
}
```
