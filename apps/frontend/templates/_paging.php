<?php if($pager->haveToPaginate()): ?>
    <?php $pagination=Pagination::show($pager->getPage(),$pager->getLastPage(),$route); ?>
    <footer class="pagination">
        <nav><?php echo $pagination; ?></nav>
    </footer>
<?php endif; ?>
