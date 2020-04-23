@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a>FancyGrid</a></li>
        </ul>
    </div>
    <div class="content-body">
        <div id="container" style="margin: 0 auto;display: block;"></div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                new FancyGrid({
                    renderTo: 'container',
                    title: 'CRUD',
                    width: '100%',
                    height: 400,
                    theme: 'blue',
                    trackOver: true,
                    selModel: 'rows',
                    data: {
                        remoteSort: true,
                        remoteFilter: true,
                        proxy: {
                            api: {
                                create: '',
                                read: 'filter',
                                update: '',
                                destroy: ''
                            }
                        }
                    },
                    defaults: {
                        type: 'string',
                        width: 100,
                        sortable: true,
                        resizable: true,
                        ellipsis: true,
                        filter: {
                            header: true,
                            emptyText: 'Search'
                        }
                    },
                    paging: true,
                    clicksToEdit: 1,

                    columns: [
                        {
                            index: 'id',
                            title: 'ID',
                            type: 'number',


                        },
                        {

                            index: 'name',
                            title: 'name',
                            filter: {
                                header: true,
                                headerNote: true
                            }
                        },
                        {
                            index: 'email',
                            title: 'email'
                        },

                        {
                            width: 70,

                            index: 'id',
                            title: 'Tools',
                            type: 'number',
                            render: function (o) {
                                o.value = '<a href="users/' + o.value + '/edit" class="text-primery fa fa-edit">edit</a>'
                                    + '<a href="users/' + o.value + '" class="text-primery fa fa-remove">delete</a>';
                                return o;
                            }

                        },
                        {
                            width: 70,

                            index: 'id',
                            title: 'Tools',
                            type: 'number',
                            render: function (o) {

                                o.value = '<form action="users/' + o.value + '" method="post">@method('DELETE')@csrf
                                        @method('DELETE')
                                    <button class="text-danger fa fa-trash" type="submit">Delete</button> </form>';
                                return o;


                            }

                        }


                    ]
                });
            });
        </script>
    </div>
@endsection