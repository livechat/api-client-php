<?php

class Status extends Model
{
	public function get($group=0)
	{
		$group = (int)$group;

		$url = 'status';
		if ($group !== 0)
		{
			$url .= '/'.$group;
		}

		$status = parent::get($url);
		return $status->status;
	}
}