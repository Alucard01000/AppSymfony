<?php

namespace App\Service;

class Greeter {
    public $name; // on met notre propriété name, qui prendra la valeur donnée au service via le fichier de config de services
    public function __construct($name) {  
        $this->name = $name;
    } 
    
    
    public function greet() {  // methode greet
        return "Hello à toi, ".$this->name." !";   // on utilise notre prop 'name'
    }
}