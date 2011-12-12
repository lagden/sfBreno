(function ($){
    $(function(){

        var $container = $('#uploader-container');

        $container
        .pluploadQueue({
            runtimes : 'html5,flash',
            url: $container.data('plupload-target-url'),
            urlstream_upload: true,
            multipart: true,
            multipart_params:{ "estate_id" : $container.data('plupload-estate'), "rnd" : $container.data('plupload-rnd') },
            max_file_size: '100mb',
            required_features: "chunks",
            chunk_size: '1mb',
            multiple_queues:true,
            dragdrop:true,
            rename:true,
            sortable:true,
            browse:true,
            start:true,
            stop:true,
            filters : [
            { title : "Image files", extensions : "jpg,jpeg,gif,png,tif,tiff,eps,ps" }
            ],
            flash_swf_url : $container.data('plupload-swf-url'),
            init:
            {
                // Events
                FileUploaded: function(up, file, response)
                {
                    log('[FileUploaded] ',response.response);
                    Uploaded.add(JSON.decode(response.response,true));
                },
                Error: function(up, args)
                {
                    log('[PluploadError] ', up, args);
                }
            }
        });


        $('.removeImage').live('click',function(e){
            Uploaded.deleta(this);
        });

        $('img.file').live('click',function(e){
            Uploaded.destaque(this);
        });
    })
})
(jQuery);

// Upload Helpers
var Uploaded={
    add:function(o)
    {
        if(o.success)
        {
            jQuery.post(jQuery('#uploader-container').data('add-url'),{"id":o.data.id,"file":o.data.file,"destaque":o.data.destaque},
            function(r)
            {
                if(r)
                {
                    if(r=='end_of_session')
                    {
                        alert('Sessão expirada. Efetue o login novamente.');
                        location.reload();
                    }
                    else jQuery('div#imageFields').append(r);
                }
                else ajuda.alerta('Erro na resposta.');
            }
            ,"html");
        }
        else ajuda.alerta('Erro no upload.');
    },
    deleta:function(_this)
    {
        var o = jQuery(_this);
        if(confirm('Deseja remover?'))
        {
            jQuery.post(o.data('url'),{"sf_method":"delete","id":o.data('img-id')},
            function(r)
            {
                if(r)
                {
                    if(r.success)
                    {
                        ajuda.alerta(r.msg);
                        var el = jQuery('div.ib_img[data-img-id="'+r.data.id+'"]');
                        el.remove();
                    }
                    else
                    {
                        ajuda.alerta(r.msg);
                    }
                    if( !r.auth )
                    {
                        alert(r.msg);
                        location.reload();
                    }
                }
                else alert('Erro na resposta.');
            }
            ,"json");
        }
    },
    destaque:function(_this)
    {
        var o = jQuery(_this);
        if(confirm('Deseja colocar essa imagem como destaque?'))
        {
            jQuery.post(o.data('url'),{"id":o.data('img-id')},
            function(r)
            {
                if(r)
                {
                    if(r.success)
                    {
                        ajuda.alerta(r.msg);
                        jQuery('div.ib_img > img').removeClass('destaque');
                        jQuery('div.ib_img[data-img-id="'+r.data.id+'"] > img').addClass('destaque');
                    }
                    else
                    {
                        ajuda.alerta(r.msg);
                    }
                    if( !r.auth )
                    {
                        alert(r.msg);
                        location.reload();
                    }
                }
                else alert('Erro na resposta.');
            }
            ,"json");
        }
    }
};
