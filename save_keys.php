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

header('Location: menu.php');
