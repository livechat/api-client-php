<?php

class Chats extends Model{

	public function get( $params=array() ) {
		$paramsString = $this->parseParams( $params );
		$url = 'chats';
		$this->encodeParams( $params );
		$paramsString = $this->parseParams( $params );
		$url .= $paramsString != "" ? "?" . $paramsString : "";
		return parent::get( $url );
	}

	public function getSingleChat( $chatId ) {
		$url = 'chats/' . $chatId;
		return parent::get( $url );
	}

	public function updateTags($id, $vars){
		$url = 'chats/'.$id.'/tags';
		return parent::put($url, $vars);
	}
}
