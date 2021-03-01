<!-- CSS dependencies -->
{{-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<!-- Javascript dependencies -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> --}}

<!-- Ckeditor js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>

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
                [9, 3]
            ],
            content_types: ['ckeditor'],
            ckeditor: {
                config: {
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
        console.log(html);
    });

</script>

<style>
    .row.ui-sortable{width: 100%;}
</style>


<div id="gridMacker">



    <div class="row">
        <div class="col-lg-12">
            <h2>Lorem ipsum dolor.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro distinctio atque molestiae optio,
                consequuntur? Iusto ratione cumque dolor aut dolore!</p>


        </div>


    </div>

</div>
