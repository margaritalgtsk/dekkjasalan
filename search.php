<?php get_header(); ?>

<script>
jQuery(document).ready(function($){
	
	var $searchContainer = $('#search-results');
	
	$(window).load(function(){
		
		$searchContainer.isotope({
		   itemSelector: '.result',
		   layoutMode: 'packery',
		   packery: { columnWidth: $('#search-results').width() / 3 }
		});
		
		$searchContainer.css('visibility','visible');
				
	});
	
	$(window).resize(function(){
	   $searchContainer.isotope({
	   	  layoutMode: 'packery',
	      packery: { columnWidth: $('#search-results').width() / 3}
	   });
	});

	
});
</script>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
			<div class="col span_12">
				<div class="col span_12 section-title">
					<h1>Niðurstöður fyrir<span>(<?php $allsearch = new WP_Query("s=$s&showposts=0"); echo $allsearch ->found_posts?>)<span> <span>"<?php echo esc_html( get_search_query( false ) ); ?>"</span></h1>
				</div>
			</div>
		</div>
		
		<div class="divider"></div>
		
		<div class="row">
			
			<div class="col span_12" id="post-area">
				
				<div class="posts-container" data-load-animation="none">	
						
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						

							
			<?php if( get_post_type($post->ID) == 'post' ){ ?>
				<article id="post-<?php echo $post->ID ?>" class="regular post-<?php echo $post->ID ?> post type-post status-publish format-standard has-post-thumbnail hentry category-dekk-felgum">
					<div class="inner-wrap">
						<div class="post-content">
						 
						 <div class="content-inner">
						 <?php if(has_post_thumbnail( $post->ID )) {	
							echo '<a href="'.get_permalink().'"><span class="post-featured-img search-img" >'.get_the_post_thumbnail($post->ID, 'full').'</span></a>'; 
						} ?>
										
							<div class="article-content-wrap">
							   <div class="post-header">
								  <h2 class="title">
									 <a href="<?php the_permalink()?>"><?php the_title(); ?></a> 
								  </h2>
								  
							   </div>
							   <!--/post-header-->
							   <div class="excerpt">
								  <?php if(has_excerpt( $post->ID )){
									echo the_excerpt();
								  }else{
									 the_content();
								  }?>  
							   </div>
							   <div class="addtioonal-description"> <?=get_post_meta($post->ID, 'additional_description', true);?></div>
							   <a class="more-link" href="<<?php the_permalink()?>">"><span class="continue-reading">Read More</span></a>							
							</div>
							<!--article-content-wrap-->
						 </div>
						 <!--/content-inner-->
						</div>
						<!--/post-content-->
					</div>
					<!--/inner-wrap-->
					</article>
							<?php }
							
							else if( get_post_type($post->ID) == 'page' ){ ?>
							
							<article id="post-<?php echo $post->ID ?>" class="regular post-<?php echo $post->ID ?> post type-post status-publish format-standard has-post-thumbnail hentry category-dekk-felgum">
					<div class="inner-wrap">
						<div class="post-content">
						 
						 <div class="content-inner">
						 <?php if(has_post_thumbnail( $post->ID )) {	
							echo '<a href="'.get_permalink().'"><span class="post-featured-img search-img" >'.get_the_post_thumbnail($post->ID, 'full').'</span></a>'; 
						} ?>
										
							<div class="article-content-wrap">
							   <div class="post-header">
								  <h2 class="title">
									 <a href="<?php the_permalink()?>"><?php the_title(); ?></a> 
								  </h2>
								  
							   </div>
							   <!--/post-header-->
							   <div class="excerpt">
								  <?php echo the_excerpt()?>
							   </div>
							   <a class="more-link" href="<<?php the_permalink()?>">"><span class="continue-reading">Read More</span></a>							
							</div>
							<!--article-content-wrap-->
						 </div>
						 <!--/content-inner-->
						</div>
						<!--/post-content-->
					</div>
					<!--/inner-wrap-->
							
					</article>		
								
							<?php }
							
							else if( get_post_type($post->ID) == 'portfolio' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Portfolio Item', NECTAR_THEME_NAME); ?></span></h2>
									</div>
								</article><!--/search-result-->		
							<?php }
							
							else if( get_post_type($post->ID) == 'product' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'. get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Product', NECTAR_THEME_NAME); ?></span></h2>	
									</div>
								</article><!--/search-result-->	
							<?php } else { ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									</div>
								</article><!--/search-result-->	
							<?php } ?>
							
						
						
					<?php endwhile; 
					
					else: echo "<p> Engar niðurstöður fundust </p>"; endif;?>
				
						
				</div><!--/search-results-->
				
				
				<?php if( get_next_posts_link() || get_previous_posts_link() ) { ?>
					<div id="pagination">
						<div class="prev"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
						<div class="next"><?php next_posts_link('Next Entries &raquo;','') ?></div>
					</div>	
				<?php }?>
				
			</div><!--/span_9-->
			
			<div id="sidebar" class="col span_3 col_last">
				<?php get_sidebar(); ?>
			</div><!--/span_3-->
		
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php get_footer(); ?>

