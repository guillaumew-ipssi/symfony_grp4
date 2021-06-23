<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierProduct = [];

        foreach ($panier as $id => $quantity) {
            $panierProduct[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('panier/index.html.twig', [
            'items' => $panierProduct
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, SessionInterface $session) 
    {
        $panier = $session->get('panier', []);

        $panier[$id] = 1;

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id, SessionInterface $session) 
    {
        $panier = $session->get('panier');

        if($panier[$id]){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }
}
