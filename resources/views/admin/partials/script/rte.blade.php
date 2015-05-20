<script src="/plugins/ckeditor/ckeditor.js"></script>
	<script>
	$(function() {
		CKEDITOR.config.toolbar = [
		   ['Format','Bold','Italic','Underline', 'Link', 'Table', 'NumberedList', 'BulletedList', 'HorizontalRule', 'Source']
		];
		CKEDITOR.config.format_tags	= 'p;h1;h2;h3;h4;h5;h6';
	 	CKEDITOR.replace('richtext');
	 	CKEDITOR.replace('richtext2');
	 	CKEDITOR.replace('richtext3');
	});
	</script>
@stop