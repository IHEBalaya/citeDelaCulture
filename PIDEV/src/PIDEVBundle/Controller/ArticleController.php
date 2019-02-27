<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\CommentaireArticle;
use AppBundle\Entity\Reaction;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all article entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AppBundle:Article a Where a.statutArticle='public'";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        // parameters to template
        return $this->render('article/index.html.twig', array('articles' => $pagination));


    }

    public function deleteCommentAction(Article $article,CommentaireArticle $commentaireArticle)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaireArticle);
        $em->flush();

        return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
    }

    public function noPublishAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articlesB = $em->getRepository('AppBundle:Article')->findBy(['statutArticle'=>'brouillon','journaliste'=>$this->getUser()]);
        $articlesP = $em->getRepository('AppBundle:Article')->findBy(['statutArticle'=>'public','journaliste'=>$this->getUser()]);

        return $this->render('article/myArticles.html.twig', array(
            'articlesP' => $articlesP,
            'articlesB' => $articlesB,
        ));
    }


    public function statAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articlesBrouillon = $em->getRepository('AppBundle:Article')->findBy(['statutArticle'=>'brouillon','journaliste'=>$this->getUser()]);
        $articlesPublic = $em->getRepository('AppBundle:Article')->findBy(['statutArticle'=>'public','journaliste'=>$this->getUser()]);
        $likesCounter=0;
        $DislikesCounter=0;
        foreach ($articlesPublic as $ap)
        {
            $likes = $em->getRepository('AppBundle:Reaction')->findBy(['idArticle' => $ap->getIdarticle(), 'reaction' => 1]);
            $likesCounter=$likesCounter+sizeof($likes);
        }
        foreach ($articlesPublic as $ap)
        {
            $dislikes = $em->getRepository('AppBundle:Reaction')->findBy(['idArticle' => $ap->getIdarticle(), 'reaction' => 0]);
            $DislikesCounter=$DislikesCounter+sizeof($dislikes);
        }
        $counter = 0;
        $apublic=sizeof($articlesPublic);
        $abrouiilon=sizeof($articlesBrouillon);
        foreach ($articlesPublic as $ap)
        {
            $commentaireArticles = $em->getRepository('AppBundle:CommentaireArticle')->findBy(['idArticle'=>$ap->getIdarticle()]);
            $counter=$counter+sizeof($commentaireArticles);
        }



        return $this->render('article/stat.html.twig', array(
            'counter' => $counter,
            'aPublic' => $apublic,
            'aBrouillon' => $abrouiilon,
            'likesCounter' => $likesCounter,
            'dislikesCounter' => $DislikesCounter,
        ));
    }

    public function likeAction(Article $article,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reactionex = $em->getRepository('AppBundle:Reaction')->findOneBy(['reacteur'=>$this->getUser(),'idArticle'=>$article]);
        if($reactionex!=null and $reactionex->getReaction()==0){
            $reactionex->setReaction(1);
            $em->persist($reactionex);
            $em->flush();
            return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }
        else{
            $reaction = new Reaction();
            $reaction->setIdArticle($article);
            $reaction->setReacteur($this->getUser());
            $reaction->setReaction(1);
            $em->persist($reaction);
            $em->flush();

            return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }
    }

    public function dislikeAction(Article $article,Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $reactionex = $em->getRepository('AppBundle:Reaction')->findOneBy(['reacteur'=>$this->getUser(),'idArticle'=>$article]);
        if($reactionex!=null and $reactionex->getReaction()==1){
            $reactionex->setReaction(0);
            $em->persist($reactionex);
            $em->flush();
            return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }
        else{
        $reaction = new Reaction();
        $reaction->setIdArticle($article);
        $reaction->setReacteur($this->getUser());
        $reaction->setReaction(0);
        $em->persist($reaction);
        $em->flush();

        return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }
    }

    /**
     * Creates a new article entity.
     *
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $article->getImageArticle();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $fileName);
            $article->setImageArticle($fileName);


            $article ->setStatutArticle("brouillon");
            $article->setJournaliste($this->getUser());
            $article->setDatePublication(new \DateTime('now'));
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }


    public function publishAction(Article $article,Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $article->setStatutArticle('public');
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute('article_no_publish');
    }


    /**
     * Finds and displays a article entity.
     *
     */
    public function showAction(Article $article,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaireArticle = new Commentairearticle();
        $form = $this->createForm('AppBundle\Form\CommentaireArticleType', $commentaireArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireArticle->setDateCommentaire(new \DateTime('now'));
            $commentaireArticle->setCommentateur($this->getUser());
            $commentaireArticle->setIdArticle($article);

            $em->persist($commentaireArticle);
            $em->flush();

            return $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));
        }



        $deleteForm = $this->createDeleteForm($article);

        $commentaireArticles = $em->getRepository('AppBundle:CommentaireArticle')->findBy(['idArticle'=>$article->getIdarticle()]);

        $reaction = $em->getRepository('AppBundle:Reaction')->findOneBy(['reacteur'=>$this->getUser(),'idArticle'=>$article]);
        $reactionsLike = $em->getRepository('AppBundle:Reaction')->findBy(['reaction'=>1,'idArticle'=>$article]);
        $reactionsDislike = $em->getRepository('AppBundle:Reaction')->findBy(['reaction'=>0,'idArticle'=>$article]);
$nbrDislike=sizeof($reactionsDislike);
$nbrLike=sizeof($reactionsLike);

        return $this->render('article/show.html.twig', array(
            'reaction'=>$reaction,
            'nbrDislike'=>$nbrDislike,
            'nbrLike'=>$nbrLike,
            'commentaireArticles'=>$commentaireArticles,
            'article' => $article,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     */
    public function editAction(Request $request, Article $article)
    {
        $article->setImageArticle(null);

        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('AppBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $article->getImageArticle();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $fileName);
            $article->setImageArticle($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_edit', array('idArticle' => $article->getIdarticle()));
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a article entity.
     *
     */
    public function deleteAction(Article $article)
    {


            $em = $this->getDoctrine()->getManager();

        $commentaireArticles = $em->getRepository('AppBundle:CommentaireArticle')->findBy(['idArticle'=>$article->getIdarticle()]);
foreach ($commentaireArticles as $a)
{
    $em->remove($a);
    $em->flush();
}
        $reactionArticles = $em->getRepository('AppBundle:Reaction')->findBy(['idArticle'=>$article->getIdarticle()]);
        foreach ($reactionArticles as $a)
        {
            $em->remove($a);
            $em->flush();
        }

        $em->remove($article);
            $em->flush();

        return $this->redirectToRoute('article_no_publish');
    }

    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('idArticle' => $article->getIdarticle())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function pdfAction(Article $article)
    {

        $pageUrl = $this->redirectToRoute('article_show', array('idArticle' => $article->getIdarticle()));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            'file.pdf'
        );

    }

}


