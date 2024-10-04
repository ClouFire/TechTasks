<?php
$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

sort($data);
$subjects = array_unique(array_column($data, 1));
sort($subjects);
$grades = [];

foreach($data as list($name, $subject, $grade)) {
    if(isset($grades[$name][$subject])) {
        $grades[$name][$subject] += $grade;
    }
    else {
        $grades[$name][$subject] = $grade;
    }
}

function showTable($grades, $subjects) {
    foreach($subjects as $subject) {
        echo "<td>$subject</td>";
    }
    foreach($grades as $name => $info) {
        echo "<tr>" . "<td>$name</td>";
        foreach($subjects as $subject) {
            if(isset($info[$subject])) {
                echo "<td>$info[$subject]</td>";
            }
            else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
}
