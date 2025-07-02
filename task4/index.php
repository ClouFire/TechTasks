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

$doc = new DOMDocument();
$doc->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
$body = $doc->documentElement->lastChild;
function stripText($text, $body, $limit = 27)
{
    if($limit <= 0) return '';

    $NT = [];
    $NT = cleanText($body, $NT);

    if($limit >= count($NT)) return $text;

    $keyword = $NT[$limit-1];
    $stop = false;
    $counter = 0;
    getNodes($body, $result, $keyword, $stop, $counter, $limit);

    return implode('',  $result);
}
function cleanText($node, &$NT): array
{
    if($node instanceof DOMText)
    {
        $NT = array_merge($NT, explode(' ', $node->nodeValue));
    }
    elseif($node instanceof DOMElement)
    {
        foreach($node->childNodes as $child)
        {
            cleanText($child, $NT);
        }
    }
    foreach($NT as $key => $word)
    {
        if(!trim($word))
        {
            unset($NT[$key]);
        }
    }
    foreach($NT as $key => $word)
    {
        if(trim($word) == '-')
        {
            unset($NT[$key]);
        }
        if(trim($word) == '.')
        {
            unset($NT[$key]);
        }
    }
    $NT = array_values($NT);

    return $NT;
}


function getNodes($node, &$result, $keyword, &$stop, &$counter, $limit)
{
    if($stop)
    {
        return;
    }

    if($node instanceof DOMText)
    {
        $txt = explode(' ', $node->nodeValue);
        $flag = 1;
        foreach($txt as $key => $word)
        {
            if($word !== '.' and $word !== '-' and trim($word) !== '') $counter++;
            if($word == $keyword and $counter >= $limit-1)
            {
                for($i = 0; $i < $key; $i++)
                {
                    $result[] = $txt[$i] . ' ';
                }
                $result[] = $word . '...';
                $stop = true;
                $flag = 0;
                break;
            }
        }
        if($flag)
        {
            $result[] = $node->nodeValue;
        }

    }
    elseif($node instanceof DOMElement)
    {
        $tagContent = '';
        foreach($node->attributes as $attr)
        {
            $tagContent .= (' ' . $attr->nodeName . '=' . "\"{$attr->nodeValue}\"");
        }
        $result[] = '<' . $node->nodeName . $tagContent . '>';

        foreach($node->childNodes as $child)
        {
            getNodes($child, $result, $keyword, $stop, $counter, $limit);
        }

        $result[] = '</' . $node->nodeName . '>';


    }
}

#Искомый результат по заданию
echo stripText($text, $body);

#Проверка всевозможных вариантов сокращения текста
/*
for($i = 1; $i <= 85; $i++)
{
    print("- {$i} -" . PHP_EOL);
    print(stripText($text, $body, $i) . PHP_EOL);
}
*/
