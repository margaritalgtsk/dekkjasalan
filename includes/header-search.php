<?php $options = get_nectar_theme_options(); 

if(!empty($options['header-disable-ajax-search']) && $options['header-disable-ajax-search'] == '1') {
	$ajax_search = 'no';	
} else {
	$ajax_search = 'yes';
} ?>

<div id="search-outer" class="nectar">
		
	<div id="search">
	  	 
		<div class="container">
		  	 	
		     <div id="search-box">
		     	
		     	<div class="col span_12">
			      	<form action="<?php echo home_url(); ?>" method="GET">
			      		<input type="text" name="s" <?php if($ajax_search == 'yes') { echo 'id="s"'; } ?> value="Byrjaðu að skrifa" data-placeholder="Byrjaðu að skrifa" />
			      	</form>
			      	<?php if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend' && $ajax_search == 'no') echo '<span><i>Ýttu á enter til að hefja leitina</i></span>'; ?>
		        </div><!--/span_12-->
			      
		     </div><!--/search-box-->
		     
		     <div id="close"><a href="#"><span class="icon-salient-x" aria-hidden="true"></span></a></div>
		     
		 </div><!--/container-->
	    
	</div><!--/search-->
	  
</div><!--/search-outer-->