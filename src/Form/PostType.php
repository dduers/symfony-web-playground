<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\PostCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\PostCategoryRepository;

class PostType extends AbstractType
{
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }

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
            ->add('postCategories', /*EntityType::class*/ChoiceType::class, [
                //'class' => PostCategory::class,
                'attr' => [
                    'data-select-multiple' => 1,
                    'multiple' => 'multiple',
                ],
                'choice_label' => function(PostCategory $postCategory) {
                    return sprintf('(%d) %s', $postCategory->getId(), $postCategory->getName());
                },
                'by_reference' => false,
                'choices' => $this->postCategoryRepository->findAllAlphabetical(),
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
