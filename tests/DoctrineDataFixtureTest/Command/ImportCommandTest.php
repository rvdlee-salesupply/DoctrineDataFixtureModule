<?php

namespace DoctrineDataFixtureTest\Command;

use DoctrineDataFixtureModule\Command\ImportCommand;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

class ImportCommandTest extends TestCase
{
    /**
     * Injecting the ZF3 ServiceManager
     */
    public function testCanBeCreatedWithZF3()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $this->getMockBuilder(ServiceManager::class)->getMock();

        $command = new ImportCommand($serviceManager);
    }

    /**
     * Injecting the Symfony ServiceManager
     */
    public function testCanBeCreatedWithSymfony()
    {
        /** @var ServiceManager $serviceManager */
        $serviceManager = $this->getMockBuilder(ServiceManager::class)->getMock();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get(EntityManager::class);

        $command = new ImportCommand($serviceManager);
        $command->setEntityManager($entityManager);
    }
}