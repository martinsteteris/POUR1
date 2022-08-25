<?php
$testCount = 10;
$minRandomValue = 1;
$maxRandomValue = 30;

$testFile = fopen("test.txt", "w");
fwrite($testFile, $testCount . "\n");

for ($i = 0; $i < ($testCount * 3); $i++){
    fwrite($testFile, rand($minRandomValue, $maxRandomValue) . "\n");
}
fclose($testFile);
