<?php
//класс с обертками для стандартных функций PHP
require_once('php/wrapPhp.class.php');
$wrapPhp = new wrapPhp();
//получить именна ботов поисковиков из файлов
function getBots(string $fileName): array{
    $bots=$GLOBALS['wrapPhp']->file($fileName);
    return $bots;
}
//парсинг строки лога и получение из нее ассоциативного массива
function parceString(string $string): array{
    $string=$GLOBALS['wrapPhp']->str_replace(['" "', '" ', ' "'], '"', $string);
    $values=$GLOBALS['wrapPhp']->explode('"', $string);
    $codeAndVisits=$GLOBALS['wrapPhp']->explode(' ', $values[2]);
    $result['code']=$codeAndVisits[0];
    $result['traffic']=$codeAndVisits[1];
    $result['url']=$values[3];
    $result['client']=$values[4];
    return $result;
}

//получение названий поисковых ботов
$bots['yandex']=getBots('bots/yandex.txt');
$bots['google']=getBots('bots/google.txt');
$bots['bing']=getBots('bots/bing.txt');
$bots['baidu']=getBots('bots/baidu.txt');
//получение указателя на файл для чтения
$handle=$wrapPhp->fopen('access_log', 'r');
//начальные значения
$traffic=0;
$crawlers=[
    'Google'=>0,
    'Bing'=>0,
    'Baidu'=>0,
    'Yandex'=>0
];
//чтение файла и обработка значений
while($string=$wrapPhp->fgets($handle)){
    $string=parceString($string);
    $urls[$string['url']]=$string['url'];
    $traffic=$traffic+$string['traffic'];
    if($wrapPhp->empty($codes[$string['code']])) $codes[$string['code']]=1;
    else $codes[$string['code']]++;
    foreach($bots as $type => $botNames){
        foreach($botNames as $botName){
            if($wrapPhp->strpos($string['client'], trim($botName))!==false){
                $crawlers[$wrapPhp->ucfirst($type)]++;
                break 2;
            }
        }
    }
}

//упаковываем результат
$result['views']=$wrapPhp->count($log);
$result['urls']=$wrapPhp->count($urls);
$result['traffic']=$traffic;
$result['crawlers']=$crawlers;
$result['statusCodes']=$codes;

//вывод в json формате
echo $wrapPhp->json_encode($result);

?>














