<?php

/**
 * LiveChat Api Client class file.
 */
namespace LiveChat\Api;

/**
 * LiveChat Api Client class.
 */
class Client
{
    /**
     * @var string - User's login (used for API authentication)
     */
    private $apiLogin = null;

    /**
     * @var string - Once authorized, API key is used for other API calls
     */
    private $apiKey = null;

    /**
     * @var boolean - Indicates whether to return the API response or send response body and headers directly
     */
    private $returnResponse = true;

    /**
     * @var string - Proxy for RestRequest (optional)
     */
    private $proxy = null;


    /**
     * Sets user's login and API key for API requests
     *
     * @param string $login
     * @param string $apiKey
     */
    public function __construct($login = null, $apiKey = null)
    {
        $this->apiLogin = $login;
        $this->apiKey = $apiKey;
    }

    /**
     * Returns model of a given name
     *
     * @param $name Requested model name
     * @return \LiveChat\Api\Model\BaseModel Model
     * @throws \Exception for unknown model
     */
    public function __get($name)
    {
        $className = 'LiveChat\Api\Model\\' . ucfirst($name);

        if (!class_exists($className)) {
            throw new \Exception('No such model: '.$name);
        }

        return new $className($this->apiLogin, $this->apiKey, $this->returnResponse, $this->proxy);
    }

    /**
     * Sets returnResponse flag
     *
     * @param boolean $bReturn Return response flag
     */
    public function setReturnResponse($bReturn)
    {
        $this->returnResponse = (boolean) $bReturn;
    }

    /**
     * Returns returnResponse flag
     *
     * @return boolean Response flag
     */
    public function getReturnResponse()
    {
        return $this->returnResponse;
    }

    /**
     * Sets proxy for the RestRequest
     *
     * @param string $proxy Url:Port
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * Returns proxy for the RestRequest
     *
     * @return string $proxy
     */
    public function getProxy()
    {
        return $this->proxy;
    }
}
