<?php

function prepareData($data)
{
    $grades = [];
    $subjects = [];

    foreach($data as list($name, $subject, $grade)) {
        if(!in_array($subject, $subjects))
        {
            $subjects[] = $subject;
        }
        if(isset($grades[$name][$subject])) {
            $grades[$name][$subject] += $grade;
        }
        else {
            $grades[$name][$subject] = $grade;
        }
    }
    sort($subjects);
    $result["grades"] = $grades;
    $result["subjects"] = $subjects;

    return $result;
}
