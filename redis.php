<?php
require 'vendor/autoload.php';



print_r($_ENV);


print "<br>\n";
print 'host:' . parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST);
print "<br>\n";
print 'port:' . parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT);
print "<br>\n";
print 'password:' . parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS);
print "<br>\n";


$redis = new Predis\Client(array(
  'host' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST),
  'port' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT),
  'password' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS),
));

$redis->set('foo', 'bar');
$value = $redis->get('foo');

var_dump($value);



