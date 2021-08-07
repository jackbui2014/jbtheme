<?php
/**
 *
 * Render dynamic home banner block
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
if ( !function_exists('jbpostslist_render_block') ){
	/**
	 *
	 * Render home banner block.
	 *
	 * @since 1.0
	 *
	 *
	 * @param Array $attributes 
	 * @param String $content
	 * @return String block content
	 */
	function jbpostslist_render_block($attributes, $content ){

		$bg = '';
		if( !empty($attributes['background_color']) ):
			$bg = 'style="background-color:'.$attributes['background_color'].'"';
		endif;
        $item_cls = '';
        if( !empty($attributes['posts_per_page']) ):
            $posts_per_page = (int)$attributes['posts_per_page'];
            switch($posts_per_page){
                case 3:
                    $item_cls = 'jbpostslist-item jb-post-item col-md-4 col-sm-12';
                    break;
                case 4:
                    $item_cls = 'jbpostslist-item jb-post-item col-md-3 col-sm-12';
                    break;
                case 6:
                    $item_cls = 'jbpostslist-item jb-post-item col-md-4 col-sm-12';
                    break;
                case 8: 
                    $item_cls = 'jbpostslist-item jb-post-item col-md-3 col-sm-12';
                    break;
                default:
                    $item_cls = 'jbpostslist-item jb-post-item col-md-4 col-sm-12';
                    break;
            }
        else:
            $posts_per_page = 3;
            $item_cls = 'jbpostslist-item jb-post-item col-md-4 col-sm-12';
        endif;
        $args = array(
            'post_status'=>'publish',
            'post_type'=>'post',
            'numberposts'=> $posts_per_page
        );
        $recent_posts = wp_get_recent_posts($args);
        
		ob_start(); ?>
		<section class="jb-postslist-section jb-section" <?php echo $bg; ?> >
			<div class="container jb-postslist-wrapper">                
                <?php if( !empty( $attributes['title']) ):?>
                    <h3 class="jbpostslist-title section-title"><?php echo $attributes['title']; ?></h3>
                <?php endif; ?>
                <?php if( !empty($attributes['subtitle'])): ?>
                <p class="jbpostslist-subtitle section-subtitle">
                    <?php echo $attributes['subtitle']; ?>
                </p>
                <?php endif; ?>
                <div class="row jb-postslist-inner jb-post-list">
                    <?php if( !empty($recent_posts) ):
                        foreach($recent_posts as $key=>$value): 
                            $link = get_permalink( $value['ID']);
                            $thumbnail = get_the_post_thumbnail_url( $value['ID'],'thumbnail' );  
                            $date =  date(get_option('date_format'), strtotime($value['post_date']));
                            $post_expert = get_the_excerpt($value['ID']);
                            $comments = get_comments_number($value['ID']);
                        ?>
                            <div class="<?php echo $item_cls; ?>">
                                <div class="inner">
                                    <div class="post-item-image"><a href="<?php echo $link; ?> "><img src="<?php echo $thumbnail; ?>" atl="<?php echo $value['title']; ?>" /></a></div>
                                    <h3 class="post-item-title"><a href="<?php echo $link; ?> "><?php echo $value['post_title']; ?></a></h3>
                                    <div class="post-item-info">
                                        <div class="post-item-info-date"><i class="far fa-calendar-alt"></i><?php echo $date; ?>  <span class="seperator-icon">|</span>  </div>
                                        <div class="post-item-info-comments"><i class="fas fa-comments"></i><?php echo $comments; ?></div>

                                    </div>
                                    <div class="post-item-exceprt"><?php echo $post_expert; ?></div>
                                    <a class="post-item-readmore" href="<?php echo $link; ?>"><?php _e('Read more', 'jbtheme'); ?></a>
                                </div>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
			</div>
		</section>	
	<?php 
		return ob_get_clean();
	}
}

if( !function_exists('jbpostslist_register_block') ){

	/**
	 *
	 *Register action after all plugins have loaded
	 */
	function jbpostslist_register_block(){
		if( function_exists('register_block_type') ){
			register_block_type(
				'jbtheme/jbpostslist',
				array(
					'render_callback'=>'jbpostslist_render_block'
				)
			);
		}
	}
}
add_action('init', 'jbpostslist_register_block');