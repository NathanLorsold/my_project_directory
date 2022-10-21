<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\PanierRepository;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session, ProductsRepository $productsRepository): Response
    
    {
        $panier = $session->get("panier", []);

        //On fabrique les données
        $panierplein = [];
        $total = 0;

        foreach($panier as $id => $quantite) {
            $product = $productsRepository->find($id);
            //Information à afficher à l'utilisateur dans le fichier twig.
            $panierplein[] = [
                "product" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getUnitPrice() * $quantite;      
        }
        
        return $this->render('panier/index.html.twig', compact("panierplein", "total"));
    }

    #[Route('/panier/add/{id}', name: 'app_ajout', methods: ['GET'])]
    public function add($id, SessionInterface $session)
    {
        //On récupère le panier actuel
        $panier = $session->get("panier", []);

        if(!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        //On sauvegarde dans la session
        $session->set("panier", $panier);
        
        return $this->redirectToRoute("app_panier");
    }

    #[Route('/panier/remove/{id}', name: 'app_remove', methods: ['GET'])]
    public function remove($id, SessionInterface $session)
    {
        //On récupère le panier actuel
        $panier = $session->get("panier", []);
        //Vérification si on contient quelque chose dans le panier
        if(!empty($panier[$id])) {
            if ($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        //On sauvegarde dans la session
        $session->set("panier", $panier);
        
        return $this->redirectToRoute("app_panier");
    }

    #[Route('/panier/delete/{id}', name: 'app_delete', methods: ['GET'])]
    public function delete($id, SessionInterface $session)
    {        
        
        //On récupère le panier actuel
        $panier = $session->get("panier", []);

        unset($panier[$id]);

        $session->set("panier", $panier);
        return $this->redirectToRoute("app_panier");
    }


    #[Route('/panier/delete', name: 'app_delete_all')]
    public function deleteAll(SessionInterface $session)
    {

        $session->remove("panier");
        
        return $this->redirectToRoute("app_panier");
    }
}
