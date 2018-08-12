<? 
get_header();

$reviews = new WP_Query(array('category_name'=>'reviews', 'orderby'=>'date', 'order'=>'ASC'));
?>
<section class="sect lawyers review">
  <div class="wrapper">
    <div class="content">
      <h1>Отзывы</h1>
      <? if(wpmd_is_phone()) : ?>
        <div class="lawyers_content review_content mobile">
          <div class="review_col review_col_center">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <div class="review_block" data-index="<?=$my_key_block;?>">
                <? if ( has_post_thumbnail()) : ?>
                  <div class="review_block_application">
                    <? the_post_thumbnail('full'); ?>
                  </div>
                <? endif; ?>
                <div class="review_block_caption">
                  <?=my_typograf(get_the_content());?>
                  <p class="author"><? the_title(); ?></p>
                </div>
              </div>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
        </div>
      <? elseif(wpmd_is_tablet()) : ?>
        <div class="lawyers_content review_content tablet">
          <div class="review_col review_col_center">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <div class="review_block" data-index="<?=$my_key_block;?>">
                <? if ( has_post_thumbnail()) : ?>
                  <div class="review_block_application">
                    <? the_post_thumbnail('full'); ?>
                  </div>
                <? endif; ?>
                <div class="review_block_caption">
                  <?=my_typograf(get_the_content());?>
                  <p class="author"><? the_title(); ?></p>
                </div>
              </div>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
          <div class="review_col review_col_left">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <? if($my_key_block % 2 != 0) : ?>
                <div class="review_block" data-index="<?=$my_key_block;?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="review_block_application">
                      <? the_post_thumbnail('full'); ?>
                    </div>
                  <? endif; ?>
                  <div class="review_block_caption">
                    <?=my_typograf(get_the_content());?>
                    <p class="author"><? the_title(); ?></p>
                  </div>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
          <div class="review_col review_col_right">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <? if($my_key_block % 2 == 0) : ?>
                <div class="review_block" data-index="<?=$my_key_block;?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="review_block_application">
                      <? the_post_thumbnail('full'); ?>
                    </div>
                  <? endif; ?>
                  <div class="review_block_caption">
                    <?=my_typograf(get_the_content());?>
                    <p class="author"><? the_title(); ?></p>
                  </div>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
        </div>
      <? else : ?>
        <div class="lawyers_content review_content">
          <div class="review_col review_col_left">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <? if($my_key_block % 2 != 0) : ?>
                <div class="review_block" data-index="<?=$my_key_block;?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="review_block_application">
                      <? the_post_thumbnail('full'); ?>
                    </div>
                  <? endif; ?>
                  <div class="review_block_caption">
                    <?=my_typograf(get_the_content());?>
                    <p class="author"><? the_title(); ?></p>
                  </div>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
          <div class="review_col review_col_right">
            <? $my_key_block = 1; ?>
            <? while($reviews->have_posts()) : $reviews->the_post(); ?>
              <? if($my_key_block % 2 == 0) : ?>
                <div class="review_block" data-index="<?=$my_key_block;?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="review_block_application">
                      <? the_post_thumbnail('full'); ?>
                    </div>
                  <? endif; ?>
                  <div class="review_block_caption">
                    <?=my_typograf(get_the_content());?>
                    <p class="author"><? the_title(); ?></p>
                  </div>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
        </div>
      <? endif; ?>
      <? if($my_key_block > 12) : ?>
        <div class="items_more items_more_90 review_more" data-type="review" data-count="7"><span>показать ещё</span></div>
      <? endif; ?>
      <div class="btn btn_review" data-type="modal" data-modal-id="2" data-modal-title="Оставьте отзыв">оставить отзыв</div>
    </div>
  </div>
</section>

<? get_footer();