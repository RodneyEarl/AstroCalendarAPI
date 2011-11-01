<?php
/**
 * Main handler page for the API.  From here go to
 * whatever page or action is required.
 */

/**
 * Determines which page to go to.
 * @var String
 */

switch($action){

	case 'all':
		require_once '/getDate.php';
		$date = new getDate($_GET['startDate'], $_GET['endDate']);
		$dates = $date->createArray();
		break;
}
// For Testing Purposes
require_once '/sendJSON.php';
$info = array();
$info['count'] = 2;
$info[0] = array();
$info[0]['day'] = 'Monday';
$info[0]['dayNumerical'] = '14';
$info[0]['month'] = '11';
$info[0]['year'] = '2011';
$info[0]['payload'] = array(
	'sunrise'  => '07-44-00',
	'sunset'   => '17-34-23',
	'moonrise' => '13-08-00',
	'moonset'  => '22-08-00'
);
$info[1] = array();
$info[1]['day'] = 'Tuesday';
$info[1]['dayNumerical'] = '15';
$info[1]['month'] = '11';
$info[1]['year'] = '2011';
$info[1]['payload'] = array(
	'sunrise'  => '07-52-00',
	'sunset'   => '17-28-00',
	'moonrise' => '13-02-22',
	'moonset'  => '22-15-38'
);
$json = new sendJSON();
$json->returnJSONN($json->createJSON($info));