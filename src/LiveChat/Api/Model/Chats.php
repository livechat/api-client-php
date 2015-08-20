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

        return parent::get($url);
    }

    public function getSingleChat($chatId)
    {
        $this->ensureInteger($chatId);
        $url = self::METHOD_PATH . '/' . $chatId;

        return parent::get($url);
    }

    public function updateTags($id, array $vars)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id . '/tags';

        return parent::put($url, $vars);
    }
}
