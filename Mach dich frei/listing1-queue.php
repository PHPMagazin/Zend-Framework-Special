<?php

// MyModule/src/MyModule/Queue/Queue.php
namespace MyModule\Queue;
    
class Queue
{
    protected $storage;

    public function __construct()
    {
        $this->storage = new FileStorage();
    }

    public function next() 
    {
        $jobs = $this->storage->read();
        $res = array_pop($jobs);
        $this->storage->write($jobs);
        return $res;
    }

    public function append($job) 
    {
        $jobs = $this->storage->read();
        $jobs[] = $job;
        $this->storage->write($jobs);
    }
}

// MyModule/src/MyModule/Queue/FileStorage.php
namespace MyModule\Queue;

class FileStorage
{
    protected $filename;

    public function __construct()
    {
        $this->filename = dirname(__FILE__) . '/../../tmp/queue';
    }

    public function read()
    {
        $data = @file_get_contents($this->filename);
        if (false === $data) {
            $data = array();
        } else {
            $data = unserialize($data);
        }
        return $data;
    }

    public function write(array $jobs)
    {
        file_put_contents($this->filename, serialize($jobs));
    }
}

// MyModule/src/MyModule/Controller/QueueController.php
namespace MyModule\Controller;

use \Zend\Mvc\Controller\AbstractActionController;

class QueueController extends AbstractActionController {

    public function createJobAction()
    {
        $queue = new Queue\Queue();

        $job = $this->processUserInput();
        $queue->appendJob();

        return array('job' => $job);

    }
    // ...
}
