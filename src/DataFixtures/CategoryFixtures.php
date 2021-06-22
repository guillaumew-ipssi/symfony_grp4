<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach ($this->getTypeData() as $data) {
            $category = new Category();

            $category->setName($data['name']);
            $manager->persist($category);

            $this->addReference('category_' .$i, $category);
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
                'name' => 'health'
            ],
            [
                'name' => 'food'
            ],
            [
                'name' => 'accessories'
            ]
        ];
    }
}
