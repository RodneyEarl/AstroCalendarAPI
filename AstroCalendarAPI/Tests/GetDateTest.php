<?php
require_once('AstroCalendarAPI\API\getDate.php');
/**
 * Test Class for Receiving a request
 * @author Rodney
 */
class GetDateTest extends PHPUnit_Framework_TestCase{

	/**
	 * Set up the data and dateArray variable.
	 * Dates are in the form dd-mm-yyyy.
	 */
	var $dateArray;
	protected function setUp(){
		$date = new getDate('14-11-2011', '28-11-2011');
		$this->dateArray = $date->createArray();
	}
	/**
	 * Test that dateArray has the startDate index.
	 */
	public function testDateArrayHasStartDateKey(){

		$this->assertArrayHasKey('startDate', $this->dateArray);
	}
	/**
	 * Test that dateArray['startDate'] has day index.
	 */
	public function testStartDateHasDayKey(){

		$this->assertArrayHasKey('day', $this->dateArray['startDate']);
	}/**
	* Test that dateArray['startDate'] has day index.
	*/
	public function testStartDateHasMonthKey(){

		$this->assertArrayHasKey('month', $this->dateArray['startDate']);
	}/**
	* Test that dateArray['startDate'] has day index.
	*/
	public function testStartDateHasYearKey(){

		$this->assertArrayHasKey('year', $this->dateArray['startDate']);
	}/**
	* Test that dateArray has the startDate index.
	*/
	public function testDateArrayHasEndDateKey(){

		$this->assertArrayHasKey('endDate', $this->dateArray);
	}
	/**
	 * Test that dateArray['startDate'] has day index.
	 */
	public function testEndDateHasDayKey(){

		$this->assertArrayHasKey('day', $this->dateArray['endDate']);
	}/**
	* Test that dateArray['startDate'] has day index.
	*/
	public function testEndDateHasMonthKey(){

		$this->assertArrayHasKey('month', $this->dateArray['endDate']);
	}/**
	* Test that dateArray['startDate'] has day index.
	*/
	public function testEndDateHasYearKey(){

		$this->assertArrayHasKey('year', $this->dateArray['endDate']);
	}
	/**
	 * Test to check that the start day can be parsed.
	 */
	public function testStartAt14November2011HasDay14(){

		$this->assertEquals('14', $this->dateArray['startDate']['day']);
	}
	/**
	 * Test to check that the start month can be parsed.
	 */
	public function testStartAt14November2011HasMonth11(){

		$this->assertEquals('11', $this->dateArray['startDate']['month']);
	}
	/**
	 * Test to check that the start year can be parsed.
	 */
	public function testStartAt14November2011HasYear2011(){

		$this->assertEquals('2011', $this->dateArray['startDate']['year']);
	}

	/**
	 * Test to check that the end day can be parsed.
	 */
	public function testEndAt28November2011HasDay28(){

		$this->assertEquals('28', $this->dateArray['endDate']['day']);
	}
	/**
	 * Test to check that the end month can be parsed.
	 */
	public function testEndAt28November2011HasMonth11(){

		$this->assertEquals('11', $this->dateArray['endDate']['month']);
	}
	/**
	 * Test to check that the end year can be parsed.
	 */
	public function testEndAt28November2011HasYear2011(){

		$this->assertEquals('2011', $this->dateArray['endDate']['year']);
	}
}