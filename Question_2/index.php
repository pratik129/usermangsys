<?php
function searchingChallenge($strArr = array())
{
    $finalArray = array();
    if (!empty($strArr) && is_array($strArr)) {
        foreach ($strArr as $arr) {
            $newArray = explode(':', $arr);
            if (!isset($finalArray[$newArray[0]])) {
                $finalArray[$newArray[0]] = intval($newArray[1]);
            } else {
                $finalArray[$newArray[0]] += intval($newArray[1]);
            }
        }

        $filterArray = array_filter($finalArray, function ($value) {
            return $value != 0;
        });
        ksort($filterArray);
        $finalOp = array();
        foreach ($filterArray as $key => $val) {
            $finalOp[] = "$key:$val";
        }
        return implode(",", $finalOp);
    } else {
        return "Please Provide Valid Array to be search";
    }
}

$input1 = array("X:-1", "Y:1", "X:-4", "B:3", "X:5");
$input2 = array("Z:0", "A:-1");
$input3 = "sdfsdfs";
echo searchingChallenge($input1);
echo "<br>";
echo searchingChallenge($input2);
echo "<br>";
echo searchingChallenge($input3);
echo "<br>";
