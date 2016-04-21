<?php

use \app\classes\Pen;
use \app\classes\AutomatPen;
use \app\classes\MechanicalPencil;
use \app\classes\AutoPen;

header('Content-Type: text/html; charset=utf-8');

require('classes/AutoPen.php');

$inks = [
    [
        'color' => 'red',
        'thick' => 1,
        'capacity' => 3
    ],

    [
        'color' => 'green',
        'thick' => 2,
        'capacity' => 4
    ],

    [
        'color' => 'blue',
        'thick' => 3,
        'capacity' => 6
    ],

];

$pen = new Pen('black', 1, 3, 12);
$automatPen = new AutomatPen('blue', 2, 4, 15);
$mechanicalPencil = new MechanicalPencil(4, 6, 72);
$autoPen = new AutoPen($inks, 20);

?>