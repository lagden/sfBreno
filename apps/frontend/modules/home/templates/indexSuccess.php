<?php
use_stylesheet('jquery/flexslider.css');
use_javascript('vendor/jquery/plugins/flexslider/jquery.flexslider.js');
use_javascript('vendor/jquery/plugins/flexslider/init.js');
?>
<header>
    
</header>
<div class="container">
    <div class="clearfix">
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_5"><p>3 grid</p></div>
    </div>
    
    <div class="clearfix">
        <div class="grid_3">
            <h2>Apply Settings</h2>
            <p>You probably noticed by looking at that text that the default grid has the following properties:</p>
            <ul>
                <li>units for page = <b>pixels</b></li>
                <li>units for columns = <b>pixels</b></li>
                <li>page width = <b>960px</b></li>
                <li>number of columns = <b>6</b></li>
                <li>column width = <b>140px</b></li>
                <li>gutter width = <b>24px</b></li>
                <li>page top margin = <b>35px</b></li>
                <li>row height = <b>20px</b></li>
            </ul>
            <p>Alter the numbers to create your desired grid. If you don’t need the baseline grid, set the row height to <b>0</b>. The default unit of measure is&nbsp;<b>pixels</b>.</p>
            <p>You are now ready to get back to the real work: meticulously lining up images and text!</p>
        </div>
        <div class="grid_3">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <figure>
                            <?php echo image_tag('demo-stuff/inacup_samoa.jpg',array('alt'=>'')); ?>
                            <figcaption class="flex-caption">
                                <p>Australian Birds. From left to right, Kookburra, Pelican and Rainbow Lorikeet. Originals by <a href="http://www.flickr.com/photos/rclark/">Richard Clark</a></p>
                            </figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <?php echo link_to(image_tag('demo-stuff/inacup_pumpkin.jpg',array('alt'=>'')),'http://flex.madebymufffin.com',array(),array('target'=>'_blank')); ?>
                            <figcaption class="flex-caption">
                                <p>This image is wrapped in a link!</p>
                            </figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <?php echo image_tag('demo-stuff/inacup_donut.jpg',array('alt'=>'')); ?>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <?php echo image_tag('demo-stuff/inacup_vanilla.jpg',array('alt'=>'')); ?>
                        </figure>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="grid_2"><p>1 grid</p></div>
        <div class="grid_2"><p>1 grid</p></div>
        <div class="grid_2"><p>1 grid</p></div>
    </div>
    <div class="clearfix">
        <div class="grid_6"><p>1 grid</p></div>
    </div>
    <div class="clearfix">
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_1"><p>1 grid</p></div>
        <div class="grid_1"><p>1 grid</p></div>
    </div>
</div>