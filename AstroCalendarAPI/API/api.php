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
		require_once '/APIDateConverter.php';
		$date = new getDate($_GET['startDate'], $_GET['endDate']);
		$dates = $date->createArray();
		$converter = new APIDateConverter();
		$offset = $converter->getOffset($dates);
		$lowerBound = mktime(0, 0, 0, $dates['startDate']['month'], $dates['startDate']['day'], $dates['startDate']['year']);
		$upperBound = mktime(0, 0, 0, $dates['endDate']['month'], $dates['endDate']['day'], $dates['endDate']['year']);
		for(; $lowerBound <= $upperBound; $lowerBound += 24*60*60){
			
		}
		break;
}