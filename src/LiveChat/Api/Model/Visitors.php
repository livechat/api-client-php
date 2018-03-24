<?php

/**
 * @see https://docs.livechatinc.com/rest-api/#visitors
 */
namespace LiveChat\Api\Model;

class Visitors extends BaseModel
{
    const METHOD_PATH = 'visitors';

    public function get(array $params = array())
    {
        $url = self::METHOD_PATH;
        $paramsString = $this->parseParams($params);
        $url .= $paramsString != "" ? "?" . $paramsString : "";

        return $this->executeGet($url);
    }
}
