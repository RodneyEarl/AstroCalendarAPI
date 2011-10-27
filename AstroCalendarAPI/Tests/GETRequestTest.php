<?php
require_once('AstroCalendarAPI\API\getDate.php');
/**
 * Test Class for $_GET
 * @author Rodney
 */
class GETRequestTest extends PHPUnit_Framework_TestCase{

	/**
	 * Set up the $_GET and date variable.
	 * Dates are in day-month-year, numerically 2 digits each, separated by a dash.
	 */
	var $date;
	public function setUp(){
		$_GET['startDate'] = '21-11-12';
		$_GET['endDate'] = '30-11-12';
	}
	/**
	 * Test to check that the start day can be parsed from $_GET.
	 */
	public function testStartAt21November2012HasDay21(){

		$date = new GETRequest();
		$startDay = $date->start_day();
		$this->assertEquals('21', $startDay);
	}
	/**
	 * Test to check that the start month can be parsed from $_GET.
	 */
	public function testStartAt21November2012HasMonth11(){

		$date = new GETRequest();
		$startMonth = $date->start_month();
		$this->assertEquals('11', $startMonth);
	}
	/**
	 * Test to check that the start year can be parsed from $_GET.
	 */
	public function testStartAt21November2012HasYear12(){

		$date = new GETRequest();
		$startYear = $date->start_year();
		$this->assertEquals('12', $startYear);
	}
	
	/**
	 * Test to check that the end day can be parsed from $_GET.
	 */
	public function testEndAt30November2012HasDay30(){

		$date = new GETRequest();
		$endDay = $date->end_day();
		$this->assertEquals('30', $endDay);
	}
	/**
	 * Test to check that the end month can be parsed from $_GET.
	 */
	public function testEndAt30November2012HasMonth11(){

		$date = new GETRequest();
		$endMonth = $date->end_month();
		$this->assertEquals('11', $endMonth);
	}
	/**
	 * Test to check that the end year can be parsed from $_GET.
	 */
	public function testEndAt30November2012HasYear12(){

		$date = new GETRequest();
		$endYear = $date->end_year();
		$this->assertEquals('12', $endYear);
	}
}