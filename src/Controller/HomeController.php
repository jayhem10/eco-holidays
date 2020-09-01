<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    /**
     * @Route("/", name="home")
     * 
     */
    public function home(EntityManagerInterface $manager)
    {

        $active1 = "active";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";
        

        $ad = $manager->createQuery("SELECT a FROM App\Entity\Ad a where MOD(a.id,2)=1 ORDER BY a.id ASC")->getResult();
        $pair = $manager->createQuery("SELECT a FROM App\Entity\Ad a where MOD(a.id,2)=0 ORDER BY a.id ASC")->getResult();

        return $this->render('site/home.html.twig', [
            'ad' => $ad,
            'pair' => $pair,
            'active1' => $active1,
            'active2' => $active2,
            'active3' => $active3,
            'active4' => $active4,
            'active5' => $active5,
            'active6' => $active6,
            'active7' => $active7,
            'active8' => $active8,
        ]);
        
    }

    /**
     * @Route("/about", name="about")
     * 
     */
    public function about()
    {
       
        $active1 = "";
        $active2 = "active";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";
        

        return $this->render('site/about.html.twig',[
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active5' => $active5,
            'active6' => $active6,
            'active7' => $active7,
            'active8' => $active8,
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     * 
     */
    public function contact()
    {
        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "active";
        $active7 = "";
        $active8 = "";

        return $this->render('site/contact.html.twig',[
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
     * @Route("/blog", name="blog")
     * 
     */
    public function blog()
    {

        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "active";
        $active6 = "";
        $active7 = "";
        $active8 = "";

        return $this->render('site/blog.html.twig',[
            'active5' =>$active5,
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active6' => $active6,
            'active7' => $active7,
            'active8' => $active8,
        ]);
    }



    /**
     * @Route("/services", name="services")
     * 
     */
    public function services()
    {

        $active1 = "";
        $active2 = "";
        $active3 = "active";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";

        return $this->render('site/services.html.twig',[
            'active5' =>$active5,
            'active2' => $active2,
            'active1' => $active1,
            'active3' => $active3,
            'active4' => $active4,
            'active6' => $active6,
            'active7' => $active7,
            'active8' => $active8,
        ]);
    }

    public function account(EntityManagerInterface $manager,  Request $request)
    {

        // Je récupère l'ID de l'user connecté pour n'afficher que ses propres éléments de collection
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser()->getId();

        $follows = $manager->createQuery("SELECT f FROM App\Entity\Follow f WHERE f.follower = $user")->getResult();

        // Je crée la requête DQL qui récupère dans la table collection les éléments en rapport avec l'id de l'utilisateur connecté
        $listes = $manager->createQuery("SELECT c FROM App\Entity\Collection c WHERE c.user = $user")->getResult(); 

        // Je récupère la catégorie des éléments
        $cat = $manager->createQuery("SELECT k FROM App\Entity\Category k")->getResult();          

        return $this->render('site/account.html.twig', [
          'listes'=> $listes,
          'cat' => $cat,
          'follows'=>$follows
        ]);
    }


}



?>