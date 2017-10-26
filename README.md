LiveChat API Client
==============

PHP client for connecting to the LiveChat REST API.

Documentation
-------------

To find out more, visit the official [LiveChat REST API documentation](https://developers.livechatinc.com/rest-api/#!introduction).

Previous version of [LiveChat API Client](https://github.com/livechat/api-client-php/tree/0.9).

Requirements
------------

- PHP 5.3 or greater
- cUrl extension enabled

**Authentication to the API occurs via HTTP Basic Auth. Provide your:**

- login
- API key

More information: https://developers.livechatinc.com/rest-api/#authentication

Installation
------------

**Composer**

~~~shell
$ composer require livechat/api-client-php "@dev"
~~~

**Or**, set up `dev` as  `minimum-stability` in your `composer.json`:

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
~~~

Available methods
------------

**Methods returns `stdClass` (parsed JSON response).**

### Agents

[Agents REST API documentation](https://developers.livechatinc.com/rest-api/#!agents).

- `$LiveChatAPI->agents->get($login = null)`
- `$LiveChatAPI->agents->add(array $vars)`
- `$LiveChatAPI->agents->update($login, array $vars)`
- `$LiveChatAPI->agents->delete($login)`

### Canned responses

[Canned responses REST API documentation](https://developers.livechatinc.com/rest-api/#!canned-responses).

- `$LiveChatAPI->cannedResponses->get($group = 0)`
- `$LiveChatAPI->cannedResponses->getSingleResponse($id)`
- `$LiveChatAPI->cannedResponses->addNewResponse($text, $tags)`
- `$LiveChatAPI->cannedResponses->updateResponse($id, $text, $tags)`
- `$LiveChatAPI->cannedResponses->deleteResponse($id)`

### Chat archives

[Archives REST API documentation](https://developers.livechatinc.com/rest-api/#!archives).

- `$LiveChatAPI->chats->get($params = array())`
- `$LiveChatAPI->chats->getSingleChat($chatId)`
- `$LiveChatAPI->chats->updateTags($id, array $vars)`

### Goals

[Goals REST API documentation](https://developers.livechatinc.com/rest-api/#!goals).

- `$LiveChatAPI->goals->markAsSuccessful($goalId)`

### Groups

[Groups REST API documentation](https://developers.livechatinc.com/rest-api/#!groups).

- `$LiveChatAPI->groups->get($group = 0)`
- `$LiveChatAPI->groups->update($id, array $vars)`
- `$LiveChatAPI->groups->add(array $vars)`
- `$LiveChatAPI->groups->delete($id)`

### Reports

[Reports REST API documentation](https://developers.livechatinc.com/rest-api/#!reports).

- `$LiveChatAPI->reports->get($type, array $params = array())`

### Status

[Status REST API documentation](https://developers.livechatinc.com/rest-api/#!status).

- `$LiveChatAPI->status->get($group = 0)`

### Tickets

[Tickets REST API documentation](https://developers.livechatinc.com/rest-api/#!tickets).

- `$LiveChatAPI->tickets->get(array $params = array())`
- `$LiveChatAPI->tickets->getSingleTicket($ticketId)`
- `$LiveChatAPI->tickets->add(array $vars)`
- `$LiveChatAPI->tickets->updateTags($id, array $vars)`

### Visitors

[Visitors REST API documentation](https://developers.livechatinc.com/rest-api/#!visitors).

- `$LiveChatAPI->visitors->get(array $params = array())`

### Tags

[Tags REST API documentation](https://docs.livechatinc.com/rest-api/#tags).

- `$LiveChatAPI->tags->get($group=0)`

- `$LiveChatAPI->tags->add(array(
    "author" => 'test@email.com',
    "tag" => 'Test Tag', 
    "group" => 1 
))`

- `$LiveChatAPI->tags->delete('Tag Name')`

### Webhooks

[Webhooks REST API documentation](https://docs.livechatinc.com/rest-api/#webhooks).

- `$LiveChatAPI->webhooks->get()`

- `$LiveChatAPI->webhooks->add(array(
    "event_type" => "chat_started",
    "data_types" => array(
        "chat", "visitor"
    ),
    "url" => "http://www.shoeshop.com/webhook",
))`

- `$LiveChatAPI->webhooks->delete('622d3950eecea8bb5f8c26f20c76ee2e')`

To do
------------

- Tests for models
- Add all supported API methods
