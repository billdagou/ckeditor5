<?php
namespace Dagou\Ckeditor5\ViewHelpers\Uri;

use Dagou\Ckeditor5\Interfaces\Source;
use Dagou\Ckeditor5\Source\Local;
use Dagou\Ckeditor5\Type\Editor;
use Dagou\Ckeditor5\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class JsViewHelper extends AbstractViewHelper {
    protected static array $builds = [
        'balloon',
        'balloon-block',
        'classic',
        'document',
        'inline',
    ];

    public function initializeArguments(): void {
        $this->registerArgument('build', 'string', 'Build name');
        $this->registerArgument('forceLocal', 'boolean', 'Force to use local source.');
    }

    /**
     * @return string
     */
    public function render(): string {
        if ($this->arguments['forceLocal'] !== TRUE
            && is_subclass_of(($className = ExtensionUtility::getSource()), Source::class)
        ) {
            $source = GeneralUtility::makeInstance($className);
        } else {
            $source = GeneralUtility::makeInstance(Local::class);
        }

        $build = in_array($this->arguments['build'], self::$builds) ? $this->arguments['build'] : 'classic';

        $GLOBALS['TSFE']->fe_user->setKey('ses', Editor::class, $build);

        return $source->getJs($build);
    }
}