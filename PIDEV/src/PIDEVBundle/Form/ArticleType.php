<?php

namespace AppBundle\Form;


use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreArticle',null, array('label' => 'Titre', 'attr' => array('class' => 'form-control')))
            ->add('typeArticle',ChoiceType::class, [
                'choices'  => [
                    'Musique' => 'Musique',
                    'Peinture' => 'Peinture',
                    'Sculpture' => 'Sculpture',
                    'Cinema' => 'Cinema',
                    'Literature' => 'Literature',
                ],
            ], array('label' => 'Type', 'attr' => array('class' => 'form-control')))
            ->add('descriptionArticle',TextareaType::class, array('label' => 'Description', 'attr' => array('class' => 'form-control')))
            ->add('contenuArticle', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                )))
            ->add('imageArticle',FileType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
