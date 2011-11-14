<?php

/**
 * Class to convert date and times between GMT
 * and Local.
 * @author Rodney
 */
class APIDateConverter{
	
	/**
	 * Need to find offset for user.
	 * @param $localDateArray Array containing the local time information.
	 */
	function getOffset($localDateArray){
		//Initialize the localtime.
		$localDate = new DateTime($localDateArray['startDate']['year'].'-'.
			$localDateArray['startDate']['month'].'-'.$localDateArray['startDate']['day']);
		//Calculate the GMT
		$gmt = new DateTime('', new DateTimeZone('GMT'));
		//Find the offset, needed for future date calculations
		$offset = $localDate->getOffset();
		//return the offset
		return $offset;
	}
	
	/**
	 * Ephemeris sends GMT time, need to convert to local.
	 * @param $offset The offset to be added to the GMT time.
	 * @param $gmt The gmt time given.
	 */
	function convertToLocal($offset, $gmt){
		
		$temp = new DateTime($gmt['year'].'-'.$gmt['month'].'-'.$gmt['day'].' '.
			$gmt['hour'].':'.$gmt['min'].':'.$gmt['sec']);
			
		$localTimeTemp = $temp->add(new DateInterval($offset.' secconds'));
		
		$localTime = array();
		$localTime['year'] = $localTimeTemp['year'];
		$localTime['month'] = $localTimeTemp['month'];
		$localTime['day'] = $localTimeTemp['day'];
		$localTime['hour'] = $localTimeTemp['hour'];
		$localTime['minute'] = $localTimeTemp['minute'];
		$localTime['second'] = $localTimeTemp['second'];
		
		return $localTime;
	}
}