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