(function ($){
    $(function(){
        
        var $container = $('#uploader-container');

        $container
        .pluploadQueue({
            runtimes : 'html5,flash',
            url: $container.data('plupload-target-url'),
            urlstream_upload: true,
            multipart: true,
            multipart_params:{ "user_id" : $container.data('plupload-user'), "rnd" : $container.data('plupload-rnd') },
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
                FileUploaded: function(up, file, response) {
                    log('[FileUploaded] ',response.response);
                },
                Error: function(up, args) {
                    log('[PluploadError] ', up, args);
                }
            }
        });
    })
})
(jQuery);
