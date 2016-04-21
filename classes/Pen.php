<?php

namespace app\classes;

require('Writer.php');

/*
 * Клас простої ручки.
 * Можливо було варто винести функціонал з абстрактного класу Writer сюди,
 * але мені здалось, що краще щоб речі які притаманні усім наслідникам зберігалися саме там
 * */
class Pen extends Writer
{
    protected $type = "ручка";
    protected $probab_defect = 100;

    function __construct($color = "black", $thick = 1, $capacity = 1, $price = 2) {
        Writer::__construct($thick, $capacity, $price);
        self::setColor($color);
    }
}