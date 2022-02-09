<?php

namespace App\Controller\Purchase;

use App\Payment\StripeService;
use App\Repository\PurchaseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PurchasePaymentController extends AbstractController
{

    /**
     * @Route("/purchase/payment/{id}", name="purchase_payment", priority=1)
     * @IsGranted("ROLE_USER")
     */
    public function payment($id, PurchaseRepository $purchaseRepository, StripeService $stripeService, Request $request): Response
    {
        $purchase = $purchaseRepository->find($id);

        if(!$purchase){
            throw new NotFoundHttpException("Cet achat n'existe pas");
        }

        $paymentIntent = $stripeService->getPaymentIntent();

        $stripePublicKey = $stripeService->getPublicKey();

        // To include  checkout.js  properly in the <script src=""> in the template (instead of using absolute path)
        $homeUrl = $request->server->get("SYMFONY_APPLICATION_DEFAULT_ROUTE_URL");

        return $this->render('purchase/purchasePayment.html.twig', [
            'paymentIntent' => $paymentIntent,  // So we can get clientSecret
            'id' => $purchase->getId(),
            'stripePublicKey' => $stripePublicKey,
            'homeUrl' => $homeUrl
        ]);
    }

}