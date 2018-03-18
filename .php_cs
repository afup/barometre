<?php

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src'])
;

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setFinder($finder)
    ->setRules([
        '@Symfony' => true,
        'psr0' => false,
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_summary' => false,
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_order' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => true,
        'return_type_declaration' => ['space_before' => 'none'],
    ])
;
