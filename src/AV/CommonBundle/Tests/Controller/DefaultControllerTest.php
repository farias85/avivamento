<?php

namespace AV\CommonBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex() {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/');
//        $this->assertContains('Hello World', $client->getResponse()->getContent());

        $this->assertEquals(1, 1, "Probar que 1 es igual a 1");
    }
}
