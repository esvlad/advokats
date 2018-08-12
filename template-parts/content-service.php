<? 
$service_individuals_posts = new WP_Query(array('category_name'=>'individuals', 'orderby'=>'date', 'order'=>'ASC', 'nopaging'=>true));
$service_legal_entities_posts = new WP_Query(array('category_name'=>'legal_entities', 'orderby'=>'date', 'order'=>'ASC', 'nopaging'=>true)); 
//, 'posts_per_page'=>50

?>
<div id="menu_view" class="none" data-menu="Услуги"></div>
<section class="sect lawyers service">
  <div class="wrapper">
    <div class="content">
      <h1>Услуги</h1>
      <div class="left_block categories">
        <div class="categories_block">
          <div class="categories_block_service">
            <? if(!wpmd_is_phone() && !wpmd_is_tablet()) : ?>
              <div class="categories_block_title categories_switch"><span>юридическим лицам</span></div>
              <ul class="categories_items">
            <? else : ?>
              <div class="categories_block_title">юридическим лицам</div>
              <ul class="categories_items">
            <? endif; ?>
              <? while($service_legal_entities_posts->have_posts()) : ?>
                <? $service_legal_entities_posts->the_post(); ?>
                <li<? my_active_link(get_the_permalink(), $_SERVER['REQUEST_URI']); ?>><a href="<? the_permalink(); ?>"><span><?= my_typograf(get_the_title()); ?></span></a></li>
              <? endwhile; ?>
            </ul>
          </div>
          <div class="categories_block_service">
            <? if(!wpmd_is_phone() && !wpmd_is_tablet()) : ?>
              <div class="categories_block_title categories_switch"><span>физическим лицам</span></div>
            <? else : ?>
              <div class="categories_block_title">физическим лицам</div>
            <? endif; ?>
            <ul class="categories_items">
              <? while($service_individuals_posts->have_posts()) : ?>
                <? $service_individuals_posts->the_post(); ?>
                <li<? my_active_link(get_the_permalink(), $_SERVER['REQUEST_URI']); ?>><a href="<? the_permalink(); ?>"><span><?= my_typograf(get_the_title());; ?></span></a></li>
              <? endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="content_block">
        <div class="lawyers_view service_view">
          <?
            $the_id = get_queried_object_id();

            $post = get_post($the_id);
            $projects_obj = get_post_meta($the_id, 'projects', true);
          ?>
          <h2><?= my_typograf($post->post_title); ?></h2>
          <?=my_typograf($post->post_content); ?>
          <div class="btn btn_service" data-type="modal" data-modal-id="1" data-modal-title="Опишите задачу для оценки стоимости" data-form-name="Оценка стоимости услуг">оценить стоимость услуг</div>
        </div>
        <?
        	$tags = get_the_tags();

        	if(isset($tags) && $tags != ''){
        		$slug_tags = array();
          
		        foreach($tags as $tag){
		          	$slug_tags[] = $tag->slug;
		        }

		        $command_items = new WP_Query(array('category_name'=>'command', 'tag'=>implode(',', $slug_tags)));
        	}
        ?>
        <? if($command_items) : ?>
	        <div class="lawyers_view commands_block">
	          <h2>Специалисты этого направления</h2>
	          <div class="commands_items">
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
	    <? endif; ?>
        <? if($projects_obj) : ?>
          <div class="lawyers_view blog_view practika_more">
            <h2>Проекты по защите интелектуальной собственности</h2>
            <div class="practika_items">
              <? query_posts(array('post__in' => $projects_obj)); ?>
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
        <div class="lawyers_view service_block service_block_form fade">
          <h2 class="form_title">Задайте свой вопрос адвокату</h2>
          <p class="form_result">Спасибо! Мы перезвоним вам в течении рабочего дня с ответом.</p>
          <form class="form" action="" method="POST" name="standart" data-name="Общий вопрос адвокатам" enctype="multipart/form-data" data-target="vopros_advokat">
            <input type="hidden" name="form_name" value="Общий вопрос адвокатам">
            <div class="form_row flex">
              <div class="form_col">
                <label for="name">
                  <p>имя</p>
                  <input class="required" id="name" type="text" name="name" value=""/>
                </label>
              </div>
              <div class="form_col">
                <label for="phone">
                  <p>телефон</p>
                  <input class="required" id="phone" type="text" name="phone" value=""/>
                </label>
              </div>
              <div class="form_col xs"></div>
            </div>
            <div class="form_row flex">
              <div class="form_col">
                <label for="email">
                  <p>электронная почта</p>
                  <input id="email" type="text" name="email" value=""/>
                </label>
              </div>
              <div class="form_col">
                <label for="file_service">
                  <p>&nbsp;</p>
                  <input class="file_load none" id="file_service" type="file" name="user_file" multiple value=""/>
                </label>
                <div class="file_upload" for="file_service">
                  <div class="file_upload_line"></div>
                  <div class="file_upload_block" id="file_btn_service">
                    <div class="file_upload_block__caption">
                      <p>прикрепить документы</p>
                      <p class="small">doc, pdf, jpg до 10 мб</p>
                    </div>
                    <div class="file_upload_block__file_name none">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form_col xs">
                <label for="file">
                  <p>&nbsp;</p>
                </label>
                <div>
                  <div class="cssload-spin-box none"></div>
                  <p>не&nbsp;прикреплено</p>
                </div>
              </div>
            </div>
            <div class="form_row">
              <div class="form_col_md">
                <label for="text">
                  <p>вопрос</p>
                  <textarea id="text" class="required" name="text" cols="20" rows="5"></textarea>
                </label>
              </div>
              <div class="form_col xs"></div>
            </div>
            <div class="form_row">
              <input class="btn btn_form" type="submit" value="отправить"/>
              <div class="form_politics">
                <input id="politics" type="checkbox" name="politics" value="1" checked="checked"/>
                <label for="politics">
                  <p>я соглашаюсь<br/><span class="link_modal modal_link" data-type="modal" data-modal-id="3" data-modal-title="Политика конфиденциальности">с&nbsp;политикой конфиденциальности</span></p>
                </label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>