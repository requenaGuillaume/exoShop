<?php

namespace App\Payment;

use App\Entity\User;
use App\Entity\Purchase;
use App\Cart\CartService;
use App\Entity\Purchaseitem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FillPurchaseWithItems
{
    private $cartService;
    private $em;

    public function __construct(CartService $cartService, EntityManagerInterface $em)
    {
        $this->cartService = $cartService;
        $this->em = $em;
    }

    public function fill(Purchase $purchase, User $user, Request $request): void
    {        
        // If user matches with the purchase and if the purchase is not paid yet
        if($purchase->getUser() === $user && $purchase->getStatus() !== Purchase::STATUS_PAID){
                
            $purchase->setStatus('Paid');                

            // Create an order line (Purchaseitem) for every product on the order (Purchase)
            foreach($this->cartService->getDetailsOfCart() as $item){
                $purchaseitem = new Purchaseitem();

                $purchaseitem->setPurchase($purchase)
                             ->setProduct($item['product'])
                             ->setName($item['product']->getName())
                             ->setPrice($item['product']->getPrice())
                             ->setQuantity($item['quantity'])
                             ->setTotalPrice($item['totalPrice'])
                             ;

                $this->em->persist($purchaseitem);
                $this->em->flush();

            }

            $this->cartService->delete();

            $request->getSession()->getFlashBag()->add('success', 'Le paiement a bien été pris en compte.'); 
        }
    }

}