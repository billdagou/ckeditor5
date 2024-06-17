<?php
namespace Dagou\Ckeditor5\Type;

class Editor {
    protected string $build;

    /**
     * @param string $build
     */
    public function __construct(string $build) {
        $this->build = $build;
    }

    /**
     * @return string
     */
    public function getEditorName(): string {
        return match ($this->build) {
            'balloon', 'balloon-block' => 'BalloonEditor',
            'document' => 'DecoupledEditor',
            'inline' => 'InlineEditor',
            default => 'ClassicEditor',
        };
    }
}