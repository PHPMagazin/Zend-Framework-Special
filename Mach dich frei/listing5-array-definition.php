<?php

namespace {
    
    $definitionConfig = array(
        array(
            'Queue\FileStorage' => array(
                'supertypes' => array('Queue\StorageInterface'),
                'instantiator' => '__construct',
                'methods' => array('__construct' => true,),
                'parameters' => array(
                    '__construct' => array(
                        'Queue\FileStorage::__construct:0' => array(
                            'filename', null, true,
                        ),
                    ),
                ),
            ),
        ),
    );
    
    $di = include 'di-config.php';
    $di->definitions()->addDefinition($definitionConfig);
}
