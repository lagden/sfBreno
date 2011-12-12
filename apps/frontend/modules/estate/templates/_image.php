<div class="estateImg">
    <?php 
    echo content_tag('a', image_tag("/estates/{$image->square->file}",array('alt'=>'')), array(
        'class' => 'showImageEstate',
        'title' => $title,
        'rel' => 'grupoimovel',
        'href'=>public_path("/estates/{$image->large->file}") 
    ));
    ?>
</div>