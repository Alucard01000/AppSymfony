<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Psr\Log\LoggerInterface;  // on importe le service logger
use App\Service\Greeter; //on appelle notre service Greeter

class HelloController extends AbstractController {
    
    /**
     * @Route("/hello/{number}", requirements={"number"="\d+"})    // requirements pour des conditions sur le param dynamique : ici number doit être un entier positif
     */
    public function helloNumber(Request $request, $number) {
        return new Response($number);  // renverra le nombre capturé
    }

    /**
     * @Route("/hello/{_locale}/{name}")    // on met entre accolades un param dynamique
     */                                     // on met {_locale} pour capturer la valeur mise pour la variable 'locale' de Request
    public function hello(Request $request, LoggerInterface $logger, $name = null) {  // on peut récupérer notre name dans la route via une variable du même nom
        //return new Response("Hello !");
        //throw $this->createNotFoundException();  //renverra une erreur Not Found !

        //echo($request->query->get('name')); // pour récupérer les variables de paramètres passés en url ($_GET) => on utilise la méthode get en indiquant le nom du paramètre (ici 'name')
        echo $request->getLocale(); // affiche la valeur de la variable locale (en par défaut ici)
        
        $logger->alert("Ceci est une alerte faite par le service Logger!");

        $users = ['Sophie', "Julie", "Anne", "Cindy", "Perrine"];

        return $this->render('hello.html.twig', [  // on passe les paramètres via un tableau associatif
                    'name' => $name, 
                    'utilisateurs' => $users ]);  
    }

    /**
     * @Route("/hellotest", name="hellotest")    // on met entre accolades un param dynamique
     */
    public function helloTest(Greeter $greeter) {  // injection du service Greeter 

        return new response($greeter->greet());  // on appelle la méthode greet de notre objet Greeter
    }
}