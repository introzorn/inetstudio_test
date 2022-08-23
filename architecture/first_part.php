<?php

$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1" ,'another'=>'5'],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2" ,'another'=>'7'],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4" ,'another'=>'5'],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1" ,'another'=>'14'],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4" ,'another'=>'13'],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3" ,'another'=>'10'],
  ];

function UniqArray(Array $array, String $keyname):Array{
	$sunicid=[];
	$narr=[];
	array_map(function($el1) use (&$sunicid, &$narr,$keyname){if(!in_array($el1[$keyname],$sunicid)){$sunicid[]=$el1[$keyname]; $narr[]=$el1;} },$array);
	return 	$narr;
}

function sortByKey(Array $array, String $keyname):Array{
	usort($array, function($a,$b)use($keyname){return ($a[$keyname]-$b[$keyname]);});
    return $array;
}

function findBy(Array $array, String $key, String $val):Array{
	$rt=array_filter($array, function($a)use($key,$val){if($a[$key]==$val){return $a;}});
    //return empty($rt)?false:$rt[0] //если нужно одно поле;
	return empty($rt)?false:$rt;
    
}

function NewFlip(Array $array) :Array{
 return array_map(function($el1){return array_flip($el1);},$array);
}

echo('1 Массив элеменов с уникальными id <br>');
$uniqArray=UniqArray($array,'id');
var_dump($uniqArray);
echo('<hr>');

echo('2 Отсортерованный массив по id <br>');
$sortArray=sortByKey($uniqArray,'id');
var_dump($sortArray);
echo('<hr>');

echo('3 поиск элементов по id <br>');
$findArray=findBy($uniqArray,'id','1');
var_dump($findArray);
echo('<hr>');

echo('4 Массив перевертыш <br>');
$flipArray=NewFlip($uniqArray,'id','1');
var_dump($flipArray);
echo('<hr>');

echo('<hr>');
echo('5 SQL :<br><code>');
echo("SELECT goods.id as id, goods.name as name, tags.name as tag_name FROM goods_tags INNER JOIN goods ON (goods.id=goods_tags.goods_id) INNER JOIN tags ON (tags.id=goods_tags.tag_id);");
echo('</code><br>');

echo('<hr>');
echo('6 SQL :<br><code>');
echo("SELECT *, count(evaluations.respondent_id) as mans FROM `evaluations` WHERE evaluations.gender=TRUE AND evaluations.value>5 GROUP BY evaluations.department_id;");
echo('</code><br>');
