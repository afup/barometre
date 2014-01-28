<?php

namespace Afup\BarometreBundle\Twig;

use Symfony\Component\Finder\Finder;

class Assets extends \Twig_Extension
{
    /**
     * @var string
     */
    protected $assetsDir;

    /**
     * @param string $assetsDir
     */
    public function __construct($assetsDir)
    {
        $this->assetsDir = $assetsDir;
    }

    /**
     * @return string
     */
    public function getGlobals()
    {
        return array(
          'compiled_css_file' => $this->getCompiledFile('*.css', 'css'),
          'compiled_js_file' => $this->getCompiledFile('*.js', 'js'),
        );
    }

    /**
     * @param string $pattern
     * @param string $subDir
     *
     * @return string
     */
    protected function getCompiledFile($pattern, $subDir)
    {
        $finder = new Finder();
        $files = $finder->files()->name($pattern)->in($this->assetsDir . '/' . $subDir);
        if (count($files) > 1) {
            throw new \Exception('There should not have more than one file in the assets dir');
        }
        $compiledFile = null;
        foreach ($files as $file) {
            $compiledFile = $file->getBasename();
        }
        return sprintf('/assets/%s/%s', $subDir, $compiledFile);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'afup_barometre_twig_assets';
    }
}
