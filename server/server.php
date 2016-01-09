<?php
/*
* Author  : Irfan Radzi
* Project : Hermo Challenge 2016
* January 2016
*/

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/vendor/alash3al/horus/Horus.php'; // App not optimized for autoload...

Twig_Autoloader::register();
$app = new Horus();
$app->config->base = '/';

function render($path, $data=null) {
    $loader   = new Twig_Loader_Filesystem('../app');
    $twig     = new Twig_Environment($loader, array('debug'=>true));

    $twig->addExtension(new Twig_Extension_Debug());

    $template = $twig->loadTemplate($path.'.html');

    echo $template->render($data);
}

session_start();
include 'cart.php';
include 'checkout.php';

$app->on('/', function() {
    $this->end(render('index', []));
});

$app->on('GET /api/cart', function() {
    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
    $this->json($cart);
});

$app->on('POST /api/cart', function() {
    $cart = new Cart();
    $a = $cart->add($this->body);
    $this->json($a);
});

$app->on('PUT /api/cart/:?/:?', function($itemid, $action) {
    $cart = new Cart();
    $a = $cart->update($itemid, $action);
    $this->json($a);
});

$app->on('DELETE /api/cart/:?', function($itemid) {
    $cart = new Cart();
    $a = $cart->delete($itemid);
    $this->json($cart);
});
