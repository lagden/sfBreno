<?php if ($section->Contents->count()>0): ?>
    <div class="clearfix vejatb">
        <h3>Veja também</h3>
        <hr/>
        <ul>
            <?php foreach ($section->Contents as $c): ?>
                <li><?php echo link_to($c->title,'site_content',array('section'=>$section->slug,'slug'=>$c->slug)) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>