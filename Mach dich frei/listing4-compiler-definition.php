<?php

namespace {

    use \Zend\Di\Definition\ArrayDefinition;
    use \Zend\Di\Definition\CompilerDefinition;

    $queueDefinitionPath = '/pfad/zu/queue-definition.php';

    if (!file_exists($queueDefinitionPath)) {

        $compiler = new CompilerDefinition();
        $compiler->addDirectory(__DIR__);
        $compiler->compile();
        $content = '<?php return ' . var_export($compiler->toArrayDefinition()->toArray(), true) . ';';
        file_put_contents($queueDefinitionPath, $content);
    }

    $di = include 'di-config.php';
    $di->definitions()->addDefinition(new ArrayDefinition(include $queueDefinitionPath));
}
