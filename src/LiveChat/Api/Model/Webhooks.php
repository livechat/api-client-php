<?php

/**
 * @see https://docs.livechatinc.com/rest-api/#webhooks
 */
namespace LiveChat\Api\Model;

class Webhooks extends BaseModel
{
    const METHOD_PATH = 'webhooks';

    public function get()
    {
        return $this->executeGet(self::METHOD_PATH);
    }

    public function add(array $vars)
    {
        return $this->executePost(self::METHOD_PATH, $vars);
    }

    public function delete($webhookID)
    {
        $url = self::METHOD_PATH . '/' . $webhookID;

        return $this->executeDelete($url);
    }
}
