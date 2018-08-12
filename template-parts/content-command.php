<? 
$command_posts = new WP_Query(array('category_name'=>'command', 'orderby'=>'date', 'order'=>'DESC', 'nopaging'=>true)); 

$get_tag_slug = get_the_tags()[0]->slug;
$practika_items = new WP_Query(array('category_name'=>'arbitrage_practice', 'tag'=>$get_tag_slug, 'nopaging'=>true));
?>
<div id="menu_view" class="none" data-menu="Команда"></div>
<section class="sect lawyers commands post">
  <div class="wrapper">
    <div class="content">
      <h1>Команда</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_commands">
            <? if(wpmd_is_phone() || wpmd_is_tablet()) : ?>
              <div class="categories_block_title">адвокаты</div>
            <? endif; ?>
            <ul>
              <? while($command_posts->have_posts()) : ?>
                <? $command_posts->the_post(); ?>
                  <li<? my_active_link(get_the_permalink(), $_SERVER['REQUEST_URI']); ?> data-set="123">
                    <a href="<? the_permalink(); ?>" target="_self">
                      <img src="<?= wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'mini_img', true), 'command_small'); ?>"/>
                      <span><span><?= get_post_meta(get_the_ID(), 'title_menu', true); ?></span></span>
                    </a>
                  </li>
              <? endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="content_block">
        <div class="lawyers_view commands_view advocat">
          <?
            $the_id = get_queried_object_id();

            $post = get_post($the_id);
          ?>
          <img class="commands_view_image" src="<?= wp_get_attachment_image_url(get_post_thumbnail_id($the_id), 'command_big'); ?>" />
          <h2><?= $post->post_title; ?></h2>
          <?=my_typograf($post->post_content); ?>
        </div>
        <? if($practika_items->have_posts()) : ?>
          <div class="lawyers_view commands_view project">
            <h2>Проекты</h2>
            <div class="practika_items">
              <? $practika_item = 1; ?>
              <? while($practika_items->have_posts()) : $practika_items->the_post(); ?>
                <? $practika_class = ($practika_item > 4) ? ' none' : null; ?>
                <div class="lawyers_post practika_item<?=$practika_class;?>" data-item="<?=$practika_item;?>">
                  <p class="title"><a href="<? the_permalink(); ?>" target="_self"><?=my_typograf(get_the_title());?></a></p>
                  <p class="result"><?=my_typograf(strip_tags(get_post_meta(get_the_ID(), 'result', true)));?></p>
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
                <? $practika_item++; ?>
              <? endwhile; ?>
            </div>
            <? if($practika_item > 4) : ?>
              <div class="items_more items_more_90 practika_more command_pr_more" data-count="<?=++$practika_item;?>" data-offset="4"><span>Показать ещё</span></div>
            <? endif; ?>
          </div>
        <? endif; ?>
        <? $curses = get_post_meta($the_id, 'courses', true); ?>
        <? if(isset($curses) && $curses != '') : ?>
          <div class="lawyers_view commands_view curses">
            <h2>Конференции и курсы</h2>
            <?= do_shortcode($curses); ?>
          </div>
        <? endif; ?>
        <? $publication = get_post_meta($the_id, 'publications', true);?>
        <? if(isset($publication) && $publication != '') : ?>
          <div class="lawyers_view commands_view publication">
            <h2>Публикации</h2>
            <div class="publication_items">
              <?=my_typograf($publication); ?>
            </div>
            <div class="items_more items_more_90 publication_more" style="display: none;"><span>Показать ещё</span></div>
          </div>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>