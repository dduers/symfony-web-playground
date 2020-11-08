<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\Persistence\ManagerRegistry;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('teaser', TextareaType::class, [
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('text', TextareaType::class, [
                'attr' => [
                    'rows' => 50
                ]
            ])
            ->add('postCategories', ChoiceType::class, [
                'choices' => [
                    'juhee' => 1
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
