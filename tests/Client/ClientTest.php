<?php

class ClientTest extends PHPUnit_Framework_TestCase
{
    private $correctModels = array(
        'agents', 'cannedResponses', 'chats', 'goals', 'groups', 'reports', 'status', 'tickets', 'visitors'
    );

    public function testGetProperModelClasses()
    {
        $client = new LiveChat\Api\Client();

        foreach ($this->correctModels as $modelName) {
            $expectedClass = 'LiveChat\Api\Model\\' . ucfirst($modelName);
            $this->assertEquals($expectedClass, get_class($client->{$modelName}));
        }
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessageRegExp /No such model: \w+/
     */
    public function testGetWrongModelClass()
    {
        $client = new LiveChat\Api\Client();
        $client->undefinedModel;
    }

    public function testReturnResponseFlag()
    {
        $client = new LiveChat\Api\Client();
        $client->setReturnResponse(true);
        $this->assertTrue($client->getReturnResponse());
        $client->setReturnResponse(false);
        $this->assertFalse($client->getReturnResponse());
    }

    public function testProxy()
    {
        $proxyUrl = 'https://www.example.com';

        $client = new LiveChat\Api\Client();
        $client->setProxy($proxyUrl);
        $this->assertEquals($client->getProxy(), $proxyUrl);
    }
}
