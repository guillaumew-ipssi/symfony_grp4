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
            $animal->setPath($data['path']);

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
                'name' => 'Ricola',
                'age' => 2,
                'type' => 'type_1',
                'gender' => 2,
                'weight' => 5,
                'path' => 'ricola.jpg'
            ],
            [
                'name' => 'Sprite',
                'age' => 1,
                'type' => 'type_1',
                'gender' => 1,
                'weight' => 1,
                'path' => 'sprite.jpeg'
            ],
            [
                'name' => 'Saphir',
                'age' => 1,
                'type' => 'type_1',
                'gender' => 2,
                'weight' => 1,
                'path' => 'saphir.jpg'
            ],
            [
                'name' => 'Mimine',
                'age' => 4,
                'type' => 'type_1',
                'gender' => 2,
                'weight' => 3,
                'path' => 'mimine.jpg'
            ],
            [
                'name' => 'Honey',
                'age' => 3,
                'type' => 'type_1',
                'gender' => 2,
                'weight' => 3,
                'path' => 'honey.jpg'
            ],
            [
                'name' => 'Zorro',
                'age' => 1,
                'type' => 'type_1',
                'gender' => 1,
                'weight' => 1,
                'path' => 'zorro.jpg'
            ],
            [
                'name' => 'Rabanne',
                'age' => 7,
                'type' => 'type_2',
                'gender' => 1,
                'weight' => 6,
                'path' => 'rabanne.jpg'
            ],
            [
                'name' => 'Qem',
                'age' => 4,
                'type' => 'type_2',
                'gender' => 2,
                'weight' => 5,
                'path' => 'qem.jpeg'
            ],
            [
                'name' => 'Smoke',
                'age' => 3,
                'type' => 'type_2',
                'gender' => 2,
                'weight' => 3,
                'path' => 'smoke.jpg'
            ],
            [
                'name' => 'Boyca',
                'age' => 2,
                'type' => 'type_2',
                'gender' => 2,
                'weight' => 5,
                'path' => 'boyca.jpeg'
            ],
            [
                'name' => 'Juste',
                'age' => 7,
                'type' => 'type_2',
                'gender' => 1,
                'weight' => 2,
                'path' => 'juste.png'
            ],
            [
                'name' => 'Twix',
                'age' => 4,
                'type' => 'type_2',
                'gender' => 1,
                'weight' => 3,
                'path' => 'twix.png'
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
