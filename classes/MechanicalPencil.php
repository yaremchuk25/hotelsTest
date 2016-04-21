<?php

namespace app\classes;

require('AutomatPen.php');

use Exception;

/*
 * Клас, який опистує поведінку механічного олівця.
 * */
class MechanicalPencil extends AutomatPen
{
    protected $type = "механічний олівець";
    protected $probab_defect = 1000000;
    protected $checked = false; // стани олівця. По замовчуванню він з закритим стержнем
    private $rod_length = 0; // довжина стержня, який показаний, внаслідок натискання на кнопку зверху

    function __construct($thick = 1, $capacity = 1, $price = 2) {
        Writer::__construct($thick, $capacity, $price);
        // Наврядчи існують різнокольорові механічні олівці.
        // Якщо ж так, то потрібно робити все аналогічно, як з ручками
        $this->color = "grey";
    }

    /*
     * Функція яка імітує натискання на кнопку зверху механічного олівця.
     * При натисканні на кнопку будемо додавати стержню 2 мм.
     * */
    public function pushTopButton() {

        // Якщо натискаємо на кнопку в стані письма, то стержень ломається і повертається в початковий стан
        // Процес писання припиняється
        if ($this->writing) {
            $this->checked = false;
            $this->rod_length = 0;
            $this->writing = false;

            throw new Exception("Не натискайте на кнопку в процесі писання механічним олівцем");
        }
        $this->checked = true;
        $this->rod_length += 2;
    }

    // Отримати поточну довжину стержня
    public function getRodLength () {
        return $this->rod_length;
    }

    /*
     * Доповнимо функцію write.
     * Якшо стержень довший ніж 1 см.(або 10 мм.) , то він ламається і олівець повертається в початковий стан
     * */
    public function write() {

        if ($this->rod_length >= 10) {
            $this->checked = false;
            $this->rod_length = 0;
            throw new Exception("Нажаль стержень зламався. Постарайтеся щоб його довжина не перевищувала 1-го сантиметра.");
        }
        AutomatPen::write();
    }
}