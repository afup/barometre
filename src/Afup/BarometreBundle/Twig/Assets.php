<?php

namespace Afup\BarometreBundle\Twig;

use Symfony\Component\Finder\Finder;

class Assets extends \Twig_Extension
{

    protected $assetsPath;

    public function __construct($kernelRootDir)
    {
      $this->assetsPath = $kernelRootDir . '/../web/assets/';
    }

    public function getGlobals()
    {
      return array(
        'compiled_css_file' => $this->getPathForPattern('*.css', 'css'),
        'compiled_js_file' => $this->getPathForPattern('*.js', 'js'),
      );
    }

    protected function getPathForPattern($pattern, $subDir)
    {
      $finder = new Finder();
      $files = $finder->files()->name($pattern)->in($this->assetsPath . '/' . $subDir);
      if (1 !== count($files)) {
        throw new \Exception('un fichier js non trouvé ?');
      }
      $compiledCssFile = null;
      foreach ($files as $file) {
        $compiledCssFile = $file->getBasename();
      }
      return sprintf('/assets/%s/%s', $subDir, $compiledCssFile);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'afup_barometre_twig_assets';
    }
}
