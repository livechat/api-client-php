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

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Unauthorized. You have no rights to access this data. Check your API Key and/or username
     */
    public function testInvalidAuth()
    {
        $restRequest = new \LiveChat\Api\Rest\RestRequest('agents', 'GET', array(), array( 'X-API-Version' => 2));
        $restRequest->setUsername('invalid');
        $restRequest->setPassword('invalid');
        $restRequest->execute();
        $response = $restRequest->getResponse();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Not Found.
     */
    public function testPutNotFound()
    {
        $this->notFoundTest('PUT');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Not Found.
     */
    public function testGetNotFound()
    {
        $this->notFoundTest('GET');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Not Found.
     */
    public function testPostNotFound()
    {
        $this->notFoundTest('POST');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Not Found.
     */
    public function testDeleteNotFound()
    {
        $this->notFoundTest('DELETE');
    }

    public function testInvalidProxy()
    {
        $restRequest = new \LiveChat\Api\Rest\RestRequest('unknown', 'GET', array(), array( 'X-API-Version' => 2));
        $restRequest->setUsername('invalid');
        $restRequest->setPassword('invalid');
        $restRequest->setProxy('invalid');
        $restRequest->execute();
        $errorMessage = $restRequest->getError();
        $this->assertEquals('Could not resolve proxy: invalid', $errorMessage);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Something went wrong. StausCode is null.
     */
    public function testEmptyResponse()
    {
        $restRequest = new \LiveChat\Api\Rest\RestRequest('unknown', 'GET', array(), array( 'X-API-Version' => 2));
        $restRequest->getResponse();
    }

    private function notFoundTest($methodName)
    {
        $restRequest = new \LiveChat\Api\Rest\RestRequest('unknown', $methodName, array(), array( 'X-API-Version' => 2));
        $restRequest->setUsername('invalid');
        $restRequest->setPassword('invalid');
        $restRequest->execute();
        $response = $restRequest->getResponse();
    }
}
