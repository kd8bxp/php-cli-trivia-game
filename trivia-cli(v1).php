
<?php


echo "Script Start: " . date("D M d, Y @ h:i a") . "\n";


$json = file_get_contents("http://opentdb.com/api.php?amount=10&category=9&difficulty=easy");
$decode = json_decode($json, TRUE);

print_r($decode);
$score=0;
$results = $decode["results"];
echo "I will present you with 10 questions from: ";
echo $decode["results"][0]["category"];
echo "\n\n";
for ($i = 0; $i <= 9; $i++) {
echo "\nScore: " . $score . "\n";

echo "Question " . ($i+1) . " is ". $decode["results"][$i]["difficulty"] . "\n";
echo $results[$i]["question"] . "\n";

$answers[0] = $results[$i]["correct_answer"];
$answers[1] = $results[$i]["incorrect_answers"][0];
if ($results[$i]["type"] == "boolean") {
		$answers[2] = "xxx";
		$answers[3] = "xxx"; } else {
			$answers[2] = $results[$i]["incorrect_answers"][1];
			$answers[3] = $results[$i]["incorrect_answers"][2];
			}
	for ($x = 0; $x <= 3; $x++) {
	if ($answers[$x] != "xxx" ) {
echo "    " . $x+1 . ") " . $answers[$x] . "\n";
		}	
	}
}

?>
