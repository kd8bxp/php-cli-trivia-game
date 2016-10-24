
<?php

/* Copyright 2016 - LeRoy F. Miller
 * Oct 23, 2016
 * Thanks to Open Trivia DB for the API
 * http://opentdb.com/ See notes at end of this file for more information
 * version 3.0 
 */

echo "Script Start: " . date("D M d, Y @ h:i a") . "\n";

$json = file_get_contents("http://www.opentdb.com/api.php?amount=10&category=9&encode=url3986");
$decode = json_decode($json, TRUE);

//print_r($decode);
$score=0;
$results = $decode["results"];
echo "A Simple (or not so simple) CLI Trivia game. \nBy LeRoy F. Miller (c) 2016. \n\n This game could not be possiable with out opentdb.com \n\n";
echo "I will present you with 10 questions from: ";
echo urldecode($decode["results"][0]["category"]);
echo "\n\n";
for ($i = 0; $i <= 9; $i++) {
echo "\nScore: " . $score . "\n";

echo "Question " . ($i+1) . " is ". $decode["results"][$i]["difficulty"] . "\n";
echo urldecode($results[$i]["question"]) . "\n";

$answers[0] = urldecode($results[$i]["correct_answer"]);
$answers[1] = urldecode($results[$i]["incorrect_answers"][0]);
if ($results[$i]["type"] == "boolean") {
		$answers[2] = "xxx";
		$answers[3] = "xxx"; } else {
			$answers[2] = urldecode($results[$i]["incorrect_answers"][1]);
			$answers[3] = urldecode($results[$i]["incorrect_answers"][2]);
			}
$answer = $answers[0];
shuffle($answers);
	for ($x = 0; $x <= 3; $x++) {
	if ($answers[$x] != "xxx" ) {
echo "    " . $x+1 . ") " . $answers[$x] . "\n";
		}	
	}
$youranswer = getanswer();
//echo $youranswer . "\n";

if ($answers[intval($youranswer)-1] == $answer) {
	echo "Correct. \n";
	$score ++;
	} else {
echo "Incorrect! Correct Answer: " . $answer . "\n";
	}

}

echo "\n ";
if ($score >= 8) {echo "You did excellent.\n"; }
if ($score < 8 && $score >= 5) {echo "Not Bad...\n ";}
if ($score < 5) {echo "I think it's time for more school... \n";}
echo "Final Score: " . $score . "\n";
echo "\n\nScript End: " . date("D M d, Y @ h:i a") . "\n";

function getanswer() {

echo "Number? ";
$youranswer = trim(fgets(STDIN));
if (intval($youranswer) < 1 || intval($youranswer) > 4) {
	echo "\nBetween 1 and 4, Please.\n";	
	$youranswer = getanswer();}

return($youranswer);
}
/*
I have a special feeling for the CLI, and I like doing CLI programming using
PHP. However the idea behind this script was to test out ways to make a trivia game for the arduino. 
I used this as a test platform, but I'm very happy with the results.
My code is free to use, but the opentdb.com api has some restrictions on commerical use. so check with www.opentdb.com if you plan on using any part of this for a commerical application.
*/

?>
