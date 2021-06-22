<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach ($this->getTypeData() as $data) {
            $type = new Type();

            $type->setName($data['name']);
            $manager->persist($type);

            $this->addReference('type_' .$i, $type);
            $i++;
        }

        $manager->flush();
    }

    /**
    * Données Type
    *
    * @return array[]
    */
    private function getTypeData(): array
    {
        return [
            [
                'name' => 'chat'
            ],
            [
                'name' => 'chien'
            ]
        ];
    }
}
