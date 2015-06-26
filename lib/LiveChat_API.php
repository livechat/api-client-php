<?php

define('ROOT', dirname(__FILE__).'/');
define('API_URL', 'https://api.livechatinc.com/');
define('VERSION', '2.0');

require_once (ROOT . 'models/abstract.Model.php');
require_once (ROOT . 'rest/RestRequest.php');
require_once (ROOT . 'rest/RestUtils.php');

class LiveChat_API
{
	/**
	 * User's login (used for API authentication)
	 */
	protected $_login = null;

	/**
	 * Once authorized, API key is used for other API calls
	 */
	protected $_apiKey = null;

	/**
	 * Supported models array
	 */
	protected $_models = array(
		'agents',
		'chats',
		'goals',
		'groups',
		'reports',
		'status',
		'visitors',
		'tickets',
		'cannedResponses',
		'webhooks'
	);

	/**
	 * Indicates whether to return the API response
	 * or send response body and headers directly
	 *
	 * Default: true (API response will be returned)
	 */
	protected $_returnResponse = true;

	/**
	 * Sets user's login and API key for API requests
	 */
	public function __construct()
	{
		$aConfig = parse_ini_file(ROOT.'config.ini.php');

		if (!isset($aConfig['login']) || strlen($aConfig['login']) == 0
		 || !isset($aConfig['api_key']) || strlen($aConfig['api_key']) == 0)
		{
			throw new Exception('Please enter correct login and api_key in <strong>/lib/config.ini.php</strong>.');
		}

		/**
		 * Enable session handling
		 * for caching sessionId
		 */
		if (!isset($_SESSION))
		{
			session_start();
		}

		$this->_login = $aConfig['login'];
		$this->_apiKey = $aConfig['api_key'];

		/**
		 * Check if sessionId is cached
		 * Also, if the login has changed, force the authentication
		 */
		if (!isset($_SESSION['login']) || $_SESSION['login'] != $this->_login
		 || !isset($_SESSION['api_key']) || $_SESSION['api_key'] != $this->_apiKey)
		{
			$_SESSION['login'] = $this->_login;
			$_SESSION['api_key'] = $this->_apiKey;
		}
	}

	/**
	 * Returns model of a given name
	 *
	 * Example:
	 * $API->visitors
	 * will return the 'visitors' model
	 */
	public function __get($name)
	{
		if (in_array($name, $this->_models) == false)
		{
			throw new Exception('No such model: '.$name);
		}

		$class = ucwords($name);
		$path = ROOT . 'models/'.$class.'.php';
		if (file_exists($path) == false)
		{
			throw new Exception('Model source does not exist: '.$name);
		}

		require_once($path);
		$model = new $class;
		$model->setLogin($this->_login);
		$model->setSessionId($this->_apiKey);
		$model->setReturnResponse($this->getReturnResponse());

		return $model;
	}

	/**
	 * Sets returnResponse flag
	 */
	public function setReturnResponse($bReturn)
	{
		$this->_returnResponse = (bool)$bReturn;
	}

	/**
	 * Returns returnResponse flag
	 */
	public function getReturnResponse()
	{
		return $this->_returnResponse;
	}
}
