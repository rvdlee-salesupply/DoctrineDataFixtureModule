<?php

namespace DoctrineDataFixtureModule;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Application;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use DoctrineDataFixtureModule\Command\ImportCommand;
use DoctrineDataFixtureModule\Service\FixtureFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Base module for Doctrine Data Fixture.
 *
 * @license MIT
 * @link    www.doctrine-project.org
 * @author  Martin Shwalbe <martin.shwalbe@gmail.com>
 * @author  Rob van der Lee <r.vdlee@salesupply.com>
 */
class Module implements
    AutoloaderProviderInterface,
    ServiceProviderInterface,
    ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ],
            ],
        ];
    }

    /**
     * @param ModuleManager $e
     */
    public function init(ModuleManager $e)
    {
        $events = $e->getEventManager()->getSharedManager();

        // Attach to helper set event and load the entity manager helper.
        $events->attach('doctrine', 'loadCli.post', function (EventInterface $e) {
            /* @var $cli Application */
            $cli = $e->getTarget();
            /* @var $sm ServiceLocatorInterface */
            $sm = $e->getParam('ServiceManager');
            /** @var EntityManager $em */
            $em = $cli->getHelperSet()->get('em')->getEntityManager();
            /** @var array $paths */
            $paths = $sm->get('doctrine.configuration.fixtures');

            $importCommand = new ImportCommand($sm);
            $importCommand->setEntityManager($em);
            $importCommand->setPaths($paths);

            ConsoleRunner::addCommands($cli);

            $cli->addCommands([
                $importCommand
            ]);
        });
    }

    /**
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => [
                'doctrine.configuration.fixtures' => new FixtureFactory('fixtures_default'),
            ],
        );
    }
}
