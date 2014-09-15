<?php

class Tickets extends Model
{
	public function get( $params=array() ) {
		$paramsString = $this->parseParams( $params );
		$url = 'tickets';
		$this->encodeParams( $params );
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
