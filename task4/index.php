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

function stripText($text, $limit = 28) {

    $newText = explode(' ', strip_tags($text));
    if($limit >= count($newText)) return "Fatal Error: Wrong limit value. Try input less";
    $keyword = $newText[$limit-1];
    $text = explode(' ', $text);
    $result = [];
    foreach($text as $key => $word) {
        if(($key >= $limit-1 and strip_tags($word) == $keyword) or ($limit == 1 and $key >= $limit)) {
            $result[] = $word;
            break;
        }
        else {
            $result[] = $word;
        }
    }
    return implode(' ', $result) . '...';
}

echo stripText($text, 20);




?>