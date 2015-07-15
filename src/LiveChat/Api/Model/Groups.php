<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!groups
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

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

        return parent::get($url);
    }

    public function update($id, array $vars)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return parent::put($url, $vars);
    }

    public function add(array $vars)
    {
        return parent::post(self::METHOD_PATH, $vars);
    }

    public function delete($id)
    {
        $this->ensureInteger($id);
        $url = self::METHOD_PATH . '/' . $id;

        return parent::delete($url);
    }
}
