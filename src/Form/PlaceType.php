<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Century;
use App\Entity\Place;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('subtitle', TextType::class)
            ->add('address', TextType::class)
            ->add('postcode', TextType::class)
            ->add('city', TextType::class)
            ->add('country', TextType::class)
            ->add('phone', TextType::class)
            ->add('description', TextareaType::class)
            ->add('price', TextareaType::class)
            ->add('openingHours', TextareaType::class)
            ->add('rating', NumberType::class)
            ->add('accessibility', CheckboxType::class)
            ->add('guidedTour', CheckboxType::class)
            ->add('isValid', CheckboxType::class)
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('slug')
            ->add('latitude', NumberType::class)
            ->add('longitude', NumberType::class)
            ->add('website', UrlType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('centuries', EntityType::class, [
                'class' => Century::class,
                'choice_label' => 'century',
                'multiple' => true,
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
