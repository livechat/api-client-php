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

    /**
     * Set up base properties.
     * @param string $username
     * @param string $password
     * @param boolean $returnResponse
     */
    public function __construct($username = null, $password = null, $returnResponse = true)
    {
        $this->username = $username;
        $this->password = $password;
        $this->returnResponse = (boolean) $returnResponse;
    }

    /**
     * Execute GET method
     * @param string $path
     * @return mixed
     */
    protected function get($path)
    {
        $result = $this->executeRequest('GET', $path);

        return $result;
    }

    /**
     * Execute POST method
     * @param string $path
     * @param array $requestBody
     * @return mixed
     */
    protected function post($path, array $requestBody = array())
    {
        return $this->executeRequest('POST', $path, $requestBody);
    }

    /**
     * Execute POST method
     * @param string $path
     * @param array $requestBody
     * @return mixed
     */
    protected function put($path, array $requestBody = array())
    {
        return $this->executeRequest('PUT', $path, $requestBody);
    }

    /**
     * Execute DELETE method.
     * @param string $path
     * @return mixed
     */
    protected function delete($path)
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
        $encodedParams = array_map('urlencode', $params);

        $return = '';
        foreach ($encodedParams as $key => $value) {
            # skip empty param keys or values
            if (trim($value) != '' && $key != '') {
                $return != '' ? $return .= '&' : '';
                $return .= $key . '=' . $value;
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
        $request->execute();

        return ($this->returnResponse === true) ? $request->getResponse() : null;
    }
}
