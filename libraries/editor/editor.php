<script type="text/javascript">
$('document').ready(function(){
	
	CKEDITOR.replace( 'editor',
	{
		filebrowserBrowseUrl : '../libraries/editor/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '../libraries/editor/ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl : '../libraries/editor/ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl : '../libraries/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
		filebrowserImageUploadUrl :  '../libraries/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
		filebrowserFlashUploadUrl : '../libraries/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	});
	
	CKEDITOR.config.toolbar = [
		['Styles','Format','Font','FontSize','Bold','Italic','Underline','StrikeThrough','-','Print'],
		'/',
		['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source','Maximize']
	] ;


});
</script>




