$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.apps = {
        storageItem: {
            set: function (key, value) { localStorage.setItem(key,value); },
            get: function (key, defaultValue) { return localStorage.getItem(key) || defaultValue; },
            setObject: function (key, value) { localStorage.setItem(key,JSON.stringify(value)); },
            getObject: function (key) { return JSON.parse(localStorage.getItem(key)); },
            remove: function (key) { localStorage.removeItem(key); }
        },
        delete: function (url) {
            $.ajax({
                url:url,
                type:'DELETE'
            }).done(function () {
                window.location.reload();
            });
        },
        setCollapseEvents : function (selector) {
            var $selector = $( selector === undefined ? '.collapse' : selector );

            if( $selector.length > 0 ) {
                $selector.on('show.bs.collapse', function () {
                    $(this).closest('table')
                        .find('.collapse.in')
                        .not(this)
                        .collapse('toggle');

                    $('a[href="#'+ $(this).attr('id') +'"]').html('<i class="fa fa-minus"></i>');
                });
                $selector.on('hide.bs.collapse', function () {
                    $('a[href="#'+ $(this).attr('id') +'"]').html('<i class="fa fa-plus"></i>');
                });
            }
        },
        confirmation : function (selector) {
            $( selector === undefined ? '[data-toggle="confirmation"]' : selector ).confirmation({
                popout:true,
                singleton:true,
                placement:'left',
                btnCancelClass:'btn-xs btn-danger',
                onConfirm: function () {
                    if( $(this).data('btn-type') && $(this).data('btn-type') === 'delete' ) {
                        apps.delete($(this).data('url'));
                    }
                }
            });
        },
        htmlEditor: function (selector) {
            $(selector === undefined ? '[data-toggle="wysihtml5"]' : selector ).wysihtml5();
        },
        setNavigation : function () {
            var _this = this;
            var checkNav = _this.storageItem.get('navigation',true);

            if( checkNav == "true" ) {
                $('body').removeClass('sidebar-collapse');
            }

            $('.sidebar-toggle').on('click', function () {
                setTimeout(function () {
                    var getNavStatus = $('body').hasClass('sidebar-collapse');

                    _this.storageItem.set('navigation',getNavStatus ? false : true);
                },100);
            });
        },
        setup: function () {
            this.setCollapseEvents();
            this.setNavigation();
            this.confirmation();
            this.htmlEditor();
        }
    }

    apps.setup();

    var calendarSelector = $('[data-toggle="calendar"]');

    if( calendarSelector.length > 0 ) {

        calendarSelector.fullCalendar({
            lang:'en',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            eventRender: function (event, element) {
                $(element).attr({
                    'href'        :'javascript:void(0)',
                    'data-toggle' : 'modal',
                    'data-target' : '#task-modal',
                    'data-url'    : event.url
                });
            }
        });

        var url = calendarSelector.data('url');
        if( url.length > 0 ) {
            calendarSelector.fullCalendar('addEventSource', url);
        }

    }

    $('#task-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        var url = button.data('url');

        $.get(url).done(function (data) {
            modal.find('.modal-content').html(data);
        })
    });

    var filterForm = $('#task-filter');

    if( filterForm.length > 0 ) {
        filterForm.on('submit', function (e) {
            e.preventDefault();
            var _this = $(this);

            var params = [];

            $.each(_this.serializeArray(), function (i, object) {
                if( object.value.length > 0 ) {
                    params.push(object.name + ':' + object.value);
                }
            })

            window.location.href = $(this).attr('action') + '=' + params.join(';');

            return false;
        });

        if( $('[data-target="#filter"]').length > 0) {

            var queryString = location.search;

            if( queryString.indexOf('&') > -1 ) {
                queryString = queryString.split('&')[0];
            }

            queryString = queryString.replace('?'+ filterForm.attr("action").split('?')[1] +'=','').split(';')

            if( queryString.length > 0 && queryString[0] !== "") {
                var control = false;

                queryString.forEach(function(item) {
                    var split = item.split(":");

                    if (split.length > 0 && !split[0].startsWith('?page=')) {
                        if( split[1].length > 0 ) {
                            control = true;
                            if( $('[name="'+ item.split(':')[0] +'"]').length > 0 ) {
                                $('[name="'+ item.split(':')[0] +'"]').val(item.split(':')[1])
                            }
                        }
                    }

                });

                if( control ) {
                    $('[data-target="#filter"]').trigger('click');
                }
            }
        }
    }

})