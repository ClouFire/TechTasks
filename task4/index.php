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

/**
 * @param array $array массив, в котором все теги поднимаются на один индекс вверх, а пустоты удаляются
 * @return array возврат массива с переиндексацией, без пустот и с отображением тегов, приближенным к оригинальному тексту
 */

function trimSpecialChars(array $array): array
{

    foreach($array as $key => $word)
    {
        if(preg_match("#<[^>]+>#", $word))
        {
            $array[$key-1] .= $word;
            $array[$key] = '';
        }
    }

    foreach($array as $key => $word)
    {
        if(!trim($word))
        {
            unset($array[$key]);
        }
    }

    $array = array_values($array);

    foreach($array as $key => $word)
    {
        if(trim(strip_tags($word)) == '.' or strip_tags(trim($word)) == '!' or strip_tags(trim($word)) == '?' or strip_tags(trim($word)) == ',')
        {
            $array[$key-1] = trim($array[$key-1]) . trim($word);
            unset($array[$key]);
        }
        elseif(strip_tags(trim($word)) == '-')
        {
            $array[$key-1] = trim($array[$key-1]) . ' ' .trim($word);
            unset($array[$key]);
        }


    }
    $array = array_values($array);
    return $array;
}

/**
 * @param string $text исходный текст для редактирования
 * @param int $limit слово, до которого нужно обрезать текст, включительно
 * @return string возврат обрезанного текста с добавлением "..." к последнему слову
 */

function stripText(string $text, int $limit = 27): string
{
    if($limit <= 0) return '';
    $counter = 0;
    $result = [];
    $closedTags = [];
    $singleTags = ['</img' => 1, '</br' => 1, '</col' => 1, '</hr' => 1, '</input' => 1, '</link' => 1];
    $specialChars = ['.', ',', '!', '?', ';', ':'];

    $formattedText = preg_replace("#<[^>]+>#", " $0 ", $text);
    $newText = explode(' ', preg_replace("#<[^>]+>#", ' ', $text));
    $formattedText = explode(' ', $formattedText);

    $formattedText = trimSpecialChars($formattedText);
    $newText = trimSpecialChars($newText);

    if($limit >= count($newText)-1) return $text;
    $keyword = $newText[$limit-1];

    foreach($formattedText as $key => $word)
    {
        $result[] = $word;
        if(in_array(trim(strip_tags($word)), $newText)) $counter++;
        if(trim(strip_tags($word)) == $keyword and $counter >= $limit-1) break;
    }
    foreach($specialChars as $char)
    {
        if(mb_substr((trim(strip_tags($result[count($result)-1]))), -1) == $char)
        {
            $result[count($result)-1] = substr_replace($result[count($result)-1], '', strrpos($result[count($result)-1], $char));
            break;
        }
    }

    $result[count($result)-1] .= '...';


    foreach($result as $elem)
    {
        preg_match_all('#<[/a-zA-Z]+#', $elem, $tags);
        foreach($tags[0] as $tag)
        {
            if(!str_contains($tag, '</')) $tag = str_replace('<', '</', $tag);
            if(!isset($singleTags[$tag])) $closedTags[] = $tag;
        }
    }
    $closedTags = array_reverse($closedTags);
    foreach(array_count_values($closedTags) as $key => $elem)
    {
        if($elem % 2 != 0)
        {
            $result[] = $key . '>';
        }
    }
    return implode(' ', $result);
}

echo stripText($text);