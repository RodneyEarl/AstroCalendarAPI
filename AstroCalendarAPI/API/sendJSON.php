<?php
/**
 * Class for creating and sending json.
 * @author Rodney
 */
class sendJSON{

	/**
	 * Takes an array and converts it to json.
	 * If there is an error, it returns nothing.
	 * @param array $array
	 */
	public function createJSON($array){

		$json = json_encode($array);
		if(json_last_error() == JSON_ERROR_NONE){
			return $json;
		}
	}
	/**
	 * Sets the MIME type to JSON then echos the json
	 * for the client.
	 * @param String $json
	 */
	public function returnJSONN($json){
		header('Content-type: text/json');
		echo $json;
	}
}