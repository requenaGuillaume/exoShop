<?php

namespace App\Controller\Purchase;

use App\Cart\CartService;
// use App\Entity\Purchaseitem;
use App\Payment\FillPurchaseWithItems;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PurchasePaymentSuccessController extends AbstractController
{

    /**
     * @Route("/purchase/payment/{id}/success", name="purchase_payment_success")
     * @IsGranted("ROLE_USER")
     */
    public function success($id, PurchaseRepository $purchaseRepository, FillPurchaseWithItems $filler, Request $request): Response
    {
        $purchase = $purchaseRepository->find($id);

        if(!$purchase){
            return $this->redirectToRoute('home');
        }

        $filler->fill($purchase, $this->getUser(), $request);

        return $this->redirectToRoute('purchase_list');
    }

}