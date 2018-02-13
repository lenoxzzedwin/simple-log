<?php

require __DIR__ . '/../vendor/autoload.php';

use Lenoxzzedwin\SimpleLog\SimpleLog;

$log = new SimpleLog();


$log->lfile('file.txt');


$log->lwrite(['hello','world']); // array
$log->lwrite('Hello World'); // string
$data = ['person' => ['name'=>'Edwin']];
$log->lwrite( (object) $data);  //object ALL!

$log->lclose();
