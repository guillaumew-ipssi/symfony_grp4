<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/order", name="order")
     */
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/order_valid", name="order_valid")
     */
    public function orderValid(ProductRepository $productRepository): Response
    {

        $session = $this->requestStack->getSession();

        $panier = $session->get('panier', []);

        $order = new Order();
        $totalOrder = 0;

        $em = $this->getDoctrine()->getManager();

        foreach ($panier as $id => $quantity) {
            $orderLine = new OrderLine();

            $product = $productRepository->find($id);
            $product_quantity = $product->getQuantity();

            $orderLine->setProduct($product);
            $orderLine->setQuantity($quantity);
            $total = $product->getPrice() * $quantity;
            $orderLine->setTotal($total);
            $orderLine->setCustomerOrder($order);

            $product_new_quantity = $product_quantity - $quantity;
            $productRepository->updateQuantity($product->getId(), $product_new_quantity);

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

        $orders = $this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/order_show/{id}", name="order_show")
     */
    public function show_order($id): Response
    {

        $order = $this->getDoctrine()->getRepository(OrderLine::class)->findBy(['customerOrder'=> $id]);

        $products = [];
        for ($i=0; $i < count($order); $i++) { 
            $product = $this->getDoctrine()->getRepository(Product::class)->findBy(["id" => $order[$i]->getProduct()->getId()]);
            $products[$i]["order"] = $order;
            $products[$i]["product"] = $product;
        }

        return $this->render('order/order_show.html.twig', [
            'products' => $products,
            'orderId' => $id
        ]);
    }
}
