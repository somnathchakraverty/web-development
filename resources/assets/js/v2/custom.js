$(document).ready(function() {
    
        
    // search result
    // $('.check-boxes').css('display', 'none');
    // $('.filter-box h4').append('<i class="fa fa-plus-circle"></i>');
    // $('.filter-box h4').addClass('check-active');
    // $('.filter-box h4').click(function() {
    //   $('.filter-box').children('.check-boxes').hide();
    //   $('.filter-box').find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');  
    //   $(this).parent('.filter-box').children('.check-boxes').show();
    //    $(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');

       //$(this).parent('div').parent('.filter-box').find('.check-boxes').slideToggle();
       //$('.filter-box').siblings('.check-boxes').hide();

        $('.filter-box h4').click(function() {        
            // demo start
            $(this).parent('div').parent('.filter-box').parent('.relative-div').addClass('parent-height').siblings().removeClass('parent-height');
            var divHeight = ($(this).parents('.filter-box').find('.check-boxes').height()*1 + $('.heading-h4').height()*1);
            $('.parent-height').css('height', 'auto');
            // $('.parent-height').css('height', divHeight+'px');
            // demo end

            $('.filter-box').children('.check-boxes').stop().slideUp();
            $('.filter-box h4').removeClass('current-filter');
            $(this).addClass('current-filter').siblings().removeClass('current-filter');
            //$(this).toggleClass('current-filter');
             if (!$(this).parents('.filter-box').find('.check-boxes').is(':hidden')) {
                $(this).removeClass('current-filter');
             }

            $(this).parent('div').parent('.filter-box').children('.check-boxes').stop().slideToggle();

       });
    });



// labs page tab
 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
        
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();        
        
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

      $(".tab_drawer_heading").removeClass("d_active");
      $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
      
    /*$(".tabs").css("margin-top", function(){ 
       return ($(".tab_container").outerHeight() - $(".tabs").outerHeight() ) / 2;
    });*/
    });
    $(".tab_container").css("min-height", function(){ 
      return $(".tabs").outerHeight() + 50;
    });
    /* if in drawer mode */
    $(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
      
      $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
      
      $("ul.tabs li").removeClass("active");
      $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
    
    
    /* Extra class "tab_last" 
       to add border to bottom side
       of last tab 
    $('ul.tabs li').last().addClass("tab_last");*/

// labs page tab end
    
    $(".slidingDiv").addClass("show_hide");
     $(".fixed-bar").click(function(){
        $(".slidingDiv").animate({
          width: "toggle"
        });
      });
     
    $('[data-toggle="tooltip"]').tooltip(); 
    
    $("#owl-demo1").owlCarousel({
         
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 1,
          itemsDesktop : [1199,1],
          itemsDesktopSmall : [979,1],
          itemsMobile : [767,1],
          pagination:true
     
      });

    $("#teams-slider1").owlCarousel({
        navigation : true,
        pagination : false,
        items : 3,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,2],
        itemsMobile : [360,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

    $("#teams-slider2").owlCarousel({
        navigation : true,
        pagination : false,
        items : 3,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

     $("#blog-inner").owlCarousel({
        navigation : true,
        pagination : false,
        items : 3,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

    // $("#teams-slider3").owlCarousel({
    //     navigation : true,
    //     pagination : false,
    //     items : 3,
    //     infinite: true,
    //     itemsDesktop:[1199,3],
    //     itemsDesktopSmall:[980,2],
    //     itemsMobile : [600,1],
    //     autoPlay:true,
    //     loop:1,
    //     navigationText : ["",""]
    // });

    $("#teams-slider4").owlCarousel({
        navigation : true,
        pagination : false,
        items : 4,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

    // $("#teams-slider5").owlCarousel({
    //     navigation : true,
    //     pagination : false,
    //     items : 3,
    //     infinite: true,
    //     itemsDesktop:[1199,3],
    //     itemsDesktopSmall:[980,2],
    //     itemsMobile : [600,1],
    //     autoPlay:true,
    //     loop:1,
    //     navigationText : ["",""]
    // });

    // $("#recomendation").owlCarousel({
    //     navigation : true,
    //     pagination : false,
    //     items : 3,
    //     infinite: true,
    //     itemsDesktop:[1199,3],
    //     itemsDesktopSmall:[980,2],
    //     itemsMobile : [600,1],
    //     autoPlay:true,
    //     loop:1,
    //     navigationText : ["",""]
    // });

 

    $("#special-offer").owlCarousel({
        navigation : true,
        pagination : false,
        items : 4,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

    $("#time-slider").owlCarousel({
        navigation : true,
        pagination : false,
        items : 8,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:true,
        navigationText : ["",""]
    });

    $("#profile-slider").owlCarousel({
        navigation : true,
        pagination : true,
        items : 6,
        infinite: true,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:true,
        navigationText : ["",""]
    });

    $("#inner-banner").owlCarousel({
        navigation : true,
        pagination : false,
        items : 2,
        infinite: true,
        itemsDesktop:[1199,2],
        itemsDesktopSmall:[980,1],
        itemsMobile : [600,1],
        autoPlay:true,
        loop:1,
        navigationText : ["",""]
    });

    
$('.investor-cont h2+div').matchHeight({ 
         byRow: 0
    });
  $('.about-icon').matchHeight({ 
         byRow: 0
    });
    $('.book-div').matchHeight({ 
         byRow: 0
    });
    $('.carer-group').matchHeight({ 
         byRow: 0
    }); 
    
// });

    // ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 300) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

 

function copy(element_id){
var aux = document.createElement("div");
aux.setAttribute("contentEditable", true);
aux.innerHTML = document.getElementById(element_id).innerHTML;
aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
document.body.appendChild(aux);
aux.focus();
document.execCommand("copy");
document.body.removeChild(aux);
}
    
    

$('ul.nav li.dropdown').hover(function() {
$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
 // for multipal select and search
    //$('select').selectpicker();
});

//Filter Dropdown

    $(".drop-filter").hover(function(){
    $(".drop-filter-show").show();
    $(".drop-filter-show1").hide();
    // $(".drop-filter").addClass("arrow")
    // $(".drop-filter1").removeClass("arrow")
});

    $(".close-filter").click(function(){
        $(".drop-filter-show").hide();
        $(".drop-filter-show1").hide();
        // $(".drop-filter").removeClass("arrow")
        // $(".drop-filter1").removeClass("arrow")

    });

    $(".drop-filter1").hover(function(){
    $(".drop-filter-show1").show();
    $(".drop-filter-show").hide();
    // $(".drop-filter1").addClass("arrow")
    // $(".drop-filter").removeClass("arrow")
});
 $(".search-section").hover(function(){
    $(".drop-filter-show1").hide();
    $(".drop-filter-show").hide();
    // $(".drop-filter1").addClass("arrow")
    // $(".drop-filter").removeClass("arrow")
});
//load more

$(".moreBox").slice(0, 1).show();
        if ($(".more-result:hidden").length != 0) {
            $("#loadMore").show();
        }       
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".moreBox:hidden").slice(0, 6).slideDown();
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });


// masanary
$(document).ready(function() {
$('#pinBoot').pinterest_grid({
no_columns: 3,
padding_x: 10,
padding_y: 10,
margin_bottom: 50,
single_column_breakpoint: 700
});
});

;(function ($, window, document, undefined) {
    var pluginName = 'pinterest_grid',
        defaults = {
            padding_x: 10,
            padding_y: 10,
            no_columns: 3,
            margin_bottom: 50,
            single_column_breakpoint: 700
        },
        columns,
        $article,
        article_width;

    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options) ;
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype.init = function () {
        var self = this,
            resize_finish;

        $(window).resize(function() {
            clearTimeout(resize_finish);
            resize_finish = setTimeout( function () {
                self.make_layout_change(self);
            }, 11);
        });

        self.make_layout_change(self);

        setTimeout(function() {
            $(window).resize();
        }, 500);
    };

    Plugin.prototype.calculate = function (single_column_mode) {
        var self = this,
            tallest = 0,
            row = 0,
            $container = $(this.element),
            container_width = $container.width();
            $article = $(this.element).children();

        if(single_column_mode === true) {
            article_width = $container.width() - self.options.padding_x;
        } else {
            article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
        }

        $article.each(function() {
            $(this).css('width', article_width);
        });

        columns = self.options.no_columns;

        $article.each(function(index) {
            var current_column,
                left_out = 0,
                top = 0,
                $this = $(this),
                prevAll = $this.prevAll(),
                tallest = 0;

            if(single_column_mode === false) {
                current_column = (index % columns);
            } else {
                current_column = 0;
            }

            for(var t = 0; t < columns; t++) {
                $this.removeClass('c'+t);
            }

            if(index % columns === 0) {
                row++;
            }

            $this.addClass('c' + current_column);
            $this.addClass('r' + row);

            prevAll.each(function(index) {
                if($(this).hasClass('c' + current_column)) {
                    top += $(this).outerHeight() + self.options.padding_y;
                }
            });

            if(single_column_mode === true) {
                left_out = 0;
            } else {
                left_out = (index % columns) * (article_width + self.options.padding_x);
            }

            $this.css({
                'left': left_out,
                'top' : top
            });
        });

        this.tallest($container);
        $(window).resize();
    };

    Plugin.prototype.tallest = function (_container) {
        var column_heights = [],
            largest = 0;

        for(var z = 0; z < columns; z++) {
            var temp_height = 0;
            _container.find('.c'+z).each(function() {
                temp_height += $(this).outerHeight();
            });
            column_heights[z] = temp_height;
        }

        largest = Math.max.apply(Math, column_heights);
        _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
    };

    Plugin.prototype.make_layout_change = function (_self) {
        if($(window).width() < _self.options.single_column_breakpoint) {
            _self.calculate(true);
        } else {
            _self.calculate(false);
        }
    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new Plugin(this, options));
            }
        });
    }

})(jQuery, window, document);

