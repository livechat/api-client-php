<?php
namespace LiveChat\Models;

class Groups extends BaseModel
{
	public function get($group=0)
	{
		$group = (int)$group;

		$url = 'groups';
		if ($group !== 0)
		{
			$url .= '/'.$group;
		}

		return parent::get($url);
		
	}
	
	public function update($id, $vars)
	{
		$id = (int)$id;
		$url = 'groups/'.$id;
		
		return parent::put($url, $vars);
	}
	
	public function add($vars)
	{
		$url = 'groups';

		return parent::post($url, $vars);
	}
	
	public function delete($id)
	{
		$id = (int)$id;
		$url = 'groups/'.$id;

		return parent::delete($url);
	}
}
