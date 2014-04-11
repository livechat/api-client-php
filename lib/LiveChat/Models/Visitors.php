<?php
namespace LiveChat\Models;

class Visitors extends BaseModel
{
	public function get()
	{
		return parent::get('visitors');
	}
}
