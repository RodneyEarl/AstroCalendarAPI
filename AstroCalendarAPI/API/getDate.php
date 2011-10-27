<?php
class GETRequest {
	
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
	function GETRequest(){
		$temp = explode('-', $_GET['startDate']);
		$this->start_date = array('day' => $temp[0],
			'month' => $temp[1],
			'year' => $temp[2]
		);
		$temp = explode('-', $_GET['endDate']);
		$this->end_date = array('day' => $temp[0],
			'month' => $temp[1],
			'year' => $temp[2]
		);
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