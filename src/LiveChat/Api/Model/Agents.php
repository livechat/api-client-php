<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!agents
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

        return parent::get($url);
    }

    public function add(array $vars)
    {
        return parent::post(self::METHOD_PATH, $vars);
    }

    public function update($login, array $vars)
    {
        $url = self::METHOD_PATH . '/' . $login;

        return parent::put($url, $vars);
    }

    public function delete($login)
    {
        $url = self::METHOD_PATH . '/' . $login;

        return parent::delete($url);
    }
}
