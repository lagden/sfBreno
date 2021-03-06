(function($){
    definegrid = function(){
        var browserWidth = $(window).width();
        if (browserWidth >= 1000) 
        {
            pageUnits = 'px';
            colUnits = 'px';
            
            // pagewidth = 940;
            // columns = 6;
            // columnwidth = 140;
            // gutterwidth = 20;

            // pagewidth = 940;
            // columns = 12;
            // columnwidth = 60;
            // gutterwidth = 20;
            
            pagewidth = 940;
            columns = 8;
            columnwidth = 100;
            gutterwidth = 20;
            
            pagetopmargin = 0;
            rowheight = 20;
            gridonload = 'off';
            makehugrid();
        }
        if (browserWidth <= 768) 
        {
            pageUnits = '%';
            colUnits = '%';
            pagewidth = 96;
            columns = 2;
            columnwidth = 49;
            gutterwidth = 2;
            pagetopmargin = 35;
            rowheight = 20;
            gridonload = 'off';
            makehugrid();
        }
    } 
})(jQuery);

jQuery(function($){
    definegrid();
    setgridonload();
    $(window).resize(function()
    {
        definegrid();
        log($(window).width());
    });
});