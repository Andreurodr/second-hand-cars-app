<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $getContent = file_get_contents(dirname(__DIR__).'\DataFixtures\cars.json', true);
        $contentCars = json_decode($getContent, true);
        foreach ($contentCars as $cars){
                    $newCar = new Cars();
                    $newCar->setBrand($cars["brand"]);
                    $newCar->setModel($cars["model"]);
                    $newCar->setFuel($cars["fuel"]);
                    $newCar->setKilometers($cars["kilometers"]);
                    $newCar->setYear($cars["year"]);
                    $newCar->setHorsepower($cars["horsepower"]);
                    $newCar->setType($cars["type"]);
                    $newCar->setDoors($cars["doors"]);
                    $newCar->setColor($cars["color"]);
                    $newCar->setPhotography($cars["photography"]);
                    $newCar->setPrice($cars["price"]);
                    $manager->persist($newCar);
                    $manager->flush();
            }
    }
}