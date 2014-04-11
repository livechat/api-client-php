<?php
namespace LiveChat\Models;


abstract class BaseModel
{
	protected $_apiUrl = null;
	protected $_login = null;
	protected $_sessionId = null;
	protected $_returnResponse = true;

	public function __construct()
	{
		$this->_apiUrl = \LiveChat\API::API_URL;
	}

	protected function getApiUrl() {
		return $this->_apiUrl;
	}

	public function setLogin( $login ) {
		$this->_login = $login;
	}

	public function getLogin() {
		return $this->_login;
	}

	public function setSessionId( $sessionId ) {
		$this->_sessionId = $sessionId;
	}

	public function getSessionId() {
		return $this->_sessionId;
	}

	public function setReturnResponse( $bReturn ) {
		$this->_returnResponse = (bool)$bReturn;
	}

	public function getReturnResponse() {
		return $this->_returnResponse;
	}

	public function getCallback() {
		if ( isset( $_REQUEST['callback'] ) ) {
			return $_REQUEST['callback'];
		}

		return null;
	}

	protected function _buildUrl( $url ) {
		$url = $this->getApiUrl() . $url;

		$callback = $this->getCallback();
		if ( $callback ) {
			$url = $url . '?callback='.$callback;
		}

		return $url;
	}

	protected function _doRequest($method, $url, $vars=null)
	{
		
		$url = $this->_buildUrl($url);
		switch ($method)
		{
			case 'POST':
			case 'PUT':
				$request = new \LiveChat\REST\Request($url, $method, $vars, array('X-API-Version' => \LiveChat\API::VERSION));
				break;

			case 'GET':
			case 'DELETE':
				$request = new \LiveChat\REST\Request($url, $method, null, array('X-API-Version' => \LiveChat\API::VERSION));
				break;
		}
		$request->setUsername( $this->getLogin() );
		$request->setPassword( $this->getSessionId() );
		$request->execute();

		if ( $this->getReturnResponse() === true ) {
			$response = $request->getResponseInfo();
			$http_code = $response['http_code'];

			// Check if response HTTP code starts with `2` (200, 201, 202 codes)
			if (preg_match('/^2/', $http_code) == false)
			{
				throw new \Exception(\LiveChat\REST\Utils::getStatusCodeMessage($http_code), $http_code);
			}

			return $request->getResponseBody();
		}
		else {
			$response = $request->getResponseInfo();
			\LiveChat\REST\Utils::sendResponse( $response['http_code'], $request->getResponseBody() );
		}
	}

	public function get( $url ) {
		$result = $this->_doRequest( 'GET', $url );
		$result = json_decode( $result );

		return $result;
	}

	public function post( $url, $vars ) {
		return $this->_doRequest( 'POST', $url, $vars );
	}

	public function put( $url, $vars ) {
		return $this->_doRequest( 'PUT', $url, $vars );
	}

	public function delete( $url ) {
		return $this->_doRequest( 'DELETE', $url );
	}

	protected function encodeParams( &$params ) {
		$params = array_map( "urlencode",  $params );
	}

	protected function parseParams( $params) {
		$this->encodeParams($params);

		$return = "";
		foreach ( $params as $keyParam => $valueParam ) {
			# skip empty param keys or values
			if ( trim( $valueParam ) != "" && $keyParam != "") {
				$return != "" ? $return.="&" : '';
				$return.=$keyParam . '=' . $valueParam;
			}
		}

		return $return;
	}
}
