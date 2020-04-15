<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    /* Test sur la page Index*/
    public function testIndex()
    {
        $client = static::createClient();
        // Le client fait une requete
        $client->request('GET', '/home');
        // On vérifie si la requete HTTP est OK
        $this->assertResponseIsSuccessful();
        // On vérifie si le message ci dessous est présent dans le titre principal de la page
        $this->assertSelectorTextContains('h1', 'Welcome to Material Manager plateform');
        // On vérifie si le message ci dessous est présent dans un paragraphe
        $this->assertSelectorTextContains('p', 'Create and manage new materials');
    }
}
