jQuery(document).ready(function($) {

    var rtl;
    
    if( the_schema_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    //header search toggle
    $('.header-search .header-search-form').hide();
    $('.search-toggle').on('click', function(){
        $(this).parent('.header-search').addClass('active');
        $('.header-search .header-search-form').fadeIn();
    });

    //add dropdown arrow
    $('.main-navigation ul > li.menu-item-has-children').prepend('<span class="dropdown"><i class="fas fa-chevron-down"></i></span>');
    if($(window).width() <= 1024) {
        $('.main-navigation ul ul').hide();
        $('.main-navigation ul li.menu-item-has-children .dropdown').on('click', function(){
            $(this).siblings('ul.sub-menu').slideToggle();
            $(this).toggleClass('open');
        });
    }

    //close search form
    $('.header-search-form .close').on('click', function(){
        $(this).parent('.header-search').removeClass('active');
        $('.header-search .header-search-form').fadeOut();
    });

    //responsive menu
    $('.menu-toggle').on('click', function(){
        $('.site').toggleClass('toggled');
    });


    if($( "#sticky-inner-meta" ).hasClass( "entry-meta" )){
        //sticky social icons
        if($(window).width() > 640){
            var sidebar = new StickySidebar('.sticky-inner', {
                topSpacing: 20,
                bottomSpacing: 20,
                containerSelector: '.site-main',
                innerWrapperSelector: '.sidebar__inner'
            });
        }
    }

    if($(window).width() > 1024) {

        $(".main-navigation ul li a").focus(function() {
            $(this).parents("li").addClass("focus");
        }).blur(function() {
            $(this).parents("li").removeClass("focus");
        });
    }
     
});