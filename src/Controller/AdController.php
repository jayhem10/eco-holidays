<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AdType;
use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(EntityManagerInterface $manager)
    {
        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "active";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";
        

        $ad = $manager->createQuery("SELECT a FROM App\Entity\Ad a where MOD(a.id,2)=1")->getResult();
        $pair = $manager->createQuery("SELECT a FROM App\Entity\Ad a where MOD(a.id,2)=0")->getResult();


        return $this->render('ad/index.html.twig', [
            'ad' => $ad,
            'pair' => $pair,
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
     * Créer un annonce
     * 
     * @Route("/ads/new", name="ads_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){

        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";

        $user1 = $this->getUser()->getId();

        $user = $manager->getRepository(User::class)->find($user1);
        
        $ad = new Ad();

        $form = $this->createForm(AdType::class, $ad);

        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $ad->getCoverImage();
            $fileName = 'images/'. md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $ad->setCoverImage($fileName);
            $ad->setAuthor($user);
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                'success',
                "The ad  <strong>{$ad->getTitle()}</strong> has been recorded !"
            );
            

            return $this->redirectToRoute('ads_show', [
                'id' => $ad->getId()
            ]);
        }

        return $this->render('ad/new.html.twig',[
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
     * Affichage d'une seule annonce
     * 
     * @Route("/ads/{id}", name="ads_show")
     */
    public function show(Ad $ad){
        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";


    return $this->render('ad/show.html.twig', [
        'ad'=> $ad,
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
     * Ajouter une image
     * 
     * @Route("/ads/{id}/image", name="ads_image")
     *
     * 
     * @return Response
     */
    public function newimage(Request $request, EntityManagerInterface $manager){

        $active1 = "";
        $active2 = "";
        $active3 = "";
        $active4 = "";
        $active5 = "";
        $active6 = "";
        $active7 = "";
        $active8 = "";

        $id1 = $request->attributes->get('id');

        $id = $manager->getRepository(Ad::class)->find($id1);

        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $image->setAd($id);
            $file = $image->getUrl();
            dump($image);
            $fileName = 'images/' . md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $image->setUrl($fileName);
            $manager->persist($image);
            $manager->flush();

            $this->addFlash(
                'success',
                "The picture has been recorded !"
            );
            

            return $this->redirectToRoute('ads_show', [
                'id' => $id1
            ]);
        }

        return $this->render('ad/newimage.html.twig',[
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




}




