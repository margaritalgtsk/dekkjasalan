jQuery(document).ready(function() {
	
  jQuery('table').addClass('responsive');
  
  
	var beautifyTablesResponsive = function(){
		
		jQuery('table').each(function(){
						
			var maxHeight = getMaxHeigh(jQuery(this).find('p'));  
			jQuery(this).find('p').height(maxHeight);	
			
		});
	  
	}

	var getMaxHeigh = function(jObjects){
	  
	var maxHeight = 0;
	 
		jObjects.each(function(){
			
		
		if ( jQuery(this).height() > maxHeight ) 
		{
		maxHeight = jQuery(this).height();
		}
		});
		console.log(maxHeight)
		 
		return maxHeight;	
	}
  
	var switched = false;
	var updateTables = function() {
	   
	beautifyTablesResponsive();  
	  
    if ((jQuery(window).width() < 767) && !switched ){
      switched = true;
      jQuery("table.responsive").each(function(i, element) {
        splitTable(jQuery(element));		
      });
	  jQuery('.scrollable').scrollLeft(jQuery(this).height())
      return true;
    }
    else if (switched && (jQuery(window).width() > 767)) {
      switched = false;
      jQuery("table.responsive").each(function(i, element) {
        unsplitTable(jQuery(element));
      });
    }
	
	var tablesScroll = function(){
	
		jQuery('.scrollable').scroll(function() { 
			
			var self=jQuery(this);
			var value = jQuery(this).scrollLeft(); 
			var scrollValue = jQuery(this).scrollLeft();
			
			jQuery('.scrollable').not(this).each(function(){
			
				jQuery(this).scrollLeft(scrollValue)
			
			});
		});

	}
	
	tablesScroll();
  };
  
  


   
  jQuery(window).load(updateTables);
  jQuery(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
  jQuery(window).on("resize", updateTables);
   
	
	function splitTable(original)
	{
		original.wrap("<div class='table-wrapper' />");
		
		var copy = original.clone();
		copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
		copy.removeClass("responsive");
		
		original.closest(".table-wrapper").append(copy);
		copy.wrap("<div class='pinned' />");
		original.wrap("<div class='scrollable' />");

    setCellHeights(original, copy);
	}
	
	function unsplitTable(original) {
    original.closest(".table-wrapper").find(".pinned").remove();
    original.unwrap();
    original.unwrap();
	}

  function setCellHeights(original, copy) {
    var tr = original.find('tr'),
        tr_copy = copy.find('tr'),
        heights = [];

    tr.each(function (index) {
      var self = jQuery(this),
          tx = self.find('th, td');

      tx.each(function () {
        var height = jQuery(this).outerHeight(true);
        heights[index] = heights[index] || 0;
        if (height > heights[index]) heights[index] = height;
      });

    });

    tr_copy.each(function (index) {
      jQuery(this).height(heights[index]);
    });
	
  }
  
   jQuery(window).resize();
	

});

