<?php
/**
 * Menu page
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Noboru Koike <noboru_koike@metaps.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */
?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="ja">
  <head>
    <meta charset="utf-8">
    <title>SPIKE Checkout demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.1/css/normalize.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/foundation/5.3.1/css/foundation.min.css">
    <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/vendor/modernizr.js"></script>
  </head>
  <body>


  <h1>SPIKE Checkout demo</h1>

<?php
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] != 'https') {
    print sprintf('<p style="color: red;">WARNING:<strong>USE <a href="%s">HTTPS</a> to send secret key securely.</strong></p>', 'https://'.$_SERVER['HTTP_HOST']);
}
?>

<?php
if (empty($_SESSION['secret_key']) || empty($_SESSION['publishable_key'])) {
?>

    <div class="row">
      <a href="index.php" class="button">Back to TOP</a>
    </div>

<?php
} else {
?>

    <div class="row">
      <ul style="list-style: none">
        <li><a href="payment_form.php" class="button">SPIKE Checkout</a></li>
        <li><a href="webhook.php" class="button">Webhook</a></li>
      </ul>
    </div>

<?php
}
?>


  <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/vendor/jquery.js"></script>
  <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>

  </body>
</html>
