<?php


class Garage
{
    public $cars;
    public $adress;
    public function __construct(Car ...$cars){
        $this->cars=$cars;
    }
}