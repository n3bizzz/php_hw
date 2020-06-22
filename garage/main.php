<?php
require_once 'Car.php';
require_once 'Garage.php';

$car1=new Car();
$car1->mark='Hyundai';
$car1->model='Creta';
$car1->color='white';
$car1->yearOfManufacture=2018;

$car2=new Car();
$car2->mark='Porsche';
$car2->model='911 Turbo S';
$car2->color='gold';
$car2->yearOfManufacture=2019;

$car3=new Car();
$car3->mark='Mercedes';
$car3->model='SLR McLaren';
$car3->color='black';
$car3->yearOfManufacture=2009;

$car4=new Car();
$car4->mark='Lamborghini';
$car4->model='Aventador';
$car4->color='yellow';
$car4->yearOfManufacture=2009;

$garage=new Garage($car1,$car2,$car3,$car4);
$garage->adress='409 Nelson St SW, Atlanta, GA 30313, USA';

var_dump('Сейчас в гараже:');
foreach($garage->cars as $car){
    var_dump($car->mark, $car->model);
}