<?php
namespace Dagou\Ckeditor5\ViewHelpers;

use Dagou\Ckeditor5\Interfaces\Source;
use Dagou\Ckeditor5\Source\Local;
use Dagou\Ckeditor5\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\ViewHelpers\Asset\ScriptViewHelper;

class JsViewHelper extends ScriptViewHelper {
    protected static array $builds = [
        'balloon',
        'balloon-block',
        'classic',
        'document',
        'inline',
    ];

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('build', 'string', 'Build name');
        $this->registerArgument('disableSource', 'boolean', 'Disable Source.');

        $this->overrideArgument(
            'identifier',
            'string',
            'Use this identifier within templates to only inject your JS once, even though it is added multiple times.',
            FALSE,
            'ckeditor5'
        );
    }

    /**
     * @return string
     */
    public function render(): string {
        if (!$this->arguments['src']) {
            if (!$this->arguments['disableSource'] !== TRUE
                && is_subclass_of(($className = ExtensionUtility::getSource()), Source::class)
            ) {
                $source = GeneralUtility::makeInstance($className);
            } else {
                $source = GeneralUtility::makeInstance(Local::class);
            }

            $build = in_array($this->arguments['build'], self::$builds) ? $this->arguments['build'] : 'classic';

            $this->tag->addAttribute('src', $source->getJs($build));
        }

        return parent::render();
    }
}