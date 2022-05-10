<?php
namespace Test;

require __DIR__ .'/nosql/cach.php';

use NoSQL\Cach;
use NoSQL\Redis;
use NoSQL\Memcached;

$cach = new Cach(new Redis());
//$cach->setStrategy(new Memcached());

if ($argv[3] =='add') {
  $cach->set($argv[4], $argv[5], 1200);
}elseif ($argv[3] =='delete') {
  $cach->del($argv[4]);
} else{
  echo "bad command console !!!\n";
}

try {
  foreach ($cach->getAll() as $key => $value) {
    echo $key.' '.$value."\n";
  } 
} catch (\Throwable $ex) {
  echo $ex->getMessage();
}
