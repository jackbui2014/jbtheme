<?php 
global $post;
$item_cls = 'col-md-4 col-sm-12';
$link = get_permalink( $post->ID );
$thumbnail = get_the_post_thumbnail_url( $post->ID,'thumbnail' );  
$date =  date(get_option('date_format'), strtotime($post->post_date));
$post_expert = get_the_excerpt($post->ID);
$comments = get_comments_number($post->ID);
?>
<div class="<?php echo $item_cls; ?> animate__animated fadeInUp" data-scroll>
    <div class="inner">
        <div class="post-item-image"><a href="<?php echo $link; ?> "><img src="<?php echo $thumbnail; ?>" atl="<?php echo $post->post_title; ?>" /></a></div>
        <h3 class="post-item-title"><a href="<?php echo $link; ?> "><?php echo $post->post_title; ?></a></h3>
        <div class="post-item-info">
            <div class="post-item-info-date"><i class="far fa-calendar-alt"></i><?php echo $date; ?>  <span class="seperator-icon">|</span>  </div>
            <div class="post-item-info-comments"><i class="fas fa-comments"></i><?php echo $comments; ?></div>

        </div>
        <div class="post-item-exceprt"><?php echo $post_expert; ?></div>
        <a class="post-item-readmore" href="<?php echo $link; ?>"><?php _e('Read more', 'jbtheme'); ?></a>
    </div>
</div>