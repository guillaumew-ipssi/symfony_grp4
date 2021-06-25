<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddCartType;
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
        // Récupérer tous les produits
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        // Formulaire pour filtrer les produits par le titre
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // Récupérer le paramètre et chercher les produits
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
    public function product ($id, Request $request)
    {
        // Récupérer le produit selon son id
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        
        // Si le produit n'est pas en stock, on n'ajoute pas de formulaire pour le panier
        if($product->getQuantity() > 0){

            // Formulaire pour ajouter un produit au panier avec sa quantité
            $form = $this->createForm(AddCartType::class, null, ["maxQuantity" => $product->getQuantity()]);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
    
                $data = $form->getData();
                $quantity = $data['quantity'];
                
                return $this->redirectToRoute('panier_add', [
                    'id' => $id,
                    'quantity' => $quantity
                ]);
            }
            // Si le formulaire existe on renvoie un array avec le form
            $options = ["product" => $product, "form" => $form->createView()];
        } else {
            // Sinon juste le produit
            $options = ["product" => $product];
        }

        return $this->render("product/single.html.twig", $options);
    }
}
