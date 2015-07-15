<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!tickets
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

class Tickets extends BaseModel
{
    const METHOD_PATH = 'tickets';

    public function get(array $params = array())
    {
        $url = self::METHOD_PATH;
        $paramsString = $this->parseParams($params);
        $url .= $paramsString != "" ? "?" . $paramsString : "";

        return parent::get($url);
    }

    public function getSingleTicket($ticketId)
    {
        $this->ensureInteger($ticketId);
        $url = self::METHOD_PATH . '/' . $ticketId;
        return parent::get($url);
    }

    public function add(array $vars)
    {
        return parent::post(self::METHOD_PATH, $vars);
    }

    public function updateTags($id, array $vars)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id . '/tags';

        return parent::put($url, $vars);
    }
}
