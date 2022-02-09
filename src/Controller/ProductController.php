<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    private $productRepository;
    private $categoryRepository;
    private $em;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, EntityManagerInterface $em)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     * @Route("/{categorySlug<[a-z-]+>}/{productSlug<[a-z-]+>}", name="product_show", priority=-2)
     */
    public function show($categorySlug, $productSlug): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $categorySlug]);

        $product = $this->productRepository->findOneBy(['slug' => $productSlug]);

        // A REFACTORISER ? !!!!! /!\
        if(!$category){
            $this->addFlash('warning', 'La catégorie indiquée en url est inexistante.'); // ici un pb
            return $this->redirectToRoute('category_list');
        }elseif(!$product){
            $this->addFlash('danger', 'Ce produit est introuvable !');
            return $this->redirectToRoute('home');
        }

        if($category !== $product->getCategory()){
            $this->addFlash('danger', 'La catégorie ne semble pas correspondre a ce produit');
            return $this->redirectToRoute('home');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }


    /**
     * @Route("/{categorySlug<[a-z-]+>}/{productSlug<[a-z-]+>}/edit", name="product_edit")
     * @IsGranted("ROLE_ADMIN", message="Bats les pattes. Espace résérvé aux admins.")
     */
    public function edit($productSlug, Request $request): Response
    {
        $product = $this->productRepository->findOneBy(['slug' => $productSlug]);

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('product_show', [
                'categorySlug' => $product->getCategory()->getSlug(),
                'productSlug' => $product->getSlug()
            ]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'formEditProduct' => $form->createView()
        ]);
    }

    /**
     * @Route("/product/create", name="product_create", priority=1)
     * @IsGranted("ROLE_ADMIN", message="Bats les pattes. Espace résérvé aux admins.")
     */
    public function create(Request $request, SluggerInterface $slugger): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $product->setSlug(strtolower($slugger->slug($product->getName())));

            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('product_show', [
                'categorySlug' => $product->getCategory()->getSlug(),
                'productSlug' => $product->getSlug()
            ]);
        }

        return $this->render('product/create.html.twig', [
            'formCreateProduct' => $form->createView()
        ]);
    }


    /**
     * @Route("/{categorySlug<[a-z-]+>}/{productSlug<[a-z-]+>}/delete", name="product_delete")
     * @IsGranted("ROLE_ADMIN", message="Bats les pattes. Espace résérvé aux admins.")
     */
    public function delete($productSlug): Response
    {
        $this->em->remove($this->productRepository->findOneBy(['slug' => $productSlug]));
        $this->em->flush();

        $this->addFlash('success', 'Le produit a bien été supprimé du catalogue');

        return $this->redirectToRoute('home');
    }

}
