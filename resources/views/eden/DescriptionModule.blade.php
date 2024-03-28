@foreach ($editorModule as $key => $module)
    @include(@env('TEMPLATE_NAME') . '.' . ucfirst($module['type']))
@endforeach
