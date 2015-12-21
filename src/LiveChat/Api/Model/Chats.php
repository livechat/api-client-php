<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!chats
 */
namespace LiveChat\Api\Model;

class Chats extends BaseModel
{
    const METHOD_PATH = 'chats';

    public function get($params = array())
    {
        $url = self::METHOD_PATH;

        if (($paramsString = $this->parseParams($params)) !== '') {
            $url .= '?' . $paramsString;
        }

        return $this->executeGet($url);
    }

    public function getSingleChat($chatId)
    {
        $url = self::METHOD_PATH . '/' . $chatId;

        return $this->executeGet($url);
    }

    public function updateTags($id, array $vars)
    {
        $url = self::METHOD_PATH . '/' . $id . '/tags';

        return $this->executePut($url, $vars);
    }
}
