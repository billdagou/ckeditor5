<?php
namespace Dagou\Ckeditor5\ViewHelpers\Form;

use Dagou\Ckeditor5\Interfaces\Editor;
use TYPO3\CMS\Core\Page\AssetCollector;

class TextareaViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextareaViewHelper {
    protected AssetCollector $assetCollector;

    /**
     * @param \TYPO3\CMS\Core\Page\AssetCollector $assetCollector
     */
    public function injectAssetCollector(AssetCollector $assetCollector) {
        $this->assetCollector = $assetCollector;
    }

    public function initializeArguments() {
        parent::initializeArguments();

        $this->registerArgument('var', 'string', 'Variable name.');
    }

    public function render(): string {
        $name = $this->getName();

        $this->assetCollector->addInlineJavaScript(
            'ckeditor5.'.$name,
            Editor::EDITOR[$GLOBALS['TSFE']->fe_user->getKey('ses', Editor::NAME)]
                .'.create(document.querySelector(\'textarea[name="'.$name.'"]\'))'
                .($this->arguments['var'] ? '.then(editor => {'.$this->arguments['var'].' = editor;})' : '')
                .'.catch(error => {alert(error);})'
                .';'
        );

        return parent::render();
    }
}