<?
$cat_ID = get_query_var('cat'); 

$categories_lawyers = get_categories(array('child_of' => 9));
$categories_branch  = get_categories(array('child_of' => 11));

$count_post = count(query_posts("cat=$cat_ID"));
$cat_url = get_site_url('', 'arbitrage_practice/');
?>
<div id="menu_view" class="none" data-menu="Судебная практика"></div>
<section class="sect lawyers practika page">
  <div class="wrapper">
    <div class="content">
      <h1>Судебная практика</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_blog">
            <div class="categories_block_title">адвокат</div>
            <ul>
              <? $advocat =  get_category(9); ?>
              <li<?my_active_link($cat_url . $advocat->slug, $_SERVER['REQUEST_URI']);?>><a href="<?=$cat_url . $advocat->slug;?>"><span>все</span><sup><?=$advocat->category_count;?></sup></a></li>
              <? foreach($categories_lawyers as $cat) : ?>
                <li<? my_active_link($cat_url . $advocat->slug . '/' . $cat->slug, $_SERVER['REQUEST_URI']); ?>>
                  <a href="<?=$cat_url . $advocat->slug . '/' . $cat->slug;?>">
                    <span><?=my_typograf($cat->name);?><sup><?=$cat->category_count;?></sup></span>
                  </a>
                </li>
              <? endforeach; ?>
            </ul>
          </div>
          <div class="categories_block_blog">
            <div class="categories_block_title">отрасль права</div>
            <ul>
              <? $cat_otr = get_category(11); ?>
              <li<?my_active_link($cat_url . $cat_otr->slug, $_SERVER['REQUEST_URI']);?>><a href="<?=$cat_url . $cat_otr->slug;?>"><span>все</span><sup><?=$cat_otr->category_count;?></sup></a></li>
              <? foreach($categories_branch as $cat) : ?>
                <li<? my_active_link($cat_url . $cat_otr->slug . '/' . $cat->slug, $_SERVER['REQUEST_URI']); ?>>
                  <a href="<?=$cat_url . $cat_otr->slug . '/' . $cat->slug;?>">
                    <span><?=my_typograf($cat->name);?><sup><?=$cat->category_count;?></sup></span>
                  </a>
                </li>
              <? endforeach; ?>
              <? if(wpmd_is_phone() || wpmd_is_tablet()) : ?>
                <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам" data-form-name="Общий вопрос адвокатам">задать вопрос</div>
              <? endif; ?>
            </ul>
          </div>
          <? if(!wpmd_is_phone() || !wpmd_is_tablet()) : ?>
            <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам" data-form-name="Общий вопрос адвокатам">задать вопрос</div>
          <? endif; ?>
        </div>
      </div>
      <div class="content_block">
        <div class="lawyers_view practika_view">
          <div class="practika_items">
            <? query_posts("cat=$cat_ID&posts_per_page=8"); ?>
            <? while(have_posts()) : the_post(); ?>
              <div class="lawyers_post practika_item">
                <p class="title"><a href="<? the_permalink(); ?>" target="_self"><?= my_typograf(get_the_title()); ?></a></p>
                <p class="result"><?= my_typograf(strip_tags(get_post_meta(get_the_ID(), 'result', true))); ?></p>
                <?
                $the_categories = get_the_category();

                foreach($the_categories as $categories){
                  if($categories->category_parent != 0){
                    $get_category = get_category($categories->category_parent);

                    if($get_category->slug == 'branch_of_law'){
                      echo '<p class="cat_theme">'. $categories->name .'</p>';
                    }
                  }
                }
                ?>
              </div>
            <? endwhile; ?>
          </div>
          <? if($count_post >= 8) : ?>
            <div class="items_more items_more_90 practika_more ajax_more" data-type="practika" data-offset="8" data-step="8" data-cat-id="<?=$cat_ID;?>"><span>показать ещё</span></div>
          <? endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>