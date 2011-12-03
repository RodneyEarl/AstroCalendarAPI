<?php
/*
Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:
The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

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
	public function returnJSON($json){
		header('Content-type: text/json');
		echo $json;
	}
}
