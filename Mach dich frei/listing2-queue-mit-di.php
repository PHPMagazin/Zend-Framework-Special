<?php

// MyModule/src/MyModule/Queue/Queue.php
namespace MyModule\Queue;
    
class Queue
{
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
    // ...
}


// MyModule/src/MyModule/Queue/StorageInterface.php
namespace MyModule\Queue;

interface StorageInterface
{
    public function read();
    public function write(array $jobs);
}


// MyModule/src/MyModule/Queue/FileStorage.php
namespace MyModule\Queue;

class FileStorage implements StorageInterface
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    // ...
}

// MyModule/src/MyModule/Controller/QueueController.php
namespace MyModule\Queue;

use Queue\FileStorage;
use Queue\Queue;

class QueueController extends AbstractActionController {

    public function createJobAction()
    {
        $storage = new FileStorage(APPLICATION_PATH . '/../data/queue.txt');
        $queue = new Queue($storage);

        // ...
    }
    // ...
}
