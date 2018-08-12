<?
$cat_ID = get_query_var('cat'); 

$categories_lawyers = get_categories(array('child_of' => 9));
$categories_branch  = get_categories(array('child_of' => 11));

$related_posts_obj = get_post_meta(get_the_ID(), 'related_posts', true);
?>
<div id="menu_view" class="none" data-menu="Судебная практика"></div>
<section class="sect lawyers practika practika_post post">
  <div class="wrapper">
    <div class="content">
      <h1>Судебная практика</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_blog">
            <div class="categories_block_title">адвокат</div>
            <ul>
              <li<?my_active_link(get_category_link(9), $_SERVER['REQUEST_URI']);?>><a href="<?=get_category_link(9);?>"><span>все<sup><?=get_category(9)->category_count?></sup></span></a></li>
              <? foreach($categories_lawyers as $cat) : ?>
                <li<? my_active_link(get_category_link($cat->term_id), $_SERVER['REQUEST_URI']); ?>>
                  <a href="<?=get_category_link($cat->term_id);?>">
                    <span><?=my_typograf($cat->name);?><sup><?=$cat->category_count;?></sup></span>
                  </a>
                </li>
              <? endforeach; ?>
            </ul>
          </div>
          <div class="categories_block_blog">
            <div class="categories_block_title">отрасль права</div>
            <ul>
              <li<?my_active_link(get_category_link(11), $_SERVER['REQUEST_URI']);?>><a href="<?=get_category_link(11);?>"><span>все<sup><?=get_category(11)->category_count?></sup></span></a></li>
              <? foreach($categories_branch as $cat) : ?>
                <li<? my_active_link(get_category_link($cat->term_id), $_SERVER['REQUEST_URI']); ?>>
                  <a href="<?=get_category_link($cat->term_id);?>">
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
        <div class="lawyers_view practika_view post">
          <h2><?= my_typograf(get_the_title()); ?></h2>
          <?= my_typograf(get_the_content()); ?>
          <div class="practika_result">
            <p>Результат</p>
            <?= my_typograf(get_post_meta(get_the_ID(), 'result', true)); ?>
          </div>
        </div>
        <div class="lawyers_view commands_block">
          <h2>Адвокаты проекта</h2>
          <div class="commands_items">
            <?
              $tags = get_the_tags();
              $slug_tags = array();
              foreach($tags as $tag){
                $slug_tags[] = $tag->slug;
              }
              $command_items = new WP_Query(array('category_name'=>'command', 'tag'=>implode(',', $slug_tags)));
            ?>
            <? while($command_items->have_posts()) : $command_items->the_post(); ?>
              <div class="commands_item">
                <a href="<? the_permalink(); ?>" target="_self">
                  <img src="<? the_post_thumbnail_url('command_preview'); ?>"/>
                  <p class="title"><span><? the_title(); ?></span></p>
                </a>
              </div>
            <? endwhile; ?>
          </div>
        </div>
        <? if($related_posts_obj) : ?>
          <div class="lawyers_view blog_view practika_more">
            <h2>Похожие проекты</h2>
            <div class="practika_items">
              <? query_posts(array('post__in' => $related_posts_obj)); ?>
              <? while(have_posts()) : the_post(); ?>
                <div class="lawyers_post practika_item">
                  <p class="title"><a href="<? the_permalink(); ?>" target="_self"><? the_title(); ?></a></p>
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
              <? wp_reset_query(); ?>
            </div>
          </div>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>