<?php

/**
 * Base Model class file.
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Rest\RestRequest;

/**
 * Base Model class.
 */
abstract class BaseModel
{
    private $username = null;
    private $password = null;
    private $returnResponse = true;
    private $proxy = null;
    private $returnArrayResponse = false;

    /**
     * Set up base properties.
     * @param string $username
     * @param string $password
     * @param boolean $returnResponse
     * @param string $proxy
     */
    public function __construct($username = null, $password = null, $returnResponse = true, $proxy = null, $returnArrayResponse = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->returnResponse = (boolean) $returnResponse;
        $this->proxy = $proxy;
        $this->returnArrayResponse = (boolean) $returnArrayResponse;
    }

    /**
     * Execute GET method
     * @param string $path
     * @param bool $returnArrayResponse true to return array, else stdClass object
     * @return mixed
     */
    protected function executeGet($path, $returnArrayResponse = false)
    {
        $this->setReturnArrayResponse($returnArrayResponse);
        $result = $this->executeRequest('GET', $path);

        return $result;
    }
    
    protected function setReturnArrayResponse($value){
        $this->returnArrayResponse = $value;
    }

    /**
     * Execute POST method
     * @param string $path
     * @param array $requestBody
     * @return mixed
     */
    protected function executePost($path, array $requestBody = array())
    {
        return $this->executeRequest('POST', $path, $requestBody);
    }

    /**
     * Execute POST method
     * @param string $path
     * @param array $requestBody
     * @return mixed
     */
    protected function executePut($path, array $requestBody = array())
    {
        return $this->executeRequest('PUT', $path, $requestBody);
    }

    /**
     * Execute DELETE method.
     * @param string $path
     * @return mixed
     */
    protected function executeDelete($path)
    {
        return $this->executeRequest('DELETE', $path);
    }

    /**
     * Integer validation.
     * @param mixed $value
     * @return boolean
     * @throws \Exception
     */
    protected function ensureInteger($value)
    {
        if (!is_int($value)) {
            throw new \Exception('Given parameter must be an integer.');
        }

        return true;
    }

    /**
     * Parse array of parameters to string
     * @param array $params
     * @return string
     */
    protected function parseParams(array $params)
    {
        $return = '';
        foreach ($params as $key => $value) {
            # skip empty param keys or values
            if ($key != '') {
                if(is_array($value)){
                    foreach($value as $v){
                        $return != '' ? $return .= '&' : '';
                        $return .= $key . '[]=' . $v;
                    }
                }else{
                    if(trim($value) != '' ){
                        $return != '' ? $return .= '&' : '';
                        $return .= $key . '=' . $value;
                    }
                }
            }
        }
        
        return $return;
    }

    /**
     * Execute request.
     * @param string $method
     * @param string $path
     * @param array $requestBody
     * @return miexd
     * @throws \Exception
     */
    private function executeRequest($method, $path, array $requestBody = array())
    {
        $requestBody = (in_array($method, array('GET', 'DELETE'))) ? array() : $requestBody;

        $request = new RestRequest($path, $method, $requestBody, array( 'X-API-Version' => 2));
        $request->setUsername($this->username);
        $request->setPassword($this->password);
        $request->setProxy($this->proxy);
        $request->execute();

        return ($this->returnResponse === true) ? $request->getResponse($this->returnArrayResponse) : null;
    }
}
