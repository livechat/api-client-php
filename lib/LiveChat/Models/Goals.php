<?php
namespace LiveChat\Models;

class Goals extends BaseModel
{
	public function mark($vars)
	{
		$url = 'goals/mark_as_successful';
		return parent::post($url, $vars);
	}
}
