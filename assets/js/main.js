(function($){
	if(typeof THEME == "undefined" ){
		THEME = {};
	}

	THEME.slide_load = function(){
		$('.owl-carousel').owlCarousel({
            loop:false,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                1000:{
                    items:3
                }
            }
        })
	}

    THEME.tabs = function(){
		var tabs = $(".section_news");
        $.each( tabs, function() {
            var tab = $(this),
                links = tab.find('.tab-links'),
                contents = tab.find('.tabcontent'),
                labels = links.find('.tablink');
                name = $(labels[0]).attr('tab-name');// lay ten tab
                //an tat ca cac tab
                contents.hide();
                //hien thi tab mac dinh
                $(labels[0]).addClass('active');
                tab.find('#' + name).show();
                $( labels ).on('click', function(e) {
                    e.preventDefault();
                    if( $(this).hasClass('active') )
                        return;

                    var name = $(this).attr('tab-name');
                    
                    $(this).closest('.tab-links').find('.tablink').removeClass('active');//xoa class active//labels.removeClass('active');//xoa class active
                    $(this).addClass('active');//them class 
                    contents.slideUp();
                    tab.find('#' + name).slideDown();//show tab content
                });
        });
	}

    
	$(document).ready(function(){
		THEME.slide_load();
        THEME.tabs();
	});
})(jQuery);