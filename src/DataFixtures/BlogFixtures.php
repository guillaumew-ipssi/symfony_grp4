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
			$blog->setWritted_by($data['writted_by']);

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
				'title' => 'Mois de l\'adoption : 5 questions à se poser avant d\'adopter',
				'summary' => 'Durant ce Mois de l’adoption, la SPA sensibilise les futurs adoptants à l’adoption responsable. L’accueil d’un animal représente un engagement véritable dont il faut prendre en compte toutes les facettes pour que tout se passe sereinement pour l’animal et la famille adoptante.',
				'description' => '1. QUELLE EST SA DURÉE DE VIE MOYENNE ?<br>
				L’adoption d’un animal est un véritable engagement dans la durée. Vous vous engagez pour toute la durée de la vie de l’animal. Une décennie, deux décennies, les espérances de vie varient d’une espèce à l’autre – et même d’une race à l’autre… On estime qu’un chien peut vivre en moyenne 10-12 ans et un chat en moyenne 15 ans. Ce n’est qu’une moyenne, la durée de vie dépendant de la race, de la taille, de l’état de santé de l’animal. Elle peut être plus longue !
				<br><br>
				2. QUEL EST LE COÛT ANNUEL POUR PRENDRE SOIN D’UN CHIEN OU D’UN CHAT ?<br>
				Un animal représente des frais. Il est indispensable de pouvoir subvenir aux besoins alimentaires et vétérinaires, mais également aux dépenses liées aux éventuelles gardes durant les vacances, aux divertissements (jouets, friandises…) et aux accessoires (panier, bac à litière, griffoir…).
				<br><br>
				3.COMBIEN D’HEURES SERA-T-IL SEUL À LA MAISON ?<br>
				Maintenant que vous savez que vous pouvez subvenir aux besoins financiers afférents à l’animal ; pourrez-vous subvenir à ses besoins psychiques ? Votre présence au domicile, vos capacités de sorties, d’attention, de jeu… Autant de critères qui sont cruciaux. Il est très important d\'accorder un certain nombre d’heures à votre animal pour sa santé morale et sa santé en général. Le besoin de présence dépend de l’espèce et du caractère de l’animal.
				<br><br>
				4.QUELS SONT LES SOINS VÉTÉRINAIRES DONT IL A BESOIN ?<br>
				Si l’animal que vous souhaitez accueillir exige des dispositions vétérinaires (prédispositions de certaines races, pathologies), vous devez connaître ces dernières et les accommoder convenablement.
				<br><br>
				5.COMMENT VAIS-JE ORGANISER MES VACANCES AVEC LUI ?<br>
				Dernière question, mais pas des moindres ! Vos vacances… Avez-vous réfléchi à votre organisation avec votre animal ? Pourrez-vous partir avec lui ? Si ce n’est pas le cas, quelles seraient vos options ?',
				'datecreated' => new \DateTime('2021-01-31'),
				'writted_by' => 'Victor Hugo'
			],
			[
				'title' => 'Les refuges de demain',
				'summary' => 'La Société Protectrice des Animaux a imaginé ses refuges de demain ! Disposant d’un réseau de 62 refuges et Maisons SPA, l’association a travaillé sur un concept de refuge pour les futures constructions. C’est une réflexion de long terme, qui a été menée de façon structurée pour la rendre pérenne.',
				'description' => 'UN LIEU CONÇU AUTOUR DU BIEN-ÊTRE ANIMAL<br><br>Fruit d’une réflexion collective interne d’une année, ce nouveau concept de refuge a été pensé autour la relation entre les animaux accueillis, l’homme et la nature. C’est un lieu dédié au bien-être et à la protection animale.<br>Le bien-être des animaux recueillis a été au centre de la réflexion. Les espaces et les équipements qui leurs sont dédiés sont adaptés en fonction de leurs caractéristiques et de leurs besoins quotidiens. Les Nouveaux Animaux de Compagnie et les animaux de ferme ont été intégrés à la conception de ce nouveau site. Ce dernier est conçu pour pouvoir accueillir ces animaux aux besoins particuliers en toute quiétude.',
				'datecreated' => new \DateTime('2021-05-25'),
				'writted_by' => 'Arthur Raimbault'
			],
			[
				'title' => 'Organiser ses vacances avec son animal',
				'summary' => 'Un des principaux freins à l’adoption et, encore de nos jours, une des raisons principales de l’abandon... est l’organisation des vacances ! Pourtant, il existe de nombreuses solutions pour partir avec ou sans son animal. Il faut juste bien préparer son séjour !',
				'description' => 'Pour de multiples raisons, vous avez décidé de ne pas emmener votre animal en vacances (chien, chat, NAC… !). Heureusement, beaucoup de solutions existent de nos jours pour passer cette période en toute sérénité, pour vous et pour votre compagnon.
				<br><br>
				<li>Faites-le garder par un proche !</li><br>
				Au sein de votre entourage et cercle : famille, amis, collègues de bureau ou voisins, vous trouverez possiblement quelqu’un, voire plusieurs personnes enclines à s’occuper temporairement de votre compagnon ! En échange de bons procédés, vous pourrez à votre tour rendre un service similaire aux personnes pouvant vous aider !
				​<br><br>
				<li>Sollicitez une aide à domicile !</li><br>
				Ce service est généralement assuré par des personnes retraitées qui résident chez vous durant votre absence pour nourrir votre animal et le promener plusieurs fois par jour, si nécessaire. La mise en relation est garantie par des sites qui vérifient la fiabilité des gardiens.
				<br><br>
				<li>Faites appel à un ou plusieurs pet-sitters !</li><br>
				Une personne peut se rendre quotidiennement à votre domicile pour nourrir, câliner et promener votre animal à l’heure et le nombre de fois qui conviennent. Ce mode de garde est plutôt réservé à des vacances courtes, comme un week-end. Il s’agit d’un dépannage et c’est parfois difficile de s’y habituer pour les animaux, car la solitude peut être très rapidement traumatique pour eux. Soyez vigilants du bien-être psychique de vos compagnons…
				<br><br>
				<li>Sollicitez l’aide d’une pension professionnelle !</li><br>
				Les pensions sont gérées par des professionnels de la gestion des animaux. Ces personnes suivent des consignes précises pour les animaux en garde : alimentation spécialisée, soins dédiés, promenades à heures fixées à l’avance. Nous vous recommandons de vous rendre sur place, de contacter plusieurs pensions afin de trouver LA pension qui vous conviendra ainsi qu’à votre ou vos compagnons. Sur place, vérifiez la propreté, la taille des lieux de vie ou boxes, leur température, la sécurité des locaux et le nombre des personnes impliquées dans l’ensemble des soins quotidiens.<br><br>
				IMPORTANT : la pension doit posséder un agrément de la préfecture (contactez la DDPP de votre département pour le vérifier), votre animal doit être à jour de ses vaccinations, vermifuges et antipuces, et toute nourriture spécifique doit être fournie par les détenteurs. Pensez à obtenir un contrat pour toute la durée où vous allez confier votre compagnon : chaque prestation fournie doit figurer sur le contrat !',
				'datecreated' => new \DateTime('2021-05-25'),
				'writted_by' => 'Arthur Raimbault'
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
