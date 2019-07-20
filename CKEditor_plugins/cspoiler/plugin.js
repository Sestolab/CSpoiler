CKEDITOR.plugins.add('cspoiler', {
	requires: 'dialog,widget',
	lang: 'en,ru,uk',
	icons: 'cspoiler',
	init: function(editor){

		CKEDITOR.dialog.add('cspoiler', this.path + 'dialogs/cspoiler.js');
		var lang = editor.lang.cspoiler;

		editor.widgets.add('cspoiler', {
			allowedContent:
				'div(!cspoiler); div(!cspoiler-content); input[!id, type]; label[for]; p',

			requiredContent: 'div(cspoiler)',

			editables: {
				caption: 'label',
				content: {
					selector: '.cspoiler-content',
				}
			},

			template:
				'<div class="cspoiler"><input type="checkbox" /><label>  </label>' +
					'<div class="cspoiler-content"><p>Content...</p></div>' +
				'</div>',

			button: lang.label,
			dialog: 'cspoiler',

			upcast: function(element){
				return element.name == 'div' && element.hasClass('cspoiler');
			},

			init: function(){
				if (editor.getSelectedHtml())
					this.setData('scontent', editor.getSelectedHtml(true))
				this.setData('scaption', this.element.getChild(1).getText());
			},

			data: function(){
					this.element.getChild(1).setText(this.data.scaption);
					if (this.data.scontent)
						this.element.getChild(2).setHtml(this.data.scontent);

					if (!this.element.getChild(0).getAttribute('id')){
							var id = 0;
							while(document.getElementById('cspoiler-'+id) != null){
								id++;
							}
						this.element.getChild(1).setAttribute('for', 'cspoiler-'+id);
						this.element.getChild(0).setAttribute('id', 'cspoiler-'+id);
					}
			},

		});

		if (editor.contextMenu){
			editor.addMenuGroup('cspoilerGroup');
			editor.addMenuItem('cspoiler', {
				label: lang.menuLabel,
				command: 'cspoiler',
				group: 'cspoilerGroup'
			});

			editor.contextMenu.addListener(function(element){
				if (element.getName() == 'div' && element.findOne('.cspoiler')){
					return { cspoiler: CKEDITOR.TRISTATE_OFF };
				}
			
			});
		};

	}
});
