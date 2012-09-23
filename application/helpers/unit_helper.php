<?php
/**
 * This function converts fahrenheit into celcius
 * @param  string|integer $number The amount of fahrenheit to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function fahrenheit_to_celcius ( $number ) {
	return (($number - 32)/9*5);
}

/**
 * This function converts celcius into fahrentheit
 * @param  string|integer $number The amount of celcius degrees to convert into fahrenheit
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function celcius_to_fahrenheit ( $number ) {
	return ($number*9/5-32);
}

/**
 * This function converts celcius to kelvin
 * @param  string|integer $number The amount of celcius degrees to turn into kelvin
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function celcius_to_kelvin ( $number ) {
	return (273.15 + $number);
}

/**
 * This function converts kelvin to celcius
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function kelvin_to_celcius ( $number ) {
	return ($number - 273.15);
}

/**
 * This function converts fahrenheit to kelvin
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function fahrenheit_to_kelvin ( $number ) {
	return ( ($number + 459.67) * 1.8);
}

/**
 * This function converts kelvin to fahrenheit
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function kelvin_to_fahrenheit ( $number ) {
	return ($number * 1.8 - 459.67);
}

/**
 * This function converts rankine to celcius
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function rankine_to_celcius ( $number ) {
	return ( ($number - 491.67) *(5/9));
}

/**
 * This function converts celcius to rankine
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function celcius_to_rankine ( $number ) {
	return (($number + 273.15) * 1.8);
}

/**
 * This function converts fahrenheit to rankine
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function fahrenheit_to_rankine ( $number) {
	return ($number + 459.67);
}

/**
 * This function converts rankine to fahrenheit
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function rankine_to_fahrenheit ( $number) {
	return ($number - 459.67);
}

/**
 * This function converts kelvin to rankine
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function kelvin_to_rankine ( $number ) {
	return ($number * (9/5));
}

/**
 * This function converts the Rankine unit into Kelvin units
 * @param  string|integer $number The amount to convert
 * @return integer
 * @author Bo Thomsen <bo@illution.dk>
 */
function rankine_to_kelvin ( $number ) {
	return ($number * (5/9));
}

################################# New ########################################

function meters_to_centimeters ( $number ) {
	return ($number*100);
}

function centimeters_to_meters ( $number ) {
	return ($number/100);
}

function milimeters_to_centimeters ( $number ) {
	return ($number/10);
}

function centimeters_to_milimeters ( $number ) {
	return ($number * 10);
}

function kilometers_to_meters ( $number ) {
	return ($number * 1000);
}

function meters_to_kilometers ( $number ) {
	return ($number / 1000);
}

function meters_to_yards ( $number ) {
	return ($number * 1.09361);
}

function yards_to_meters ( $number ) {
	return ($number * 0.9144);
}

function yards_to_feets ( $number ) {
	return ($number * 3);
}

function feets_to_yards ( $number ) {
	return ($number / 3);
}
?>