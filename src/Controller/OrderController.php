<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderLine;
use App\Repository\ProductRepository;
use App\Service\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USER')")
 */
class OrderController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/order_valid", name="order_valid")
     */
    public function orderValid(ProductRepository $productRepository): Response
    {

        $session = $this->requestStack->getSession();

        // On récupère le panier
        $panier = $session->get('panier', []);

        // On créé une nouvelle commande
        $order = new Order();
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUser($this->getUser());
        $totalOrder = 0;

        $em = $this->getDoctrine()->getManager();

        // On créé une ligne par produit
        foreach ($panier as $id => $quantity) {

            // Création d'une ligne qui compose une commande
            $orderLine = new OrderLine();

            // On récupère le produit selon son id
            $product = $productRepository->find($id);
            // Stock initial du produit
            $product_quantity = $product->getQuantity();

            $orderLine->setProduct($product);
            $orderLine->setQuantity($quantity);
            $total = $product->getPrice() * $quantity;
            $orderLine->setTotal($total);
            $orderLine->setCustomerOrder($order);

            // Nouveau stock du produit, et update en base
            $product_new_quantity = $product_quantity - $quantity;
            $productRepository->updateQuantity($product->getId(), $product_new_quantity);

            // On récupère le total de chaque ligne pour obtenir le total de la commande
            $totalOrder += $total;
            $order->addOrderLine($orderLine);
            
            $em->persist($orderLine);
            
        }
        $order->setTotal($totalOrder);
        
        $em->flush();
        
        $em->persist($order);
        $em->flush();

        $session->set('panier', []);

        return $this->render('order/order_valid.html.twig');
    }

    /**
     * @Route("/order_list", name="order_list")
     */
    public function list_order(): Response
    {
        // On récupère uniquement les commandes qui concernent l'user connecté
        $orders = $this->getDoctrine()->getRepository(Order::class)->findOrderByUser($this->getUser());

        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/order_show/{id}", name="order_show")
     */
    public function show_order($id): Response
    {

        // On récupère les lignes de la commande, avec le détail du produit
        $order = $this->getDoctrine()->getRepository(OrderLine::class)->findWithProduct($id);

        return $this->render('order/order_show.html.twig', [
            'order' => $order,
            'orderId' => $id
        ]);
    }
}
