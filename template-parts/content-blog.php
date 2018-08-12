<?
$my_key_block = 1;
setPostViews(get_the_ID());

$cats = get_the_category();

$categories = get_categories(array('child_of' => 2));

$get_category = get_category($cat_ID);

preprint($cat_ID);
?>
<div id="menu_view" class="none" data-menu="Блог"></div>
<section class="sect lawyers blog post">
  <div class="wrapper">
    <div class="content">
      <h1>Блог</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_blog cat">
            <div class="categories_block_title">категория</div>
            <ul class="categories_items">
              <? $cat_active = ($cat_ID == 2) ? ' class="active"' : null; ?>
              <li<?=$cat_active;?>><a href="<?=get_site_url('', 'blog');?>"><span>все<sup><?=get_category(2)->category_count;?></sup></span></a></li>
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
                  <li<?=$cat_active;?>><a href="<?=get_site_url('', 'blog/') . $cat->slug;?>"><span><?=$cat->name;?><sup><?=$cat->category_count;?></sup></span></a></li>
                <? endif; ?>
              <? endforeach; ?>
            </ul>
          </div>
          <div class="categories_block_blog theme">
            <!--<div class="categories_block_title">тема</div>-->
            <ul class="categories_items">
              <? if(wpmd_is_phone() || wpmd_is_tablet()) : ?>
                <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам"  data-form-name="Общий вопрос адвокатам">задать вопрос</div>
              <? endif; ?>
            </ul>
          </div>
          <? if(!wpmd_is_phone() || !wpmd_is_tablet()) : ?>
            <div class="btn btn_question" data-type="modal" data-modal-id="1" data-modal-title="Задайте свой вопрос адвокатам"  data-form-name="Общий вопрос адвокатам">задать вопрос</div>
          <? endif; ?>
        </div>
      </div>
      <div class="content_block">
        <div class="lawyers_view blog_view post">
          <h2><?=my_typograf(get_the_title()); ?></h2>
          <div class="post_info">
            <div class="post_info_view"><?=getPostViews(get_the_ID()); ?></div>
            <time class="post_info_time"><? the_time('d.m.Y'); ?></time>
          </div>
		  <?=my_typograf(get_the_content()); ?>
          <div class="post_social_btn">
            <div class="btn_sc fb">
            	<div class="fb-share-button" data-layout="button_count" data-size="small" data-mobile-iframe="false"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Поделиться</a></div>
            </div>
            <div class="btn_sc vk">
            	<script type="text/javascript"><!--
					document.write(VK.Share.button(false,{type: "round", text: "Поделиться"}));
				--></script>
            </div>
            <div class="btn_sc od"></div>
          </div>
        </div>
        <div class="lawyers_view blog_view popular_posts">
          <h2>Популярные статьи</h2>
          <div class="blog_items">
          	<?
	          $args = array('category_name'=>'blog', 'numberposts' => 3, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => 4);
	          query_posts($args);
	        ?>
	        <? if(wpmd_is_phone()) : ?>
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
						<a href="<? the_permalink(); ?>" target="_self">
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
	        <? else : ?>
	          <div class="blog_cols blog_col_left">
	        	<? $my_key_block = 1; ?>
	        	<? while ( have_posts() ) : the_post(); ?>
	          	<?
	              if(get_post_meta(get_the_ID(), 'blog_video', true) == 0){
	                $v_class = null;
	              } else {
	                $v_class = 'video';
	              }
	            ?>
	            <? if($my_key_block % 2 != 0) : ?>
		            <div class="blog_item <?=$b_class;?>">
						<a href="<? the_permalink(); ?>" target="_self">
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
	          <div class="blog_cols blog_col_right">
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
	            <? if($my_key_block % 2 == 0) : ?>
		            <div class="blog_item <?=$b_class;?>">
						<a href="<? the_permalink(); ?>" target="_self">
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
	        <? endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12&appId=684579861723456';
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>