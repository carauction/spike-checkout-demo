<?php
/**
 * Save keys to session variable.
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Yuki Matsukura <yuki_matsukura@metaps.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */
$_SESSION['secret_key']      = $_POST['secret_key'];
$_SESSION['publishable_key'] = $_POST['publishable_key'];

require 'vendor/autoload.php';
#$_ENV['REDISCLOUD_URL']="http://:@127.0.0.1:6379";
$redis = new Predis\Client(array(
  'host' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST),
  'port' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT),
  'password' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS),
));
$demoKey = hash('sha256', session_id());
$redis->del('webhook:'.$demoKey);

header('Location: menu.php');

