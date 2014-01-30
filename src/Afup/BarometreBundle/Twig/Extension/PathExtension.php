<?php

namespace Afup\BarometreBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PathExtension extends \Twig_Extension
{
    private $requestStack;

    private $generator;

    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $generator)
    {
        $this->requestStack = $requestStack;
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

    public function contextPath($name, $parameters = array(), $relative = false)
    {
        $parameters = array_merge($parameters, $this->requestStack->getCurrentRequest()->query->all());

        return $this->generator->generate($name, $parameters, $relative ? UrlGeneratorInterface::RELATIVE_PATH : UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'context_path';
    }
}
