<?php

namespace App\Form;

use App\Entity\Movies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title')
            ->add('Year')
            ->add('Rated')
            ->add('Released')
            ->add('Runtime')
            ->add('Genre')
            ->add('Director')
            ->add('Writer')
            ->add('Actors')
            ->add('Plot')
            ->add('Language')
            ->add('Country')
            ->add('Awards')
            ->add('Poster')
            ->add('Ratings')
            ->add('Type')
            ->add('DVD')
            ->add('BoxOffice')
            ->add('Production')
            ->add('Website')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}
