<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchaseListController extends AbstractController

{

    /**
     * @Route("purchase/list/", name="purchase_list", priority=1)
     * @IsGranted("ROLE_USER", message="Vous devez vous connecter pour accéder à cette page")
     */
    public function list(): Response
    {
        /** @var User */
        $user = $this->getUser();

        $purchases = $user->getPurchases();

        return $this->render('purchase/purchaseList.html.twig', [
            'purchases' => $purchases
        ]);

    }

}