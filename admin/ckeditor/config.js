/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'tableresize';
	config.enterMode = 'CKEDITOR.ENTER_BR';
	config.shiftEnterMode = 'CKEDITOR.ENTER_P';
	config.toolbar = '1'; 
	config.toolbar_1 =
	[
		{ name: 'tools', items : [ 'Maximize','-','About' ] },		
		{ name: 'document', items : [ 'Source','ShowBlocks','-','DocProps','Preview','Print','-','NewPage','-','Templates' ] },		
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
		//{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] }
	];
	config.docType = '<!DOCTYPE html>';
	config.emailProtection = 'encode';
	config.entities_greek = false;
	config.entities = false;
	config.entities_additional = '';
	config.entities_latin = false;
	//config.font_defaultLabel = 'Arial';
	//config.fontSize_defaultLabel = '12px';
	config.tabSpaces = 4;
};
