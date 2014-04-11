<?php
namespace LiveChat\Models;

class Reports extends BaseModel
{

  public function get($type, $params=array())
  {
    $url = 'reports/'.$type;
				$this->encodeParams($params);
    $params = $this->parseParams($params);
				$paramsString = http_build_query($params);
    $url .= $paramsString != "" ? "?" . $paramsString : "";
    return parent::get($url);
  }

  protected function parseParams($params)
  {
    foreach ($params as $keyParam => $valueParam)
      if (trim($valueParam) == "")
					unset ($params[$keyParam]);
    return $params;
  }
}
