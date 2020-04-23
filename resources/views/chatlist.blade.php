@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li>
                <a class="text-18 pos-rel">Chat List
                    <i class="blink online-status width-15 height-15 pos-abs radius-all top-two-tenth right-full-reverse active"
                    data-toggle="tooltip" data-placement="right" title=""></i>
                </a>
                <div class="operator_log pull-right margin-l-full-3 pos-rel top-full"></div>
            </li>
        </ul>
    </div>
    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height pos-rel padding-full">
                <div class="online-offline-container text-center clearfix center-block margin-b-full">
                    <div class="btn-group online-offline-mode disInlineBlock center-block radius-all mat-elevation-z"
                         role="group">
                        <a data-status="1" class="btn btn-online btn-default radius-all transition btn-danger active">Online</a>
                        <a data-status="0" class="btn btn-online btn-default radius-all transition">Offline</a>
                    </div>
                </div>
                <div class="chat-list-container pos-rel">
                    <ul class="client-list transition nav nav-tabs pull-left" role="tablist">
                        @foreach($users as $client)
                            <li data-status="offline" class="full-width hide" role="presentation">
                                <div class="panel mat-elevation-z">
                                    <div class="panel-body no-padding no-margin">
                                        <a data-id="{{ $client['uniq'] }}"
                                           class="chat-item disBlock full-width full-height padding-full"
                                           href="#{{ $client['uniq'] }}" aria-controls="5daf6f506d15d1" role="tab"
                                           data-toggle="tab" aria-expanded="true">
                                            <img class="img-circle mat-elevation-z"
                                                 src="https://abatalk.com/img/profile-placeholder.jpg"
                                                 alt="">
                                            <span class="text-16">{{ $client['name'] }} </span>
                                            <span class="text-10 text-gray">(Offline)</span>
                                            <span class="full-width disBlock">{{--{{ $client['date']  }}--}}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="chat-content transition pull-left">
                        <div class="tab-content pos-rel full-width full-height">
                            @foreach($users as $client)
                                <div role="tabpanel" class="tab-pane full-height " id="{{ $client['uniq'] }}">
                                    <div class="chat_wrapper full-width full-height">
                                        <div class="message_header pos-rel">
                                            <a class="close-chat font-full-plus-two-tenth-em padding-r-l pos-rel pull-left"><i
                                                        class="fa fa-angle-left"></i> Back</a>
                                            <span class="client_name font-full-plus-two-tenth-em pos-rel pull-left">
                                                <span class="pull-left">{{ $client['name'] }}</span>
                                            </span>
                                            <div class="message_log"></div>
                                        </div>
                                        <div class="message_box">
                                            <div class="message_container">
                                                @foreach($client['conversations'] as $conv)

                                                    <div data-type="{{ $conv['type'] }}"
                                                         class="message-content pos-rel">
                                                        <span class="avatar pos-abs">
                                                            <span class="avatar-name pos-abs">{{ $conv['name'] }}</span>
                                                            <img src="https://{{ $hostname }}/socket/asset/img/avatar-{{ $conv['icon'] }}.svg"></span>
                                                        <div class="message_{{ $conv['sender'] }}">{{ $conv['message'] }}</div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        var $body = $('body'),
            websocket = '';

        $(document).ready(function () {
            $body.find('[data-toggle="tooltip"]').tooltip();

            connect();

            $body.on('click', '.send_message', function (e) { //use clicks message send button
                e.preventDefault();

                var $message = $(this).prev('.message'),
                    uniqClient = $(this).parents('.tab-pane').attr('id');

                console.log(uniqClient);

                if (!$.trim($message.val()).length) {
                    return false;
                }

                //prepare json data
                var msg = {
                    type: 'operator',
                    data: {
                        message: $message.val(),
                        uniq: uniqClient
                    }
                };

                var messageInfo = {
                    name: '{{ Auth::user()->name }}',
                    type: 'operator',
                    data: {
                        message: $message.val(),
                        uniq: uniqClient
                    }
                };

                //convert and send data to server
                websocket.send(JSON.stringify(msg));

                $message.val('');

                $.createElementChat(messageInfo);

                $.goScrollDown(uniqClient);
            });

            $body.on('keydown', '.message', function (e) {
                var keyCode = e.which ? e.which : e.keyCode;

                if (keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();

                    $(this).next('.send_message').trigger('click');
                }
            });

            $body.on('click', '.client-list .chat-item', function (e) {
                e.preventDefault();

                if ($(this).parents('[role="presentation"]').hasClass('active')) {
                    return;
                }

                $body.find('.chat-list-container').addClass('active');

                // if (offline mode) then do nothing
                if ($(this).parents('li').data('status') !== "offline") {
                    /*if ($body.find('.tab-pane.active').length) {*/

                    var data = $(this).data('id');

                    var msg = {
                        type: 'connectToClient',
                        clientId: data,
                        operator: '{{$operatorId}}',
                        data: {
                            message: ''
                        }
                    };

                    websocket.send(JSON.stringify(msg));

                    $.createElementChat(msg);

                    /*}*/
                }
            });

            $body.on('click', '.online-offline-mode .btn-online', function () {
                var mode = $(this).data('status');

                if ($(this).hasClass('active')) {
                    return;
                }

                $body.find('.btn-online').removeClass('btn-danger active');
                $(this).addClass('active btn-danger');

                if (mode) {
                    $body.find('.client-list li[data-status="online"]').removeClass('hide');
                    $body.find('.client-list li[data-status="offline"]').addClass('hide');
                } else {
                    $body.find('.client-list li[data-status="online"]').addClass('hide');
                    $body.find('.client-list li[data-status="offline"]').removeClass('hide');
                }

                $body.find('.chat-list-container').removeClass('active');

                $body.find('.client-list li').removeClass('active');

                setTimeout(function () {
                    $body.find('.chat-content .tab-pane').removeClass('active');
                }, 500);
            });

            $body.on('click', '.close-chat', function () {
                $body.find('.chat-list-container').removeClass('active');

                $body.find('.client-list li').removeClass('active');

                setTimeout(function () {
                    $body.find('.chat-content .tab-pane').removeClass('active');
                }, 500);
            });
        });

        function connect() {
            var wsUri = "wss://{{ $hostname }}/wss/?component=chatlist&operator={{$operatorId}}&name={{$operatorName}}";

            websocket = new WebSocket(wsUri);

            websocket.onopen = function () {
                var messageInfo = {
                    type: 'operatorLog',
                    data: {
                        message: 'Connected to server :)'
                    }
                };

                $.createElementChat(messageInfo);
            };

            websocket.onclose = function (ev) {
                var reason;
                switch (ev.code) {
                    case (1000) :
                        reason = "Normal closure, meaning that the purpose for which the connection was established has been fulfilled.";
                        break;
                    case (1001) :
                        reason = "An endpoint is \"going away\", such as a server going down or a browser having navigated away from a page.";
                        break;
                    case (1002) :
                        reason = "An endpoint is terminating the connection due to a protocol error";
                        break;
                    case (1003) :
                        reason = "An endpoint is terminating the connection because it has received a type of data it cannot accept (e.g., an endpoint that understands only text data MAY send this if it receives a binary message).";
                        break;
                    case (1004) :
                        reason = "Reserved. The specific meaning might be defined in the future.";
                        break;
                    case (1005) :
                        reason = "No status code was actually present.";
                        break;
                    case (1006) :
                        reason = "The connection was closed abnormally, e.g., without sending or receiving a Close control frame";
                        break;
                    case (1007) :
                        reason = "An endpoint is terminating the connection because it has received data within a message that was not consistent with the type of the message (e.g., non-UTF-8 [http://tools.ietf.org/html/rfc3629] data within a text message).";
                        break;
                    case (1008) :
                        reason = "An endpoint is terminating the connection because it has received a message that \"violates its policy\". This reason is given either if there is no other sutible reason, or if there is a need to hide specific details about the policy.";
                        break;
                    case (1009) :
                        reason = "An endpoint is terminating the connection because it has received a message that is too big for it to process.";
                        break;
                    case (1010) :
                        reason = "An endpoint (client) is terminating the connection because it has expected the server to negotiate one or more extension, but the server didn't return them in the response message of the WebSocket handshake. <br /> Specifically, the extensions that are needed are: " + ev.reason;
                        break;
                    case (1011) :
                        reason = "A server is terminating the connection because it encountered an unexpected condition that preved it from fulfilling the request.";
                        break;
                    case (1015) :
                        reason = "The connection was closed due to a failure to perform a TLS handshake (e.g., the server certificate can't be verified).";
                        break;
                    default:
                        reason = "Unknown reason";
                }

                var messageInfo = {
                    type: 'operatorLog-dc',
                    data: {
                        message: 'Connection Closed : ' + reason
                    }
                };

                $.createElementChat(messageInfo);
            };

            websocket.onmessage = function (ev) {

                var data = JSON.parse(ev.data),
                    type = data.type,
                    messageInfo = {};

                switch (type) {
                    case 'client' :

                        messageInfo = {
                            name: data.name,
                            data: {
                                message: data.data.message,
                                uniq: data.data.uniq
                            },
                            type: data.type
                        };

                        $.createElementChat(messageInfo);

                        $.goScrollDown(messageInfo.data.uniq);

                        break;

                    case 'system' :
                        $body.find('.system-log').remove();

                        if (data.action === 'assignClient') {
                            messageInfo = {
                                type: 'system',
                                data: {
                                    uniq: data.uniq,
                                    message: ''
                                }
                            };

                            $.createElementChat(messageInfo);

                            $.goScrollDown(messageInfo.data.uniq);

                        } else if (data.action === 'connectToClient') {
                            messageInfo = {
                                data: {
                                    message: 'Connected to ' + data.name,
                                    uniq: data.uniq
                                },
                                type: 'system'
                            };

                            $.createElementChat(messageInfo);

                            $.goScrollDown(messageInfo.data.uniq);
                        }

                        break;

                    case 'connectToClient' :

                        $.goScrollDown(data.clientId);

                        break;

                    case 'operator' :

                        $.goScrollDown(data.uniqClient);

                        break;

                    case 'users' :

                        $.loadUser(data);

                        break;
                }
            };

            websocket.onerror = function (ev) {
                $('#message_box').append("<div class=\"system_error\">Error Occurred</div>");
            };
        }

        $.loadUser = function (data) {
            var clientList = '',
                clientMessage = '';

            $.each(data['users'], function (index, value) {
                var $value = $('#' + value.id);
                if ($value.length) {
                    $('[data-id=' + value.id + ']').parents('li').remove();
                    $value.remove();
                }

                clientList += [
                    '<li data-status="online" class="full-width" role="presentation">',
                    '   <div class="panel mat-elevation-z">',
                    '       <div class="panel-body no-padding no-margin">',
                    '           <a data-id="' + value.id + '" class="chat-item disBlock full-width full-height padding-full" href="#' + value.id + '" aria-controls="' + value.id + '" role="tab" data-toggle="tab">',
                    '               <img class="img-circle mat-elevation-z" src="{{asset('img/profile-placeholder.jpg')}}" alt="">',
                    '               <span class="text-16">' + value.name + '</span>',
                    '           </a>',
                    '       </div>',
                    '   </div>',
                    '</li>'
                ].join('');

                clientMessage += [
                    '<div role="tabpanel" class="tab-pane full-height" id="' + value.id + '">',
                    '   <div class="chat_wrapper full-width full-height">',
                    '       <div class="message_header pos-rel">',
                    '           <a class="close-chat font-full-plus-two-tenth-em padding-r-l pos-rel pull-left"><i class="fa fa-angle-left"></i> Back</a>',
                    '           <span class="client_name font-full-plus-two-tenth-em pos-rel text-left">' + value.name + '</span>',
                    '           <div class="message_log"></div>',
                    '       </div>',
                    '   <div class="message_box">',
                    '       <div class="message_container">'
                ].join('');

                var messageInfo = {};

                $.each(value['conversation'], function (i, v) {
                    if (v.operator_id === 'offline') {
                        return;
                    }

                    var icon = v.type, type = v.type, name = v.name;

                    messageInfo = {
                        name: name,
                        data: {
                            message: v.data.message
                        },
                        type: type
                    };

                    var htmlInline = '<div class="message_' + v.type + '">' + messageInfo.data.message + '</div>';

                    clientMessage += [
                        '<div data-type="' + type + '" class="message-content pos-rel">',
                        '   <span class="avatar pos-abs">',
                        '       <span class="avatar-name pos-abs">' + messageInfo.name + '</span>',
                        '       <img src="https://{{ $hostname }}/socket/asset/img/avatar-' + icon + '.svg">',
                        '   </span>',
                        htmlInline,
                        '</div>'
                    ].join('');
                });

                clientMessage += [
                    '           </div>',
                    '       </div>',
                    '       <div class="message_typing pos-rel">',
                    '           <textarea class="transition message" name="message" id="message" placeholder="Type your message here" autofocus></textarea>',
                    '           <button class="send_message pos-abs"><img src="https://{{ $hostname }}/socket/asset/img/send_message.svg"></button>',
                    '       </div>',
                    '   </div>',
                    '</div>'
                ].join('');

                $.goScrollDown(value.id);
            });

            $('.client-list').append(clientList);

            $('.chat-content .tab-content').append(clientMessage);
        };

        $.createElementChat = function (messageInfo) {
            var html = '',
                $messageBox = $body.find('.tab-pane[id="' + messageInfo.data.uniq + '"] .message_box'),
                $messageBoxHeader = $body.find('.tab-pane[id="' + messageInfo.data.uniq + '"] .message_header');

            switch (messageInfo.type) {
                case 'client':

                    html = '<div class="message_client">' + messageInfo.data.message + '</div>';

                    break;
                case 'operator':

                    html = '<div class="message_operator">' + messageInfo.data.message + '</div>';

                    break;
                case 'connectToClient':

                    if (messageInfo.data.message !== '') {
                        html = '<div class="system-log">' + messageInfo.data.message + '</div>';
                    }

                    break;
                case 'system':

                    html = '<div class="system-log">' + messageInfo.data.message + '</div>';

                    break;
                case 'system-dc':

                    html = '<div class="system-log-dc">' + messageInfo.data.message + '</div>';


                    break;
                case 'operatorLog':

                    // html = '<div class="alert alert-success no-margin padding-r-l no-padding-t-b">' + messageInfo.data.message + '</div>';

                    $.iziSuccess('', messageInfo.data.message);
                    $body.find('.online-status')
                        .attr({'title': messageInfo.data.message, 'data-original-title': messageInfo.data.message})
                        .addClass('active').tooltip('destroy').tooltip();

                    break;
                case 'operatorLog-dc':
                    $body.find('.online-status')
                        .attr({'title': 'Connection closed', 'data-original-title': 'Connection closed'})
                        .removeClass('active').tooltip('destroy').tooltip();

                    $.iziQuestionConnect('', 'Connection closed').then(function() {
                        connect();
                    });

                    /*html = [
                        '<div class="alert alert-danger no-margin padding-r-l no-padding-t-b">',
                            messageInfo.data.message,
                        '   <button class="btn btn-success btn-xs" onclick="connect()">Connect</button>',
                        '</div>'
                    ].join('');*/

                    break;
            }

            if (messageInfo.type === 'operatorLog' || messageInfo.type === 'operatorLog-dc') {
                var $operatorLog = $body.find('.operator_log');
                $operatorLog.html(html);
            } else if (messageInfo.type === 'system-dc') {
                var $messageLog = $messageBoxHeader.find('.message_log');
                $messageLog.slideDown('fast');

                $messageLog.html(messageInfo.data.message);
            } else if (messageInfo.type === 'system') {
                $messageBox.find('.message_container').append(html);
            } else {
                var lastMessage = $messageBox.find('.message_container .message-content:last-child').data('type');

                if (lastMessage === messageInfo.type) {
                    $messageBox.find('.message_container .message-content:last-child').append(html);
                } else {
                    var innerHtml = [
                        '<div data-type="' + messageInfo.type + '" class="message-content pos-rel">',
                        '   <span class="avatar pos-abs">',
                        '       <span class="avatar-name pos-abs">' + messageInfo.name + '</span>',
                        '       <img src="https://{{ $hostname }}/socket/asset/img/avatar-', messageInfo.type, '.svg">',
                        '   </span>',
                            html,
                        '</div>'
                    ].join('');

                    $messageBox.find('.message_container').append(innerHtml);
                }
            }
        };

        $.goScrollDown = function (id) {
            try {
                var elem = document.querySelector('.tab-pane[id="' + id + '"] .message_box');
                elem.scrollTop = elem.scrollHeight;
            } catch (e) {}
        };
    </script>
@endsection


