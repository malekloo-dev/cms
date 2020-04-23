@extends('layouts.blank')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Live chat support</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=1">

    <link href="{{asset('socket/asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('socket/asset/css/flatpickr-dark.min.css')}}" rel="stylesheet">
    <link href="{{asset('socket/asset/css/style.css')}}" rel="stylesheet">
    <script src="{{asset("socket/asset/js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("socket/asset/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("socket/asset/js/flatpickr.min.js")}}"></script>
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css" rel="stylesheet"/>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.0.1/mapbox-gl-geocoder.css"
          rel="stylesheet"/>
</head>
<body>
<div id="sound"></div>

<div class="chat_wrapper">
    <div class="message_header text-center pos-rel">
        <div class="message_log text-left pos-rel"></div>

        <a class="refresh-btn pos-abs hidden" data-toggle="tooltip" title="You can reset chat" data-placement="left">
            <img class="full-width" src="https://{{ $hostname }}/socket/asset/img/refresh.svg">
        </a>
    </div>
    <div class="message_box without_typing" id="message_box">
        <div class="message_container"></div>

        <div class="user-form-container pos-abs">
            <div class="form-group">
                <p class="text-bold">Welcome to 4smile.com</p>

                <p>
                    Please enter the following information and send us your message so we can respond as soon as
                    possible.
                </p>
            </div>

            <div class="form-group">
                <label for="name" class="control-label full-width">
                    Your Name:

                    <span class="text-danger">*</span>

                    <span class="help-block pull-right no-margin">Please enter your full name</span>
                </label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email" class="control-label full-width">
                    Your Email:

                    <span class="text-danger">*</span>

                    <span class="help-block pull-right no-margin">Please enter your email address</span>
                </label>
                <input type="email" class="form-control" id="email" placeholder="Enter you email" required>
            </div>

            <div class="form-group">
                <button type="button" class="connect btn btn-primary btn-chat btn-block">Start Chat</button>
            </div>
        </div>
    </div>
    <div class="message_typing pos-rel" style="display: none;">
        <div class="show_message text-danger pos-abs">Please enter valid email address</div>

        <input class="transition pos-rel" name="message" id="message" placeholder="Type your message here" autofocus>

        <button class="send_message pos-abs">
            <img src="https://{{ $hostname }}/socket/asset/img/send_message.svg">
        </button>
    </div>

    <span class="loading pos-abs">
        <span>.</span>
        <span>.</span>
        <span>.</span>
    </span>
</div>

<input id="uniq" type="hidden" value="<?= uniqid() ?>">

<script type="text/javascript">
    $(document).ready(function () {
        var $body = $('body'),
            $messageBox = $('#message_box'),
            $messageBoxHeader = $('.message_header'),
            $messageTyping = $('.message_typing'),
            $messageLog = $messageBoxHeader.find('.message_log'),
            $message = $body.find('#message'),
            $avatarOnlineBadge = $body.find('.avatar-online-badge'),
            $name = $body.find('#name'),
            $email = $body.find('#email'),
            $reloadBtn = $body.find('.refresh-btn'),
            $userFormContainer = $body.find('.user-form-container'),
            websocket = '',
            id = $body.find('#uniq').val(),
            currentData = {},
            fetchMyConversation = false,
            flatPickr,
            map;

        $body.find('[data-toggle="tooltip"]').tooltip();

        mapboxgl.accessToken = 'pk.eyJ1IjoiYWxsZW5rb3RseWFyIiwiYSI6ImNqeTUzOWwwdzAzZGYza21oazQ3ejV4OGkifQ.Y0DJ_92gP_ud35xxKZRuow';

        /*****************************************
         *
         *         Start Check Connection
         *
         ****************************************/

        if (localStorage.getItem('uniq') === null) {
            localStorage.setItem('uniq', id + '1');
        }
        if (localStorage.getItem('userInfo') !== null) {
            var userInfo = JSON.parse(localStorage.getItem('userInfo'));
            $name.val(userInfo.name);
            $email.val(userInfo.email);
        }

        window.addEventListener('storage', function (data) {
            // console.log('storage change with child: ', data);

            // console.log('conversation', data.storageArea.conversation);

            if (!fetchMyConversation) {
                var messageInfoConversation = {
                    type: 'conversation',
                    conversation: JSON.parse(localStorage.getItem('conversation'))
                };

                $.createElementChat(messageInfoConversation);

                var messageInfo = {
                    type: ''
                };

                $.createElementChat(messageInfo);
            }

            if (data.key === 'message') {
                var messageInfoArchive = {};

                if (id === localStorage.getItem('uniq')) {
                    console.log('B3:', messageInfo);

                    $.sendMsg(localStorage.getItem('message'));

                    messageInfoArchive = {
                        data: {
                            message: messageInfo
                        },
                        type: 'client'
                    };

                    $.createElementChat(messageInfoArchive);

                    console.log('B4: ', messageInfoArchive);
                } else {
                    messageInfoArchive = {
                        data: {
                            message: messageInfo
                        },
                        type: 'client'
                    };

                    $.createElementChat(messageInfoArchive);

                    console.log('A6: ', messageInfoArchive);
                }

                $('[data-type="operator"] .question-title').next().remove();

            } else if (data.key === 'conversation') {
                console.log('conversation', data.storageArea.conversation);
            }
        });

        console.log('Current id: ', id);

        $.checkWSLastTime = function () {
            if (localStorage.getItem('ws_last_time') === null) {
                return 0;
            }

            var t1 = parseInt(localStorage.getItem('ws_last_time')),
                t2 = Math.floor(Date.now() / 1000);

            if ((t2 - t1) >= 3) {
                return -1;
            }
        };

        $.checkSocket = function () {
            var a = $.checkWSLastTime();
            if (a === -1) {
                localStorage.setItem('ws_last_time', Math.floor(Date.now() / 1000).toString());
                $.connect();
            }
        };

        setInterval(function () {
            console.log(1);
            var uniq = localStorage.getItem('uniq');

            if (localStorage.getItem('ws_last_time') !== null && id !== uniq) {
                $.checkSocket();
            } else {
                if (localStorage.getItem('isSocketConnected') !== null && parseInt(localStorage.getItem('isSocketConnected'))) {
                    localStorage.setItem('ws_last_time', Math.floor(Date.now() / 1000).toString());
                }
            }

        }, 1000);

        // for show or hide connect form
        if (localStorage.getItem('ws_last_time') !== null) {
            $userFormContainer.css('display', 'none');
        }

        /*****************************************
         *
         *          End Check Connection
         *
         ****************************************/

        $.connect = function () {
            console.log('connect...');

            var uniq = localStorage.getItem('uniq');

            var userInfo = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')) : {name: $name.val(), email: $email.val()};

            var wsUri = "wss://{{ $hostname }}/wss/server.php?uniq=" + uniq + '&name=' + userInfo.name + '&email=' + userInfo.email;

            websocket = new WebSocket(wsUri);

            websocket.onopen = function () { // connection is open
                var messageInfo = {
                    type: 'system',
                    data: {
                        message: 'Connected!'
                    },
                    typingToggle: false
                };

                $reloadBtn.removeClass('hidden');

                $.createElementChat(messageInfo);

                $body.find('.send_message').prop('disabled', false);

                id = uniq;

                localStorage.setItem('isSocketConnected', '1');
                localStorage.setItem('ws_last_time', Math.floor(Date.now() / 1000).toString());
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
                    type: 'system-dc',
                    data: {
                        message: reason
                    }
                };

                $.show_hide_toggle({loading: false});

                $.createElementChat(messageInfo);

                $body.find('.send_message').prop("disabled", true);

                //localStorage.removeItem('uniq');
            };

            websocket.onmessage = function (ev) {
                var messageInfo = JSON.parse(ev.data); //PHP sends Json data

                if (localStorage.getItem('conversation') !== null) {
                    var conversation = JSON.parse(localStorage.getItem('conversation'));
                    conversation.push(messageInfo);
                    localStorage.setItem('conversation', JSON.stringify(conversation));
                }

                $.createElementChat(messageInfo);

                $message.val(''); //reset text
            };

            websocket.onerror = function () {

                var messageInfo = {
                    type: 'system',
                    data: {
                        message: 'Error Occurred'
                    }
                };

                $.createElementChat(messageInfo);
            };
        };

        $.storeMessage = function (messageInfo) {
            localStorage.setItem('message', JSON.stringify(messageInfo));
            console.log('A2: ', messageInfo);

            if (id === localStorage.getItem('uniq')) {
                $.sendMsg(messageInfo);
            }
        };

        $.sendMsg = function (messageInfo) {
            var messageInfoArchive = {},
                conversation = {};

            $.show_hide_toggle({loading: false});

            if (localStorage.getItem('uniq') === id) {
                if (localStorage.getItem('message') !== null) {
                    console.log('A3: ', messageInfo);
                    websocket.send(localStorage.getItem('message'));
                    console.log('send ');

                    if (localStorage.getItem('conversation') !== null) {
                        var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

                        messageInfoArchive = {
                            name: userInfo_name,
                            data: {message: messageInfo.value},
                            type: 'client'
                        };

                        conversation = JSON.parse(localStorage.getItem('conversation'));
                        conversation.push(messageInfoArchive);
                        localStorage.setItem('conversation', JSON.stringify(conversation));
                        console.log('A4: ', messageInfoArchive);

                        localStorage.removeItem('message');
                        console.log('A5: deleted message');
                    }
                } else {
                    localStorage.setItem('message', messageInfo);

                    if (localStorage.getItem('conversation') !== null) {
                        var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

                        messageInfoArchive = {
                            name: userInfo_name,
                            data: {message: messageInfo.value},
                            type: 'client'
                        };

                        conversation = JSON.parse(localStorage.getItem('conversation'));
                        conversation.push(messageInfoArchive);
                        localStorage.setItem('conversation', JSON.stringify(conversation));

                        localStorage.removeItem('message');
                    }
                }
            } else {
                console.log('B2: ', messageInfo);
                localStorage.setItem('message', messageInfo);
            }
        };

        $body.on('click', '.connect', function (e) {
            e.preventDefault();

            if (!$name.val().length) {
                $name.parent().addClass('has-error');
            } else {
                $name.parent().removeClass('has-error');
            }

            if (!$email.val().length) {
                $email.parent().addClass('has-error');
            } else {
                $email.parent().removeClass('has-error');
            }

            if (!$name.val().length || !$email.val().length) {
                return;
            }

            localStorage.setItem('userInfo',JSON.stringify({name:$name.val(),email:$email.val()}));

            $.connect();

            $userFormContainer.stop().slideUp('fast');
        });

        $body.on('click', '.send_message', function (e) { //use clicks message send button
            e.preventDefault();

            var messageInfo = {},
                dataMessage = currentData;

            var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

            if (!$.trim($message.val()).length && dataMessage.type !== 'bot') {
                return false;
            }

            if (dataMessage.type === 'bot') {
                if (dataMessage.data.params.required !== undefined && dataMessage.data.params.required && !$message.val().length) {

                    $message.addClass('has-error');

                    $.showError({toggle: true, message: 'Please fill message'});

                    return false;

                } else if (dataMessage.data.params.validation !== undefined) {
                    if (dataMessage.data.params.validation === 'email' && !$.emailValidation($message.val())) {

                        $message.addClass('has-error');

                        $.showError({toggle: true, message: 'Please enter a valid email address'});

                        return false;

                    } else if (dataMessage.data.params.validation === 'phone') {

                    }

                } else {
                    $.showError({toggle: false});

                    $message.removeClass('has-error');
                }

                dataMessage.data.value = $message.val();

                console.log('check mom: ', id, localStorage.getItem('uniq'));

                if (id === localStorage.getItem('uniq')) {
                    console.log('A1: ', dataMessage);
                } else {
                    console.log('B1: ', dataMessage);
                }

                $.storeMessage(dataMessage);

                $(this).data('message', '');

                messageInfo = {
                    type: 'client',
                    data: {message: $message.val()},
                    name: userInfo_name,
                    typingToggle: false
                };

                $.createElementChat(messageInfo);

                $message.val('');

                $.show_hide_toggle({typing: false, loading: true});

            } else {
                messageInfo = {
                    type: 'client',
                    data: {message: $message.val()},
                    name: userInfo_name,
                    typingToggle: true
                };

                $.createElementChat(messageInfo);

                $.storeMessage(messageInfo);

                $message.val('');
            }
        });

        $body.on('keydown', '#message', function (e) {
            var keyCode = e.which ? e.which : e.keyCode;

            if (keyCode === 13 && !e.shiftKey) {
                e.preventDefault();

                $body.find('.send_message').trigger('click');
            }
        });

        $body.on('keyup, blur', '.form-control[required]', function () {
            if ($(this).val().length > 2) {
                $(this).parent().removeClass('has-error');
            } else {
                $(this).parent().addClass('has-error');
            }

            if ($(this).attr('id') === 'email' && !$.emailValidation($(this).val())) {
                $(this).parent().addClass('has-error');
            } else if ($(this).attr('id') === 'email' && $.emailValidation($(this).val())) {
                $(this).parent().removeClass('has-error');
            }
        });

        $body.on('click', '.item-choice', function () {
            var dataMessage = currentData,
                optionValue = $(this).data('value');

            var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

            dataMessage.data.value = optionValue;

            currentData = [];

            var messageInfo = {
                type: 'bot',
                data: dataMessage.data
            };

            $.storeMessage(messageInfo);

            messageInfo = {
                type: 'client',
                data: {
                    message: $(this).children().html()
                },
                name: userInfo_name
            };

            $.createElementChat(messageInfo);

            $.show_hide_toggle({typing: false, loading: false});

            $(this).parent('.multiple-choice').find('.item-choice').remove();
        });

        $body.on('click', '.select-date', function (e) {
            e.preventDefault();

            debugger;

            var dataMessage = currentData;

            var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

            var messageInfo = {
                type: 'bot',
                action: 'client',
                data: dataMessage.data
            };

            $.storeMessage(messageInfo);

            flatPickr.destroy();

            $(this).remove();

            messageInfo = {
                type: 'client',
                data: {
                    message: dataMessage.data.value
                },
                name: userInfo_name
            };

            $.createElementChat(messageInfo);
        });

        $body.on('click', '.select-place', function (e) {
            e.preventDefault();

            var dataMessage = currentData;
            dataMessage.data.value = JSON.stringify(dataMessage.data.value);

            var userInfo_name = localStorage.getItem('userInfo') !== null ? JSON.parse(localStorage.getItem('userInfo')).name : $name.val();

            var messageInfo = {
                type: 'bot',
                data: dataMessage.data
            };

            $.storeMessage(messageInfo);

            map.remove();

            $body.find('[data-type="operator"] .map-container').remove();

            $(this).remove();

            dataMessage.data.value = JSON.parse(dataMessage.data.value);

            messageInfo = {
                type: 'client',
                data: dataMessage.data,
                name: userInfo_name
            };

            $.createElementChat(messageInfo);
        });

        $body.on('click', '.refresh-btn', function (e) {
            e.preventDefault();

            var uniq = localStorage.getItem('uniq');

            if (id === uniq) {
                $.show_hide_toggle({typing: false, loading: true, log: false});

                localStorage.removeItem('conversation');
                localStorage.removeItem('isSocketConnected');
                /*localStorage.setItem('uniq', (new Date().getTime()).toString(16));*/

                $messageBox.find('.message_container').html('');

                $userFormContainer.stop().slideDown('fast');

                $.show_hide_toggle({typing: false, loading: false, log: false});

                $reloadBtn.addClass('hidden');



                var messageInfo = {
                    type: 'chatReload',
                    data: {
                        uniq: uniq
                    }
                };

                $.storeMessage(messageInfo,function () {
                    websocket.close();
                });


            }
        });

        $body.on('keypress', '#name, #email', function(e) {
            var code = e.which ? e.which : e.keyCode;
            if (code === 13) {
                $body.find('.connect').trigger('click');
            }
        });

        $.createElementChat = function (messageInfo, isConversation) {
            var html = '',
                innerHtml = '',
                rndMapId = Math.floor((Math.random() * 100) + 1);

            $message.attr('placeholder', 'Type your message here');
            $messageTyping.find('[name="message"]').attr('type', 'text');

            console.log(messageInfo);

            switch (messageInfo.type) {
                case 'client':
                    if (messageInfo.data.value !== undefined && messageInfo.data.value.action !== undefined && messageInfo.data.value.action === 'mapPreview') {

                        html = [
                            '<div class="message_client">',
                            '<span>You Selected Here:</span>',
                            '<div id="map' + rndMapId + '" class="map-container mini"></div>',
                            '</div>'
                        ].join('');

                        $.show_hide_toggle({typing: false, loading: true});

                    } else {

                        $.show_hide_toggle({typing: true, loading: false});
                        html = '<div class="message_client">' + messageInfo.data.message + '</div>';

                    }

                    break;

                case 'operator':
                    $.show_hide_toggle({typing: true, loading: false});
                    if (isConversation === undefined) {
                        $.playSound('ding');
                    }

                    html = '<div class="message_operator">' + messageInfo.data.message + '</div>';

                    break;

                case 'system':
                    $body.find('.system-log').remove();

                    if (messageInfo.action === 'connectToOperator') {
                        var operatorAvatar = [
                            '<span class="avatar-online-badge pos-abs img-circle hidden"></span>',
                            '<img class="img-circle header-avatar pull-left pos-rel" src="https://{{ $hostname }}/socket/asset/img/avatar-operator.svg">'
                        ].join('');

                        html = '<div class="system-log">Connected to ' + messageInfo.name + '</div>';

                        $messageLog.html(operatorAvatar + messageInfo.name);

                        $message.prop({placeholder: 'Type your message here', type: 'text'});

                        currentData = {};

                        $.show_hide_toggle({typing: true, loading: false, log: true});

                    } else if (messageInfo.action === 'pendingAssignment') {
                        html = '<div class="system-log text-primary">' + messageInfo.data.message + '</div>';

                        $.show_hide_toggle({typing: true, loading: false, log: true});
                    }

                    $avatarOnlineBadge.removeClass('hidden');

                    $messageBox.find('.message_container').append(html);

                    break;

                case 'system-dc':
                    $body.find('.system-log').remove();

                    html = '<div class="system-log">' + messageInfo.data.message + '</div>';

                    $messageBox.find('.message_container').append(html);

                    $avatarOnlineBadge.addClass('hidden');

                    $.show_hide_toggle({typing: false, loading: true, log: true});

                    break;

                case 'bot':
                    var botAvatar = '<img src="https://{{ $hostname }}/socket/asset/img/avatar-bot.svg">';

                    if (isConversation === undefined) {
                        $.playSound('ding');
                    }

                    var data = messageInfo.data;

                    if (data !== null && data !== undefined && data.type !== undefined) {
                        switch (data.type) {
                            case 'message':

                                innerHtml = [
                                    '<div data-type="operator" class="message-content pos-rel">',
                                    '   <span class="avatar pos-abs">',
                                    botAvatar,
                                    '   </span>',
                                    '   <div class="message_operator">' + data.message + '</div>',
                                    '</div>'
                                ].join('');

                                messageInfo = {
                                    type: 'bot',
                                    data: data,
                                    action: 'client'
                                };

                                if (data.conversation === undefined) {
                                    $.storeMessage(messageInfo);

                                    $.show_hide_toggle({typing: false, loading: false});

                                    if (data.data !== undefined && data.data.params.next === 'end') {
                                        $reloadBtn.trigger('mouseover');
                                    }
                                }

                                break;

                            case 'question':
                                innerHtml = [
                                    '<div data-type="operator" class="message-content pos-rel">',
                                    '   <span class="avatar pos-abs">',
                                    botAvatar,
                                    '   </span>',
                                    '   <div class="message_operator">' + data.message + '</div>',
                                    '</div>'
                                ].join('');

                                if (data.params.validation !== undefined && data.params.validation === 'email') {

                                    $message.attr('placeholder', 'Please Enter your email');

                                    $messageTyping.find('[name="message"]').attr('type', 'email');

                                } else if (data.params.validation !== undefined && data.params.validation === 'phone') {

                                    $message.attr('placeholder', 'Please Enter your phone number');

                                    $messageTyping.find('[name="message"]').attr('type', 'phone');

                                } else {
                                    $messageTyping.find('[name="message"]').attr('type', 'text');
                                }

                                $.show_hide_toggle({typing: true, loading: false, focus: true});

                                messageInfo = {
                                    type: 'bot',
                                    data: data,
                                    action: 'client'
                                };

                                currentData = messageInfo;

                                break;

                            case 'multiple-choice':
                                html = '';

                                currentData = messageInfo;

                                $.each(data.params.list, function (i, v) {
                                    html += [
                                        '<span class="item-choice" data-value="' + (v.value !== undefined ? v.value : v.label) + '">',
                                        '   <span class="btn btn-primary text-bold btn-sm">',
                                        v.label,
                                        '   </span>',
                                        '</span>'
                                    ].join('');
                                });

                                innerHtml = [
                                    '<div data-type="operator" class="message-content pos-rel">',
                                    '   <span class="avatar pos-abs">',
                                    botAvatar,
                                    '   </span>',
                                    '   <div class="message_operator multiple-choice full-width">',
                                    '       <span class="question-title">' + data.message + '</span>',
                                    html,
                                    '   </div>',
                                    '</div>'
                                ].join('');

                                $.show_hide_toggle({typing: false, loading: false});

                                break;

                            case 'calendar':

                                currentData = messageInfo;

                                innerHtml = [
                                    '<div data-type="operator" class="message-content pos-rel">',
                                    '   <span class="avatar pos-abs">',
                                    botAvatar,
                                    '   </span>',
                                    '   <div class="message_operator full-width">',
                                    '       <span class="question-title">' + data.message + '</span>',
                                    '       <span class="calendar-container"></span>',
                                    '       <button class="select-date btn btn-primary btn-block hidden">Select Date</button>',
                                    '   </div>',
                                    '</div>'
                                ].join('');

                                $.show_hide_toggle({loading: false});

                                break;

                            case 'map':

                                currentData = messageInfo;

                                innerHtml = [
                                    '<div data-type="operator" class="message-content pos-rel">',
                                    '   <span class="avatar pos-abs">',
                                    botAvatar,
                                    '   </span>',
                                    '   <div class="message_operator full-width">',
                                    '       <span class="question-title">' + data.message + '</span>',
                                    '       <div id="map' + rndMapId + '" class="map-container full-width full-height"></div>',
                                    '       <button class="select-place btn btn-primary btn-block hidden">Select this place</button>',
                                    '   </div>',
                                    '</div>'
                                ].join('');

                                $.show_hide_toggle({loading: false});

                                break;
                        }
                    }

                    break;

                case 'conversation':

                    if (messageInfo.conversation !== null) {
                        localStorage.setItem('conversation', JSON.stringify(messageInfo.conversation));

                        fetchMyConversation = true;

                        if (messageInfo['conversation'].length) {
                            $.playSound('ding');
                        }

                        $.each(messageInfo['conversation'], function (i, v) {
                            var type = '',
                                name = '',
                                botType = '';

                            switch (v.type) {
                                case 'client':
                                    type = 'client';
                                    name = v.name;
                                    break;

                                case 'operator':
                                    type = 'operator';
                                    name = v.name;
                                    break;

                                case 'bot':
                                    type = 'bot';
                                    name = v.name;
                                    botType = 'message';
                                    break;
                            }

                            var tmpMessageInfo = {
                                type: type,
                                name: name,
                                data: {
                                    message: v.data.message
                                },
                                typingToggle: false
                            };

                            if (type === 'bot') {
                                tmpMessageInfo.data.type = botType;
                                tmpMessageInfo.data.conversation = 1;
                            }

                            $.createElementChat(tmpMessageInfo, true);
                        });
                    }

                    break;
            }

            var lastMessage = $messageBox.find('.message_container .message-content:last-child').data('type');

            if (lastMessage === messageInfo.type) {

                if ($body.find('[data-type="offline_message"]').length) {
                    $messageBox.find('.message_container .message-content:last-child').html(html);
                } else {
                    $messageBox.find('.message_container .message-content:last-child').append(html);
                }

            } else {

                if (!['system', 'system-dc', 'bot', 'offlineMsgSend', 'conversation'].includes(messageInfo.type)) {
                    innerHtml = [
                        '<div data-type="' + messageInfo.type + '" class="message-content pos-rel">',
                        '   <span class="avatar pos-abs">',
                        '       <span class="avatar-name pos-abs">' + messageInfo.name + '</span>',
                        '       <img src="https://{{ $hostname }}/socket/asset/img/avatar-' + messageInfo.type + '.svg">',
                        '   </span>',
                        html,
                        '</div>'
                    ].join('');
                }

                $messageBox.find('.message_container').append(innerHtml);

                if (messageInfo.type === 'bot' && messageInfo.data !== null && messageInfo.data !== undefined && messageInfo.data.type === 'calendar') {
                    flatPickr = $body.find('.calendar-container').flatpickr({
                        dateFormat: 'Y-m-d',
                        inline: true,
                        minDate: 'today',
                        onChange: function (selectedDates, dateStr, instance) {

                            $body.find('.select-date').removeClass('hidden');

                            $.goScrollDown();

                            currentData.data.value = dateStr;

                        }
                    });
                } else if (messageInfo.type === 'bot' && messageInfo.data !== null && messageInfo.data !== undefined && messageInfo.data.type === 'map') {

                    map = new mapboxgl.Map({
                        container: 'map' + rndMapId, // container id
                        style: 'mapbox://styles/mapbox/light-v9', //stylesheet location
                        center: [-101.592301, 39.986656], // starting position
                        zoom: 2 // starting zoom
                    });

                    map.addControl(new MapboxGeocoder({
                        accessToken: mapboxgl.accessToken
                    }));

                    map.addControl(new mapboxgl.GeolocateControl({
                        positionOptions: {
                            enableHighAccuracy: true
                        },
                        trackUserLocation: true
                    }));

                    var markers = [];
                    map.on('click', function (e) {
                        if (markers.length) {
                            $.each(markers, function (index, marker) {
                                marker.remove();
                            });
                        }

                        var lngLat = e.lngLat;

                        currentData.value = {action: 'mapPreview', lngLat: e.lngLat, zoom: map.getZoom()};

                        currentData.data.value = currentData.value;

                        // delete(currentData.value);

                        console.log('map value : ', currentData);

                        markers.push(new mapboxgl.Marker().setLngLat([lngLat.lng, lngLat.lat]).addTo(map));

                        $body.find('.select-place').removeClass('hidden');

                        $.goScrollDown();
                    });
                }

                if (messageInfo.type === 'client' &&
                    messageInfo.data !== undefined &&
                    messageInfo.data.value !== undefined &&
                    messageInfo.data.value.action !== undefined &&
                    messageInfo.data.value.action === 'mapPreview') {
                    map = new mapboxgl.Map({
                        container: 'map' + rndMapId, // container id
                        style: 'mapbox://styles/mapbox/light-v9', //stylesheet location
                        center: [messageInfo.data.value.lngLat.lng, messageInfo.data.value.lngLat.lat], // starting position
                        zoom: messageInfo.data.value.zoom,// starting zoom
                        interactive: false
                    });

                    new mapboxgl.Marker().setLngLat([messageInfo.data.value.lngLat.lng, messageInfo.data.value.lngLat.lat]).addTo(map);
                }
            }

            $.goScrollDown();
        };

        $.show_hide_toggle = function (toggleObj) {
            if (toggleObj.typing !== undefined) {
                if (toggleObj.typing) {
                    $messageBox.removeClass('without_typing');
                    $messageTyping.stop().slideDown(50);
                } else {
                    $messageBox.addClass('without_typing');
                    $messageTyping.stop().slideUp('fast');
                }
            }

            if (toggleObj.log !== undefined) {
                if (toggleObj.log) {
                    $messageLog.stop().slideDown(50);
                } else {
                    $messageLog.stop().slideUp(50);
                }
            }

            if (toggleObj.loading !== undefined) {
                if (toggleObj.loading) {
                    $body.find('.loading').stop().slideDown(50);
                    $messageBox.addClass('loadingMessage');
                } else {
                    $body.find('.loading').stop().slideUp(50);
                    $messageBox.removeClass('loadingMessage');
                }
            }

            if (toggleObj.focus !== undefined) {
                if (toggleObj.focus) {
                    $messageTyping.find('[name="message"]').focus();
                }
            }
        };

        $.goScrollDown = function () {
            var elem = document.getElementById('message_box');
            elem.scrollTop = elem.scrollHeight;
        };

        $.emailValidation = function (txt) {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            return !!txt.match(mailformat);
        };

        $.playSound = function (filename) {
            var mp3Source = ['<source src="/socket/asset/sounds/', filename, '.mp3" type="audio/mpeg">'].join('');

            document.getElementById("sound").innerHTML = '<audio autoplay="autoplay">' + mp3Source + '</audio>';
        };

        $.showError = function (config) {
            var $showMessage = $body.find('.show_message');

            if (config.toggle) {
                $showMessage.addClass('active');
            } else {
                $showMessage.removeClass('active');
            }

            $showMessage.html(config.message !== undefined ? config.message : '');
        };
    });
</script>
</body>
</html>
@endsection