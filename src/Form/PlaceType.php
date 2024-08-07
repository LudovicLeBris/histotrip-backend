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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;

class PlaceType extends AbstractType
{
    public function __construct(
        private SluggerInterface $slugger
    ) {}
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Château de Versailles'],
                ])
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre',
                'required' => false,
                'attr' => ['placeholder' => 'Résidence du Roi Soleil'],
                ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
                'attr' => ['placeholder' => 'Place d\'Armes'],
            ])
            ->add('postcode', TextType::class, [
                'label' => 'Code postal',
                'attr' => ['placeholder' => '78000'],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => ['placeholder' => 'Versailles'],
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => ['placeholder' => 'France'],
            ])
            ->add('latitude', NumberType::class, [
                'attr' => ['placeholder' => '48.80550086167535'],
            ])
            ->add('longitude', NumberType::class, [
                'attr' => ['placeholder' => '2.120441230688502'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => ['placeholder' => '01 30 83 78 00'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['placeholder' => 'Le château de Versailles est un château et un monument historique français situé à Versailles dans les Yvelines. Il fut la résidence principale des rois de France Louis XIV, Louis XV et Louis XVI.'],
            ])
            ->add('website', UrlType::class, [
                'label' => 'Site internet',
                'required' => false,
                'attr' => ['placeholder' => 'https://www.chateauversailles.fr/'],
            ])
            ->add('price', TextareaType::class, [
                'label' => 'Prix',
                'required' => false,
                'attr' => ['placeholder' => '21€'],
            ])
            ->add('openingHours', TextareaType::class, [
                'label' => 'Heures d\'ouvertures',
                'required' => false,
                'attr' => ['placeholder' => 'lundi	Fermé
                    mardi	09:00–18:30
                    mercredi	09:00–18:30
                    jeudi	09:00–18:30
                    vendredi	09:00–18:30
                    samedi	09:00–18:30
                    dimanche	09:00–18:30
                    '],
            ])
            ->add('accessibility', CheckboxType::class, [
                'label' => 'Aménagements handicapés',
                'required' => false,
            ])
            ->add('guidedTour', CheckboxType::class, [
                'label' => 'Visite guidée',
                'required' => false,
            ])
            ->add('isValid', CheckboxType::class, [
                'label' => 'Lieu validé'
            ])
            ->add('rating', NumberType::class, [
                'label' => 'Note',
                'required' => false,
            ])
            // ->add('slug', TextType::class, [])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Catégories'
            ])
            ->add('centuries', EntityType::class, [
                'class' => Century::class,
                'choice_label' => 'century',
                'multiple' => true,
                'label' => 'Siècles couverts'
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Tags',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Validez'
            ])
        ;

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
            $place = $event->getData();
            if (!$place || null === $place->getId()) {
                $slug = $this->slugger->slug($place->getName());
                $place->setSlug($slug);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
