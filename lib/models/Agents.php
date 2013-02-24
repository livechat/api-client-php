<?php

class Agents extends Model
{
	public function get($id=null)
	{
		$url = 'agents';
		$id = (int)$id;
		if ($id > 0)
		{
			$url .= '/'.$id;
		}

		return parent::get($url);
	}

	public function add($vars)
	{
		$url = 'agents';

		return parent::post($url, $vars);
	}

	public function update($id, $vars)
	{
		$id = (int)$id;
		$url = 'agents/'.$id;
		return parent::put($url, $vars);
	}

	public function delete($id)
	{
		$id = (int)$id;
		$url = 'agents/'.$id;

		return parent::delete($url);
	}
}