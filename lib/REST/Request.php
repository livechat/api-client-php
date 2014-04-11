<?php
namespace LiveChat\REST;

class Request
{
	protected $url;
	protected $verb;
	protected $requestBody;
	protected $requestLength;
	protected $username;
	protected $password;
	protected $acceptType;
	protected $responseBody;
	protected $responseInfo;
	
	public function __construct ($url = null, $verb = 'GET', $requestBody = null, $headers = array())
	{
		$this->url				= $url;
		$this->verb				= $verb;
		$this->requestBody		= $requestBody;
		$this->headers			= $headers;
		$this->requestLength	= 0;
		$this->username			= null;
		$this->password			= null;
		$this->acceptType		= 'application/json';
		$this->responseBody		= null;
		$this->responseInfo		= null;
		$this->error 			= null;
		
		if ($this->requestBody !== null)
		{
			$this->buildPostBody();
		}
	}

	public function execute()
	{
		$ch = curl_init();
		$this->setAuth($ch);
		try
		{
			switch (strtoupper($this->verb))
			{
				case 'GET':
					$this->executeGet($ch);
					break;
				case 'POST':
					$this->executePost($ch);
					break;
				case 'PUT':
					$this->executePut($ch);
					break;
				case 'DELETE':
					$this->executeDelete($ch);
					break;
				default:
					throw new InvalidArgumentException('Current verb (' . $this->verb . ') is an invalid REST verb.');
			}
		}
		catch (\InvalidArgumentException $e)
		{
			curl_close($ch);
			throw $e;
		}
		catch (\Exception $e)
		{
			curl_close($ch);
			throw $e;
		}
	}

	public function buildPostBody ($data = null)
	{
		$data = ($data !== null) ? $data : $this->requestBody;
		
		if (!is_array($data))
		{
			throw new \InvalidArgumentException('Invalid data input for postBody.  Array expected');
		}

		$data = http_build_query($data, '', '&');
		$this->requestBody = $data;
	}

	protected function executeGet ($ch)
	{
		$this->doExecute($ch);	
	}

	protected function executePost ($ch)
	{
		if (!is_string($this->requestBody))
		{
			$this->buildPostBody();
		}
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$this->doExecute($ch);	
	}

	protected function executePut ($ch)
	{
		if (!is_string($this->requestBody))
		{
			$this->buildPostBody();
		}

		/* Prepare the data for HTTP PUT. */
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: '.$this->requestLength));
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody);

		$this->doExecute($ch);
	}

	protected function executeDelete ($ch)
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		
		$this->doExecute($ch);
	}

	protected function doExecute (&$curlHandle)
	{
		$this->setCurlOpts($curlHandle);
		$this->responseBody = curl_exec($curlHandle);
		$this->responseInfo	= curl_getinfo($curlHandle);
		$this->error = curl_error($curlHandle);
		
		curl_close($curlHandle);
	}

	protected function setCurlOpts (&$curlHandle)
	{
		$headers = array('Accept' => $this->acceptType);
		foreach ($this->headers as $key => $value)
		{
			$headers[] = "$key: $value";
		}

		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT, 15);
		curl_setopt($curlHandle, CURLOPT_URL, $this->url);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
	}
	
	protected function setAuth (&$curlHandle)
	{
		if ($this->username !== null && $this->password !== null)
		{
			curl_setopt($curlHandle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curlHandle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		}
	}
	
	public function getAcceptType ()
	{
		return $this->acceptType;
	} 
	
	public function setAcceptType ($acceptType)
	{
		$this->acceptType = $acceptType;
	} 
	
	public function getPassword ()
	{
		return $this->password;
	} 
	
	public function setPassword ($password)
	{
		$this->password = $password;
	} 
	
	public function getResponseBody ()
	{
		return $this->responseBody;
	} 
	
	public function getResponseInfo ()
	{
		return $this->responseInfo;
	} 
	
	public function getUrl ()
	{
		return $this->url;
	} 
	
	public function setUrl ($url)
	{
		$this->url = $url;
	} 
	
	public function getUsername ()
	{
		return $this->username;
	} 
	
	public function setUsername ($username)
	{
		$this->username = $username;
	} 
	
	public function getVerb ()
	{
		return $this->verb;
	} 
	
	public function setVerb ($verb)
	{
		$this->verb = $verb;
	}

	public function getError ()
	{
		return $this->error;
	}
}
