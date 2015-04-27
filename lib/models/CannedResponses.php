<?php

class CannedResponses extends Model
{

	public function get($group = 0) 
	{
		$group = (int)$group;
		$url = 'canned_responses?group='.$group;
		
		return parent::get( $url );
	}
	
	public function getSingleResponse($id)
	{
		$id = (int)$id;
		$url = 'canned_responses/'.$id;
		
		return parent::get( $url );
	}
        
	public function addNewResponse($text, $tags)
	{
            $url = 'canned_responses';
            return parent::post($url, array('text' => $text, 'tags' => $tags));
	}
	

}
