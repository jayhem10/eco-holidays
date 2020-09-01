<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Form\PictureType;
use App\Entity\ImageUpdate;
use App\Entity\UpdatePassword;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
/**
 * @Route("/login", name="security_login")
 */
public function login(AuthenticationUtils $utils){

    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "active";
    $active8 = "";

    $error = $utils->getLastAuthenticationError();
    $username = $utils->getLastUsername();

    return $this->render('account/login.html.twig', [
        'hasError' => $error !== null,
        'username' => $username,
        'active6' => $active6,
        'active2' => $active2,
        'active1' => $active1,
        'active3' => $active3,
        'active4' => $active4,
        'active5' => $active5,
        'active7' => $active7,
        'active8' => $active8,
    ]);

}

/**
 * @Route("/logout", name="security_logout")
 */
public function logout(){


}

/**
 * @Route("/register", name="security_register")
 * 
 * @return Response
 */
public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){


    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "";
    $active8 = "active";


        $user = new User();

        $form = $this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user->setSlug("");
            $file = $user->getPicture();
            $fileName = 'images/profile/'. md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('profile_directory'), $fileName);
            $user->setPicture($fileName);
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Account created, you can log in !"
            );

            return $this->redirectToRoute('security_login');
        }

        return $this->render('account/registration.html.twig',[
            'form'=> $form->createView(),
            'active6' => $active6,
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active5' => $active5,
            'active7' => $active7,
            'active8' => $active8,
        ]);

    }


                                                                // GESTION DU COMPTE

    /**
     * @Route("/account", name="account")
     * 
     * @IsGranted("ROLE_USER")
     */
    public function account(EntityManagerInterface $manager,  Request $request)
    {

        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";
    
        // Je récupère l'ID de l'user connecté pour n'afficher que ses propres éléments de collection
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser()->getId();

     dump($user);

        return $this->render('account/account.html.twig', [
            'active6' => $active6,
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active5' => $active5,
            'active7' => $active7,
            'active8' => $active8,
        ]);
    }



/**
 * Permet d'afficher et de traiter le formulaire de modification du profil
 * 
 * @Route("/account/profile", name="security_profile")
 * 
 * @IsGranted("ROLE_USER")
 * 
 */
public function profile(Request $request, EntityManagerInterface $manager){

    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "";
    $active8 = "";


    $user = $this->getUser();

    $form = $this->createForm(AccountType::class , $user );

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){


        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "Les données ont été modifiées avec succès !"
        );

        return $this->redirectToRoute('account');
    }

    return $this->render('account/profile_modify.html.twig', [
        'form'=> $form->createView(),
        'active6' => $active6,
        'active2' => $active2,
        'active1' => $active1,
        'active3' => $active3,
        'active4' => $active4,
        'active5' => $active5,
        'active7' => $active7,
        'active8' => $active8,
    ]);

        
    }



    /**
 * Permet d'afficher et de traiter le formulaire de modification du mot de passe
 * 
 * @Route("/account/password-update", name="security_password")
 * @IsGranted("ROLE_USER")
 * @return Response
 * 
 */
public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager){

    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "";
    $active8 = "";

    $user = $this->getUser();

    $passwordUpdate = new UpdatePassword();

    $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);


    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        // 1. Vérifier que le oldPassword est le même que celui en base de données
        if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
            // Gérer l'erreur
            $form->get('oldPassword')->addError(new FormError("The password you entered is not your current password!"));
        }
        else {
            $newPassword = $passwordUpdate->getNewPassword();
            $hash = $encoder->encodePassword($user, $newPassword);

            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "Le mot de passe a été modifié avec succès !"
            );

            return $this->redirectToRoute('account');
        }

    }


    return $this->render('account/password.html.twig', [
        'form' => $form->createView(),
        'active6' => $active6,
        'active2' => $active2,
        'active1' => $active1,
        'active3' => $active3,
        'active4' => $active4,
        'active5' => $active5,
        'active7' => $active7,
        'active8' => $active8,
    ]);
        
    }


    /**
 * Permet d'afficher et de traiter le formulaire de modification de la photo de profil
 * 
 * @Route("/account/profile_picture", name="security_picture")
 * 
 * @IsGranted("ROLE_USER")
 * 
 */
public function picture(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){

    $active1 = "";
    $active2 = "";
    $active3 = "";
    $active4 = "";
    $active5 = "";
    $active6 = "";
    $active7 = "";
    $active8 = "";


    $user = $this->getUser();

    $imageUpdate = new ImageUpdate();

    $form = $this->createForm(PictureType::class , $imageUpdate );

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
     
        $file = $imageUpdate->getNewImage();
        dump($file);
        $fileName = 'images/profile/'. md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->getParameter('profile_directory'), $fileName);
        $user->setPicture($fileName);
     
        $manager->persist($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "Profile picture updated!"
        );

        return $this->redirectToRoute('account');
    }

    return $this->render('account/profile_picture.html.twig', [
        'form'=> $form->createView(),
        'active6' => $active6,
        'active2' => $active2,
        'active1' => $active1,
        'active3' => $active3,
        'active4' => $active4,
        'active5' => $active5,
        'active7' => $active7,
        'active8' => $active8,
    ]);

        
    }

        /**
     * @Route("/account/ads", name="myads")
     */
    public function myads(EntityManagerInterface $manager)
    {
        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";
        
        $user = $this->getUser()->getId();

        $myads = $manager->createQuery("SELECT a FROM App\Entity\Ad a where a.author = $user")->getResult();


        return $this->render('account/myads.html.twig', [
            'myads' => $myads,
            'active6' => $active6,
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active5' => $active5,
            'active7' => $active7,
            'active8' => $active8,
        ]);
    }

}