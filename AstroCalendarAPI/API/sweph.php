<?php

/**
 * Class to communicate directly with the Swiss Ephemeris Library
 * All times received by this file are assumed to be in local time for the user
 * All times calculated by this file will be in Greenwich Mean Time (GMT)
 * The calculations performed also assume a time of 12:00am on the day of the parameter because the ephemeris is only predictive.
 * @author Michael
 */

define("STD_TEMP", 15);
define("STD_PRESS", null);
define("EPHE_TYPE", SEFLG_SWIEPH);
define("STAR_NAME", null);

$sweph = new sweph();
$sweph->getSunrise(2011, 11, 10, -120, 49, 350);
$sweph->getSunset(2011, 11, 10, -120, 49, 350);
$sweph->getMoonrise(2011, 11, 10, -120, 49, 350);
$sweph->getMoonset(2011, 11, 10, -120, 49, 350);

class sweph {
	
	/**
	 * Returns the time of sun rise on $day in GMT
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $lng longitude
	 * @param $lat latitude
	 * @param $alt altitude
	 */
	public function getSunrise($year, $month, $day, $lng, $lat, $alt) {
		// year, month, day, hour, calendar type
		$jul_day_gmt = swe_julday($year, $month, $day, 0, SE_GREG_CAL);
		
		// Parameters for swe_rise_trans
		$planet = SE_SUN;
		$eventname = SE_CALC_RISE;
		
		// swe_rise_trans is a Swiss Ephemeris function
		$ret_info = swe_rise_trans($jul_day_gmt, $planet, STAR_NAME, EPHE_TYPE, $eventname, $lng, $lat, $alt, STD_PRESS, STD_TEMP);
		
		// extract time from $ret_info
		$jul_day_event_time = $ret_info['tret'][0];
		
		// turn Julian day of event into GMT
		$event_time_gmt = swe_jdet_to_utc($jul_day_event_time, 1);
		
		// Array{year, month, day, hour, minute, second}
		return $event_time_gmt;
	}
	
	/**
	 * Returns the time of sun set on $day in GMT
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $lng longitude
	 * @param $lat latitude
	 * @param $alt altitude
	 */
	public function getSunset($year, $month, $day, $lng, $lat, $alt) {
		// year, month, day, hour, calendar type
		$jul_day_gmt = swe_julday($year, $month, $day, 0, SE_GREG_CAL);
		
		// Parameters for swe_rise_trans
		$planet = SE_SUN;
		$eventname = SE_CALC_SET;
		
		// swe_rise_trans is a Swiss Ephemeris function
		$ret_info = swe_rise_trans($jul_day_gmt, $planet, STAR_NAME, EPHE_TYPE, $eventname, $lng, $lat, $alt, STD_PRESS, STD_TEMP);
		
		// extract time from $ret_info
		$jul_day_event_time = $ret_info['tret'][0];
		
		// turn Julian day of event into GMT
		$event_time_gmt = swe_jdet_to_utc($jul_day_event_time, 1);
		
		// Array{year, month, day, hour, minute, second}
		return $event_time_gmt;
	}
	
	/**
	 * Returns the time of moon rise on $day in GMT
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $lng longitude
	 * @param $lat latitude
	 * @param $alt altitude
	 */
	public function getMoonrise($year, $month, $day, $lng, $lat, $alt) {
		// year, month, day, hour, calendar type
		$jul_day_gmt = swe_julday($year, $month, $day, 0, SE_GREG_CAL);
		
		// Parameters for swe_rise_trans
		$planet = SE_MOON;
		$eventname = SE_CALC_RISE;
		
		// swe_rise_trans is a Swiss Ephemeris function
		$ret_info = swe_rise_trans($jul_day_gmt, $planet, STAR_NAME, EPHE_TYPE, $eventname, $lng, $lat, $alt, STD_PRESS, STD_TEMP);
		
		// extract time from $ret_info
		$jul_day_event_time = $ret_info['tret'][0];
		
		// turn Julian day of event into GMT
		$event_time_gmt = swe_jdet_to_utc($jul_day_event_time, 1);
		
		// Array{year, month, day, hour, minute, second}
		return $event_time_gmt;
	}
	
	/**
	 * Returns the time of moon set on $day in GMT
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $lng longitude
	 * @param $lat latitude
	 * @param $alt altitude
	 */
	public function getMoonset($year, $month, $day, $lng, $lat, $alt) {
		// year, month, day, hour, calendar type
		$jul_day_gmt = swe_julday($year, $month, $day, 0, SE_GREG_CAL);
		
		// Parameters for swe_rise_trans
		$planet = SE_MOON;
		$eventname = SE_CALC_SET;
		
		// swe_rise_trans is a Swiss Ephemeris function
		$ret_info = swe_rise_trans($jul_day_gmt, $planet, STAR_NAME, EPHE_TYPE, $eventname, $lng, $lat, $alt, STD_PRESS, STD_TEMP);
		
		// extract time from $ret_info
		$jul_day_event_time = $ret_info['tret'][0];
		
		// turn Julian day of event into GMT
		$event_time_gmt = swe_jdet_to_utc($jul_day_event_time, 1);
		
		// Array{year, month, day, hour, minute, second}
		return $event_time_gmt;
	}
	
}

?>