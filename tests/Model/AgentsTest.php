<?php

use LiveChat\Api\Client as LiveChat;

class AgentsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Unauthorized. You have no rights to access this data. Check your API Key and/or username.
     */
    public function testGetAgentUnauthorized() {
        $LiveChatAPI = new LiveChat('unknownLogin', 'unknownApiKey');
        $agents = $LiveChatAPI->agents->get();
    }
}
