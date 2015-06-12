<?php

namespace LiveChat\Models;

class Tickets extends BaseModel
{
	public function get( $params=array() ) {

		$url = 'tickets';
		$paramsString = $this->parseParams( $params );
		$url .= $paramsString != "" ? "?" . $paramsString : "";

		return parent::get( $url );
	}

	public function getSingleTicket( $ticketId ) {
		$url = 'tickets/' . $ticketId;
		return parent::get( $url );
	}

	public function add($vars)
	{
		$url = 'tickets';
		return parent::post($url, $vars);
	}

	public function updateTags($id, $vars){
		$url = 'tickets/'.$id.'/tags';

		return parent::put($url, $vars);
	}
}
