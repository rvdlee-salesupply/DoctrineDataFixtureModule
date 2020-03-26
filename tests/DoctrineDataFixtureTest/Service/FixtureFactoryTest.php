<?php

namespace DoctrineDataFixtureTest\Command;

use DoctrineDataFixtureModule\Service\FixtureFactory;
use Laminas\ServiceManager\ServiceManager;
use Laminas\Test\PHPUnit\Controller\AbstractControllerTestCase;

class FixtureFactoryTest extends AbstractControllerTestCase
{
    public function testFactoryGetInstanceWithConfig()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = new ServiceManager();
        $serviceManager->setService('config', [
            'doctrine' => [
                'fixture' => [
                    __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/Fixture',
                ]
            ],
        ]);

        // Instance the fixture factory
        $factory = new FixtureFactory();

        // Assert if the just created class is in fact a FixtureFactory
        $this->assertInstanceOf(FixtureFactory::class, $factory, 'Expected instance of ' . FixtureFactory::class);

        // Check if this is properly loaded
        $this->assertTrue($factory->canCreate($serviceManager, FixtureFactory::class));

        $factory->__invoke($serviceManager, FixtureFactory::class, []);
    }

    public function testFactoryGetInstanceWithoutConfig()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = new ServiceManager();
        $serviceManager->setService('config', []);

        // Instance the fixture factory
        $factory = new FixtureFactory();

        // Assert if the just created class is in fact a FixtureFactory
        $this->assertInstanceOf(FixtureFactory::class, $factory, 'Expected instance of ' . FixtureFactory::class);

        // Check if this is properly loaded
        $this->assertTrue($factory->canCreate($serviceManager, FixtureFactory::class));

        $factory->__invoke($serviceManager, FixtureFactory::class, []);
    }
}
