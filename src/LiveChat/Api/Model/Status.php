<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!status
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

class Status extends BaseModel
{
    const METHOD_PATH = 'status';

    public function get($group = 0)
    {
        $this->ensureInteger($group);

        $url = self::METHOD_PATH;
        if ($group > 0) {
            $url .= '/' . $group;
        }

        $status = parent::get($url);

        return $status->status;
    }
}
