<?php

/**
 * @see https://docs.livechatinc.com/rest-api/#tags
 */
namespace LiveChat\Api\Model;

class Tags extends BaseModel
{
    const METHOD_PATH = 'tags';

    public function get($group = 0)
    {
        $this->ensureInteger($group);
        $url = self::METHOD_PATH . '?group=' . $group;

        return $this->executeGet($url);
    }

    public function add(array $vars)
    {
        return $this->executePost(self::METHOD_PATH, $vars);
    }

    public function delete($tag)
    {
        $url = self::METHOD_PATH . '/' . $tag;

        return $this->executeDelete($url);
    }
}
