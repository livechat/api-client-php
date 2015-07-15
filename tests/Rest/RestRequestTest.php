<?php

class RestRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Current method (invalidMethod) is an invalid REST method.
     */
    public function testInvalidMethod()
    {
        $restRequest = new \LiveChat\Api\Rest\RestRequest('agents', 'invalidMethod', array());
    }
}
