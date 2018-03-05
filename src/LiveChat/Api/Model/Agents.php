<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!agents
 */
namespace LiveChat\Api\Model;

class Agents extends BaseModel
{
    const METHOD_PATH = 'agents';
    
    /**
     * Get Agent(s)
     * @param array|string $loginOrParams Login if String, Filter Parameters if Array
     * @return type
     */
    public function get($loginOrParams = null)
    {
        $url = self::METHOD_PATH;
        if ($loginOrParams !== null) {
            if(is_array($loginOrParams)){
                $paramsString = $this->parseParams($loginOrParams);
                $url .= $paramsString != "" ? "?" . $paramsString : "";
            }else{
                $url .= '/' . $loginOrParams;
            }
        }

        return $this->executeGet($url);
    }

    public function add(array $vars)
    {
        return $this->executePost(self::METHOD_PATH, $vars);
    }

    public function update($login, array $vars)
    {
        $url = self::METHOD_PATH . '/' . $login;

        return $this->executePut($url, $vars);
    }

    public function delete($login)
    {
        $url = self::METHOD_PATH . '/' . $login;

        return $this->executeDelete($url);
    }
}
