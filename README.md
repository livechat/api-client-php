LiveChat API Client
==============

PHP client for connecting to the LiveChat REST API.

Documentation
-------------

To find out more, visit the official [LiveChat REST API documentation](http://developers.livechatinc.com/rest-api/#!introduction).

Previous version of [LiveChat API Client](https://github.com/livechat/api-client-php/tree/0.9).

Requirements
------------

- PHP 5.3 or greater
- cUrl extension enabled

**Authentication to the API occurs via HTTP Basic Auth. Provide your:**

- login
- API key

More information: http://developers.livechatinc.com/rest-api/#authentication

Installation
------------

**Composer**

Set up `dev` as  `minimum-stability` in your `composer.json`: 

~~~javascript
    "minimum-stability": "dev"
~~~

Then:

~~~shell
 $ composer require livechat/api-client-php
 $ composer update
~~~

Execute tests
------------

This operation requires PHPUnit installed.

~~~shell
 $ phpunit
~~~

Basic usage
------------

~~~php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use LiveChat\Api\Client as LiveChat;

$LiveChatAPI = new LiveChat('%login%', '%apiKey%');
$agents = $LiveChatAPI->agents->get();
?>
~~~

Available methods
------------

### Agents

[Agents REST API documentation](http://developers.livechatinc.com/rest-api/#!agents).

- `$LiveChatAPI->agents->get($login = null)`
- `$LiveChatAPI->agents->add(array $vars)`
- `$LiveChatAPI->agents->update($login, array $vars)`
- `$LiveChatAPI->agents->delete($login)`

### Canned responses

[Canned responses REST API documentation](http://developers.livechatinc.com/rest-api/#!canned-responses).

- `$LiveChatAPI->cannedResponses->get($group = 0)`
- `$LiveChatAPI->cannedResponses->getSingleResponse($id)`
- `$LiveChatAPI->cannedResponses->addNewResponse($text, $tags)`
- `$LiveChatAPI->cannedResponses->updateResponse($id, $text, $tags)`
- `$LiveChatAPI->cannedResponses->deleteResponse($id)`

### Chats

[Chats REST API documentation](http://developers.livechatinc.com/rest-api/#!chats).

- `$LiveChatAPI->chats->get($params = array())`
- `$LiveChatAPI->chats->getSingleChat($chatId)`
- `$LiveChatAPI->chats->updateTags($id, array $vars)`

### Goals

[Goals REST API documentation](http://developers.livechatinc.com/rest-api/#!goals).

- `$LiveChatAPI->goals->markAsSuccessful($goalId)`

### Groups

[Groups REST API documentation](http://developers.livechatinc.com/rest-api/#!groups).

- `$LiveChatAPI->groups->get($group = 0)`
- `$LiveChatAPI->groups->update($id, array $vars)`
- `$LiveChatAPI->groups->add(array $vars)`
- `$LiveChatAPI->groups->delete($id)`

### Reports

[Reports REST API documentation](http://developers.livechatinc.com/rest-api/#!reports).

- `$LiveChatAPI->reports->get($type, array $params = array())`

### Status

[Status REST API documentation](http://developers.livechatinc.com/rest-api/#!status).

- `$LiveChatAPI->status->get($group = 0)`

### Tickets

[Tickets REST API documentation](http://developers.livechatinc.com/rest-api/#!tickets).

- `$LiveChatAPI->tickets->get(array $params = array())`
- `$LiveChatAPI->tickets->getSingleTicket($ticketId)`
- `$LiveChatAPI->tickets->add(array $vars)`
- `$LiveChatAPI->tickets->updateTags($id, array $vars)`

### Visitors

[Visitors REST API documentation](http://developers.livechatinc.com/rest-api/#!visitors).

- `$LiveChatAPI->visitors->get()`

To do
------------

- Tests for models
- Add all supported API methods
