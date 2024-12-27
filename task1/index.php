<?php
require_once __DIR__ . '/data.php';

$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

$data = prepareData($data);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>1st-task</title>
</head>
<body>
    <div class="block">
        <table class="table">
            <tr>
                <td></td>
                <?php foreach($data["subjects"] as $subject) : ?>
                     <td><?=$subject?></td>
                <?php endforeach ?>
                <?php foreach($data["grades"] as $name => $info) : ?>
                     <tr><td><?=$name?></td>
                    <?php foreach($data["subjects"] as $subject) :
                        if(isset($info[$subject])) : ?>
                            <td><?=$info[$subject]?></td>
                        <?php else : ?>
                            <td></td>
                        <?php endif ?>
                    <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
        </table>
    </div>
</body>
</html>
