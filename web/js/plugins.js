// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
    log.history = log.history || [];   // store logs to an array for reference
    log.history.push(arguments);
    if(this.console) {
        arguments.callee = arguments.callee.caller;
        var newarr = [].slice.call(arguments);
        (typeof console.log === 'object' ? log.apply.call(console.log, console, newarr) : console.log.apply(console, newarr));
    }
};

// make it safe to use console.log always
(function(b){
    function c(){}
    for(var d="assert,clear,count,debug,dir,dirxml,error,exception,firebug,group,groupCollapsed,groupEnd,info,log,memoryProfile,memoryProfileEnd,profile,profileEnd,table,time,timeEnd,timeStamp,trace,warn".split(","),a;a=d.pop();)
    {
        b[a]=b[a]||c
    }
})((function()
{
    try{
        console.log();return window.console;
    }catch(err){
        return window.console={};
    }
})());


// place any jQuery/helper plugins in here, instead of separate, slower script files.

/* ========================================================
 * bootstrap-tabs.js v1.4.0
 * http://twitter.github.com/bootstrap/javascript.html#tabs
 * ======================================================== */

!function( $ ){
    "use strict"
    function activate ( element, container )
    {
        container
        .find('> .active')
        .removeClass('active')
        .find('> .dropdown-menu > .active')
        .removeClass('active')

        element.addClass('active')

        if ( element.parent('.dropdown-menu') ) {
            element.closest('li.dropdown').addClass('active')
        }
    }

    function tab( e )
    {
        var $this = $(this)
        , $ul = $this.closest('ul:not(.dropdown-menu)')
        , href = $this.attr('href')
        , previous
        , $href

        if ( /^#\w+/.test(href) ) {
            e.preventDefault()

            if ( $this.parent('li').hasClass('active') ) {
                return
            }

            previous = $ul.find('.active a').last()[0]
            $href = $(href)

            activate($this.parent('li'), $ul)
            activate($href, $href.parent())

            $this.trigger({
                type: 'change'
                , relatedTarget: previous
            })
        }
    }


    /* TABS/PILLS PLUGIN DEFINITION
    * ============================ */

    $.fn.tabs = $.fn.pills = function ( selector )
    {
        return this.each(function () {
            $(this).delegate(selector || '.tabs li > a, .pills > li > a', 'click', tab)
        })
    }

    $(document).ready(function ()
    {
        $('body').tabs('ul[data-tabs] li > a, ul[data-pills] > li > a')
    })

}( window.jQuery || window.ender );