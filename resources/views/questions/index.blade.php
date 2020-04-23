@extends('layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a class="text-18">Bot Detail</a></li>
        </ul>

        <a data-botid="{{$botId}}" class="publish-bot top-heading-button btn btn-success btn-icon mat-elevation-z radius-all mat-button pos-abs">
            <i class="fa fa-check"></i> Publish Bot
        </a>
    </div>
    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0 bg-cloud">
            <div class="panel-body full-height">

                {{--<div class="operator_log"></div>
                <div class="chat-list-container full-height">
                    <ul class="client-list nav nav-tabs pull-left full-width" role="tablist">

                        @foreach ($questions as $item)
                            <li class="alert-info alert">
                            {{ $item['title'] }} -
                            {{ $item['type'] }} -
                            {{ $item['value'] }}
                            </li>
                        @endforeach

                    </ul>

                    <!-- Tab panes -->
                    <div class="chat-content pull-left">
                        <div class="tab-content full-width full-height"></div>
                    </div>
                </div>--}}

                <div class="bot-creator-container full-height pos-rel">
                    <div class="row pos-abs full-width full-height right-0 left-0 top-0 bottom-0 center-block">
                        <div class="bot-widget-container col-xs-12 col-sm-4 col-md-4 full-height overflow-hide">
                            <h2 class="full-width clear text-18 bordered-bottom border-midnight padding-b-half">Internal
                                Widget</h2>

                            <div class="disInlineBlock full-width drag-btn">
                                <a data-type="message" class="btn-widget draggable btn btn-default btn-icon mat-button mat-elevation-z radius-all margin-half pull-left">
                                    <i class="fa fa-commenting-o font-full-plus-two-tenth-em"></i>
                                    <span class="btn-text"><span class="item-name pull-left"></span><div class="item-title pull-left padding-l-half">Message</div></span>
                                    <span class="connected-status pos-abs text-light-gray text-12 left-full height-25">Not connected yet</span>
                                </a>
                                <a data-type="question" class="btn-widget draggable btn btn-default btn-icon mat-button mat-elevation-z radius-all margin-half pull-left">
                                    <i class="fa fa-question-circle-o font-full-plus-two-tenth-em"></i>
                                    <span class="btn-text"><span class="item-name pull-left"></span><div class="item-title pull-left padding-l-half">Question</div></span>
                                    <span class="connected-status pos-abs text-light-gray text-12 left-full height-25">Not connected yet</span>
                                </a>
                                <a data-type="multiple-choice" class="btn-widget draggable btn btn-default btn-icon mat-button mat-elevation-z radius-all margin-half pull-left multi-items">
                                    <i class="fa fa-th-list"></i>
                                    <span class="btn-text"><span class="item-name pull-left"></span><div class="item-title pull-left padding-l-half">Multiple Choice</div></span>
                                    <div class="item-container"></div>
                                </a>
                            </div>

                            <br>

                            <h2 class="full-width clear text-18 bordered-bottom border-midnight padding-b-half">External
                                Widget</h2>

                            <div class="disInlineBlock full-width drag-btn">
                                <a data-type="4smile_api" class="btn-widget draggable btn btn-light-warning btn-icon mat-button mat-elevation-z radius-all margin-half pull-left">
                                    <i class="fa fa-calendar"></i>
                                    <span class="btn-text"><span class="item-name pull-left"></span><div class="item-title pull-left padding-l-half">4Smile API</div></span>
                                    <span class="connected-status pos-abs text-light-gray text-12 left-full height-25">Not connected yet</span>
                                </a>
                            </div>
                        </div>

                        <div id="sortable" class="bot-preview radius bg-white bordered border-cloud col-xs-12 col-sm-8 col-md-8 full-height padding-t-b-full-2 overflow-x-hide overflow-y-auto"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bot-preview-container pos-fix width-150 right-full-2 bottom-0 center-block z-index-100">
            <button class="btn btn-primary radius-top mat-elevation-z mat-button btn-block text-16">Bot Preview</button>
        </div>
    </div>

    <div class="bot-creator-builder-container pos-fix bg-cloud full-width full-height top-0 bottom-0 transition">
        <a class="close-overlay-box text-danger pos-abs width-35 height-35 line-height-35 text-center top-full left-full">
            <i class="fa fa-times text-18"></i>
        </a>

        <a class="save-element width-150 pos-abs btn btn-success height-35 btn-icon mat-button mat-elevation-z radius-all top-full right-full-plus-half"><i class="fa fa-check"></i> Save Element</a>

        <div class="form-container full-width full-height padding-t-full-4 padding-b-full padding-r-l-plus-half overflow-y-auto overflow-x-hide">
            <h3 class="detail-title text-capital disBlock margin-t-three-tenth bordered-top border-cloud padding-t-b">
                <i class="fa"></i>
                <span class="text-capital"></span>
            </h3>

            <input type="hidden" id="elementId">
            <input type="hidden" id="itemType">

            <div class="form-group pos-abs right-full-plus-half top-full-4">
                <label for="name" class="control-label text-normal no-margin full-width">Element's Name</label>
                <input type="text" class="form-control" id="name" required readonly>
            </div>

            <div class="form-group">
                <label for="question" class="control-label text-normal no-margin full-width">Chat Message</label>
                <input type="text" class="form-control" id="question">
            </div>

            <div class="validation-required-container hidden">
                <div class="form-group no-margin-b">
                    <label class="checkbox-inline line-height-20" for="required">
                        <input type="checkbox" id="required" value="required"> Required
                    </label>
                </div>

                <div class="form-group">
                    <div class="pull-left">
                        <label class="checkbox-inline control-label">
                            <input class="pos-rel top-half" type="checkbox" id="validation_status">
                        </label>
                    </div>

                    <label class="control-label text-normal no-margin pull-left" for="validation_status">Validation</label>

                    <div class="btn-group validation-container radius-all pull-left margin-l-full margin-t-three-tenth hidden" role="group">
                        <button data-value="email" type="button" class="btn btn-primary btn-icon btn-xs line-height-25 width-90 padding-l-full-3 radius-left active">
                            <i class="fa fa-envelope no-bg line-height-20 margin-mini-r-l"></i> Email
                        </button>
                        <button data-value="phone" type="button" class="btn btn-primary btn-icon btn-xs line-height-25 width-90 padding-l-full-3 radius-right not-active">
                            <i class="fa fa-phone no-bg line-height-20 margin-mini-r-l"></i> Phone
                        </button>
                    </div>
                </div>
            </div>

            <div class="multi-option-container hidden">
                <label for="options" class="control-label text-normal no-margin full-width">
                    Options
                </label>
                <div class="form-group">
                    <div class="row multiOption">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control label" required>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <label class="control-label text-normal">If selected, go to: </label>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <span class="text-danger">*</span>
                            <select class="form-control next-selector" required></select>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1">
                            <button class="remove-option text-danger btn btn-link text-16 line-height-35"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>

                <button class="appendToOption btn btn-info btn-xs mat-button height-30 line-height-30 radius-all btn-icon mat-elevation-z margin-b-full">
                    <i class="fa fa-plus"></i> <span>Append Option</span>
                </button>
            </div>

            <div class="form-group show-next-field hidden">
                <label for="next_item" class="control-label text-normal no-margin full-width">Next Element <span class="text-danger font-full-plus-half-em pos-rel top-three-tenth left-three-tenth">*</span></label>
                <select id="next_item" class="form-control next-selector" required></select>
            </div>
        </div>
    </div>
    
    <script>
        var $body                        = $('body'),
            $elementId                   = $body.find('#elementId'),
            $itemType                    = $body.find('#itemType'),
            $botCreatorBuilderContainer  = $body.find('.bot-creator-builder-container'),
            $validationRequiredContainer = $body.find('.validation-required-container'),
            $multiOptionContainer        = $body.find('.multi-option-container'),
            $overlay                     = $body.find('.overlay'),
            $showNextField               = $body.find('.show-next-field'),
            $validationContainer         = $body.find('.validation-container'),
            cntDeleteButton              = 0;

        $(function () {
            // show if bot item exist
            $.showAllBotItems();

            // enable auto save changes on bot creator
            // $.autoSaveElement();

            $(document).on('keydown', function(e) {
                var key = e.which ? e.which : e.keyCode;

                if (key === 27) {
                    if ($botCreatorBuilderContainer.hasClass('active')) {
                        $overlay.trigger('click');
                    }
                }
            });

            $overlay.on('click', function () {
                $(this).fadeOut('fast');

                $botCreatorBuilderContainer.removeClass('active');
            });

            $body.on('click', '.close-overlay-box', function () {
                $overlay.trigger('click');
            });

            $( "#sortable" ).sortable({
                revert: true,
                containment: '.bot-preview',
                stop: function(e, ui) {
                    $(ui.item[0]).attr('style', '');
                    e.toElement.style = '';

                    $.reorderBotItems();
                }
            });

            $( ".bot-widget-container .draggable" ).draggable({
                connectToSortable: '#sortable',
                containment: '.bot-creator-container',
                helper: 'clone',
                revert: 'invalid',
                stop: function(e, ui) {
                    var el = $(ui.helper[0]),
                        type = el.data('type'),
                        data = {
                            element_id: 0,
                            name: '',
                            message: '',
                            type: type,
                            params: {},
                            priority: 0
                        };

                    var destination = $(ui.helper['0']).parent();

                    if (!destination.hasClass('disInlineBlock')) {
                        var newData = $.get_set_botItem('set', data);

                        $.addEssentialButtonToBotItem(el, newData, false);
                    }
                }
            }).on('click', function() {
                var type = $(this).data('type'),
                    data = {
                        element_id: 0,
                        name: '',
                        message: '',
                        type: type,
                        params: {},
                        priority: 0
                    };

                var newData = $.get_set_botItem('set', data);

                var newel = $(this).clone().appendTo('.bot-preview');

                $.addEssentialButtonToBotItem($(newel[0]), newData, false);
            });

            $body.on('click', '.delete_botItem', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var $self   = $(this),
                    itemId  = $self.data('id'),
                    title   = '',
                    message = 'Are you sure want to delete this item?';

                $.iziQuestionDelete(title, message).then(function (result) {
                    if (result) {
                        var itemList = $.get_set_botItem('getList');

                        itemList = $.grep(itemList, function(v, i) {
                            return (itemId !== v.element_id);
                        });

                        $.get_set_botItem('remove', itemList);

                        $self.parent().remove();
                    }
                });
            });

            $body.on('click', '.bot-preview .btn-widget', function () {
                var itemId = $(this).data('id');

                $overlay.fadeIn('fast');

                $botCreatorBuilderContainer.addClass('active');

                var formData = $.get_set_botItem('fetchItem', {element_id: itemId});

                $.fillForm(formData);
            });

            $body.on('click', '.appendToOption', function(e) {
                e.preventDefault();

                if ($(this).prev('.form-group').find('.row').length >= 10) {$(this).prop('disabled', true); return}

                var $multiOption = $(this).prev('.form-group').find('.row:last-child').html(),
                    deleteButton = '<div class="col-xs-1 col-sm-1 col-md-1">' +
                                   '    <button class="remove-option text-danger btn btn-link text-16 line-height-35"><i class="fa fa-times"></i></button>' +
                                   '</div>';

                var htmlDeleteButton = !cntDeleteButton ? deleteButton : '';

                $multiOptionContainer.find('.form-group').append('<div class="row multiOption">' + $multiOption + htmlDeleteButton + '</div>');

                $multiOptionContainer.find('.form-group .multiOption:last-child input:visible, .form-group .multiOption:last-child select:visible').trigger('change');

                cntDeleteButton++;
            });

            $body.on('click', '.remove-option', function(e) {
                e.preventDefault();

                $(this).parents('.multiOption').remove();

                if ($('.appendToOption').is(':disabled')) {
                    $('.appendToOption').prop('disabled', false);
                }

                cntDeleteButton--;
            });

            $body.on('change', '#validation_status', function() {
                if ($(this).is(':checked')) {
                    $validationContainer.removeClass('hidden');
                } else {
                    $validationContainer.addClass('hidden');
                }
            });

            $body.on('click', '.validation-container .btn', function() {
                var value = $(this).data('value');

                if (value === 'email') {
                    $(this).removeClass('not-active').addClass('active');
                    $(this).next().removeClass('active').addClass('not-active');
                } else if (value === 'phone') {
                    $(this).removeClass('not-active').addClass('active');
                    $(this).prev().removeClass('active').addClass('not-active');
                }
            });

            $body.on('click', '.save-element', function(e) {
                e.preventDefault();

                var elementId = parseInt($elementId.val()),
                    botItem = $.get_set_botItem('fetchItem', {element_id: elementId}),
                    formData = $.fetchFormData();

                if($.validateForm()) {
                    $.iziWarning('Warning', 'Please complete all required items!');

                    return false;
                }

                Object.assign(botItem, formData);

                $.get_set_botItem('updateItem', botItem);

                var getNewItem  = $.get_set_botItem('fetchItem', {element_id: elementId}),
                    getNextItem = {};

                $body.find('.bot-preview [data-id="'+ getNewItem.element_id +'"] .btn-text .item-title').html(getNewItem.message);

                if (botItem.type !== 'multiple-choice') {
                    if (getNewItem.params.next !== undefined) {
                        if (getNewItem.params.next !== 'end') {
                            getNextItem = $.get_set_botItem('fetchItem', {element_id: getNewItem.params.next});
                        } else {
                            getNextItem.name = 'End';
                        }

                        $body.find('.bot-preview [data-id="'+ getNewItem.element_id +'"] .connected-status').removeClass('text-light-gray').addClass('text-danger').html('Next to : ' + getNextItem.name);
                    }
                } else if (botItem.type === 'multiple-choice') {
                    var multiItemHtml = '';

                    if (getNewItem.params.list.length) {
                        $.each(getNewItem.params.list, function(i, v) {
                            var label = v.label,
                                next = v.next,
                                nextItem = {};

                            if (v.next !== 'end') {
                                nextItem = $.get_set_botItem('fetchItem', {element_id: next})
                            } else {
                                nextItem.name = 'End';
                            }

                            multiItemHtml += [
                                '<div class="min-width-100 pos-rel btn btn-blue btn-sm margin-t-half margin-b-full-2 margin-r-full radius-all pull-left">',
                                    '<span class="item-label">'+ label +'</span>',
                                    '<span class="connected-status pos-abs left-full top-full-2 text-red">Next to: '+ nextItem.name +'</span>',
                                '</div>'
                            ].join('');
                        });
                    }

                    $body.find('.bot-preview [data-id="'+ getNewItem.element_id +'"] .item-container').html(multiItemHtml);
                }

                $.iziSuccess('', 'Bot updated successfully');

                $overlay.trigger('click');
            });

            $body.on('click', '.publish-bot', function(e) {
                e.preventDefault();

                var botId = $(this).data('botid');
                var data = {data: JSON.stringify($.get_set_botItem('getList')), bot_id: botId};

                $.httpRequest('/questions/updateBot', 'post', data).then(function(resp) {
                    if (resp.result === 1) {
                        $.iziSuccess('', resp.msg);
                    } else {
                        $.iziError('', resp.msg);
                    }
                });

                var messageInfo = {
                    type: 'questionsReload',
                    data:data
                };

                sendMsg(messageInfo);

            });
        });

        /* essential functions */
        $.httpRequest = function (url, method, data, isJson) {
            var option = {
                url: url,
                headers:  {'X-CSRF-TOKEN': $('html').find('meta[name="csrf-token"]').attr('content')}
            };

            if (method !== undefined && method !== null && method !== '') {
                option.method = method;
            }

            if (data !== undefined && data !== null && data !== '') {
                option.data = data;
            }

            if (isJson !== undefined && isJson === true) {
                option.contentType = "application/json; charset=utf-8";
            }

            return $.ajax(option);
        };

        $.get_set_botItem = function(status, data) {

            var botItems = localStorage.getItem('bot_{{$botId}}_items');

            if (botItems !== null) {
                botItems = JSON.parse(botItems);
            } else {
                botItems = [];
            }

            switch (status) {
                case 'set':
                    if (!botItems.length) {
                        data.element_id = 1;
                    }

                    // get last botItem id
                    var lastId      = $.getLastItemId();
                    data.element_id = lastId;
                    data.priority   = lastId - 1;
                    data.name       = data.type + ' ' + data.element_id;

                    botItems.push(data);

                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(botItems));

                    $.fill_nextSelector();

                    return {element_id: data.element_id, name: data.name};

                case 'remove':

                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(data));

                    break;

                case 'getList':

                    return botItems;

                case 'fetchItem':
                    return $.grep(botItems, function(v, i) {
                        return v.element_id === parseInt(data.element_id);
                    }).pop();

                case 'reorderItems':

                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(data));

                    break;

                case 'updateItem':

                    botItems.map(function(item) {
                        if (item.element_id === data.element_id) {
                            Object.assign(item, data);
                        }
                    });

                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(botItems));


                    break;
            }

        };

        $.getLastItemId = function() {
            var botItems = $.get_set_botItem('getList'),
                lastId = 0;

            botItems.map(function(v) {
                lastId = lastId > v.element_id ? lastId : v.element_id;
            });

            return ++lastId;
        };

        $.addEssentialButtonToBotItem = function(el, newData, get) {
            var deleteIcon = '<span data-id="'+ newData.element_id +'" class="delete_botItem pos-abs top-0 right-0 pull-right cursor_pointer text-danger text-16"><i class="fa fa-trash"></i></span>';

            if (get) {
                return deleteIcon;
            } else {
                el.append(deleteIcon);
                el.attr('data-id', newData.element_id);
                el.find('.btn-text .item-name').html('[ ' + newData.name + ' ]');
                el.find('.btn-text .item-title').html('')
            }
        };

        $.showAllBotItems = function() {

            $.httpRequest('/api/questions/ajax', 'post', {botId: '{{$botId}}'}).then(function(resp) {
                if (resp.length) {
                    resp.map(function(item) {
                       item.name = item.type.replace('-', '') + ' ' + item.element_id;
                    });

                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(resp));

                    var botItems = $.get_set_botItem('getList'),
                        elToClone = $body.find('.btn-widget[data-type="message"]');

                    console.log(botItems);

                    $multiOptionContainer.find('.multiOption:first-child .remove-option').parent().remove();

                    $.each(botItems, function(i, v) {
                        var botBtns = $.addEssentialButtonToBotItem('', {element_id: v.element_id}, true),
                            icon = '',
                            multiItemHtml = '',
                            nextBotItem = {name: ''},
                            nextContent = '<span class="connected-status pos-abs text-light-gray text-12 left-full height-25">Not connected yet</span>';

                        if (v.type !== 'multiple-choice') {

                            if (v.params.next !== 'end') {
                                nextBotItem = $.get_set_botItem('fetchItem', {element_id: v.params.next});
                            } else {
                                nextBotItem.name = 'End';
                            }

                            nextContent = '<span class="connected-status pos-abs text-12 left-full height-25 ' + (nextBotItem !== undefined ? 'text-red' : 'text-light-gray') +'">'+ (nextBotItem !== undefined ? 'Next to: ' + nextBotItem.name : 'Not connected yet') +'</span>';
                        }

                        switch (v.type) {
                            case 'message':
                                icon = 'fa-commenting-o';
                                break;

                            case 'question':
                                icon = 'fa-question-circle-o';
                                break;

                            case 'multiple-choice':
                                icon = 'fa-th-list';
                                nextContent = '';
                                multiItemHtml = '<div class="item-container">';

                                if (v.params.list.length) {
                                    $.each(v.params.list, function(i, v) {
                                        var label = v.label,
                                            next = v.next,
                                            nextItem = {};

                                        if (v.next !== 'end') {
                                            nextItem = $.get_set_botItem('fetchItem', {element_id: next})
                                        } else {
                                            nextItem.name = 'End';
                                        }

                                        multiItemHtml += ['<div class="min-width-100 pos-rel btn btn-blue btn-sm margin-t-half margin-b-full-2 margin-r-full radius-all pull-left">',
                                                          '<span class="item-label">'+ label +'</span>',
                                                          '<span class="connected-status pos-abs left-full top-full-2 ' + (nextItem !== undefined ? 'text-red' : 'text-light-gray') +'">'+ (nextItem !== undefined ? 'Next to: ' + nextItem.name : 'Not connected yet') +'</span>',
                                                          '</div>'].join('');
                                    });
                                }

                                multiItemHtml += '</div>';

                                break;

                            case '4smile_api':
                                icon = 'fa-calendar';
                                break;
                        }

                        var html = '<i class="fa '+ icon +'"></i><span class="btn-text"><span class="item-name pull-left">[ '+ v.name +' ]</span><div class="item-title pull-left padding-l-half">'+ v.message +'</div></span>';

                        $(elToClone).attr({'data-id': v.element_id, 'data-type': v.type}).clone().html(html + multiItemHtml + nextContent + botBtns).appendTo('.bot-preview');
                    });

                    $body.find('.bot-preview [data-type="multiple-choice"]').addClass('multi-items');
                    $body.find('.bot-preview [data-type="4smile_api"]').removeClass('btn-default').addClass('btn-light-warning');
                } else {
                    localStorage.setItem('bot_{{$botId}}_items', JSON.stringify([]));
                }
            });

        };

        $.reorderBotItems = function() {
            var botItems = $.get_set_botItem('getList');

            $body.find('.bot-preview .btn-widget').each(function(i, v) {
                var dataId = parseInt($(this).data('id'));

                botItems.map(function(item) {
                    if (item.element_id === dataId) {
                        item.priority = i;
                    }
                });
            });

            botItems = botItems.sort(function(a, b) {
                return a.priority > b.priority ? 1 : -1;
            });

            localStorage.setItem('bot_{{$botId}}_items', JSON.stringify(botItems));
        };

        $.fillForm = function (data) {
            var $detailTitle    = $body.find('.detail-title'),
                questionMessage   = '',
                icon            = '',
                multiOptionHtml = '';

            console.log('Form: ', data);

            $detailTitle.find('i').removeAttr('class');

            $detailTitle.find('span').html(data.type.replace('_', ' '));

            $botCreatorBuilderContainer.find('#name').val(data.name).trigger('change');

            $elementId.val(data.element_id).trigger('change');

            $itemType.val(data.type).trigger('change');

            $multiOptionContainer.find('.multiOption').remove();

            $multiOptionContainer.addClass('hidden');

            $showNextField.removeClass('hidden');

            $validationRequiredContainer.addClass('hidden');

            $body.find('#validation_status').prop('checked', false);

            switch (data.type) {
                case 'message':
                    icon = 'fa-commenting-o';
                    questionMessage = data.message !== '' ? data.message : 'Please type a message';
                    break;

                case 'question':
                    icon = 'fa-question-circle-o';
                    questionMessage = data.message !== '' ? data.message : 'Please type an answer';

                    $body.find('#validation_status').prop('checked', data.params !== undefined && data.params.validation);

                    $validationRequiredContainer.removeClass('hidden');

                    $botCreatorBuilderContainer.find('#required').prop('checked', data.params !== undefined && data.params.required).trigger('change');
                    $botCreatorBuilderContainer.find('#validation_status').prop('checked', data.params !== undefined && data.params.validation).trigger('change');

                    if (data.params !== undefined && data.params.validation === 'email') {
                        $botCreatorBuilderContainer.find('.validation-container .btn[data-value="email"]').removeClass('not-active').addClass('active');
                        $botCreatorBuilderContainer.find('.validation-container .btn[data-value="phone"]').removeClass('active').addClass('not-active');
                    } else if (data.params !== undefined && data.params.validation === 'phone') {
                        $botCreatorBuilderContainer.find('.validation-container .btn[data-value="phone"]').removeClass('not-active').addClass('active');
                        $botCreatorBuilderContainer.find('.validation-container .btn[data-value="email"]').removeClass('active').addClass('not-active');
                    }

                    break;

                case 'multiple-choice':
                    icon = 'fa-th-list';

                    $multiOptionContainer.removeClass('hidden');

                    $showNextField.addClass('hidden');

                    questionMessage = data.message !== '' ? data.message : 'Select your choices';

                    cntDeleteButton = 0;

                    if (data.params.list !== undefined && data.params.list.length) {
                        $.each(data.params.list, function(i, v) {
                            multiOptionHtml += [
                                '<div class="row multiOption">',
                                '   <div class="col-xs-4 col-sm-4 col-md-4">',
                                '       <span class="text-danger pos-abs right-full font-full-plus-half-em">*</span>',
                                '       <input type="text" class="form-control label" value="'+ v.label +'" required>',
                                '   </div>',
                                '   <div class="col-xs-3 col-sm-3 col-md-3">',
                                '       <label class="control-label text-normal">If selected, go to: </label>',
                                '   </div>',
                                '   <div class="col-xs-4 col-sm-4 col-md-4">',
                                '       <span class="text-danger pos-abs right-0 font-full-plus-half-em">*</span>',
                                '       <select class="form-control next-selector" required></select>',
                                '   </div>'
                            ].join('');

                            if (i) {
                                multiOptionHtml += '<div class="col-xs-1 col-sm-1 col-md-1">' +
                                    '    <button class="remove-option text-danger btn btn-link text-16 line-height-35"><i class="fa fa-times"></i></button>' +
                                    '</div>';
                            }

                            multiOptionHtml += '</div>';

                            cntDeleteButton++;
                        });
                    } else {
                        multiOptionHtml  = '<div class="row multiOption">' +
                            '    <div class="col-xs-4 col-sm-4 col-md-4">' +
                            '        <input type="text" class="form-control label">' +
                            '    </div>' +
                            '    <div class="col-xs-3 col-sm-3 col-md-3">' +
                            '        <label class="control-label text-normal">If selected, go to: </label>' +
                            '    </div>' +
                            '    <div class="col-xs-4 col-sm-4 col-md-4">' +
                            '        <select class="form-control next-selector" required></select>' +
                            '    </div>' +
                            '</div>';
                    }

                    $multiOptionContainer.find('.form-group').html(multiOptionHtml);

                    break;

                case '4smile_api':
                    icon = 'fa-calendar';
                    questionMessage = data.message !== '' ? data.message : 'Book an appointment';
                    break;
            }

            $.fill_nextSelector(data.element_id, data.params);

            $detailTitle.find('i').addClass('fa ' + icon);

            $botCreatorBuilderContainer.find('#question').val(questionMessage).trigger('change');
        };

        $.fetchFormData = function() {
            var optionList  = [],
                question    = $botCreatorBuilderContainer.find('#question').val(),
                name        = $botCreatorBuilderContainer.find('#name').val(),
                next        = $botCreatorBuilderContainer.find('#next_item').val(),
                required    = $botCreatorBuilderContainer.find('#required').is(':checked') ? 1 : 0,
                validation  = $botCreatorBuilderContainer.find('#validation_status').is(':checked') ? 1 : 0,
                status      = $botCreatorBuilderContainer.find('.validation-container .btn.active').data('value'),
                type        = $itemType.val();

            if (type === 'multiple-choice') {
                optionList = {list: []};
                $multiOptionContainer.find('.multiOption').each(function() {
                    var label  = $(this).find('.label').val(),
                        nextItem    = $(this).find('.next-selector').val();

                    optionList.list.push({next: nextItem, label: label, value: label});
                });
            } else if (type === 'question') {
                var tmp = {next: next, required: required};

                if (validation) {
                    tmp.validation = status;
                } else {
                    tmp.validation = 0;
                }

                optionList = tmp;
            } else {
                optionList = {next: next};
            }

            return {
                name: name,
                message: question,
                params: optionList
            };
        };

        $.fill_nextSelector = function(id, dataValue) {
            var botItems = $.get_set_botItem('getList'),
                html = '<option value="" selected>Select Next Statement:</option>';

            $.each(botItems, function(i, v) {
                if (id !== undefined && id === v.element_id) {return}

                html += '<option value="'+ v.element_id +'">'+ v.name +'</option>'
            });

            html += '<option value="end">End Chat</option>';

            $body.find('.next-selector').html(html);

            if (dataValue !== undefined) {
                if ($botCreatorBuilderContainer.find('.next-selector:visible').length === 1) {
                    $botCreatorBuilderContainer.find('.next-selector:visible option[value=""]').prop('selected', false);
                    $botCreatorBuilderContainer.find('.next-selector:visible option[value="'+ dataValue.next +'"]').prop('selected', true).trigger('change');
                } else {
                    if (dataValue.list !== undefined && dataValue.list.length) {
                        $.each(dataValue.list, function (i, v) {
                            $botCreatorBuilderContainer.find('.next-selector:eq(' + i + ') option[value=""]').prop('selected', false);
                            $botCreatorBuilderContainer.find('.next-selector:eq(' + i + ') option[value="' + v.next + '"]').prop('selected', true).trigger('change');
                        });
                    }
                }
            }
        };

        $.validateForm = function() {
            var cnt = 0;

            $botCreatorBuilderContainer.find('[required]:visible').each(function() {
                if (!$(this).val().length) {
                    cnt++;
                }
            });

            return cnt;
        };

        /*$.autoSaveElement = function() {
            $body.on('change', '.bot-creator-builder-container input:visible, .bot-creator-builder-container select:visible', function() {
                console.log($(this).val());
            });
        };*/

        $.connect = function() {
            var wsUri = "wss://{{ $hostname }}/wss/?component=questions&operator={{$operatorId}}";
            websocket = new WebSocket(wsUri);

            websocket.onopen = function (ev) { // connection is open
                // console.log('open');
            };
            websocket.onmessage = function (ev) {
                var data = JSON.parse(ev.data);

                console.log(data);

            };
            websocket.onclose = function (ev) {
                console.log(ev);
            };
            websocket.onerror = function (ev) {
                console.log(ev);
            };
        };

        $.connect();

        function sendMsg(messageInfo) {
            //convert and send data to server

            websocket.send(JSON.stringify(messageInfo));
        }
    </script>

@endsection