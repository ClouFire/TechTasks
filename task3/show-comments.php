<?php
function getPDO() {
    static $pdo;

    if (!$pdo) {
        $dbHost = '127.0.0.1';
        $dbName = 'users';
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", 'root', '');
        } catch (PDOException $exception) {
            print_r($exception);
        }
    }
    return $pdo;
}
function calculateDate($date) {
    //Y-m-d H:i:s
    $timestamp = time() - strtotime($date);
    $seconds = ['year' => 31536000, 'month' => 2678400, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1];
    foreach ($seconds as $key => $item) {
        if (round($timestamp / $item) != 0) {
            $value = round($timestamp / $item);
            if ($value == 11 or $value == 12 or $value == 13 or $value == 14) {
                switch($key) {
                    case 'year':
                        return "$value лет назад";
                    case 'month':
                        return "$value месяцев назад";
                    case 'day':
                        return "$value дней назад";
                    case 'hour':
                        return "$value часов назад";
                    case 'minute':
                        return "$value минут назад";
                    case 'second':
                        return "$value секунд назад";
                }
            }
            elseif ($value % 10 == 1) {
                switch($key) {
                    case 'year':
                        return "$value год назад";
                    case 'month':
                        return "$value месяц назад";
                    case 'day':
                        return "$value день назад";
                    case 'hour':
                        return "$value час назад";
                    case 'minute':
                        return "$value минуту назад";
                    case 'second':
                        return "$value секунду назад";
                }
            }
            elseif ($value % 10 == 2 or $value % 10 == 3 or $value % 10 == 4) {
                switch($key) {
                    case 'year':
                        return "$value года назад";
                    case 'month':
                        return "$value месяца назад";
                    case 'day':
                        return "$value дня назад";
                    case 'hour':
                        return "$value часа назад";
                    case 'minute':
                        return "$value минуты назад";
                    case 'second':
                        return "$value секунды назад";
                }
            }
            else {
                switch($key) {
                    case 'year':
                        return "$value лет назад";
                    case 'month':
                        return "$value месяцев назад";
                    case 'day':
                        return "$value дней назад";
                    case 'hour':
                        return "$value часов назад";
                    case 'minute':
                        return "$value минут назад";
                    case 'second':
                        return "$value секунд назад";
                }
            }
        }

        }
        return 'Только что';

    }


function showComments($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM comments");
    $stmt->execute();
    foreach($stmt as $row) {
        $date = calculateDate($row['date']);
        echo "<li class=\"users-comments\" \"wrapper\">" .
                "<div class=\"about-user\">" .
                    "<a href=\"#\">$row[username]</a> <br>" .
                    "<span>$date</span>" .
                "</div>" .
                "<p>$row[comment]</p>";

    }

}


