<?php

class Reports extends Model
{

	public function get( $type, $params=array() ) {
		$url = 'reports/'.$type;
		$paramsString = $this->parseParams( $params );
		$url .= $paramsString != "" ? "?" . $paramsString : "";

		return parent::get( $url );
	}
}
