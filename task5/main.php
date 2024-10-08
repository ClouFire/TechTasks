<?php

function getSistersAmount($n, $m): int {
    if ($n > 0 and $m > 0) {
        return $n+1;
    }
    else {
        throw new Exception('Отрицательное значение');
    }

}
try {
    print(getSistersAmount(1, 2));
} catch (Exception $e) {
    echo $e->getMessage();
}