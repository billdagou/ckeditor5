<?php
namespace Dagou\Ckeditor5\Source;

use Dagou\Ckeditor5\Interfaces\Source;
use TYPO3\CMS\Core\SingletonInterface;

abstract class AbstractSource implements Source, SingletonInterface {
    protected const URL = '';
    protected const VERSION = '35.3.0';

    /**
     * @param string $build
     *
     * @return string
     */
    public function getJs(string $build): string {
        return static::URL.$this->getJsBuild($build);
    }

    /**
     * @param string $buildName
     *
     * @return string
     */
    protected function getJsBuild(string $buildName): string {
        switch ($buildName) {
            case 'balloon':
                return 'balloon/ckeditor.js';
            case 'balloon-block':
                return 'balloon-block/ckeditor.js';
            case 'classic':
                return 'classic/ckeditor.js';
            case 'document':
                return 'decoupled-document/ckeditor.js';
            case 'inline':
                return 'inline/ckeditor.js';
        }
    }
}