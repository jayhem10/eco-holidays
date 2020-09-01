<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Title", "Title"))
            ->add('price', MoneyType::class, $this->getConfiguration("Price per night", "Price per night"))
            ->add('introduction', TextType::class, $this->getConfiguration("Description", "X travellers . X rooms . X bed . X bathroom"))
            ->add('slug', TextType::class, $this->getConfiguration("Location", "Location"))
            ->add('content', TextareaType::class, $this->getConfiguration("Content", "Talk about the house and the environment"))
            ->add('coverImage', FileType::class, $this->getConfiguration("File", "Choose a file"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Rooms", "Rooms"))
            ->add('max', TextType::class, $this->getConfiguration("Max person(s)", "Maximum number of people in the apartment"))
            ->add('size', TextType::class, $this->getConfiguration("Size", "Size of the accomodation"))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
