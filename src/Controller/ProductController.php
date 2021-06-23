<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(Request $request): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $param_search = $data['search_text'];
            $products = $this->getDoctrine()->getRepository(Product::class)->findByTitle($param_search);

            return $this->render('product/index.html.twig', [
                'products' => $products,
                'form' => $form->createView()
            ]);    
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $id
     * @Route("/product/{id}", name="show_product")
     */
    public function product ($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        return $this->render("product/single.html.twig", [
            "product" => $product
        ]);
    }
}
