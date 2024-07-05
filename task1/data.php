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

$names = array_column($data, '0');
$subjects = array_column($data, '1');
$grades = [];
array_multisort($subjects, SORT_STRING, $names, SORT_STRING, $data);

foreach (array_unique($names) as $name) {
    foreach (array_unique($subjects) as $subject) {
        $grades[$name][$subject] = 0;
    }
}
foreach ($data as list($name, $subject, $grade)) {
    $grades[$name][$subject] += $grade;
}