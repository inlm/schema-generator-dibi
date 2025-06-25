<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();


/**
 * @return void
 */
function test(callable $cb)
{
	$cb();
}


/**
 * @return string
 */
function prepareTempDir()
{
	$dir = __DIR__ . '/tmp/' . getmypid();
	Tester\Helpers::purge($dir);
	return $dir;
}
