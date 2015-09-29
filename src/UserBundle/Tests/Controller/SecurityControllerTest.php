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

        // Base url is needed here. It actually depends on the format of the location attribute retrieved
        // from the reponses header
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

        $this->assertEquals(true, $client->getResponse()->isRedirect('http://'.$baseUrl.'/'));
    }
}
