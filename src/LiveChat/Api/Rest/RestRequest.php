<?php

/**
 * RestRequest class file.
 */
namespace LiveChat\Api\Rest;

/**
 * RestRequest class.
 */
class RestRequest
{
    /**
     * @var string accept type header
     */
    const ACCEPT_TYPE = 'application/json';
    /**
     * @var integer request lenght
     */
    const REQUEST_LENGTH = 0;
    /**
     * @var string base API url
     */
    const BASE_API_URL = 'https://api.livechatinc.com/';

    private $url;
    private $method;
    private $requestBody;
    private $username;
    private $password;
    private $error;
    private $responseBody;
    private $responseInfo;
    private $proxy;
    private $proxyPort;

    /**
     * Setting base request data.
     *
     * @param string $path
     * @param string $method request method GET|POST|PUT|DELETE
     * @param array $requestBody request body
     * @param array $headers headers
     */
    public function __construct($path, $method, array $requestBody, array $headers = array())
    {
        $this->url = self::BASE_API_URL . $path;
        $this->headers = $headers;
        // valid method
        if (!in_array(strtoupper($method), array('GET', 'POST', 'PUT', 'DELETE'))) {
            throw new \InvalidArgumentException('Current method (' . $method . ') is an invalid REST method.');
        }
        $this->method = strtoupper($method);
        $this->buildRequestBody($requestBody);
    }

    /**
     * Set password
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set proxy
     * @param string $proxy Url:Port
     */
    public function setProxy($proxy)
    {
        $this->proxyPort = parse_url($proxy, PHP_URL_PORT) ?: 80;
        $this->proxy = str_replace(':' . $this->proxyPort, '', $proxy);
    }

    /**
     * Returns response body
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return boolean
     * @see curl_getinfo()
     */
    public function getResponseInfo()
    {
        return $this->responseInfo;
    }

    /**
     * Set username
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Retruns error.
     * @return string the error message or '' (the empty string) if no error occurred.
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Build request body.
     * @param array $data
     */
    private function buildRequestBody(array $data = array())
    {
        if (in_array($this->method, array('POST', 'PUT'))) {
            $this->requestBody = http_build_query($data, '', '&');
        }
    }

    /**
     * Execute request
     *
     * @throws \InvalidArgumentException
     */
    public function execute()
    {
        $ch = curl_init();
        $this->setAuth($ch);
        try {
            $methodName = 'execute' . ucfirst(strtolower($this->method));
            $this->{$methodName}($ch);
        } catch (\InvalidArgumentException $e) {
            curl_close($ch);
            throw $e;
        } catch (\Exception $e) {
            curl_close($ch);
            throw $e;
        }
    }

    /**
     * Get response.
     * @return mixed
     * @throws \Exception
     */
    public function getResponse() {
        if (($response = $this->getResponseInfo()) === false) {
            return json_encode(array('error' => array('message' => 'Something went wrong.')));
        }

        $httpCode = (array_key_exists('http_code', $response)) ? $response['http_code'] : '';
        // Check if response HTTP code starts with `2` (200, 201, 202 codes)
        if (preg_match('/^2/', $httpCode) == false) {
            $this->throwException($httpCode);
        }

        return json_decode($this->getResponseBody());
    }

    /**
     * Throw exception.
     *
     * @param integer $httpCode
     * @throws \Exception
     */
    private function throwException($httpCode) {
        if ($httpCode === 0){
            throw new \Exception('Something went wrong. StausCode: 0');
        } else{
            $errorResponseBody = json_decode($this->getResponseBody(), true);
            $errorMessage = RestUtils::getStatusCodeMessage($httpCode) . '. ';

            if (array_key_exists('error', $errorResponseBody)) {
                $errorMessage .= $errorResponseBody['error'] . '.';
            } else if (array_key_exists('errors', $errorResponseBody)) {
                $errorMessage .= (is_array($errorResponseBody['errors'])) ?
                    implode('. ', array_map('ucfirst', $errorResponseBody['errors'])) : $errorResponseBody['errors'];
                $errorMessage .= '.';
            }

            throw new \Exception($errorMessage, $httpCode);
        }
    }

    /**
     * Execute request for GET method.
     * @param $ch cURL handle
     */
    private function executeGet(&$ch)
    {
        $this->doExecute($ch);
    }

    /**
     * Execute request for POST method.
     * @param $ch cURL handle
     */
    private function executePost(&$ch)
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);
        curl_setopt($ch, CURLOPT_POST, 1);

        $this->doExecute($ch);
    }

    /**
     * Execute request for PUT method.
     * @param $ch cURL handle
     */
    private function executePut(&$ch)
    {
        // Prepare the data for HTTP PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . self::REQUEST_LENGTH));
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);

        $this->doExecute($ch);
    }

    /**
     * Execute request for DELETE method.
     * @param $ch cURL handle
     */
    private function executeDelete(&$ch)
    {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $this->doExecute($ch);
    }

    /**
     * Execute request.
     * @param $curlHandle cURL handle
     */
    private function doExecute(&$curlHandle)
    {
        $this->setCurlOpts($curlHandle);
        $this->responseBody = curl_exec($curlHandle);
        $this->responseInfo = curl_getinfo($curlHandle);
        $this->error = curl_error($curlHandle);

        curl_close($curlHandle);
    }

    /**
     * Set cURL options.
     * @param $curlHandle cURL handle
     */
    private function setCurlOpts(&$curlHandle)
    {
        $headers = array('Accept' => self::ACCEPT_TYPE);
        foreach ($this->headers as $key => $value) {
            $headers[] = "$key: $value";
        }

        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 15);
        curl_setopt($curlHandle, CURLOPT_URL, $this->url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);

        if ($this->proxy && $this->proxyPort) {
            curl_setopt($curlHandle, CURLOPT_PROXY, $this->proxy);
            curl_setopt($curlHandle, CURLOPT_PROXYPORT, $this->proxyPort);
        }
    }

    /**
     * Set user authentication
     * @param $curlHandle cURL handle
     */
    private function setAuth(&$curlHandle)
    {
        if ($this->username !== null && $this->password !== null) {
            curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curlHandle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        }
    }
}
