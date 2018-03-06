<?php

namespace DoctrineDataFixtureTest\Command;

use DoctrineDataFixtureModule\Command\ImportCommand;
use PHPUnit\Framework\MockObject\Matcher\Invocation;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Zend\Console\Console;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        /** @var MockObject $eventManager */
        $eventManager = new EventManager();

        /** @var MockObject $entityManager */
        $entityManager = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getEntityManager'])
            ->getMock();
        $entityManager->method('getEntityManager')
            ->will($this->returnValue($eventManager));

        $a = $entityManager->getEventManager();

        /** @var ImportCommand $command */
        $command = new ImportCommand($serviceManager);

        $this->assertInstanceOf(ServiceManager::class, $command->getServiceLocator(), 'Expected instance of ' . ServiceManager::class);
        $this->assertInstanceOf(ImportCommand::class, $command, 'Expected instance of ' . ImportCommand::class);

        $command->setEntityManager($entityManager);

        $this->assertInstanceOf(EntityManager::class, $command->getEntityManager(), 'Expected instance of ' . EntityManager::class);

        $command->setPaths([
            '../Fixture',
        ]);

        $this->assertInternalType('array', $command->getPaths(), 'Expected paths to be array');
        $this->assertFalse(empty($command->getPaths()), 'Expected paths to be filled with fake data');

        /** @var ArgvInput $input */
        $input = $this->getMockBuilder(ArgvInput::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var ConsoleOutput $output */
        $output = $this->getMockBuilder(ConsoleOutput::class)
            ->disableOriginalConstructor()
            ->getMock();

        $command->execute($input, $output);
    }
}