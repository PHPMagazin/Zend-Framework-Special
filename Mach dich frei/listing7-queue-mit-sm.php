<?php

// MyModule/Module.php
namespace MyModule;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ServiceProviderInterface
{
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Queue\Queue' => function(ServiceManager $sm) {
                    return new \Queue\Queue($sm);
                },
                'Queue\StorageInterface' => function(ServiceManager $sm) {
                    return new \Queue\FileStorage(__DIR__ . '/queue.txt');
                }
            ),
            'aliases' => array(
                'queue' => 'Queue\Queue',
                'queue_storage' => 'Queue\StorageInterface',
            ),
        );
    }
    // ...
}

// MyModule/src/MyModule/Controller/QueueController.php
class QueueController extends AbstractActionController 
{
    public function createJobAction()
    {
        $queue = $this->getServiceLocator()->get('queue');
        // ...
    }
    // ...
}

// MyModule/src/MyModule/Queue/Queue.php
class Queue 
{
    public function __construct(ServiceManager $sl) {
        $this->storage = $sl->get('queue_storage');
    }
    // ...
}
