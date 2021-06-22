<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getAnimalData() as $data) {
            $animal = new Animal();

            $animal->setName($data['name']);
            $animal->setAge($data['age']);
            $animal->setType($this->getReference($data['type']));
            $animal->setGender($data['gender']);
            $animal->setWeight($data['weight']);

            $manager->persist($animal);
        }

        $manager->flush();
    }

    /**
    * Données Type
    *
    * @return array[]
    */
    private function getAnimalData(): array
    {
        return [
            [
                'name' => 'prout',
                'age' => 2,
                'type' => 'type_1',
                'gender' => 1,
                'weight' => 5
            ]
        ];
    }

    public function getDependencies()
    {
        return [
            TypeFixtures::class,
        ];
    }
}
