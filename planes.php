<?php
// Абстрактный класс самолета.
abstract class Airplane {
    public $name;        // Имя самолета.
    public $maxSpeed;    // Максимальная скорость самолета.
    public $inTheAir;    // Находится ли самолет в воздухе.

    // Конструктор класса самолета.
    public function __construct($name, $maxSpeed) {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
        $this->inTheAir = false; // При создании самолет находится на земле.
    }

    // Метод взлета самолета.
    public function takeOff() {
        echo "{$this->name}: взлет<br>";
        $this->inTheAir = true;
    }

    // Метод посадки самолета.
    public function landing() {
        echo "{$this->name}: посадка<br>";
        $this->inTheAir = false;
    }

    // Метод для получения состояния самолета (в воздухе или на земле).
    public function getInTheAir() {
        return $this->inTheAir;
    }
}

class MIG extends Airplane {
    // Метод для выполнения атаки.
    public function attack() {
        echo "{$this->name}: атака<br>";
    }
}

class TU extends Airplane {
}

// Класс Аэропорт.
class Airport {
    private $acceptedAirplanes; // Массив принятых самолетов.

    // Метод для принятия самолета на взлетную полосу.
    public function takeThePlane(Airplane $airplane) {
        $this->acceptedAirplanes[] = $airplane;
        $airplane->landing();
        echo "{$airplane->name} принят<br>";
    }

    // Метод для отправки самолета в полет.
    public function thePlaneTookOff(Airplane $airplane) {
        $index = array_search($airplane, $this->acceptedAirplanes);
        if ($index !== false) {
            unset($this->acceptedAirplanes[$index]);
            $airplane->takeOff();
            echo "{$airplane->name} улетел<br>";
        } else {
            echo "{$airplane->name} не найден в списке принятых самолетов<br>";
        }
    }

    // Метод для перемещения самолета на стоянку.
    public function airplaneWentToParking($airplane) {
        echo "{$airplane->name} ушел на стоянку<br>";
    }

    // Самолет готов взлетать.
    public function airplaneReadyToTakeOff($airplane) {
        echo "{$airplane->name} готов взлетать<br>";
    }

    // Метод для получения общего количества самолетов в аэропорту.
    public function getTotalAirplaneCount() {
        echo count($this->acceptedAirplanes) . " самолета в аэропорту<br>";
    }

    // Метод для создания и принятия МИГ.
    public function createMIG($name, $maxSpeed) {
        $mig = new MIG($name, $maxSpeed);
        $this->takeThePlane($mig);
    }

    // Метод для создания и принятия ТУ.
    public function createTU($name, $maxSpeed) {
        $tu = new TU($name, $maxSpeed);
        $this->takeThePlane($tu);
    }
}

// Создаем объекты самолетов
$mig29 = new MIG("MIG-29", 2000);
$tu154 = new TU("TU-154", 1000);

// Создаем объект аэропорта
$airport = new Airport();

// Принимаем самолеты на взлетную полосу
$airport->takeThePlane($mig29);
$airport->takeThePlane($tu154);

// Создаем еще один МИГ-самолет и принимаем его.
$airport->createMIG("MIG-29 (2)", 2050);

// Выводим общее количество самолетов в аэропорту.
$airport->getTotalAirplaneCount();

// Выполняем атаку самолетом МИГ.
$mig29->attack();
?>