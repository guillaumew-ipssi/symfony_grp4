<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $session = $this->requestStack->getSession();

        // Si panier n'existe pas dans la session, alors on retourne un array vide
        $panier = $session->get('panier', []);

        $panierProduct = [];

        // On récupère les entités produits selon l'id, pour avoir le produit complet et non juste son id
        foreach ($panier as $id => $quantity) {
            $panierProduct[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierProduct
        ]);
    }

    /**
     * @Route("/panier/add/{id}/{quantity}", name="panier_add")
     */
    public function add($id, $quantity) 
    {
        $session = $this->requestStack->getSession();

        $panier = $session->get('panier', []);

        // On ajoute l'id du produit choisit et sa quantité
        $panier[$id] = $quantity;

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id) 
    {

        $session = $this->requestStack->getSession();
        
        $panier = $session->get('panier');

        // On supprime l'id contenu dans le panier
        if($panier[$id]){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }
}
