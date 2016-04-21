<?php

namespace app\classes;

require('MechanicalPencil.php');

use Exception;

/*
 * Клас, який опистує поведінку авторучки.
 * */
class AutoPen extends MechanicalPencil
{
    protected $colors = array();
    protected $thicks = array();
    protected $capacities = array();
    protected $defects = array();

    protected $type = "Авторучка";
    protected $probab_defect = 100;
    protected $checked = false; // стани авторучки. По замовчуванню вона з закритим стержнем
    private $checked_color_idx; // індекс обраного на даний момент кольору


    /*
     * @param Array $inks массив з різними пастами до ручки
     *              пасти повинні мати такі властивості:
     *              color - колір
     *              thick - товщина стержня
     *              capacity - ємність
     * */
    function __construct($inks, $price = 2) {
        self::setColors($inks);
        self::setThicks($inks);
        self::setСapacities($inks);
        self::setDefects($inks);
        self::setPrice($price);

    }

    // Функція для встановлення кольорів
    private function setColors ($inks) {

        foreach ($inks as $ink) {

            if (!isset($ink['color']) || empty($ink['color'])) {
                throw new Exception ("color є обов\'язковим параметром");
            }
            $this->colors[] = $ink['color'];
        }
    }

    // Функція для встановлення товщин стержнів
    private function setThicks ($inks) {

        foreach ($inks as $ink) {

            if (!isset($ink['thick'])) {
                throw new Exception ("thick є обов\'язковим параметром");
            }

            if (!is_numeric($ink['thick'])) {
                throw new Exception ("Параметр thick повинен бути числом");
            }

            $this->thicks[] = $ink['thick'];
        }
    }

    // Функція для встановлення ємностей стержнів
    private function setСapacities ($inks) {

        foreach ($inks as $ink) {

            if (!isset($ink['capacity'])) {
                throw new Exception ("capacity є обов\'язковим параметром");
            }

            if (!is_numeric($ink['capacity'])) {
                throw new Exception ("Параметр capacity повинен бути числом");
            }

            $this->capacities[] = $ink['capacity'];
        }
    }

    private function setDefects ($inks) {

        for ($i = 0; $i < count($inks); $i++) {

            if (rand(0, $this->probab_defect) === 1) {
                $this->defects[$i] = true;
            }
            $this->defects[$i] = false;
        }
    }

    /*
     * Функція яка імітує натискання на певний колір.
     * @param Number $ink_index індекс пасти обраного кольору
     * */
    public function pushTopButton($ink_index) {

        if (!isset($ink_index)) {
            throw new Exception("Ви не обрали пасту");
        }

        if (!is_numeric($ink_index)) {
            throw new Exception("Потрібно ввести індекс пасти");
        }

        if (!isset($this->colors[$ink_index])) {
            throw new Exception("Такої пасти не існує. Оберіть іньшу пасту");
        }

        // Якщо натиснути на поточний колір, то стержень ховається
        if ($this->checked_color_idx === $ink_index) {
            $this->checked = false;
            return;
        }

        $this->checked = true;

        // Змінюємо значення кольору, товщнини, ємності та браку
        $this->color = $this->colors[$ink_index];
        $this->thick = $this->thicks[$ink_index];
        $this->capacity = $this->capacities[$ink_index];
        $this->defect = $this->defects[$ink_index];
    }
}