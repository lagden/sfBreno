// jQuery
(function($){
    // Init tabs
    $('.tabs').tabs();
    
    // Fancybox
    $(".various").fancybox({
        fitToView   : true,
        width       : '90%',
        height      : '90%',
        autoSize    : true,
        closeClick  : false,
        openEffect  : 'elastic',
        closeEffect : 'elastic'
    });
    $('button.showBairro').click(function(){
        jQuery.fancybox( {href:$(this).data('href')} );
    });
})
(jQuery);

// Other
var brenoTips;
(function(){
    brenoTips = new Tips($$('.brenoTips'),
    {
        className:'toolTip',
        fixed:true,
        offset:{x: 0, y: 16}
    }
);
})
();