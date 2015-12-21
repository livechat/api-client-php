<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!tickets
 */
namespace LiveChat\Api\Model;

class Tickets extends BaseModel
{
    const METHOD_PATH = 'tickets';

    public function get(array $params = array())
    {
        $url = self::METHOD_PATH;
        $paramsString = $this->parseParams($params);
        $url .= $paramsString != "" ? "?" . $paramsString : "";

        return $this->executeGet($url);
    }

    public function getSingleTicket($ticketId)
    {
        $url = self::METHOD_PATH . '/' . $ticketId;
        return $this->executeGet($url);
    }

    public function add(array $vars)
    {
        return $this->executePost(self::METHOD_PATH, $vars);
    }

    public function updateTags($id, array $vars)
    {
        $url = self::METHOD_PATH . '/' . $id . '/tags';

        return $this->executePut($url, $vars);
    }
}
