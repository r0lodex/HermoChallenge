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

$app->on('/', function() {
    $this->end(render('index', []));
});
