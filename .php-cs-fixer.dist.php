<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
    ])
;
return (new PhpCsFixer\Config())
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'native_function_invocation' => ['include' => ['@compiler_optimized']],
        'no_superfluous_phpdoc_tags' => true,
        'ordered_imports' => true,
        'phpdoc_summary' => false,
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_order' => true,
        'psr_autoloading' => false,
        'single_line_throw' => false,
        'simplified_null_return' => false,
        'visibility_required' => ['elements' => ['property', 'method']],
        'yoda_style' => [
            'equal' => null,
            'identical' => null,
            'less_and_greater' => null,
        ],
    ])
;
