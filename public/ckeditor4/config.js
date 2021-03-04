/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';


    config.filebrowserBrowseUrl      = '/ckeditor4/plugins/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/ckeditor4/plugins/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/ckeditor4/plugins/ckfinder/ckfinder.html?type=Flash';
    // config.filebrowserFileBrowseUrl = '/ckeditor4/plugins/ckfinder/ckfinder.html?type=Files';

    config.filebrowserUploadUrl      = '/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    // config.filebrowserFileUploadUrl = '/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
};
