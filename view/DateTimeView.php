<?php

class DateTimeView {


	public function show() 
	{
		// https://www.geeksforgeeks.org/php-date-time/

		$dayTimeString = date("l");

		$jSTimeString = date("jS");

		$monthTimeString = date("F");
		
		$yearTimeString = date("Y");

		$dateTimeString = date("G:i:s");


		return '<p>' . $dayTimeString . ", the " . $jSTimeString . " of " . $monthTimeString . " " . $yearTimeString . ", The time is " . $dateTimeString . '</p>';
	}
}