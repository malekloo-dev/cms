@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a>Offline Messages</a></li>
        </ul>
    </div>
    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <div id="container" class="full-width"></div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                new FancyGrid({
                    renderTo: 'container',
                    title: '',
                    width: 'fit',
                    height: 'fit',
                    theme: 'gray',
                    trackOver: true,
                    selModel: 'rows',
                    data: {
                        remoteSort: true,
                        remoteFilter: true,
                        proxy: {
                            api: {
                                create: '',
                                read: 'offline/filter',
                                update: '',
                                destroy: '',
                                method: 'post'
                            }
                        }
                    },
                    defaults: {
                        type: 'string',
                        //width: 100,
                        sortable: true,
                        resizable: true
                        //ellipsis: true,
                        /*filter: {
                            header: true,
                            emptyText: 'Search'
                        }*/
                    },
                    paging: true,
                    clicksToEdit: 1,
                    columns: [
                        {
                            index: 'uniq',
                            title: 'id',
                            filter: {
                                header: true,
                                headerNote: true
                            },
                            flex: .3,
                            minWidth: 100,
                            identifier: 'GLOBAL.NAME'
                        },
                        {
                            index: 'message',
                            title: 'message',
                            filter: {
                                header: true,
                                headerNote: true
                            },
                            flex: 1,
                            minWidth: 100,
                            identifier: 'GLOBAL.NAME'
                        },
                        {
                            index: 'sender',
                            title: 'sender ms',
                            filter: {
                                header: true,
                                headerNote: true
                            },
                            flex: .3,
                            minWidth: 100,
                            identifier: 'GLOBAL.NAME'
                        }


                    ]
                });
            });
        </script>
            </div>
        </div>
    </div>
@endsection