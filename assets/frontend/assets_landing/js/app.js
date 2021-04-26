! function($) {
    "use strict";

    var Covid = function() {};

    Covid.prototype.initStickyMenu = function() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
        
            if (scroll >= 50) {
                $(".sticky").addClass("nav-sticky");
            } else {
                $(".sticky").removeClass("nav-sticky");
            }
        });
    },

    Covid.prototype.initSmoothLink = function() {
        $('.navbar-nav a').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 50
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    },

    Covid.prototype.initBacktoTop = function() {
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        }); 
        $('.back-to-top').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
            return false;
        });
    },

    Covid.prototype.initScrollspy = function() {
        $("#navbarCollapse").scrollspy({
            offset: 50
        });
    },

    Covid.prototype.initContact = function() {
        
        $('#contact-form').submit(function() {

            var action = $(this).attr('action');
        
            $("#message").slideUp(750, function() {
                $('#message').hide();
        
                $('#submit')
                    .before('')
                    .attr('disabled', 'disabled');
        
                $.post(action, {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        comments: $('#comments').val(),
                    },
                    function(data) {
                        document.getElementById('message').innerHTML = data;
                        $('#message').slideDown('slow');
                        $('#cform img.contact-loader').fadeOut('slow', function() {
                            $(this).remove()
                        });
                        $('#submit').removeAttr('disabled');
                        if (data.match('success') != null) $('#cform').slideUp('slow');
                    }
                );
        
            });
        
            return false;
        
        });
    },

    Covid.prototype.init = function() {
        this.initStickyMenu();
        this.initSmoothLink();
        this.initScrollspy();
        this.initContact();
        this.initBacktoTop();
    },
    //init
    $.Covid = new Covid, $.Covid.Constructor = Covid
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Covid.init();
}(window.jQuery);