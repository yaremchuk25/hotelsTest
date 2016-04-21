<?php

namespace app\classes;

require('Pen.php');

use Exception;

/*
 * Клас, який опистує поведінку автоматичної ручки (якщо я вірно зрозумів її сенс).
 * */
class AutomatPen extends Pen
{
    protected $type = "автоматична ручка";
    protected $probab_defect = 100;
    protected $checked = false; // стани ручки. По замовчуванню вона з закритим стержнем

    function __construct($color = "black", $thick = 1, $capacity = 1, $price = 2) {
        Writer::__construct($thick, $capacity, $price);
        self::setColor($color);
    }

    /*
     * Функція яка імітує натискання на кнопку зверху автоматичної ручки.
     * Якщо стержень відкритий, то ховаємо його.
     * Якщо закритий, то навпаки показуємо
     * */
    public function pushTopButton() {
        $this->checked = !$this->checked;
    }

    /*
     * Доповнимо функцію write.
     * Якщо стержень закритий, то ми не можемо писати
     * */
    public function write () {

        if (!$this->checked) {
            throw new Exception("Для того щоб почати писати, натисність на кнопку зверху (функція pushTopButton)");
        }
        Writer::write();
    }

    // Перевірити чи не схований стержень
    public function isChecked() {
        return $this->checked;
    }
}