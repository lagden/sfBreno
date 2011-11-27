<div class="container">    
    <div class="clearfix listing someMargin top">
        <?php
        foreach($pager->getResults() as $estate)
        {
            include_partial('global/list_estate',array('estate'=>$estate));
        }
        ?>
    </div>
    <div class="clearfix someMargin top">
        <?php include_partial('global/paging', array('pager' => $pager, 'route' => sfConfig::get('page_route'))); ?>
    </div>
</div>
