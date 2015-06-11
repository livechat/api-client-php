<?php
namespace LiveChat\Models;


class Chats extends BaseModel
{
	public function get( $params=array() ) {
		$paramsString = $this->parseParams( $params );
		$url = 'chats';
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
