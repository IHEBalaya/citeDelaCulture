<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Panier;

use PIDEVBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PanierController extends Controller
{
    public function addToCartAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $produit->setNbProduit($produit->getNbProduit() - 1);
        $panier = new Panier();
        $panier->setUser($user);
        $panier->setProduct($produit);
        $panier->setNbArticle(1);
        $panier->setTotal($panier->getNbArticle()*$produit->getPrix());
        $em->persist($panier);
        $em->persist($produit);
        $em->flush();


        return $this->render('@PIDEV/Panier/Panier.html.twig', array('paniers' => $panier,'prix'=>$produit->getPrix()));


    }

    public function showCartAction(Request $request)

    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id = $user->getId();

        $price=11;

        $p = $em->getRepository(Panier::class)->findBy($user_id);



        return $this->render('@PIDEV/Panier/Panier.html.twig', array('paniers' => $p));

    }


}
   /* public function PanierAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $handle = $this->get('cart.handle');
        $panier = $handle->checkPanierExist();
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            if (!$handle->makeModification($request)) {
                $this->get('session')->setFlash('panier', 'mm');
            } else {
                $this->get('session')->setFlash('panier', 'Modification effectuée');
            }
            return $this->redirect($this->generateUrl('Panier'));
        }
// Si panier vide on ne fait pas de requête
// Sinon on récupère son contenu
        $nbre = 0;
        if ($handle->getNombreItems() != 0) {
            $nbre = $handle->getNombreItems();
            $panier = $handle->getContenuDuPanier();
        }
        return array('panier' => $panier, 'nombre' => $nbre);
    }

    /**
     * @Route("/Ajouter/{id}", name="ajout_panier")
     * Ajouter un produit dans le panier
     */
  /*  public function ajouterAction($id)
    {
        $handle = $this->get('cart.handle');
        $produit = $handle->ajouterProduit($id);
        $this->get('session')->setFlash('panier', $produit . ' bien ajouté dans votre panier !');
        return new RedirectResponse($this->generateUrl('Panier'));
    }
}
    /*
    /**
     * @Route("/client/boutique/panier" ,name="panier")
     */


   /* /**
     * @param /Produit $item
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    /* public function AjouterAuPanierAction($item)
     {


         return $this->render('@PIDEV\Panier\ajouter_au_panier.html.twig', array(
             // ...
         ));
     }

     public function SupprimerDuPanierAction($id)
     {
         return $this->render('PIDEVBundle:Panier:supprimer_du_panier.html.twig', array(
             // ...
         ));
     }

     public function ModifierPanierAction()
     {
         return $this->render('PIDEVBundle:Panier:modifier_panier.html.twig', array(
             // ...
         ));
     }
 */

