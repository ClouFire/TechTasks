<?php
$text = <<<TXT
<p class="big">
	Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
	<img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
	<span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
	<i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
TXT;

$array = explode(' ', $text);
$array2 = explode(' ', strip_tags($text));
$flag = 0;
$keyWord = $array2[28];
$closed = [];
foreach($array as $elem) {
    if ($elem == $keyWord) {
        $flag = 1;
        echo $elem . '...';
    }
    elseif ($flag and (preg_match_all('/<[^>]+>/', $elem, $tags) or preg_match_all('#<a#', $elem, $tags))) {
        foreach($tags[0] as $tag) {
            if (!preg_match('#</#', $tag) and $tag != '<a') {
                $tag = str_replace('<', '</', $tag);
                $closed[] = $tag;
            }
            elseif ($tag == '<a') {
                $closed[] = '</a>';
            }
            else {
                $closed[] = $tag;
            }
        }
    }
    elseif ($elem != $keyWord and !$flag) {
        echo $elem . ' ';
    }

}
foreach(array_count_values($closed) as $key => $elem) {
    if ($elem == 1 or $elem % 2 != 0) {
        echo $key;
    }
}
?>

<br><a href="/index.php">Назад</a>
