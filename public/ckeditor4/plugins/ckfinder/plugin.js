// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

CKEDITOR.plugins.add( 'ckfinder', {
    init: function( editor ) {
        editor.config.filebrowserBrowseUrl = '/ckeditor4/plugins/ckfinder/ckfinder.php';
    }
});
