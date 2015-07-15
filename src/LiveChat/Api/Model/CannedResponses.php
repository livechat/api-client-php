<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!canned-responses
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

class CannedResponses extends BaseModel
{
    const METHOD_PATH = 'canned_responses';

    public function get($group = 0)
    {
        $this->ensureInteger($group);
        $url = self::METHOD_PATH . '?group=' . $group;

        return parent::get($url);
    }

    public function getSingleResponse($id)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return parent::get($url);
    }

    public function addNewResponse($text, $tags)
    {
        return parent::post(self::METHOD_PATH, array('text' => $text, 'tags' => $tags));
    }

    public function updateResponse($id, $text, $tags)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return parent::put($url, array('text' => $text, 'tags' => $tags));
    }

    public function deleteResponse($id)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return parent::delete($url);
    }
}
