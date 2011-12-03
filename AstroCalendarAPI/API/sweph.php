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

	public function getSunLongitude($year, $month, $day, $hour) {
		$jul_day_gmt = swe_julday($year, $month, $day, $hour, SE_GREG_CAL);

		$planet = SE_SUN;
		
		$ret_info = swe_calc_ut($jul_day_gmt, $planet, EPHE_TYPE);
		return $ret_info[0];
	}

	public function getSunLatitude($year, $month, $day, $hour) {
		$jul_day_gmt = swe_julday($year, $month, $day, $hour, SE_GREG_CAL);

		$planet = SE_SUN;
		
		$ret_info = swe_calc_ut($jul_day_gmt, $planet, EPHE_TYPE);
		return $ret_info[1];
	}

	public function getMoonLongitude($year, $month, $day, $hour) {
		$jul_day_gmt = swe_julday($year, $month, $day, $hour, SE_GREG_CAL);

		$planet = SE_MOON;
		
		$ret_info = swe_calc_ut($jul_day_gmt, $planet, EPHE_TYPE);
		return $ret_info[0];
	}
	
	public function getDiff($sunLon, $moonLon){
		$diff = $moonLon - $sunLon;
		if($diff < 0)
			$diff = $diff + 360;
		return $diff;
	}

	/**
	 * Returns an array containing the
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $hour hour
	 * 
	 * Note: for future development, need to include the input 
	 * $geolat, the latitude of the user on Earth
	 */
	public function getLunarData($year, $month, $day, $hour) {

 		// [0] Determine Tithi (lunar day)

		// calculate the longitude of the sun and moon then get the difference between the two
		$sunLong = $this->getSunLongitude($year, $month, $day, $hour);
		$moonLong = $this->getMoonLongitude($year, $month, $day, $hour);
		$diff = $this->getDiff($sunLong, $moonLong);

		// Classical calculations involve adding a one here, 
		// but it is omitted because of array position counting
		$ti = $diff / 12;

		$tithiNames = array(
			"1. Pratipat",
			"2. Dvitiya",
			"3. Tritiya",
			"4. Chaturthi",
			"5. Panchami",
			"6. Shashti",
			"7. Saptami",
			"8. Ashtami",
			"9. Navami",
			"10. Dashami",
			"11. Ekadashi",
			"12. Dvadashi",
			"13. Trayodashi",
			"14. Chaturdashi",
			"15. Purnima",
			"1. Pratipat",
			"2. Dvitiya",
			"3. Tritiya",
			"4. Chaturthi",
			"5. Panchami",
			"6. Shashti",
			"7. Saptami",
			"8. Ashtami",
			"9. Navami",
			"10. Dashami",
			"11. Ekadashi",
			"12. Dvadashi",
			"13. Trayodashi",
			"14. Chaturdashi",
			"15. Amavasya"
		);


		// [1] Determine Paksha (phase of moon)

		if ($ti < 14) {
			// waxing moon phase
			$paksha = "Shukla";
		}
		else if (15<= $ti && $ti < 29) {
			// waning moon phase
			$paksha = "Krishna";
		}
		else if ((int)$ti == 14) {
			// full moon
			$paksha = "Full Moon";
		}
		else if((int)$ti == 29){
			// new moon
			$paksha = "New Moon";
		}


		// [2] Determine Lunar Month

		$monthNames = array(
			"Caitra",
			"Vaisakha",
			"Jyestha",
			"Asadha",
			"Sravana",
			"Bhadrapada",
			"Asvina",
			"Kartika",
			"Margasirsa",
			"Pausa",
			"Magha",
			"Phalgura"
		);

		// Default parameter values
		$geolat = 0;
		$pos = 0;
		$yr=0;
		$mn=0;
		$dy=0;
		$hr=0;

		// To determine which lunar month we are in, we want to know the y/m/d of the full moon for this month
		if ($ti < 12) {
			// get the difference in days between current day and full moon
			$tDiff = (int)(14 - $ti);
			$temp = mktime($hour, 0, 0, $month, ($day + $tDiff), $year);
			$time = date_parse(date('d-m-Y H:i', $temp));

			// modify the input date with new values
			$yr = $time['year'];
			$mn = $time['month'];
			$dy = $time['day'];
			$hr = $time['hour'];
		}
		else if ($ti > 16) {
			// get the difference in days between current day and full moon
			$tDiff = (int)($ti - 14);
			$temp = mktime($hour, 0, 0, $month, ($day - $tDiff), $year);
			$time = date_parse(date('d-m-Y H:i', $temp));

			// modify the input date with new values
			$yr = $time['year'];
			$mn = $time['month'];
			$dy = $time['day'];
			$hr = $time['hour'];
		}
		else {
			// proceed with given date
			$yr = $year;
			$mn = $month;
			$dy = $day;
			$hr = $hour;
		}

		// Get the house position that the sun is in with the given parameters
		$pos = $this->getHousePos($yr, $mn, $dy, $hr, $geolat);

		// We subtract 1 from the pos since array indices start at 0 instead of 1
		$pos -= 1;
		if($pos < 0) {
			$pos += 12;
		}

		// Create an array of the resulting tithi, paksha, and lunar month
		$result = array(
			"tithi" => $tithiNames[$ti], 
			"paksha" => $paksha,
			"lunarMonth" => $monthNames[$pos]
		);
		
		return $result;
	}

	/**
	 * Returns the lunar house position that the sun is in at the given input date
	 * Parameters are in user's local time
	 * @param $year year
	 * @param $month month
	 * @param $day day
	 * @param $hour
	 * @param $geolat latitude of the user
	 */
	public function getHousePos($year, $month, $day, $hour, $geolat) {
		// year, month, day, hour, calendar type
		$jul_day_gmt = swe_julday($year, $month, $day, $hour, SE_GREG_CAL);
		$ipl = SE_ECL_NUT;
		// julian calendar date, ipl constant, ephe_type constant
		$result = swe_calc($jul_day_gmt, $ipl, EPHE_TYPE);

		// parameters for swe_house_pos
		$eps = $result[0];
		$lng = $this->getSunLongitude($year, $month, $day, $hour);
		$lat = $this->getSunLatitude($year, $month, $day, $hour);

		// armc, geographic latitude, ecliptic obliquity, house system, longtitude, latitude
		$position = swe_house_pos(SE_ARMC, $geolat, $eps, 72, $lng, $lat);

		// 3 is added to the house position to compensate for the fact the ARMC is off by an angle of 90 degrees
		// mod 12 in case the +3 offset totals more than 12
		$retval = ($position+3)%12;
		
		return $retval;
	}
	
}

?>
