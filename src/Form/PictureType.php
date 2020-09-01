<?php

namespace App\Form;

use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PictureType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            
            ->add('newImage', FileType::class, $this->getConfiguration("Profile picture", "Modify your picture"), array('data_class' => null))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
