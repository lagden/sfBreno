(function ($){
    $(function(){

        $('textarea.tinymce').tinymce({
            // Location of TinyMCE script
            script_url : PublicPath+'js/vendor/tiny_mce/tiny_mce.js',

            force_p_newlines:true,
            force_br_newlines:false,
            forced_root_block:'',
            verify_html:false,
            apply_source_formatting:true,
            remove_linebreaks:true,
            invalid_elements:"strong,acronym,applet,bgsound,center,dir,fn,font,basefont,frameset,frame,noframes,big,blink,s,strike,tt,u,isindex,layer,ilayer,nolayer,listing,marquee,nobr,noembed,noscript,plaintext,spacer,xml,xmp",
            formats:{
                bold:{inline:'b'}
            },
            indentation : 0,

            // Size
            width : 700,
            height: 400,

            // General options
            theme : "advanced",
            plugins : "jbimages,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,forecolor,backcolor,|,undo,redo,|,link,unlink,anchor,image,jbimages,cleanup,code,|,fullscreen",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,tablecontrols,|,hr,removeformat,visualaid",
            theme_advanced_buttons3 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl",
            theme_advanced_buttons4 : "", // "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            document_base_url: location.origin + PublicPath,
            convert_urls : false,
            relative_urls : false

        });

    });
})
(jQuery);