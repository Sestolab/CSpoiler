CKEDITOR.dialog.add( 'cspoiler', function(editor){
	var lang = editor.lang.cspoiler;

	return {
		title: lang.label,
		minHeight: 50,
		contents: [
			{
				id: 'basic',
				elements: [
					{
						id: 'scaption',
						type: 'text',
						label: lang.scaptionLabel,
						setup: function(widget){
							this.setValue(widget.data.scaption);
						},
						commit: function(widget){
							widget.setData('scaption', this.getValue());
						}
					}
				]
			}
		]
	};
} );