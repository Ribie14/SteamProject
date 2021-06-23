<?php

namespace App\Form;
use App\Entity\Games;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', EntityType::class, [
                'class' => Games::class,
                'choice_label' => 'titre'
        ])
        ->add('categorie', EntityType::class, [
            'class' => Games::class,
            'choice_label' => 'categorie'
    ])
        
            ->add('recherche', SubmitType::class);
    }
}