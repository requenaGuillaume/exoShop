<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Form\PurchaseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/cart", name="cart_show")
     */
    public function show(Request $request, EntityManagerInterface $em): Response
    {
        $detailedCart = $this->cartService->getDetailsOfCart();

        $totalPrice = $this->cartService->getTotalPrice($detailedCart);

        $user = $this->getUser();

        $purchase = new Purchase();

        $form = $this->createForm(PurchaseType::class, $purchase);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $purchase->setStatus('Pending')
                     ->setCreatedAt(new \DateTimeImmutable())
                     ->setTotalPrice($totalPrice)
                     ->setUser($user);

            $em->persist($purchase);
            $em->flush();

            return $this->redirectToRoute('purchase_payment', [
                'id' => $purchase->getId()
            ]);
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $detailedCart,
            'totalPrice' => $totalPrice,
            'user' => $user,
            'formPurchase' => $form->createView()
        ]);
    }


    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id): Response
    {
        $this->cartService->addToCart($id);

        $this->addFlash('success', 'Le produit à bien été ajouté à votre panier !');

        return $this->redirectToRoute('cart_show');
    }


    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function delete($id): Response
    {
        $this->cartService->remove($id);

        $this->addFlash('success', 'Le produit à bien été supprimé de votre panier !');

        return $this->redirectToRoute('cart_show');
    }


    /**
     * @Route("/cart/decrement/{id}", name="cart_decrement")
     */
    public function decrement($id): Response
    {
        $this->cartService->decrement($id);

        $this->addFlash('success', 'Le produit à bien été retiré de votre panier !');

        return $this->redirectToRoute('cart_show');
    }
}
