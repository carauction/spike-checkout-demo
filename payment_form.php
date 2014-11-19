<?php
/**
 * SPIKE Checkout page
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Yuki Matsukura <yuki_matsukura@metaps.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */

?><!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>SPIKE Checkout demo program (1/2)</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.1/css/normalize.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/foundation/5.3.1/css/foundation.min.css">
    <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/vendor/modernizr.js"></script>
  </head>
  <body>

<h1>SPIKE Checkout and charge demo</h1>

<p>There some example code for SPIKE Checkout</p>

  <noscript>Enable Javascript and reload this page.</noscript>

  <div class="row">
    <form action="payment_finish.php" method="post">
      <input id="token" type="hidden" name="token" value="">
      <button name="purchase" id="button1">Purchase</button>
      <br>
      <button name="purchase" id="button2">Purchase (Guest checkout)</button>
      <br>
      <button name="purchase" id="button3">Purchase without amount option</button>
    </form>
  </div>


<script src="https://checkout.spike.cc/v1/checkout.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
var handler = SpikeCheckout.configure({
  key: "<?php print htmlspecialchars(addslashes($_SESSION['publishable_key'])); ?>",
  token: function(token, args) {

    alert(token.id);

    $("#customButton").attr('disabled', 'disabled');
    $(':input[type="hidden"][name="token"]').val(token.id);
    $('form').submit();
  },
  opened: function(e) {
    // Event: Overlay opened
  },
  closed: function(e) {
    // Event: Overlay closed
  }
});


$('#button1').click(function(e) {
    handler.open({
      name: "My Shop button 1",
      amount: 1000,
      currency: "JPY",
      email: "foo@example.com",
    });
  e.preventDefault();
});


$('#button2').click(function(e) {
    handler.open({
      name: "My Shop button 2",
      amount: 2000,
      currency: "JPY",
      email: "foo@example.com",
      guest: true
    });
  e.preventDefault();
});


$('#button3').click(function(e) {
    handler.open({
      name: "My Shop button 3",
      currency: "JPY",
      email: "foo@example.com",
      guest: true
    });
  e.preventDefault();
});


</script>



<h1>Charge API test</h1>

  <div class="row">
    <form action="payment_finish.php" method="post">
      Token: <input type="text" name="token" value="">
      <input type="submit" value="Charge" class="button">
    </form>
  </div>



  </body>
</html>


