<?php

// di-config.php
namespace {
    
    $di = new \Zend\Di\Di();

    $instanceManager = $di->instanceManager();
    $instanceManager->setParameters('Queue\Queue', array());
    $instanceManager->addAlias('queue', 'Queue\Queue');

    $path = '/pfad/zu/queue.txt';
    $instanceManager->setParameters('Queue\FileStorage', array('filename' => $path));
    $instanceManager->addTypePreference('Queue\StorageInterface', 'Queue\FileStorage');

    return $di;
}

// worker.php
namespace {
    
    $di = include 'di-config.php';
    $queue = $di->get('queue'); // oder: $di->get('Queue\Queue')
    processJob($queue->next());
}
