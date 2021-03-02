<!-- CSS dependencies -->
{{-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<!-- Javascript dependencies -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> --}}

<!-- Ckeditor js -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script> --}}
{{-- <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

<!-- Grid editor CSS -->
<link rel="stylesheet" type="text/css" href="{{ url('/adminAssets/css/grideditor.css') }}" />
<!-- Grid editor javascript -->
<script src="{{ url('/adminAssets/js/jquery.grideditor.min.js') }}"></script>

<script>
    $(function() {
        // Initialize grid editor
        $('#gridMacker').gridEditor({
            new_row_layouts: [
                [12],
                [6, 6],
                [4, 8]
            ],
            content_types: ['ckeditor'],
            ckeditor: {
                config: {
                    language: 'fa',
                    on: {
                        instanceReady: function(evt) {
                            var instance = this;
                            console.log('instance ready', evt, instance);
                        }
                    }
                }
            }
        });

        // Get resulting html
        var html = $('#gridMacker').gridEditor('getHtml');

    });

</script>

<style>
    .row.ui-sortable {
        width: 100%;
    }

    .gridMacker .btn-primary {
        background-image: none
    }

    .btn-group-sm>.btn,
    .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }

    .col-1 {
        max-width: 8.333333%;
    }
    .col-2 {
        max-width: 16.666667%;
    }
    .col-3 {
        max-width: 25%;
    }
    .col-4 {
        max-width: 33.333333%;
    }
    .col-5 {
        max-width: 41.666667%;
    }
    .col-6 {
        max-width: 50%
    }
    .col-7 {
        max-width: 58.333333%
    }
    .col-8 {
        max-width: 66.666667%;
    }
    .col-9 {
        max-width: 75%;
    }
    .col-10 {
        max-width: 83.333333%;
    }
    .col-11 {
        max-width: 91.666667%;
    }

    .row.ge-row-icon {
        display: flex
    }

    .col,
    .col-1,
    .col-10,
    .col-11,
    .col-12,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-auto,
    .col-lg,
    .col-lg-1,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-auto,
    .col-md,
    .col-md-1,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-auto,
    .col-sm,
    .col-sm-1,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-auto,
    .col-xl,
    .col-xl-1,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-auto {
        position: relative;
        width: 100%;
        min-height: 1px;
    }

    .ge-addRowGroup.btn-group {
        float: left;
    }

    .btn.btn-sm {
        line-height: normal !important
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: .25rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

    .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
        direction: ltr
    }

    .ge-mainControls .ge-addRowGroup .ge-row-icon .column {
        background: oldlace;
        border-left: 1px solid #4aa0e1;
        border-right: 1px solid #4aa0e1;
    }

    .ge-mainControls .ge-addRowGroup .btn.btn-primary {
        color: oldlace;
        margin: 0 2px;
        padding: 3px 3px;
    }
    .ge-mainControls .ge-wrapper.ge-fixed{position: relative;}
    .ge-mainControls .fa.fa-plus{ display: none}
</style>


<div id="gridMacker">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Lorem ipsum dolor.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro distinctio atque molestiae optio,
                consequuntur? Iusto ratione cumque dolor aut dolore!</p>
        </div>
    </div>
</div>
