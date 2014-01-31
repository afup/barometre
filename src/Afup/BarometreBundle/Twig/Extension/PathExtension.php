<?php

namespace Afup\BarometreBundle\Twig\Extension;

use Afup\BarometreBundle\Filtering\Context;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PathExtension extends \Twig_Extension
{
    private $context;

    private $generator;

    public function __construct(Context $context, UrlGeneratorInterface $generator)
    {
        $this->context = $context;
        $this->generator    = $generator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('context_path', [$this, 'contextPath'])
        ];
    }

    public function contextPath($name, $parameters = [], $relative = false)
    {
        $parameters = array_merge($parameters, ['q' => $this->context->getParameters()]);

        return $this->generator->generate(
            $name,
            $parameters,
            $relative ? UrlGeneratorInterface::RELATIVE_PATH : UrlGeneratorInterface::ABSOLUTE_PATH
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'context_path';
    }
}
