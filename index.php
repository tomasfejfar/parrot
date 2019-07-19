<?php

declare(strict_types = 1);

require_once 'vendor/autoload.php';

use Zend\Diactoros\ServerRequestFactory;

$request = ServerRequestFactory::fromGlobals();
$key = [
    $request->getUri(),
    $request->getParsedBody(),
];
$filename = sha1(serialize($key));
if (!file_exists($filename)) {
    file_put_contents($filename, '-- automatically created response for ' . $request->getUri());
}
$fp = fopen($filename, 'r+');
fpassthru($fp);
fclose($fp);


