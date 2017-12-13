/*
**	Anderson Ferminiano
**	contato@andersonferminiano.com -- feel free to contact me for bugs or new implementations.
**	jQuery ScrollPagination
**	28th/March/2011
**	http://andersonferminiano.com/jqueryscrollpagination/
**	You may use this script for free, but keep my credits.
**	Thank you.
*/
(function ($) {

    $.fn.scrollPagination = function (options) {
        var opts = $.extend($.fn.scrollPagination.defaults, options);
        var target = opts.scrollTarget;
        if (target == null) {
            target = obj;
        }
        opts.scrollTarget = target;

        return this.each(function () {
            $.fn.scrollPagination.init($(this), opts);
        });

    };

    $.fn.stopScrollPagination = function () {
        return this.each(function () {
            $(this).attr('scrollPagination', 'disabled');
        });

    };

    $.fn.isloading = false;
    $.fn.hasData = true;

    $.fn.scrollPagination.loadContent = function (obj, opts) {
        var target = opts.scrollTarget;
        var mayLoadContent = $(target).scrollTop() + opts.heightOffset >= $(document).height() - $(target).height();
        
        if ( mayLoadContent && !$.fn.isloading && $.fn.hasData ) {
            if (opts.beforeLoad != null) {
                opts.beforeLoad();             
            }
            $(obj).children().attr('rel', 'loaded');
            $.fn.isloading = true;
            
            opts.contentData.page++;
            
            $.ajax({
                type: 'POST',
                url: opts.contentPage,
                data: opts.contentData,
                success: function (data) {
                     if($.trim(data) == '') {
                        $.fn.hasData = false;
                     }
                    $(obj).append(data);
                    var objectsRendered = $(obj).children('[rel!=loaded]');
                    objectsRendered.css('opacity', '0');
                    $.fn.isloading = false;
                    if (opts.afterLoad != null) {
                        opts.afterLoad(objectsRendered);
                    }
                },
                dataType: 'html'
            });
        }

    };

    $.fn.scrollPagination.init = function (obj, opts) {
        var target = opts.scrollTarget;
        $(obj).attr('scrollPagination', 'enabled');

        $(target).scroll(function (event) {
            if ($(obj).attr('scrollPagination') == 'enabled') {
                $.fn.scrollPagination.loadContent(obj, opts);
            }
            else {
                event.stopPropagation();
            }
        });

        $.fn.scrollPagination.loadContent(obj, opts);

    };

    $.fn.scrollPagination.defaults = {
        'contentPage': null,
        'contentData': {},
        'beforeLoad': null,
        'afterLoad': null,
        'scrollTarget': null,
        'heightOffset': 0
    };
})(jQuery);