<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Produit;
use PIDEVBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    /**
     * @Route("/Shop")
     */
    public function BoutiqueAction()
    {
        $produits=$this->getDoctrine()
            ->getRepository(Produit::class)->findAll();
        return $this->render('@PIDEV\Produit\Shop.html.twig', array(
            'produits'=>$produits
        ));

    }
    /**
     * @Route("/admin/ajouterProduit" ,name="ajouterProduit")
     */
    public function ajouterProduitAction(Request $request)
    {
        //1ere etape
        //preparation du modle objet vide
        $modele= new Produit();
        //Preparation formulaire
        $form =$this->createForm(ProduitType::class,$modele);
        //2eme etape
        // requête de recuperation des données
        $form =$form->handleRequest($request);
        //test if our form is valid
        if ($form->isValid())
        {
            //3eme etape
            //enregistrement base de données
            //declaration entity manager
            $em=$this->getDoctrine()->getManager();
            //persister l objet dans l'ORM
            $em->persist($modele);
            //Sauvgarder les données dans la db
            $em->flush();
            //retour l affichage
            return $this->redirectToRoute('pidev_Shop');



        }
        return $this->render('@PIDEV\Produit\ajouterProduit.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function modifierProduitAction(Request $request,$ref)
    {
        //1ere étape

        $em= $this->getDoctrine()->getManager(); //1)appel manager pour modification
        $modele=$em->getRepository(Produit::class)->find($ref); //2)Recuperation des données(objet avec id en parametres)
        //2eme etape
        //Preparation formulaire
        $form =$this->createForm(ProduitType::class,$modele);
        //4eme etape recuperation formulaire
        $form =$form->handleRequest($request);
        if($form->isValid())
        {
            //enregistrement base de données
            //Sauvgarder les données dans la db
            $em->flush();
            //retour au read a l affichage
            return $this->redirectToRoute('pidev_ShopAdmin');
        }
        //envoie formulaire
        return $this->render('@PIDEV\Produit\modifierProduit.html.twig', array(
            'form'=>$form->createView()
        ));
    }
    public function deleteProduitAction($ref)
    {
        $em= $this->getDoctrine()->getManager();
        $modele= $em->getRepository(Produit::class)->find($ref);
        $em->remove($modele);
        $em->flush();
        return $this->redirectToRoute('pidev_ShopAdmin');
    }

    public function shopAdminAction()
    {
        $produits=$this->getDoctrine()
            ->getRepository(Produit::class)->findAll();
        return $this->render('@PIDEV\Admin\ShopAdmin.html.twig', array(
            'produits'=>$produits
        ));

    }

    /*
    public function gererProduitAction(Request $request) {
        $user = $this->getUser();
        $produit = new Produit();
        $em = $this->getDoctrine()->getManager();
        $Form=$this->CreateForm(ProduitType::class,$produit);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid())
        {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
           /* $file1 = $produit->getImage1();
            $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
            $file1->move(
                $this->getParameter('produit_directory'),
                $fileName1
            );
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
          /*  $file2 = $produit->getImage2();
            $fileName2 = $this->generateUniqueFileName().'.'.$file2->guessExtension();
            $file2->move(
                $this->getParameter('produit_directory'),
                $fileName2
            );
            $produit->setImage1($fileName1);
            $produit->setImage2($fileName2);
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('afficheProduit');
        }

        return $this->render('AppBundle:admin:ajouterProduit.html.twig',array(
            'user' => $user,
            'form'=>$Form->createView()
        ));
    }

    public function uploadImage($file)
    {
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
      /*  $file1 = $file;
        $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
        $file1->move(
            $this->getParameter('produit_directory'),
            $fileName1
        );
        return $fileName1 ;
    }


    /**
     * @Route("/admin/afficheProduit" ,name="afficheProduit")
     */
   /* public function AfficheAction(Request $request)
    {
        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AppBundle:Produit")->findAll();
        return $this->render('AppBundle:admin:afficheProduit.html.twig', array(
            'produits'=>$produits,
            'user' => $user,
        ));
    } */
    public function renderBoutique($params)
    {
        return $this->render("@PIDEV/Produit/Shop.html.twig", $params);
    }
    /**
     * @return string
     */
   /* private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
*/

}
