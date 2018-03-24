<?php

/**
 * @see https://docs.livechatinc.com/rest-api/#agents
 */
namespace LiveChat\Api\Model;

class Agents extends BaseModel
{
    const METHOD_PATH = 'agents';

    public function get($login = null)
    {
        $url = self::METHOD_PATH;
        if ($login !== null) {
            $url .= '/' . $login;
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
