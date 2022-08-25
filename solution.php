<?php

// Greatest common divider in recursive
function gcd($a, $b)
{
    if ($a == 0 || $b == 0){
        return max($a, $b);
    }
    $r = intval($a) % intval($b);
    return ($r == 0) ? $b : gcd($b, $r);
}

function playingWithWater($aMaxVolume, $bMaxVolume, $c) {

    // Setting initial volumes and step count.
    $steps = 0;
    $a = 0;
    $b = 0;

    /* Result is impossible if both vessels A and B are smaller than vessel C.
    Also, vessel C must be divisible with GDC of other vessels. For example, you cant have volume of
    vessels A and  B as even numbers and expect to fill odd value vessel C with this method. */
    if (($aMaxVolume < $c && $bMaxVolume < $c)
        || !(is_numeric($c))
        || min($aMaxVolume, $bMaxVolume, $c) < 1
        || $c % gcd($aMaxVolume, $bMaxVolume) != 0) {
        return -1;
    } else {
        while (true) {
            if ($a == $c || $b == $c) {
                return $steps;
            }

            // Empty vessel B if it's full.
            if ($b == $bMaxVolume) {
                $b = 0;
            }

            // Fill vessel A if it's empty.
            else if ($a == 0) {
                $a = $aMaxVolume;
            }

            /* Pour from vessel A to B. Pour amount is either difference between smaller vessel's B maximum volume
            and its current volume OR current volume of vessel A - whichever comes lowest. */
            else {
                $pourAmount = min($bMaxVolume - $b, $a);
                $a -= $pourAmount;
                $b += $pourAmount;
            }
            $steps++;
        }
    }
}

$stdin = fopen('test.txt', 'r');

//First line of file
$numOfTests = intval(fgets($stdin));

for($i = 0; $i<$numOfTests; $i++)
{
    $vessels = [];

    //Get 3 values for each test
    for ($j = 0; $j < 3; $j++) {
        $vessels[] = fgets($stdin);
    }

    //Define vessels
    $a = $vessels[0];
    $b = $vessels[1];
    $c = $vessels[2];
    $smallerVessel = min($a, $b);
    $largerVessel = max($a, $b);

    /* Pouring can be done in less steps if GCD between smaller vessel and vessel C is not 1.
    In that case pouring is done from lesser to greater vessel. */
    if (gcd($c, $smallerVessel) > 1 && gcd($c, $largerVessel) == 1) {
        echo playingWithWater($smallerVessel, $largerVessel, $c) . PHP_EOL;
    } else {
        echo playingWithWater($largerVessel, $smallerVessel, $c) . PHP_EOL;
    }
}

fclose($stdin);
