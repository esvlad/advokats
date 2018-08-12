<?
$cat_ID = get_query_var('cat'); 

$categories = get_categories(array('child_of' => 2));

$my_key_block = 1;

$get_category = get_category($cat_ID);

$blog_url = get_site_url('', 'blog');
?>
<div id="menu_view" class="none" data-menu="Блог"></div>
<section class="sect lawyers blog">
  <div class="wrapper">
    <div class="content">
      <h1>Блог</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_blog cat">
            <div class="categories_block_title">категория</div>
            <ul class="categories_items">
              <? $cat_active = ($cat_ID == 2) ? ' class="active"' : null; ?>
              <li<?=$cat_active;?>><a href="<?=$blog_url;?>"><span>все<sup><?=get_category(2)->category_count;?></sup></span></a></li>
              <? foreach($categories as $cat) : ?>
                <? if($cat->category_parent == 2) : ?>
                  <?
                    if($cat->cat_ID == $cat_ID){
                      $cat_active = ' class="active"';

                      $child_theme = $cat_ID;
                    } elseif($get_category->parent == $cat->cat_ID){
                      $cat_active = ' class="active"';

                      $child_theme = $get_category->parent;
                    } else {
                      $cat_active = null;
                    }
                  ?>
                  <li<?=$cat_active;?>><a href="<?=$blog_url . '/' . $cat->slug;?>"><span><?=$cat->name;?><sup><?=$cat->category_count;?></sup></span></a></li>
                <? endif; ?>
              <? endforeach; ?>
            </ul>
          </div>
          <? if($cat_ID != 2) : ?>
            <?
              if($child_theme != 2){
                $cat_theme = get_categories(array('child_of' => $child_theme));
                $parent_category = get_category($child_theme);

                $parent = get_category($parent_category->cat_ID);
              }
            ?>
            <? if(!empty($cat_theme)) : ?>
              <div class="categories_block_blog theme">
                <div class="categories_block_title">тема</div>
                <ul class="categories_items">
                  <? $cat_theme_active = ($child_theme == $cat_ID) ? ' class="active"' : null; ?>
                  <li<?=$cat_theme_active;?>><a href="<?=$blog_url . '/' . $parent->slug;?>"><span>все<sup><?=$parent->category_count;?></sup></span></a></li>
                  <? foreach($cat_theme as $theme) : ?>
                    <? $theme_active = ($theme->cat_ID == $cat_ID) ? ' class="active"' : null; ?>
                    <li<?=$theme_active;?>><a href="<?=$blog_url . '/' . $parent_category->slug . '/' . $theme->slug;?>"><span><?=$theme->name?><sup><?=$theme->category_count;?></sup></span></a></li>
                  <? endforeach; ?>
                  <? if(wpmd_is_phone() || wpmd_is_tablet()) : ?>
                    <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам" data-form-name="Общий вопрос адвокатам">задать вопрос</div>
                  <? endif; ?>
                </ul>
              </div>
            <? endif; ?>
          <? endif; ?>
          <? if(!wpmd_is_phone() && !wpmd_is_tablet()) : ?>
            <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам" data-form-name="Общий вопрос адвокатам">задать вопрос</div>
          <? endif; ?>
        </div>
      </div>
      <div class="content_block">
        <div class="lawyers_view blog_items posts">
          <? if(wpmd_is_phone()) : ?>
            <? $my_key_block = 1; ?>
            <? while(have_posts()) : the_post(); ?>
              <?
                if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                  $v_class = null;
                } else {
                  $v_class = 'video';
                }
              ?>
                <div class="blog_item">
                  <a href="<? the_permalink(); ?>" target="_self">
                    <? if ( has_post_thumbnail()) : #the_post_thumbnail('large')?>
                      <div class="preview <?=$v_class;?>">
                        <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                      </div>
                    <? endif; ?>
                    <p><span><?=my_typograf(get_the_title());?></span></p>
                    <div class="post_info">
                      <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                      <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                    </div>
                  </a>
                </div>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          <? else : ?>
          <div class="blog_cols blog_col_left">
            <? $my_key_block = 1; ?>
            <? while(have_posts()) : the_post(); ?>
              <?
                if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                  $v_class = null;
                } else {
                  $v_class = 'video';
                }
              ?>
              <? if($my_key_block % 2 != 0) : ?>
                <div class="blog_item">
                  <a href="<? the_permalink(); ?>" target="_self">
                    <? if ( has_post_thumbnail()) : ?>
                      <div class="preview <?=$v_class;?>">
                        <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                      </div>
                    <? endif; ?>
                    <p><span><?=my_typograf(get_the_title());?></span></p>
                    <div class="post_info">
                      <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                      <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                    </div>
                  </a>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
          <div class="blog_cols blog_col_right">
            <? $my_key_block = 1; ?>
            <? while(have_posts()) : the_post(); ?>
              <?
                if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                  $v_class = null;
                } else {
                  $v_class = 'video';
                }
              ?>
              <? if($my_key_block % 2 == 0) : ?>
                <div class="blog_item">
                  <a href="<? the_permalink(); ?>" target="_self">
                    <? if ( has_post_thumbnail()) : ?>
                      <div class="preview <?=$v_class;?>">
                        <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                      </div>
                    <? endif; ?>
                    <p><span><?=my_typograf(get_the_title());?></span></p>
                    <div class="post_info">
                      <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                      <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                    </div>
                  </a>
                </div>
              <? endif; ?>
              <? $my_key_block++; ?>
            <? endwhile; ?>
          </div>
          <? endif; ?>
        </div>
        <? if($my_key_block >= 12) : ?>
          <div class="items_more items_more_90 blog_more" data-type="blog" data-count="12"><span>показать ещё</span></div>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>