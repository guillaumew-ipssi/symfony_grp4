<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;


class BlogController extends AbstractController
{
	/**
	 * On retourne tout les articles de blog
	 * @Route("/blog", name="blog")
	 */
	public function index()
	{
		$blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

		return $this->render('blog/index.html.twig', [
			'blogs' => $blogs,
		]);
	}

	/**
	 * On retourne le détail d'un article de blog
	 * @param int $id
	 * @Route("/blog/{id}", name="show_blog")
	 */
	public function blog($id)
	{
		$blog = $this->getDoctrine()->getRepository(Blog::class)->find($id);

		return $this->render("blog/single.html.twig", [
			"blog" => $blog
		]);
	}
}
