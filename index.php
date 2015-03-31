<?php
/**
 * Index page
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Yuki Matsukura <yuki_matsukura@metaps.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */
?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="ja">
  <head>
    <meta charset="utf-8">
    <title>SPIKE Checkout demo program</title>
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


  <div class="row">
<p>Copy and paste your <strong>sandbox</strong> keys.</p>
    <form action="save_keys.php" method="post">
      <dl>
        <dt>Secret key</dt>
        <dd><input type="text" name="secret_key" value="<?php print $_SESSION['secret_key'] ?>" size="50" placeholder="Paste your key"></dd>
        <dt>Publishable key</dt>
        <dd><input type="text" name="publishable_key" value="<?php print $_SESSION['publishable_key'] ?>" size="50" placeholder="Paste your key"></dd>
      </dl>

      <input type="submit" value="Go to SPIKE Checkout demo" class="button">

    </form>
  </div>

  <hr>
  <footer>
    <div class="row">
      <a href="https://github.com/metaps/spike-checkout-demo" target="_blank">spike-checkout-demo</a> version:1.2.0
    </div>
  </footer>

  <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/vendor/jquery.js"></script>
  <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>

  </body>
</html>


