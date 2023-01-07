<?php

use CLI\Style;
use CLI\Cursor;
use CLI\Erase;
use CLI\Misc;
use CLI\Output;


require __DIR__ . '/vendor/autoload.php';

Erase::up();
Erase::screen();
Cursor::rowcol(1,1);

Misc::bell(1);
Erase::eol();
Output::line(Style::cyan(PHP_EOL
	."##############################################################"
	.PHP_EOL
	."CUSTOM SCRIPT TO GENERATE IMPORTRANGE FORMULA FOR GOOGLE SHEET"
	.PHP_EOL
	."##############################################################"
	.PHP_EOL
	.PHP_EOL));
Erase::eol();


Misc::bell(1);
Output::line(Style::bold("Enter the SpreadSheet URL") .": ");
Cursor::show();
$url = getOp();

$url = filter_var($url, FILTER_SANITIZE_URL);
if(!filter_var($url, FILTER_VALIDATE_URL)){
	Output::line(
		Style::white(PHP_EOL."Please enter a valid SpreadSheet URL".PHP_EOL.PHP_EOL, "red")
	);
	exit();
}

Misc::bell(1);
Output::line(Style::bold("Sheet Name") .": ");
Cursor::show();
$sheet = getOp();


Misc::bell(1);
Output::line(Style::bold("Number of rows to generate") .": ");
Cursor::show();
$count = getOp();

if(!is_numeric($count)){
	Output::line(
		Style::white(PHP_EOL."The Row Count Should be numeric".PHP_EOL.PHP_EOL, "red")
	);
	exit();
}


Misc::bell(1);
Output::line(Style::purple("Generate? [ type 'yes' to generate ]") .": ");
Cursor::show();

$generate = getOp();


if ( isset($generate) && in_array(trim(strtolower($generate)), array_map('strtolower', ['y','yes']))) {



Misc::bell(1);


	$mainTable = "={".PHP_EOL
		. "  IMPORTRANGE(\"{$url}\", \"'{$sheet}'!A1:E{$count}\"),".PHP_EOL
		. "  IMPORTRANGE(\"{$url}\", \"'{$sheet}'!G1:G{$count}\")".PHP_EOL
		." }".PHP_EOL;

	$effortStart = (int)$count + 2;
	$effortEnd = $effortStart+4;
	$efforts = "=IMPORTRANGE(\"{$url}\", \"'{$sheet}'!A{$effortStart}:E{$effortEnd}\")".PHP_EOL;

	$costStart = $effortEnd+2;
	$costEnd = $costStart+3;
	$cost = "=IMPORTRANGE(\"{$url}\", \"'{$sheet}'!A{$costStart}:D{$costEnd}\")".PHP_EOL;

	$estimationStart = $costEnd+2;
	$estimationEnd = $estimationStart+4;
	$estimation = "=IMPORTRANGE(\"{$url}\", \"'{$sheet}'!A{$estimationStart}:C{$estimationEnd}\")".PHP_EOL;

	$timelineStart = $estimationEnd+2;
	$timelineStartDate = $timelineStart+3;
	$timelineEnd = $timelineStart+7;
	$timeline = "={".PHP_EOL
		."  IMPORTRANGE(\"{$url}\", \"'{$sheet}'!B{$timelineStart}:D{$timelineStart}\");".PHP_EOL
		."  IMPORTRANGE(\"{$url}\", \"'{$sheet}'!B{$timelineStartDate}:D{$timelineEnd}\")".PHP_EOL
	." }".PHP_EOL;

Output::line(Style::green(PHP_EOL
	."##################################"
	.PHP_EOL
	."Generated the SpreadSheet Formulas"
	.PHP_EOL
	."##################################"
	.PHP_EOL
	.PHP_EOL, 'blink'));

Output::line(Style::normal(PHP_EOL
	."####################"
	.PHP_EOL
	."Query for Main Table"
	.PHP_EOL
	."####################"
	.PHP_EOL
	.PHP_EOL
	. Style::normal($mainTable, 'reverse')
	.PHP_EOL
	.PHP_EOL, 'yellow'));


Output::line(Style::normal(PHP_EOL
	."######################"
	.PHP_EOL
	."Query for Effort Table"
	.PHP_EOL
	."######################"
	.PHP_EOL
	.PHP_EOL
	. Style::normal($efforts, 'reverse')
	.PHP_EOL
	.PHP_EOL, 'red'));


Output::line(Style::normal(PHP_EOL
	."####################"
	.PHP_EOL
	."Query for Cost Table"
	.PHP_EOL
	."####################"
	.PHP_EOL
	.PHP_EOL
	. Style::normal($cost, 'reverse')
	.PHP_EOL
	.PHP_EOL, 'light_gray'));


Output::line(Style::normal(PHP_EOL
	."##########################"
	.PHP_EOL
	."Query for Estimation Table"
	.PHP_EOL
	."##########################"
	.PHP_EOL
	.PHP_EOL
	. Style::normal($estimation, 'reverse')
	.PHP_EOL
	.PHP_EOL, 'cyan'));

Output::line(Style::normal(PHP_EOL
	."########################"
	.PHP_EOL
	."Query for Timeline Table"
	.PHP_EOL
	."########################"
	.PHP_EOL
	.PHP_EOL
	. Style::normal($timeline, 'reverse')
	.PHP_EOL
	.PHP_EOL, 'magenta'));

}

else {
	Output::line(
		Style::white(PHP_EOL."Operation Cancelled!".PHP_EOL.PHP_EOL, "red")
	);	
}



function getOp(){
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	if(trim($line) != ''){
	    $line = trim($line);
	}
	return $line??'';
}