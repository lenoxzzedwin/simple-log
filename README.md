# Simple Log in PHP

A simple package for write in a file all messages and variables sets inspired by https://www.redips.net/php/write-to-log-file 

### Installation

```bash
$ composer require lenoxzzedwin/simple-log
```

### Basic Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php'; // or your path

use Lenoxzzedwin\SimpleLog\SimpleLog;
$log = new SimpleLog();
$log->lfile('path'); //load file

$log->lwrite(['hello','world']); // array
$log->lwrite('Hello World'); // string
$data = ['person' => ['name'=>'Edwin']];
$log->lwrite( (object) $data);  //object ALL!

$log->lclose();

```

### file.txt
```
[Tue Feb 13 5:17:27 2018] (/tests/test.php) Array
(
    [0] => hello
    [1] => world
)

[Tue Feb 13 5:17:27 2018] (/tests/test.php) Hello World
[Tue Feb 13 5:17:27 2018] (/tests/test.php) stdClass Object
(
    [person] => Array
        (
            [name] => Edwin
        )

)
```

### tail -f?
perfect for use with tail -f


License
----

MIT


