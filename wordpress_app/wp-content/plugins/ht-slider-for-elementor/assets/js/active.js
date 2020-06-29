(function($){
"use strict";

    var WidgetHtSliderHandler = function ($scope, $) {

        var slider_elem = $scope.find('.htslider-slider').eq(0);

        if ( slider_elem.length > 0) {

            var settings = slider_elem.data('settings');
            var arrows = settings['arrows'];
            var arrow_prev_txt = settings['arrow_prev_txt'];
            var arrow_next_txt = settings['arrow_next_txt'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 300;
            var fade = settings['fade'];
            var pause_on_hover = settings['pause_on_hover'];
            var display_columns = parseInt(settings['product_items']) || 1;
            var scroll_columns = parseInt(settings['scroll_columns']) || 4;
            var tablet_width = parseInt(settings['tablet_width']) || 800;
            var tablet_display_columns = parseInt(settings['tablet_display_columns']) || 1;
            var tablet_scroll_columns = parseInt(settings['tablet_scroll_columns']) || 1;
            var mobile_width = parseInt(settings['mobile_width']) || 480;
            var mobile_display_columns = parseInt(settings['mobile_display_columns']) || 1;
            var mobile_scroll_columns = parseInt(settings['mobile_scroll_columns']) || 1;

            slider_elem.slick({
                arrows: arrows,
                prevArrow: '<button type="button" class="slick-prev">'+arrow_prev_txt+'</button>',
                nextArrow: '<button type="button" class="slick-next">'+arrow_next_txt+'</button>',
                dots: dots,
                infinite: true,
                autoplay: autoplay,
                autoplaySpeed: autoplay_speed,
                speed: animation_speed,
                fade: false,
                pauseOnHover: pause_on_hover,
                slidesToShow: display_columns,
                slidesToScroll: scroll_columns,
                responsive: [
                    {
                        breakpoint: tablet_width,
                        settings: {
                            slidesToShow: tablet_display_columns,
                            slidesToScroll: tablet_scroll_columns
                        }
                    },
                    {
                        breakpoint: mobile_width,
                        settings: {
                            slidesToShow: mobile_display_columns,
                            slidesToScroll: mobile_scroll_columns
                        }
                    }
                ]
            });
            // Slider Area Element Animation
            var $sliderArea = $('.slider-area.htslider-slider');
            if ($sliderArea.length) {
                $sliderArea.each(function () {
                    var $this = $(this),
                        $singleSlideElem = $this.find('.slick-slide .elementor-widget-wrap .elementor-element');
                    function $slideElemAnimation() {
                        $singleSlideElem.each(function () {
                            var $this = $(this),
                                $thisSetting = $this.data('settings') ? $this.data('settings') : '',
                                $animationName = $thisSetting._animation,
                                $animationDelay = $thisSetting._animation_delay;
                            $this.removeClass('animated ' + $animationName).addClass('animated fadeOut');
                            if($this.closest('.slick-slide').hasClass('slick-current')) {
                                $this.removeClass('animated fadeOut').addClass('animated ' + $animationName).css({
                                    'animation-delay': $animationDelay+'s'
                                });
                            }
                        });
                    }
                    $slideElemAnimation();
                    $this.on('afterChange', function(slick, currentSlide){
                        $slideElemAnimation();
                    });
                    $this.on('beforeChange', function(slick, currentSlide){
                        $slideElemAnimation();
                    });
                    $this.on('init', function(slick){
                        $slideElemAnimation();
                    });
                });
            }


        };
    };
    
    // Run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/htslider-slider-addons.default', WidgetHtSliderHandler);
    });

})(jQuery);