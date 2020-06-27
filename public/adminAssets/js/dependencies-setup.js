$(function(){
	'use strict';

    // SELECT2
    $('[data-input="select2"], .select2').each(function(){
        var $this = $(this),
            placeholder = ($this.attr('placeholder') === undefined) ? 'Select a choice' : $this.attr('placeholder');

        $this.select2({
            placeholder: placeholder,
            allowClear: true
        });
    });
    $('[data-input="select2-tags"], .select2-tags').each(function(){
        var $this = $(this),
            placeholder = ($this.attr('placeholder') === undefined) ? 'Select a choice' : $this.attr('placeholder'),
            data_tags = ($this.attr('data-tags') === undefined) ? false : $this.attr('data-tags'),
            tags;

            if(data_tags){
                tags = data_tags.replace(/\s+/g, '');
                tags = tags.split(",");
            }
            else{
                tags = [];
            }

        $this.select2({
            placeholder: placeholder,
            tags: tags
        });
    });
    // END SELECT2

    // FORM VALIDATE
    $('[data-validate="form"]').each(function(){
        var $this = $(this);
        
        $this.validate({
            focusCleanup: true,
            errorClass: "text-danger",
            errorPlacement: function(error, element) {
                if ( element.parent().hasClass('nice-checkbox') || element.parent().hasClass('nice-radio') || element.parent().hasClass('input-group') ) {
                    error.appendTo( element.parent().parent() );
                }
                else{
                    error.appendTo( element.parent() );
                }
            }
        });
    });
    // END FORM VALIDATE
});
