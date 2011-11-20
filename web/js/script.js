(function($){
    /* Init tabs */
    $('.tabs').tabs();
})
(jQuery);

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