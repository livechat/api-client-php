<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!visitors
 */
namespace LiveChat\Api\Model;

use LiveChat\Api\Model\BaseModel;

class Visitors extends BaseModel
{
    const METHOD_PATH = 'visitors';

    public function get()
    {
        return parent::get(self::METHOD_PATH);
    }
}
