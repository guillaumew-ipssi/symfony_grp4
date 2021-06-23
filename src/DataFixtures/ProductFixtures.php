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
                'title' => 'Laisse pour grand chien',
                'description' => 'Laisse adaptée pour les grands chien, dérouleur résistant avec blocage',
                'category' => 'accessories',
                'price' => 29.99,
                'path' => 'img/products/accessories/laisse_001.jpeg'
            ],
            [
                'title' => 'Laisse pour grand chien',
                'description' => 'Laisse adaptée pour les grands chien, dérouleur résistant avec blocage',
                'category' => 'accessories',
                'price' => 29.99,
                'path' => 'img/products/accessories/laisse_001.jpeg'
            ],


            [
                'title' => 'Os à ronger',
                'description' => 'Os pour petit chien, renforcant la machoire et assimilé comme une récompense pour le chien.',
                'category' => 'food',
                'price' => 3.99,
                'path' => 'img/products/food/os_001.jpeg'
            ],
            [
                'title' => 'Royal Canin Medium Adult pour chien',
                'description' => 'Croquettes pour les chiens adultes de races moyennes (11 - 25 kg) de 12 mois à 7 ans, renforcent les défenses immunitaires naturelles et le système digestif, avec un complexe d\'antioxydants.',
                'category' => 'food',
                'price' => 18.99,
                'path' => 'img/products/food/royal-canin-medium.jpg'
            ],
            [
                'title' => 'Royal Canin Sterilised en sauce pour chat',
                'description' => 'Sachets fraîcheur de nourriture humide pour chat adulte stérilisé dès 1 an, délicieuses bouchées, favorisent un système urinaire sain, contribuent à maintenir le poids de forme, particulièrement savoureux.',
                'category' => 'food',
                'price' => 12.49,
                'path' => 'img/products/food/royal-canin-sterilised.jpg'
            ],
            [
                'title' => 'Hill\'s Prescription Diet Metabolic Weight Management poulet pour chat',
                'description' => 'Croquettes diététiques pauvres en calories pour les chats en surpoids, favorisent la perte de poids ou le maintien du poids après un régime, teneur en énergie réduite, 23 % de poulet.',
                'category' => 'food',
                'price' => 17.49,
                'path' => 'img/products/food/hills-prescription-diet.jpg'
            ],
            [
                'title' => 'Purizon Adult Sterilised poulet, poisson - sans céréales pour chat',
                'description' => 'Croquettes pour les chats stérilisés dont le métabolisme change et les besoins énergétiques se réduisent, pauvres en graisses, riches en protéines (poulet), sans céréales.',
                'category' => 'food',
                'price' => 4.99,
                'path' => 'img/products/food/purizon-adult.jpg'
            ],
            [
                'title' => 'PURINA PRO PLAN All sizes Adult Light/Sterilised poulet',
                'description' => 'Croquettes pauvres en graisses pour chien adulte de toutes les tailles stérilisé ou en surpoids. Formule OPTIWEIGHT pour une perte de poids progressive et durable. Régulent la sensation de faim.',
                'category' => 'food',
                'price' => 34.99,
                'path' => 'img/products/food/purina-pro.jpg'
            ],


            
            

            [
                'title' => 'antiparasite',
                'description' => 'antiparasite pour chien entre 15kg et 25kg, valable pour 3 mois',
                'category' => 'health',
                'price' => 19.99,
                'path' => 'img/products/health/frontline_001.jpeg'
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
