<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;  // import fait car on utilise l'entité User pour faire le formulaire
use App\Form\UserType; // utilisé pour créer notre formulaire User

class UserController extends AbstractController {
    /**
    * @Route("/user")
    */
    public function createUserFrom(Request $request) {  // on ajoute Request pour gérer les données mises via POST lors d'une soumission
        $user = new User();  // creation d'une instance User
        
        /* on enleve cette partie car on a ensuite créé la classe UserType pour créer un formulaire User */
        // $form = $this->createFormBuilder($user); //on passe notre instance user en param de la méthode de creation d'un formulaire provenant de AbstractController
        // $form->add('name', TextType::class )  // on ajoute les champs voulus
        //      ->add('email', EmailType::class)
        //      ->add('date', DateType::class)    // en ajoutant ce champ, il faut que celui-ci soit aussi dans l'entité User => on le modifie en consequence !!!
        //      ->add('creer', SubmitType::class);
        //$form = $form->getForm();  // on construit le formulaire : il faut bien faire ainsi, afin de pouvoir ensuite rendre dans la vue le formulaire via la méthode createView()!
        
        $form = $this->createForm(UserType::class, $user);  // on crée le formulaire via le UserType et notre objet User

        $form->handleRequest($request);  //on inspect request pour voir si des données POST sont présentes

        if($form->isSubmitted() && $form->isValid() ) {  // ici, on gère les données qui ont été soumises dans le formulaire envoyé
            
            $userInfos = $form->getData();  // ici, on récupère les valeurs saisies dans le formulaire
            
            $entityManager = $this->getDoctrine()->getManager(); // cet objet va s'occuper des interactions entre entités et BDD
            $entityManager->persist($userInfos);  // on envoie les données pour la transaction 
            $entityManager->flush();  // on lance la transaction
            return new Response("Formulaire soumis correctement");
        }



        return $this->render('form.html.twig', ['Userform' => $form->createView()]);  // on le transmet à la vue en appelant la méthode createView pour rendre le formulaire
    }   
}

?>
