/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.extraPlugins = 'uicolor,MediaEmbed,serverpreview';
    config.serverPreviewURL = 'http://localhost/zest-aire/v3/preview.php';
    config.toolbar = 'Sitem8';
    config.toolbar_Sitem8 =
    [
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['Cut','Copy','Paste','PasteText','-','Print', 'SpellChecker', 'Scayt'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
//	['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	'/',
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Flash','MediaEmbed','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','-','ServerPreview'],
	'/',
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor'],
	['Maximize', 'ShowBlocks','-','Source']
    ];

    config.filebrowserBrowseUrl = 'kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = 'kcfinder/browse.php?type=files';
    config.filebrowserFlashBrowseUrl = 'kcfinder/browse.php?type=files';
    config.filebrowserUploadUrl = 'kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = 'kcfinder/upload.php?type=files';
    config.filebrowserFlashUploadUrl = 'kcfinder/upload.php?type=files';

};
