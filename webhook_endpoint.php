<?php
/**
 * Webhook endpoint
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Noboru Koike <noboru_koike@metaps.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */

$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
if (empty($query)) {
    header('HTTP/1.0 400 Bad Request');
    print 'webhook_demo_key is not specified.';
    exit;
}
parse_str($query, $queries);
if (empty($queries['webhook_demo_key'])) {
    header('HTTP/1.0 400 Bad Request');
    print 'webhook_demo_key is not specified.';
    exit;
}


require 'vendor/autoload.php';
$redis = new Predis\Client(array(
    'host' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST),
    'port' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT),
    'password' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS),
));
$storeKey = 'webhook:' . $queries['webhook_demo_key'];

$value = $redis->get($storeKey);
$data = unserialize($value);

if (empty($data['secret_key'])) {
    header('HTTP/1.0 400 Bad Request');
    print 'webhook prepare is missing.';
    exit;
}


$json = urldecode(file_get_contents('php://input'));


// signature check
$signature = base64_encode(hash_hmac('sha256', json_decode($json), $data['secret_key'], true));

if ($signature != $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE']) {
    header('HTTP/1.0 400 Bad Request');
    print 'signature is invalid.';
    exit;
}


$data['body'] = $json;
$redis->setex($storeKey, 60 * 60 * 12, serialize($data));


header('HTTP/1.0 200 OK');
print('OK');
