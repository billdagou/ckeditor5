<?php
namespace Dagou\Ckeditor5\ViewHelpers\Form;

use Dagou\Ckeditor5\Type\Editor;
use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

class TextareaViewHelper extends AbstractFormFieldViewHelper {
    protected AssetCollector $assetCollector;

    /**
     * @var string
     */
    protected $tagName = 'textarea';

    /**
     * @param \TYPO3\CMS\Core\Page\AssetCollector $assetCollector
     *
     * @return void
     */
    public function injectAssetCollector(AssetCollector $assetCollector): void{
        $this->assetCollector = $assetCollector;
    }

    public function initializeArguments(): void {
        parent::initializeArguments();

        $this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this ViewHelper', FALSE, 'f3-form-error');
        $this->registerArgument('required', 'bool', 'Specifies whether the textarea is required', FALSE, FALSE);
        $this->registerArgument('var', 'string', 'Variable name.');
        $this->registerTagAttribute('autofocus', 'string', 'Specifies that a text area should automatically get focus when the page loads');
        $this->registerTagAttribute('cols', 'int', 'The number of columns of a text area');
        $this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
        $this->registerTagAttribute('placeholder', 'string', 'The placeholder of the textarea');
        $this->registerTagAttribute('readonly', 'string', 'The readonly attribute of the textarea', FALSE);
        $this->registerTagAttribute('rows', 'int', 'The number of rows of a text area');

        $this->registerUniversalTagAttributes();
    }

    /**
     * @return string
     */
    public function render(): string {
        $required = $this->arguments['required'];
        $name = $this->getName();
        $this->registerFieldNameForFormTokenGeneration($name);
        $this->setRespectSubmittedDataValue(TRUE);

        $this->tag->forceClosingTag(TRUE);
        $this->tag->addAttribute('name', $name);
        if ($required === TRUE) {
            $this->tag->addAttribute('required', 'required');
        }
        $this->tag->setContent(htmlspecialchars((string)$this->getValueAttribute()));
        $this->addAdditionalIdentityPropertiesIfNeeded();
        $this->setErrorClassAttribute();

        $this->assetCollector->addInlineJavaScript(
            'ckeditor5.'.$name,
            (new Editor($GLOBALS['TSFE']->fe_user->getKey('ses', Editor::class)))->getEditorName()
            .'.create(document.querySelector(\'textarea[name="'.$name.'"]\'))'
            .($this->arguments['var'] ? '.then(editor => {'.$this->arguments['var'].' = editor;})' : '')
            .'.catch(error => {alert(error);})'
            .';'
        );

        return $this->tag->render();
    }
}