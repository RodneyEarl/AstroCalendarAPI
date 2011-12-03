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
		require_once 'APIDateConverter.php';
		require_once 'sweph.php';
		$date = new getDate($_GET['startDate'], $_GET['endDate']);
		$dates = $date->createArray();
		$converter = new APIDateConverter();
		$lowerBound = mktime(0, 0, 0, $dates['startDate']['month'], $dates['startDate']['day'], $dates['startDate']['year']);
		$upperBound = mktime(0, 0, 0, $dates['endDate']['month'], $dates['endDate']['day'], $dates['endDate']['year']);
		$data = array();
		$data['count'] = 0;
		$i = 0;
		if(!isset($_GET['altitude'])){
			$_GET['altitude'] = 0;
		}
		for(; $lowerBound <= $upperBound; $lowerBound += 24*60*60){
			$current = date_parse(date('d-m-Y', $lowerBound));
			$sweph = new sweph();
			$sunrise = $sweph->getSunrise($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$sunset = $sweph->getSunset($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$moonrise = $sweph->getMoonrise($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$moonset = $sweph->getMoonset($current['year'], $current['month'], $current['day'], $_GET['longitude'], $_GET['latitude'], $_GET['altitude']);
			$lunarData = $sweph->getLunarData($current['year'], $current['month'], $current['day'], $moonrise['hour']);
/*echo '<b>Data for '.date('d-M-Y', mktime(0,0,0,$current['month'],$current['day'],$current['year'])).'</b><br \>';
echo 'Sunrise:';
print_r($sunrise);
echo '<br \>';
echo 'Sunset:';
print_r($sunset);
echo '<br \>';
echo 'Moonrise:';
print_r($moonrise);
echo '<br \>';
echo 'Moonset:';
print_r($moonset);
echo '<br \>';*/
			$data[$i] = array();
			$data[$i]['dayNumerical'] = $current['day'];
			$data[$i]['month'] = $current['month'];
			$data[$i]['year'] = $current['year'];
			$data[$i]['payload'] = array();
			$data[$i]['payload']['sunrise'] = $sunrise['hour'].'-'.$sunrise['min'].'-'.(int)$sunrise['second'];
			$data[$i]['payload']['sunset'] = $sunset['hour'].'-'.$sunset['min'].'-'.(int)$sunset['second'];
			$data[$i]['payload']['moonrise'] = $moonrise['hour'].'-'.$moonrise['min'].'-'.(int)$moonrise['second'];
			$data[$i]['payload']['moonset'] = $moonset['hour'].'-'.$moonset['min'].'-'.(int)$moonset['second'];
			$data[$i]['payload']['tithi'] = $lunarData['tithi'];
			$data[$i]['payload']['fortnight'] = $lunarData['paksha'];
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
