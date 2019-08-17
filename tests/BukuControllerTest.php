<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BukuControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/buku/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Buku index');
    }

    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/buku/new');

        $this->assertTrue($client->getResponse()->isRedirect('/login'));
        
    }
}
