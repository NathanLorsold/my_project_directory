<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {   $category = $categoriesRepository->findall();
        
        
        
        return $this->render('main/index.html.twig', [
            'category' => $category,
        ]);
    }
}
