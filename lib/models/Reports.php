<?php

class Reports extends Model
{

	public function get( $type, $params=array() ) {
		$url = 'reports/'.$type;
		$this->encodeParams( $params );
		$params = $this->parseParams( $params );
		$paramsString = http_build_query( $params );
		$url .= $paramsString != "" ? "?" . $paramsString : "";
		return parent::get( $url );
	}

	private function parseParams( $params ) {
		foreach ( $params as $keyParam => $valueParam )
			if ( trim( $valueParam ) == "" )
				unset ( $params[$keyParam] );
			return $params;
	}

}
