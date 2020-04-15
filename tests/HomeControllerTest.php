<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /* Test sur la page Index*/
    public function testIndex()
    {
        $client = static::createClient();
        // Le client envoie une requete
        $client->request('GET', '/home');
        // On vérifie si la requete HTTP est OK
        $this->assertResponseIsSuccessful();
        // On vérifie si le message ci dessous est présent dans le titre principal de la page
        $this->assertSelectorTextContains('h1', 'Welcome to Material Manager plateform');
        // On vérifie si le message ci dessous est présent dans un paragraphe
        $this->assertSelectorTextContains('p', 'Create and manage new materials');
    }

    /* Test sur la page About Us */
    public function testAboutUs(){
        // Création d'un client
        $client = static::createClient();
        // Le client envoie une requete
        $client->request('GET', '/aboutUs');
        // On vérifie si la requete HTTP est OK
        $this->assertResponseIsSuccessful();
        // On vérifie si le message ci dessous est présent dans le titre principal de la page
        $this->assertSelectorTextContains('h1', 'About us');
        // On vérifie si le message ci dessous est présent dans un paragraphe
        $this->assertSelectorTextContains('p', 'We are the only company in the world that provides to clients the possibility to create and manage their own materials');
    }

    /* Test sur la page Create new material */
    public function testCreateNewMaterial(){
        // Création d'un client
        $client = static::createClient();
        // Le client envoie une requete
        $client->request('GET', '/admin/createMaterial');
        // On vérifie si la requete HTTP est OK
        $this->assertResponseIsSuccessful();
        // On vérifie si le message ci dessous est présent dans le titre principal de la page
        $this->assertSelectorTextContains('h1','Create new material');
        // On cherche s'il y a un formulaire qui contient un bouton dont la valeur est "Create". On utilise ce formulaire pour soumettre les valeurs de test ci dessous
        $client->submitForm('Create', [
            'form[type]' => 'téléphone',
            'form[number]' => '1234',
            'form[description]' => 'This is a wonderful test'
        ]);
    }
}
