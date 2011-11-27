<?php if($pager->haveToPaginate()): ?>
    <?php $pagination=Pagination::show($pager->getPage(),$pager->getLastPage(),$route); ?>
    <footer>
        <nav><?php echo $pagination; ?></nav>
    </footer>
<?php endif; ?>
