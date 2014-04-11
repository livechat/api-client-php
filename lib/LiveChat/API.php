<?php
namespace LiveChat;

class API
{
	/**
	 * API version
	 */
	const VERSION = 2;

	/**
	 * Base API URL
	 */
	const API_URL = 'https://api.livechatinc.com/';

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
		'cannedResponses'
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
	public function __construct($login, $apikey)
	{
		if (!isset($login) || strlen($login) === 0
		 || !isset($apikey) || strlen($apikey) === 0)
		{
			throw new \Exception('Please provide a login name and API key.');
		}

		$this->_login = $login;
		$this->_apiKey = $apikey;
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
		if (in_array(strtolower($name), $this->_models) == false)
		{
			throw new \Exception('No such model: '.$name);
		}

		$name = ucwords($name);
		$class = "\\LiveChat\Models\\$name";
		if (!class_exists($class)) {
			// When no autoloader is present, load the models manually
			require_once  __DIR__ . DIRECTORY_SEPARATOR . 'REST' . DIRECTORY_SEPARATOR . 'Request.php';
			require_once  __DIR__ . DIRECTORY_SEPARATOR . 'REST' . DIRECTORY_SEPARATOR . 'Utils.php';
			require_once  __DIR__ . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'BaseModel.php';
			require_once  __DIR__ . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . $name . '.php';
		}

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
