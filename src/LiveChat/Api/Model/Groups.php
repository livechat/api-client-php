<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!groups
 */
namespace LiveChat\Api\Model;

class Groups extends BaseModel
{
    const METHOD_PATH = 'groups';

    public function get($group = 0)
    {
        $this->ensureInteger($group);
        $url = self::METHOD_PATH;

        if ($group > 0) {
            $url .= '/' . $group;
        }

        return $this->executeGet($url);
    }

    public function update($id, array $vars)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return $this->executePut($url, $vars);
    }

    public function add(array $vars)
    {
        return $this->executePost(self::METHOD_PATH, $vars);
    }

    public function delete($id)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return $this->executeDelete($url);
    }
}
