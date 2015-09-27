<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $baseUrl = $client->getKernel()->getContainer()->getParameter('hostname');

        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/login'));
    }

    public function testLoginPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertContains('Connexion', $crawler->text());
        $this->assertContains('Pas encore inscrit ?', $crawler->text());
    }

    public function testLoginSubmit()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $baseUrl = $client->getKernel()->getContainer()->getParameter('hostname');

        $form = $crawler->selectButton('_submit')->form();

        $form['_username'] = 'user1@mail.com';
        $form['_password'] = 'user1';

        $crawler = $client->submit($form);

        var_dump($client->getResponse()->getContent());

        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/'));
    }
}
