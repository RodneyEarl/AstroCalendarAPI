<?php

class sendJSON{

	public function createJSON($array){

		$json = json_encode($array);
		if(json_last_error() == JSON_ERROR_NONE){
			return $json;
		}
	}
	
	public function returnJSONN($json){
		echo $json;
	}
}