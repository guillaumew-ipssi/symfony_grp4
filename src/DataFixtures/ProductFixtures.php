<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getProductData() as $data) {
            $product = new Product();

            $product->setTitle($data['title']);
            $product->setDescription($data['description']);
            $product->setCategory($this->getReference($data['category']));
            $product->setPrice($data['price']);
            $product->setPath($data['path']);

            $manager->persist($product);
        }

        $manager->flush();
    }

    /**
    * Données Type
    *
    * @return array[]
    */
    private function getProductData(): array
    {
        return [
            [
                'title' => 'laisse pour grand chien',
                'description' => 'laisse adaptée pour les grands chien, dérouleur résistant avec blocage',
                'category' => 'accessories',
                'price' => 29.99,
                'path' => 'img/product/accessories/laisse_001.jpeg'
            ],


            [
                'title' => 'os à ronger',
                'description' => 'os pour petit chien, renforcant la machoire et assimilé comme une récompense pour le chien',
                'category' => 'food',
                'price' => 3.99,
                'path' => 'img/product/food/os_001.jpeg'
            ],

            
            [
                'title' => 'antiparasite',
                'description' => 'antiparasite pour chien entre 15kg et 25kg, valable pour 3 mois',
                'category' => 'health',
                'price' => 19.99,
                'path' => 'img/product/health/frontline_001.jpeg'
            ]
        ];
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
