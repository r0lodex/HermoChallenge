<?php
/*
    Author: Irfan Radzi
    Project: Hermo Challenge 2016
    January 2016
*/

require __DIR__.'/vendor/autoload.php';

Twig_Autoloader::register();
$app = new Horus();
$app->config->base = '/';

function render($path, $data=null) {
    $loader   = new Twig_Loader_Filesystem('../modules');
    $twig     = new Twig_Environment($loader, array('debug'=>true));
    $ENV      = [];

    $twig->addExtension(new Twig_Extension_Debug());

    $template = $twig->loadTemplate($path.'.html');

    echo $template->render($data);
}

$app->on('/', function() {
    $this->end(render('home', []));
});
