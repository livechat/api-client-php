<?php

class Agents extends Model
{
	public function get($id=null)
	{
		$url = 'agents';
		if (is_null($id) === false)
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
		$url = 'agents/'.$id;
		return parent::put($url, $vars);
	}

	public function delete($id)
	{
		$url = 'agents/'.$id;

		return parent::delete($url);
	}
}