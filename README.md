# TYPO3 Extension: CKEditor5

EXT:ckeditor5 allows you to use [CKEditor 5](https://ckeditor.com/ckeditor-5/) in your extensions.

**The extension version only matches the CKEditor 5 library version, it doesn't mean anything else.**

## How to use it
You can load the library in your Fluid template.

	<ckeditor:js />

You can also load your own library.

    <ckeditor:js src="..." />

For more options please refer to &lt;f:asset.script&gt;.

To use other CKEditor 5 source, you can register it in `ext_localconf.php` or `AdditionalConfiguration.php`.

    \Dagou\Ckeditor5\Utility\ExtensionUtility::registerSource(\Vendor\Extension\Source::class);

You may want to disable the other source and use the local one instead in some cases, for example saving page as PDF by [WKHtmlToPdf](https://wkhtmltopdf.org/).

    <ckeditor:js disableSource="true" />