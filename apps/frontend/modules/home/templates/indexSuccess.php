<?php
use_stylesheet('jquery/flexslider.css');
use_javascript('vendor/jquery/plugins/flexslider/jquery.flexslider.js');
use_javascript('vendor/jquery/plugins/flexslider/init.js');
?>
<header>
    <hgroup>
        <h1>Apartamentos em Higienópolis - Breno Homara Imóveis</h1>
        <h2>Apartamentos à venda em Higienópolis e Santa Cecília</h2>
    </hgroup>
</header>

<nav>
    <div class="wrapper">
        <?php echo image_tag('BrenoHomara.png',array('alt'=>'')); ?>
        <ul class="menu">
            <li><a href="/site/quem-e-breno-homara/">Quem &eacute; Breno Homara</a></li>
            <li><a href="/busca/" class="selected">Compre ou alugue um im&oacute;vel</a></li>
            <li><a href="/venda-ou-alugue/">Venda ou alugue seu im&oacute;vel</a></li>
            <li><a href="/site/administracao-de-imoveis-e-servicos/">Administra&ccedil;&atilde;o de im&oacute;veis e servi&ccedil;os</a></li>
            <li><a href="/fale-conosco/">Fale com a Breno Homara Imóveis</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="clearfix">
        <div class="grid_3">
            
            
            <ul class="tabs" data-tabs="tabs">
                <li class="active"><a href="#home">Home</a></li>
                <li class=""><a href="#profile">Profile</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="home">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div>
                <div class="tab-pane" id="profile">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                </div>
            </div>
            
            
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
            <h2>Other Side</h2>
            <p>You probably noticed by looking at that text that the default grid has the following properties:</p>
        </div>
    </div>
    
    <div class="clearfix listing">
        <?php
        $i=9;
        while($i){
            include_partial('global/list_estate',array('i'=>$i));
            $i--;
        }
        ?>
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

<footer>
    <div class="wrapper">
        <nav>
            <a href="http://mediaqueri.es/submit/">Submit</a>
            <a href="http://mediaqueri.es/leaderboard/">Leaderboard</a>
            <a href="http://mediaqueri.es/about/">About</a>
            <div class="secondary">
                <a href="http://twitter.com/mediaqueries">@mediaqueries</a>
                <a href="mailto:hello@mediaqueri.es">hello@mediaqueri.es</a>
            </div>
        </nav>

        <div class="meta">
            <p id="tags">
                Browse by tags:
                <a href="http://mediaqueri.es/tag/media-queries/"  style="color: rgba(204, 0, 0, 1.0);">media queries</a>,
                <a href="http://mediaqueri.es/tag/flexible-images/"  style="color: rgba(204, 0, 0, 0.7);">flexible images</a>,
                <a href="http://mediaqueri.es/tag/fluid-grids/"  style="color: rgba(204, 0, 0, 0.7);">fluid grids</a>,
                <a href="http://mediaqueri.es/tag/responsive-web-design/"  style="color: rgba(204, 0, 0, 0.6);">responsive web design</a>,
                <a href="http://mediaqueri.es/tag/fixed-grids/"  style="color: rgba(204, 0, 0, 0.5);">fixed grids</a>
                and
                <a href="http://mediaqueri.es/tag/mobile-first/"  style="color: rgba(204, 0, 0, 0.5);">mobile first</a>.<br>
                View <a href="/tag/">tag frequency</a>.
            </p>
            
            <p id="auth">
                A Twitter account is needed to submit sites and vote for the sites you like.
                <a href="http://mediaqueri.es/login/" class="sign-in-with-twitter">Sign in with Twitter</a>
            </p>
            
            <p id="feed" class="icon"><a href="http://mediaqueri.es/.atom">Subscribe to a feed of the latest highlighted sites using media queries.</a></p>
            
            <p id="copy">
                Curated by <a href="http://uggedal.com">Eivind Uggedal</a> (<a href="http://twitter.com/uggedal">@uggedal</a>).<br>
                Reused by <a href="http://lagden.github.com">Thiago Lagden</a> (<a href="http://twitter.com/thiagolagden">@thiagolagden</a>).
            </p>
        </div>
    </div>
</footer>