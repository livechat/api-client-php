<?php

/**
 * @see http://developers.livechatinc.com/rest-api/#!reports
 */
namespace LiveChat\Api\Model;

class Reports extends BaseModel
{
    const METHOD_PATH = 'reports';

    public function get($type, array $params = array())
    {
        $url = self::METHOD_PATH . '/' . $type;
        $paramsString = $this->parseParams($params);
        $url .= $paramsString != '' ? '?' . $paramsString : '';

        return parent::get($url);
    }

}
