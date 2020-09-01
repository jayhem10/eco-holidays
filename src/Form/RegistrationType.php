<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Firstname", "Your firstname"))
            ->add('lastName',TextType::class, $this->getConfiguration("Lastname", "Your lastname"))
            ->add('email',EmailType::class, $this->getConfiguration("Email", "Your email"))
            ->add('picture',FileType::class, $this->getConfiguration("Profile picture", "Add your picture"))
            ->add('hash',PasswordType::class, $this->getConfiguration("Password", "Add a strong password"))
            ->add('passwordConfirm',PasswordType::class, $this->getConfiguration("Confirm password", "Confirm your password"))
            ->add('introduction',TextType::class, $this->getConfiguration("Introduction", "Describe yourself in few words"))
            ->add('description',TextType::class, $this->getConfiguration("Description", "Describe yourself with more details"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
