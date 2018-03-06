<?php

namespace DoctrineDataFixtureTest\Command;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use DoctrineDataFixtureModule\Command\ImportCommand;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
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
        $serviceManager->setService('config', [
            'doctrine' => [
                'fixture' => [
                    __NAMESPACE__ . '_fixture' => __DIR__ . '/Fixture',
                ]
            ],
        ]);

        /** @var MockObject $conn */
        $conn = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var MockObject $config */
        $config = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var MockObject $eventManager */
        $eventManager = $this->getMockBuilder(EventManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var MockObject $entityManager */
        $entityManager = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getEventManager', 'beginTransaction', 'transactional'])
            ->getMock();
        $entityManager->method('getEventManager')
            ->will($this->returnValue($eventManager));
        $entityManager->method('beginTransaction')
            ->will($this->returnValue(true));
        $entityManager->method('transactional')
            ->will($this->returnValue(true));

        /** @var ImportCommand $command */
        $command = new ImportCommand($serviceManager);

        $this->assertInstanceOf(
            ServiceManager::class,
            $command->getServiceLocator(),
            'Expected instance of ' . ServiceManager::class
        );

        $this->assertInstanceOf(
            ImportCommand::class,
            $command,
            'Expected instance of ' . ImportCommand::class
        );

        $command->setEntityManager($entityManager);

        $this->assertInstanceOf(
            EntityManager::class,
            $command->getEntityManager(),
            'Expected instance of ' . EntityManager::class
        );

        $command->setPaths([
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Fixture',
        ]);

        $this->assertInternalType('array', $command->getPaths(), 'Expected paths to be array');
        $this->assertFalse(empty($command->getPaths()), 'Expected paths to be filled with fake data');

        /** @var MockObject $input */
        $input = $this->getMockBuilder(ArgvInput::class)
            ->disableOriginalConstructor()
            ->setMethods(['getOption'])
            ->getMock();
        $input->expects($this->any())
            ->method('getOption')
            ->withAnyParameters()
            ->will($this->returnValue(true));

        /** @var MockObject $output */
        $output = $this->getMockBuilder(ConsoleOutput::class)
            ->disableOriginalConstructor()
            ->getMock();

        $command->execute($input, $output);
    }
}
