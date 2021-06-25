<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Blog;
use App\Entity\Animal;
use App\Entity\Type;


class HomeController extends AbstractController
{
	/**
	 * On retourne les produits + articles + animaux + les totaux
	 * @Route("/", name="home")
	 */
	public function index(): Response
	{
		// On récupère les produits + articles de blog + animaux limité à 5
		$products = $this->getDoctrine()->getRepository(Product::class)->findBy([], [],5);
		// On récupère les articles de blog les plus récent
		$blogs = $this->getDoctrine()->getRepository(Blog::class)->findBy([],['datecreated' => 'DESC'], 5);
		$animals = $this->getDoctrine()->getRepository(Animal::class)->findBy([], [],5);

		// On récupère les totaux
		$total_products = $this->getDoctrine()->getRepository(Product::class)->findAll();
		$total_blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
		$total_animals = $this->getDoctrine()->getRepository(Animal::class)->findAll();

		return $this->render('home/index.html.twig', [
			'products'   => $products,
			'total_products' => count($total_products),
			'blogs'      => $blogs,
			'total_blogs' => count($total_blogs),
			'animals'    => $animals,
			'total_animals' => count($total_animals),
		]);
	}
}
