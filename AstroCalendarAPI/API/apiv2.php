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
 * Main handler page for the API.  From here go to
 * whatever page or action is required.
 */

/**
 * Determines what has been requested.
 * @var String
 */
$action = $_GET['requestType'];
switch($action){

	case 'all':
		require_once 'getDate.php';
		require_once 'sweph.php';
		$date = new getDate($_GET['startDate'], $_GET['endDate']);
		$dates = $date->createArray();
		$lowerBound = mktime(0, 0, 0, $dates['startDate']['month'], $dates['startDate']['day'], $dates['startDate']['year']);
		$upperBound = mktime(0, 0, 0, $dates['endDate']['month'], $dates['endDate']['day'], $dates['endDate']['year']);
		$data = array();
		$data['count'] = 0;
		$i = 0;
		$prevTithi = " ";
		if(!isset($_GET['altitude'])){
			$_GET['altitude'] = 0;
		}
		for(; $lowerBound <= $upperBound; $lowerBound += 24*60*60){
			$current = date_parse(date('d-m-Y H:i', $lowerBound));
			$sweph = new sweph();

			$sunrise = $sweph->getSunrise($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$sunset = $sweph->getSunset($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$moonrise = $sweph->getMoonrise($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$moonset = $sweph->getMoonset($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$data[$i] = array();
			$data[$i]['dayNumerical'] = $current['day'];
			$data[$i]['month'] = $current['month'];
			$data[$i]['year'] = $current['year'];
			$data[$i]['payload'] = array();
			$sunriseHour;
			if($sunrise['hour'] + $_GET['GMTOffset'] < 0 ){
				$sunriseHour = $sunrise['hour'] + $_GET['GMTOffset'] + 24;
			}
			else if($sunrise['hour'] + $_GET['GMTOffset'] > 23){
				$sunriseHour = $sunrise['hour'] + $_GET['GMTOffset'] - 24;
			}
			else{
				$sunriseHour = $sunrise['hour'] + $_GET['GMTOffset'];
			}

			$sunsetHour;
			if($sunset['hour'] + $_GET['GMTOffset'] < 0 ){
				$sunsetHour = $sunset['hour'] + $_GET['GMTOffset'] + 24;
			}
			else if($sunset['hour'] + $_GET['GMTOffset'] > 23){
				$sunsetHour = $sunset['hour'] + $_GET['GMTOffset'] - 24;
			}
			else{
				$sunsetHour = $sunset['hour'] + $_GET['GMTOffset'];
			}

			$moonriseHour;
			if($moonrise['hour'] + $_GET['GMTOffset'] < 0 ){
				$moonriseHour = $moonrise['hour'] + $_GET['GMTOffset'] + 24;
			}
			else if($moonrise['hour'] + $_GET['GMTOffset'] > 23){
				$moonriseHour = $moonrise['hour'] + $_GET['GMTOffset'] - 24;
			}
			else{
				$moonriseHour = $moonrise['hour'] + $_GET['GMTOffset'];
			}

			$moonsetHour;
			if($moonset['hour'] + $_GET['GMTOffset'] < 0 ){
				$moonsetHour = $moonset['hour'] + $_GET['GMTOffset'] + 24;
			}
			else if($moonset['hour'] + $_GET['GMTOffset'] > 23){
				$moonsetHour = $moonset['hour'] + $_GET['GMTOffset'] - 24;
			}
			else{
				$moonsetHour = $moonset['hour'] + $_GET['GMTOffset'];
			}
                        $data[$i]['payload']['sunrise'] = $sunriseHour.'-'.$sunrise['min'].'-'.(int)$sunrise['second'];
                        $data[$i]['payload']['sunset'] = $sunsetHour.'-'.$sunset['min'].'-'.(int)$sunset['second'];
                        $data[$i]['payload']['moonrise'] = $moonriseHour.'-'.$moonrise['min'].'-'.(int)$moonrise['second'];
                        $data[$i]['payload']['moonset'] = $moonsetHour.'-'.$moonset['min'].'-'.(int)$moonset['second'];

			$hour = 0;
			for(; $hour < 24; $hour++){
				$minute = 0;
				for(; $minute < 60; $minute++){
					
					$lunarData = $sweph->getLunarData($current['year'], $current['month'], $current['day'], $hour+($minute/60)-$_GET['GMTOffset']);

					if($prevTithi != $lunarData['tithi']){
					
						if($i ==0 && $hour == 0 && $minute ==0){
							$prevTithi = $lunarData['tithi'];
						}
						else{

							if(isset($data[$i]['payload']['tithi'])){
								$data[$i]['payload']['tithi'] .= '-'.$lunarData['tithi'];
								$data[$i]['payload']['tithiStart'] .= '-'.$hour.':'.$minute;
								$data[$i]['payload']['fortnight'] .= '-'.$lunarData['paksha'];
								$data[$i]['payload']['lunarMonth'] .= '-'.$lunarData['lunarMonth'];
								$prevTithi = $lunarData['tithi'];
							}
							else{
								$data[$i]['payload']['tithi'] = $lunarData['tithi'];
								$data[$i]['payload']['tithiStart'] = $hour.':'.$minute;
								$data[$i]['payload']['fortnight'] = $lunarData['paksha'];
								$data[$i]['payload']['lunarMonth'] = $lunarData['lunarMonth'];
								$prevTithi = $lunarData['tithi'];
							}
							$hour += 18;
						}
					}
				}
			}
			if(!isset($data[$i]['payload']['tithi'])){
				$data[$i]['payload']['tithi'] = "none";
				$data[$i]['payload']['tithiStart'] = "none";
				$data[$i]['payload']['fortnight'] = "none";
				$data[$i]['payload']['lunarMonth'] = "none";
			}	
			$i++;
		}
		$data['count'] = $i;
		break;
}
require_once 'sendJSON.php';
$json = new sendJSON();
$message = $json->createJSON($data);
//print_r($message);
$json->returnJSON($message);
