<?php
namespace Dagou\Ckeditor5\Interfaces;

interface Source {
    /**
     * @param string $build
     *
     * @return string
     */
    public function getJs(string $build): string;
}