<?php

/**
 * @see https://docs.livechatinc.com/rest-api/#goals
 */
namespace LiveChat\Api\Model;

class Goals extends BaseModel
{
    const METHOD_PATH = 'goals';

    public function markAsSuccessful($goalId)
    {
        $this->ensureInteger($goalId);
        $url = self::METHOD_PATH . '/' . $goalId . '/mark_as_successful';

        return $this->executePost($url);
    }

}
