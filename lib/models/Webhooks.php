<?php

class Webhooks extends Model
{
	public function get($group=0)
	{
		$group = (int)$group;

		$url = 'webhooks';
		if ($group !== 0)
		{
			$url .= '/'.$group;
		}

		$status = parent::get($url);
		print_r($status);
		return $status;
	}
}
