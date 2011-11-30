<?php if($pager->haveToPaginate()): ?>
  <?php use_javascript('cms/paging.js') ?>
  <?php $pagination=Pagination::show($pager->getPage(),$pager->getLastPage(),$route); ?>
  <footer>
    <nav><?php echo $pagination; ?></nav>
  </footer>
<?php endif; ?>
