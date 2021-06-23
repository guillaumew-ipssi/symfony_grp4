<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		foreach ($this->getBlogData() as $data) {
			$blog = new Blog();

			$blog->setTitle($data['title']);
			$blog->setSummary($data['summary']);
			$blog->setDescription($data['description']);
			$blog->setDatecreated($data['datecreated']);

			$manager->persist($blog);
		}

		$manager->flush();
	}

	/**
	* Données Type
	*
	* @return array[]
	*/
	private function getBlogData(): array
	{
		return [
			[
				'title' => 'Laisse pour grand chien',
				'summary' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'description' => 'Laisse adaptée pour les grands chien, dérouleur résistant avec blocage',
				'datecreated' => new \DateTime('2021-01-31')
			],
			[
				'title' => 'Os à ronger',
				'summary' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'description' => 'Os pour petit chien, renforcant la machoire et assimilé comme une récompense pour le chien.',
				'datecreated' => new \DateTime('2021-05-25')
			]
		];
	}

	// public function getDependencies()
	// {
	// 	return [
	// 		CategoryFixtures::class,
	// 	];
	// }
}
