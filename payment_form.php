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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.3.1/css/normalize.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/foundation/5.3.1/css/foundation.min.css">
    <script src="//cdn.jsdelivr.net/foundation/5.3.1/js/vendor/modernizr.js"></script>
  </head>
  <body>

<h1>SPIKE Checkout demo</h1>

  <div class="row">
    <form action="payment_finish.php" method="post">
      <input id="token" type="hidden" name="token" value="">
      <button name="purchase" data-button-guest="0">Purchase</button>
      <br>
      <button name="purchase" data-button-guest="1">Purchase (Guest checkout)</button>
    </form>
  </div>


<script src="https://checkout.spike.cc/v1/checkout.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
var handler = SpikeCheckout.configure({
  key: "<?php print htmlspecialchars(addslashes($_SESSION['publishable_key'])); ?>",
  token: function(token, args) {
    $("#customButton").attr('disabled', 'disabled');
    $(':input[type="hidden"][name="token"]').val(token.id);
    $('form').submit();
  },
  opened: function(e) {
    console.log("Event: Overlay opened.");
  },
  closed: function(e) {
    console.log("Event: Overlay closed.");
  }
});


$('button[name="purchase"]').click(function(e) {
  console.info();
    handler.open({
      name: "My Shop",
      amount: 900,
      currency: "JPY",
      email: "foo@example.com",
      guest: (e.target.dataset.buttonGuest == "0") ? false : true
    });
  e.preventDefault();
});
</script>



  </body>
</html>


