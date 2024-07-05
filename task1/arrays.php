

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>1st-task</title>
</head>
<body>
    <div class="block">
        <table class="table">
            <tr>
                <td></td>
                <?php
                require_once __DIR__ . '/data.php';
                foreach (array_unique($subjects) as $subject) {
                    echo "<td>$subject</td>";
                }
                foreach ($grades as $name => $values) {
                    echo '<tr>' . "<td>$name</td>";
                    foreach ($values as $subject => $grade) {

                        if ($grade > 0) {
                            echo "<td>$grade</td>";
                        }
                        else {
                            echo "<td></td>";
                        }
                    }
                } ?>
            </tr>

        </table>
    </div>
    <a href="/index.php">Назад</a>
</body>
</html>
