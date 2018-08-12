<div id="menu_view" class="none" data-menu="Команда"></div>
<section class="sect lawyers commands page all">
  <div class="circles_block c3" data-step="100" data-position="top">
    <div class="circles c_1"></div>
    <div class="circles c_2"></div>
    <div class="circles c_3"></div>
    <div class="circles c_4 circles_fade"></div>
    <div class="circles c_5 circles_fade"></div>
    <div class="circles c_6 circles_fade"></div>
  </div>
  <div class="circles_block c4" data-step="120" data-position="top">
    <div class="circles c_1"></div>
    <div class="circles c_2"></div>
    <div class="circles c_3"></div>
    <div class="circles c_4 circles_fade"></div>
    <div class="circles c_5 circles_fade"></div>
    <div class="circles c_6 circles_fade"></div>
  </div>
  <? $command = get_post( 31 ); ?>
  <? $comand_caption = get_post( 34 ); ?>
  <div class="wrapper">
    <div class="content">
      <h1><?= $command->post_title; ?></h1>
      <div class="commands_picture">
        <?= $command->post_content; ?>
      </div>
      <div class="commands_block_caption">
        <?= $comand_caption->post_content; ?>
      </div>
    </div>
  </div>
</section>
<? $comand_reestr = get_post( 36 ); ?>
<section class="sect commands praise">
  <div class="praise_caption">
    <p><?= $comand_reestr->post_content; ?></p>
  </div>
</section>
<section class="sect lawyers commands page">
  <div class="wrapper">
    <div class="content">
      <h1>Команда</h1>
      <div class="lawyers_view commands_block">
        <div class="commands_items">
          <? while(have_posts()) : the_post(); ?>
            <div class="commands_item">
  			     <a href="<? the_permalink(); ?>" target="_self">
  			        <img src="<? the_post_thumbnail_url('command_preview'); ?>"/>
                <p class="title"><span><? the_title(); ?></span></p>
                <div class="caption"><?=get_post_meta(get_the_ID(), 'caption', true)?></div>
  			     </a>
  		      </div>
          <? endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<? $clients = new WP_Query(array('category_name'=>'clients', 'orderby'=>'date', 'order'=>'DESC', 'posts_per_page'=>16)); ?>
<section class="sect lawyers commands client">
  <div class="wrapper">
    <div class="content">
      <h1>Наши партнеры</h1>
      <div class="lawyers_view client_items">
        <? while($clients->have_posts()) : $clients->the_post(); ?>
          <div class="client_item">
            <div class="client_item_image"></div>
            <div class="client_item_caption">
              <?=my_typograf(get_the_content()); ?>
            </div>
          </div>
        <? endwhile; ?>
      </div>
    </div>
  </div>
</section>