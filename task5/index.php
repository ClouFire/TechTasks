<?php

/**
 * @param int $n количество сестер Алисы
 * @param int $m количество братьев Алисы
 * @return int количество систер у произвольного брата Алисы
 * @throws Exception отрицательное значение братьев\сестер Алисы
*/
function getSistersAmount(int $n, int $m): int {
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