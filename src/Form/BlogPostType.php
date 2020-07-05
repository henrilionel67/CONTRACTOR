<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('content', FroalaEditorType::class, [
                "language" => "en",
                "toolbarInline" => true,
                "tableColors" => [ "#FFFFFF", "#FF0000" ],
                "saveParams" => [ "id" => "myEditorField" ]
            ])
            ->add('slug', TextType::class,
                    ['required' => false, 'attr' => ['placeholder' => 'www.example.com']])
            ->add('save', SubmitType::class,
                    ['label' => 'Save Article'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
