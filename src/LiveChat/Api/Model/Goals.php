<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!goals
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

class Goals extends BaseModel
{
    const METHOD_PATH = 'goals';

    public function markAsSuccessful($goalId)
    {
        $this->ensureInteger($goalId);
        $url = self::METHOD_PATH . '/' . $goalId . '/mark_as_successful';

        return parent::post($url);
    }

}
