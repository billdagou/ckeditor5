<?php
namespace Dagou\Ckeditor5\Interfaces;

interface Editor {
    public const NAME = 'ckeditor5';
    public const EDITOR = [
        'balloon' => 'BalloonEditor',
        'balloon-block' => 'BalloonEditor',
        'classic' => 'ClassicEditor',
        'document' => 'DecoupledEditor',
        'inline' => 'InlineEditor',
    ];
}