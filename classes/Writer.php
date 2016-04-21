<?php

namespace app\classes;

use Exception;

/* Абстрактний клас. Сюди я записав ті параметри і методи, які притаманні всім подальшим класам*/
abstract class Writer
{
    protected $color; // колір ручки
    protected $thick; // товщина стержня
    protected $capacity; // ємність (скільки км. ручка зможе прописати)
    protected $price; // ціна
    protected $type; // Тип
    protected $writing = false; // Стан ручки. В стані письма, або неактивна. При створенні неактивна
    protected $probab_defect; // кількість нормальних ручок відносно однієї бракованої
    protected $defect; // true, false. Ручка бракована або ні

    public function __construct ($thick, $capacity, $price) {
        self::setDefect();
        self::setThick($thick);
        self::setCapacity($capacity);
        self::setPrice($price);
    }

    // Встановлення кольору
    protected function setColor($color) {

        if (empty($color)) {
            throw new Exception('Variable $color couldn\'t be empty!');
        }
        $this->color = $color;
    }

    // Отримання кольору
    public function getColor () {
        return $this->color;
    }

    // Встановлення товщини пасти
    protected function setThick($thick) {

        if (!is_numeric($thick)) {
            throw new Exception('Variable $thick must be numeric!');
        }
        $this->thick = $thick;
    }

    // Встановлення ємності
    protected function setCapacity($capacity) {

        if (!is_numeric($capacity)) {
            throw new Exception('Variable $capacity must be numeric!');
        }
        $this->capacity = $capacity;
    }

    // Встановлення ціни
    protected function setPrice($price) {

        if (!is_numeric($price)) {
            throw new Exception('Variable $price must be numeric!');
        }
        $this->price = $price;
    }

    /* Якщо екземпляру не повезло, то він бракований
     * Функція перевіряє чи згенерувалося загадане нами число
     * Для прикладу будемо перевіряти рівність з 1
     * Якщо метод rand() повернув 1, то ручка бракована
    */
    protected function setDefect() {
        if (rand(0, $this->probab_defect) === 1) {
            $this->defect = true;
        }
        $this->defect = false;
    }

    // Почати писати
    public function write () {

        if ($this->defect) {
            throw new Exception("Вибачте, але " . $this->type . " не працює через брак");
        }

        if ($this->capacity === 0) {
            throw new Exception("Неможливо писати, так як закінчилася паста");
        }
        $this->writing = true;
    }

    // Припинити писати
    public function stopWrite () {
        $this->writing = false;
    }

    // Функція, яка перевіряє чи ручка знаходиться в стані письма
    public function isWriting () {
        return $this->writing;
    }

    // Отримати загальну інформацію
    public function getInfo() {
        $info = "Тип: " . $this->type . "</br>" .
            "Колір: " . $this->color . "</br>" .
            "Товщина: " . $this->thick . " мм." . "</br>" .
            "Ємність: " . $this->capacity . " км." . "</br>" .
            "Ціна: " . $this->price . " грн.";

        return $info;
    }
}
