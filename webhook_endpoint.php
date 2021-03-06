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


#$_ENV['REDISCLOUD_URL']="http://:@127.0.0.1:6379";

require 'vendor/autoload.php';
$redis = new Predis\Client(
    array(
        'host' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST),
        'port' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT),
        'password' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS)
    )
);

$storeKey = 'webhook:' . $queries['webhook_demo_key'];

$value = $redis->get($storeKey);
$data = unserialize($value);

if (empty($data['secret_key'])) {
    header('HTTP/1.0 400 Bad Request');
    print 'Re-create webhook URL and register the URL, then try again.';
    exit;
}


$json = file_get_contents('php://input');



// signature check
$signature = base64_encode(hash_hmac('sha256', $json, $data['secret_key'], true));

$data['body'] = $json;
$data['server'] = serialize($_SERVER);
$data['signature_sent'] = $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE'];
$data['signature_expected'] = $signature;

$redis->setex($storeKey, 60 * 60 * 12, serialize($data));

if ($signature != $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE']) {
    header('HTTP/1.0 400 Bad Request');
    print sprintf('signature is invalid. (received:%s) (expected:%s)', $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE'], $signature);
    exit;
}


header('HTTP/1.0 200 OK');
print('OK');

