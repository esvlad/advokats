<? 
get_header();

$home_url = get_site_url('','/');
?>
<section class="sect start home">
  <div class="wrapper">
    <div class="start_image">
      <div class="clip"></div>
      <div class="image"></div>
    </div>
    <div class="start_caption">
      <p>Защитим ваши интересы в&nbsp;суде и&nbsp;решим любой юридический вопрос</p>
	  <a class="btn btn_start" href="<?=$home_url;?>service" target="_self">Список услуг</a>
    </div>
  </div>
</section>
<?
$args_practika = array('category_name'=>'arbitrage_practice', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 4);
?>
<section class="sect lawyers practika home">
  <div class="circles_block c1" data-step="100" data-position="top">
    <div class="circles c_1"></div>
    <div class="circles c_2"></div>
    <div class="circles c_3"></div>
    <div class="circles c_4 circles_fade"></div>
    <div class="circles c_5 circles_fade"></div>
    <div class="circles c_6 circles_fade"></div>
  </div>
  <div class="wrapper">
    <div class="content">
      <div class="block_left">
        <h1>Судебная практика</h1>
        <? if(!wpmd_is_phone() && !wpmd_is_tablet()) : ?>
          <a class="items_more" href="<?=$home_url;?>arbitrage_practice" target="_self"><span>все дела</span></a>
        <? endif; ?>
      </div>
      <div class="block_right">
        <div class="practika_items">
          <? query_posts($args_practika); ?>
          <? while(have_posts()) : the_post(); ?>
            <div class="lawyers_post practika_item fade_id">
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
          <? wp_reset_query(); ?>
        </div>
      </div>
      <a class="items_more table_visible" href="<?=$home_url;?>arbitrage_practice" target="_self"><span>все дела</span></a>
    </div>
  </div>
</section>
<?
$command = get_post( 31 );
$args_success = array('category_name'=>'success_team', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 4);
?>
<section class="sect lawyers commands home">
  <div class="wrapper">
    <div class="content">
      <h1><?= $command->post_title; ?></h1>
      <div class="commands_picture">
        <?= $command->post_content; ?>
      </div>
      <div class="commands_progress">
        <div class="left_block">
          <h2>Успехи команды за&nbsp;последнее время</h2>
          <? if(!wpmd_is_phone() || !wpmd_is_tablet()) : ?>
            <a class="items_more" href="<?=$home_url;?>command" target="_self"><span>подробнее о&nbsp;компании и&nbsp;команде</span></a>
          <? endif; ?>
        </div>
        <div class="right_block commands_progress_items">
          <? query_posts($args_success); ?>
          <? while(have_posts()) : the_post(); ?>
            <div class="commands_progress_item">
              <?= my_typograf(get_the_content()); ?>
            </div>
          <? endwhile; ?>
          <? wp_reset_query(); ?>
        </div>
        <a class="items_more table_visible" href="<?=$home_url;?>command" target="_self"><span>подробнее о&nbsp;компании<br/>и&nbsp;команде</span></a>
      </div>
    </div>
  </div>
</section>
<section class="sect attention home">
  <div class="attention_caption">
    <p>Чем раньше вы&nbsp;обратитесь к&nbsp;адвокату, тем выше шансы на&nbsp;победу</p>
  </div>
</section>
<?
  $args = array('category_name'=>'blog', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 6);
  $my_key_block = 1;
?>
<section class="sect lawyers blog home">
  <div class="circles_block c2" data-step="100" data-position="top">
    <div class="circles c_1"></div>
    <div class="circles c_2"></div>
    <div class="circles c_3"></div>
    <div class="circles c_4 circles_fade"></div>
    <div class="circles c_5 circles_fade"></div>
    <div class="circles c_6 circles_fade"></div>
  </div>
  <div class="wrapper">
    <div class="content">
      <h1>Делимся знаниями в&nbsp;блоге</h1>
      <? if(wpmd_is_phone()) : ?>
        <div class="blog_items">
          <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
        </div>
        <a class="items_more" href="<?=$home_url;?>blog"><span>все статьи</span></a>
      <? elseif(wpmd_is_tablet()) : ?>
        <div class="blog_items">
          <div class="blog_item_col blog_col_left">
            <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
              <? if($my_key_block % 2 != 0) : ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <? endif; ?>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
          </div>
          <div class="blog_item_col blog_col_right">
            <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
              <? if($my_key_block % 2 == 0) : ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <? endif; ?>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
          </div>
        </div>
        <a class="items_more" href="<?=$home_url;?>blog"><span>все статьи</span></a>
      <? else : ?>
        <div class="blog_cols">
          <div class="blog_col_3 blog_col_left">
            <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
              <? if($my_key_block % 3 == 1) : ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <? endif; ?>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
          </div>
          <div class="blog_col_3 blog_col_center">
            <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
              <? if($my_key_block % 3 == 2) : ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <? endif; ?>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
          </div>
          <div class="blog_col_3 blog_col_right">
            <? query_posts($args); ?>
            <? $my_key_block = 1; ?>
            <? while ( have_posts() ) : the_post(); ?>
              <? if($my_key_block % 3 == 0) : ?>
                <?
                  if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
                    $v_class = null;
                  } else {
                    $v_class = 'video';
                  }
                ?>
                <div class="blog_item">
                 <a href="<? the_permalink(); ?>">
                  <? if ( has_post_thumbnail()) : ?>
                    <div class="preview <?=$v_class;?>">
                      <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'large');  ?>" />
                    </div>
                  <? endif; ?>
                  <p><span><?=my_typograf(get_the_title()); ?></span></p>
                  <div class="post_info">
                    <div class="post_info_view"><?=getPostViews(get_the_ID());?></div>
                    <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
                  </div>
                 </a>
                </div>
              <? endif; ?>
              <?$my_key_block++;?>
            <? endwhile; ?>
            <? wp_reset_query(); ?>
          </div>
        </div>
      <? endif; ?>
    </div>
  </div>
</section>

<? get_footer();
