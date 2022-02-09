<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private $categoryRepository;
    private $em;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     * @Route("/category", name="category_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function list(): Response
    {
        // Categories are already usable in template cause  @App\\Repository\\CategoryRepository  in twig.yaml
        return $this->render('category/index.html.twig');
    }


    /**
     * @Route("/category/{slug<[a-z-]+>}", name="category_show", priority=-1)
     */
    public function show($slug): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $slug]);

        if(!$category){
            $this->addFlash('danger',"La catégorie demandée n'existe pas.<br>Ci-dessous la liste des catégories existantes.");
            return $this->redirectToRoute('category_list');
        }

        return $this->render('category/show.html.twig', ['category' => $category]);
    }


    /**
     * @Route("/category/{slug<[a-z-]+>}/edit", name="category_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit($slug, Request $request): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $slug]);

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('category_show', [
                'slug' => $category->getSlug()
            ]);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'formEditCategory' => $form->createView()
        ]);
    }


    /**
     * @Route("/category/create", name="category_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, SluggerInterface $slugger): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category->setSlug($slugger->slug(strtolower($category->getName())))
                     ->setName(strtolower($category->getName()));

            $this->em->persist($category);
            $this->em->flush();

            return $this->redirectToRoute('category_show', [
                'slug' => $category->getSlug()
            ]);
        }

        return $this->render('category/create.html.twig', [
            'formCreateCategory' => $form->createView()
        ]);
    }


    /**
     * @Route("/category/{slug<[a-z-]+>}/delete", name="category_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete($slug): Response
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $slug]);
        $this->em->remove($category);
        $this->em->flush();

        $this->addFlash('success', 'La catégorie à bel et bien été supprimée.');

        return $this->redirectToRoute('category_list');
    }
}
