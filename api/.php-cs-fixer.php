<?php

use PhpCsFixer\Config;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        // Rule sets base primeiro
        '@PSR1'          => true,
        '@PSR12'         => true,
        '@PSR12:risky'   => true,
        '@Symfony'       => true,

        // Regras específicas (sobrescrevem os sets acima)
        'phpdoc_to_comment'                      => false,
        'declare_strict_types'                   => false,
        'array_indentation'                      => true,
        'explicit_string_variable'               => true,
        'multiline_whitespace_before_semicolons' => false,
        'binary_operator_spaces'                 => [
            'operators' => [
                '=>' => 'align_single_space_minimal',
                '+=' => 'align_single_space_minimal',
                '-=' => 'align_single_space_minimal',
                '='  => 'align_single_space_minimal',
            ],
        ],
    ])
    // ->setIndent("\t")
    ->setLineEnding("\n");