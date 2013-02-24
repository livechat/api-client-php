<?php

class Goals extends Model
{
	public function mark($vars)
	{
		$url = 'goals/mark_as_successful';
		return parent::post($url, $vars);
	}
}