<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Hello, World!</title>
</head>
<body>
<?php

// PHP program to demonstrate
// SCAN Disk Scheduling algorithm

$size = 8;
$disk_size = 200;

function SCAN($arr, $head, $direction)
{
    $seek_count = 0;
    $distance;
    $cur_track;
    $left = [];
    $right = [];
    $seek_sequence = [];

    // appending end values
    // which has to be visited
    // before reversing the direction
    if ($direction == "left") {
        array_push($left, 0);
    } elseif ($direction == "right") {
        array_push($right, $GLOBALS['disk_size'] - 1);
    }

    for ($i = 0; $i < $GLOBALS['size']; $i++) {
        if ($arr[$i] < $head) {
            array_push($left, $arr[$i]);
        }
        if ($arr[$i] > $head) {
            array_push($right, $arr[$i]);
        }
    }

    // sorting left and right vectors
    sort($left);
    sort($right);

    // run the while loop two times.
    // one by one scanning right
    // and left of the head
    $run = 2;
    while ($run-- > 0) {
        if ($direction == "left") {
            for ($i = count($left) - 1; $i >= 0; $i--) {
                $cur_track = $left[$i];

                // appending current track to seek sequence
                array_push($seek_sequence, $cur_track);

                // calculate absolute distance
                $distance = abs($cur_track - $head);

                // increase the total count
                $seek_count += $distance;

                // accessed track is now the new head
                $head = $cur_track;
            }
            $direction = "right";
        } elseif ($direction == "right") {
            for ($i = 0; $i < count($right); $i++) {
                $cur_track = $right[$i];

                // appending current track to seek sequence
                array_push($seek_sequence, $cur_track);

                // calculate absolute distance
                $distance = abs($cur_track - $head);

                // increase the total count
                $seek_count += $distance;

                // accessed track is now new head
                $head = $cur_track;
            }
            $direction = "left";
        }
    }

    echo "Total number of seek operations = " . $seek_count . "</br>"; //formatting for the output of the total seek operations
    echo "Seek Sequence is" . "</br>";
    for ($i = 0; $i < count($seek_sequence); $i++) {          //formatting for the seek sequence
        echo $seek_sequence[$i] . "</br>";
    }
}

// request array
// everything you need to manipulate is here
$arr = [98, 183, 37, 122, 14, 124, 65, 67];   //this is the queue
$head = 53;                                   //the head starting position
$direction = "left";                          //if left towards zero ; if right away from zero

SCAN($arr, $head, $direction);

?>
</body>
</html>