<?php
namespace Dagou\Ckeditor5\Source;

use Dagou\Ckeditor5\Interfaces\Source;

abstract class AbstractSource implements Source {
    protected const URL = '';
    protected const VERSION = '41.4.2';

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
        return match($buildName) {
            'balloon', 'balloon-block', 'classic', 'inline' => $buildName.'/ckeditor.js',
            'document' => 'decoupled-document/ckeditor.js',
        };
    }
}