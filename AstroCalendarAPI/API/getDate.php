<?php
/**
 * Take a request for dates and creates an array to
 * be used in the API
 * @author Rodney
 */
class getDate {

	/**
	 * The start day for the request of information.
	 * @var array
	 */
	var $start_date;
	/**
	 * The end day for the request of information.
	 * @var array
	 */
	var $end_date;

	/**
	 * Constructor to set up the start and end dates.
	 */
	public function getDate($start, $end){
		$temp = explode('-', $start);
		$this->start_date = array('day' => $temp[0],
			'month' => $temp[1],
			'year' => $temp[2]
		);
		$temp = explode('-', $end);
		$this->end_date = array('day' => $temp[0],
			'month' => $temp[1],
			'year' => $temp[2]
		);
	}

	/**
	 * Sets up the array that is to be sent to other functions.
	 * Needs time for ephemeris.
	 * Currently uses nested arrays.
	 */
	public function createArray(){
		$arr = array();
		$arr['startDate'] = array(
			'year' => $this->start_year(),
			'month' => $this->start_month(),
			'day' => $this->start_day()
		);
		$arr['endDate'] = array(
			'year' => $this->end_year(),
			'month' => $this->end_month(),
			'day' => $this->end_day()
		);
		return $arr;
	}
	/**
	 * Getter for the start day.
	 */
	public function start_day(){
		return $this->start_date['day'];
	}
	/**
	 * Getter for the start month.
	 */
	public function start_month(){
		return $this->start_date['month'];
	}
	/**
	 * Getter for the start year.
	 */
	public function start_year(){
		return $this->start_date['year'];
	}

	/**
	 * Getter for the end day.
	 */
	public function end_day(){
		return $this->end_date['day'];
	}
	/**
	 * Getter for the end month.
	 */
	public function end_month(){
		return $this->end_date['month'];
	}
	/**
	 * Getter for the end year.
	 */
	public function end_year(){
		return $this->end_date['year'];
	}
}