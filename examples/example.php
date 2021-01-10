<?php

// Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Array
$array = [
	'name' => 'PHP Dot Array',
	'version' => 1.0,
	'author' => [
		'name' => 'Raziul Islam',
		'uri' => 'https://raziulislam.com'
	]
];

// Import the class
use Raziul\Dot\Arr;

// Dot notation get
echo Arr::get($array, 'author.name');

// set
Arr::set($array, 'repository', 'iRaziul\Dot');

// set (multiple)
Arr::set($array, [
	'package.name' => 'iRaziul\Dot',
	'package.link' => 'https://github.com/iRaziul/dot-array'
]);

// Flatten
var_dump(Arr::flatten($array));


// Dump
var_dump($array);
