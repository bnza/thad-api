<?php

namespace App\Tests\Functional;

class MediaObjectResourceTest extends AuthApiTestCase
{
    public static function setUpBeforeClass(): void
    {
        $container = self::bootKernel()->getContainer();
        $container->get('app.fixtures_media_reset')->load($_ENV['APP_ENV']);
    }

    public function testSetupBeforeClass()
    {
        $this->assertTrue(true);
    }
}
