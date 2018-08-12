<? 
$service_individuals_posts = new WP_Query(array('category_name'=>'individuals', 'orderby'=>'date', 'order'=>'ASC', 'nopaging'=>true));
$service_legal_entities_posts = new WP_Query(array('category_name'=>'legal_entities', 'orderby'=>'date', 'order'=>'ASC', 'nopaging'=>true)); 
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
              <div class="categories_block_title categories_switch open"><span>юридическим лицам</span></div>
              <? $open = ' style="display: block;"'; ?>
            <? else : ?>
              <div class="categories_block_title">юридическим лицам</div>
              <? $open = null; ?>
            <? endif; ?>
            <ul class="categories_items"<?=$open;?>>
              <? while($service_legal_entities_posts->have_posts()) : ?>
                <? $service_legal_entities_posts->the_post(); ?>
                <li><a href="<? the_permalink(); ?>"><span><?= my_typograf(get_the_title()); ?></span></a></li>
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
                <li><a href="<? the_permalink(); ?>"><span><?= my_typograf(get_the_title()); ?></span></a></li>
              <? endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="content_block">
        <?
          $service_art_1 = get_post( 41 );
          $service_art_2 = get_post( 43 );
        ?>
        <div class="lawyers_view service_view">
          <h2 class="fade"><?=my_typograf($service_art_1->post_title);?></h2>
          <?=my_typograf($service_art_1->post_content);?>
        </div>
        <div class="lawyers_view service_view docs fade">
          <h2><?=my_typograf($service_art_2->post_title);?></h2>
          <?=my_typograf($service_art_2->post_content);?>
        </div>
        <div class="lawyers_view service_block service_block_form fade">
          <h2 class="form_title">Задайте свой вопрос адвокату</h2>
          <p class="form_result">Спасибо! Мы перезвоним вам в течении рабочего дня с ответом.</p>
          <form class="form" action="" method="POST" name="standart" enctype="multipart/form-data" data-target="vopros_advokat">
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
                <label for="file">
                  <p>&nbsp;</p>
                  <input class="none" id="file" type="file" name="user_file" multiple value=""/>
                </label>
                <div class="file_upload" for="file">
                  <div class="file_upload_line"></div>
                  <div class="file_upload_block" id="file_btn">
                    <div class="file_upload_block__caption">
                      <p>прикрепить документы</p>
                      <p class="small">doc, pdf, jpg до 10 мб</p>
                    </div>
                    <div class="file_upload_block__file_name none"></div>
                  </div>
                </div>
              </div>
              <div class="form_col xs">
                <label for="file">
                  <p>&nbsp;</p>
                </label>
                <div>
                  <p>не прикреплено</p>
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
                  <p>я соглашаюсь<br/><span class="link_modal modal_link" data-type="modal" data-modal-id="3" data-modal-title="Политика конфиденциальности">с политикой конфиденциальности</span></p>
                </label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>