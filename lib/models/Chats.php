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

	public function parseParams( $params, $without = "" ) {
		$return = "";
		foreach ( $params as $keyParam => $valueParam ) {
			if ( trim( $valueParam ) != "" && $keyParam != $without ) {
				$return != "" ? $return.="&" : '';
				$return.=$keyParam . '=' . $valueParam;
			}
		}
		return $return;
	}
}
