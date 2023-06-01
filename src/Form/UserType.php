<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

 class UserType extends AbstractType {  // c'est une interface : notre classe va devoir surcharger ces méthodes pour être utilisée !
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder                          // on crée notre formulaire !
        ->add('name', TextType::class)
        ->add('email', EmailType::class)
        ->add('date', DateType::class)
        ->add('creer', SubmitType::class);
    }
 }

?>