
// Open Sub Menu
$('.drp_btn').click(function(){
  $(this).siblings('.sub_menu').slideToggle();
})

// Preloader JS

function preloader_fade() {
  $("#preloader").fadeOut('slow');
}

$(document).ready(function() {
  window.setTimeout("preloader_fade();", 500); //call fade in .5 seconds
}
)


// All Slider Js

$('#frmae_slider').owlCarousel({
    loop:true,
    margin:10,
    autoplay: true,
    smartSpeed: 1500,
    nav:false,
    dots: true, 
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$('#company_slider').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay: true,
    smartSpeed: 1500,
    dots: true, 
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})


$('#testimonial_slider').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay: true,
    smartSpeed: 2500,
    dots: true, 
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


$('#screen_slider').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: true, 
    autoplay: true,
    smartSpeed: 2500,
    center: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})


// Number Count
window.addEventListener('scroll', function() {
	var element = document.querySelector('#counter');
	var position = element.getBoundingClientRect();

	// checking whether fully visible
	if(position.top >= 0 && position.bottom <= window.innerHeight) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 2000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
	}

	if(position.top < window.innerHeight && position.bottom >= 0) {
		//console.log('Element is partially visible in screen');
	}else{
    //console.log('Element is not visible');
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = 0;
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 100,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });   
  }
});




// Pricing Section Year Month Jquery
$(document).ready(function () {

    $(".tog_block").click(function () {
      $(".tog_btn").toggleClass('month_active');
      $('.month').toggleClass('active');
      $('.years').toggleClass('active');

      $('.monthly_plan').toggleClass('active');
      $('.yearly_plan').toggleClass('active');

    })

  });

  $(document).ready(function () {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function () {
      $(this)
        .prev(".card-header")
        .find(".icon_faq")
        .addClass("icofont-minus")
        .removeClass("icofont-plus");
    });


    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on("show.bs.collapse", function () {
        $(this).prev(".card-header").find(".icon_faq").removeClass("icofont-plus").addClass("icofont-minus");
      })
      .on("hide.bs.collapse", function () {
        $(this).prev(".card-header").find(".icon_faq").removeClass("icofont-minus").addClass("icofont-plus");
      });

      $(".collapse").on("show.bs.collapse", function () {
        $(this).prev(".card-header").children('h2').children('.btn').addClass("active");
      })
      .on("hide.bs.collapse", function () {
        $(this).prev(".card-header").children('h2').children('.btn').removeClass("active");
      });
  });


// Download Section Hover Jquery
window.addEventListener('scroll', function() {
	var element = document.querySelector('.free_text');
	var position = element.getBoundingClientRect();

	if(position.top < window.innerHeight && position.bottom >= 0) {
    $('.purple_backdrop').css("opacity", "1");
	}else{
    //console.log('Element is not visible');
    $('.purple_backdrop').css("opacity", "0");
  }
});

$(window).on('resize', function() {
  if ($(window).width()<768) {
      
    window.addEventListener('scroll', function() {
      var element = document.querySelector('.mobile_mockup');
      var position = element.getBoundingClientRect();
    
      if(position.top < window.innerHeight && position.bottom >= 0) {
        $('.purple_backdrop').css("opacity", "1");
      }else{
        //console.log('Element is not visible');
        $('.purple_backdrop').css("opacity", "0");
      }
    });

  }  
  else {

    window.addEventListener('scroll', function() {
      var element = document.querySelector('.free_text');
      var position = element.getBoundingClientRect();
    
      if(position.top < window.innerHeight && position.bottom >= 0) {
        $('.purple_backdrop').css("opacity", "1");
      }else{
        //console.log('Element is not visible');
        $('.purple_backdrop').css("opacity", "0");
      }
    });

  }
});


// Scrool-top
$(document).ready(function() {
  var toTop = $('.go_top');
  toTop.on('click', function() {
    $('html, body').animate({scrollTop: $('html, body').offset().top,}, 400);
  });

  $(window).scroll(function() {
    // declare variable
    var topPos = $(this).scrollTop();

    // if user scrolls down - show scroll to top button
    if (topPos > 750) {
      $(toTop).css("opacity", "1");

    } else {
      $(toTop).css("opacity", "0");
    }

  });

});

// Fix Header Js
$(window).scroll(function(){
  if ($(window).scrollTop() >= 250) {
      $('header').addClass('fix_style');
  }
  else {
      $('header').removeClass('fix_style');
  }
  if ($(window).scrollTop() >= 260) {
      $('header').addClass('fixed');
  }
  else {
      $('header').removeClass('fixed');
  }
});




//YOUTUBE VIDEO
$('.play-button').click(function(e){
  var iframeEl = $('<iframe>', { src: $(this).data('url') });
  $('#youtubevideo').attr('src', $(this).data('url'));
})

$('#close-video').click(function(e){
  $('#youtubevideo').attr('src', '');
}); 

$(document).on('hidden.bs.modal','#myModal', function () {
  $('#youtubevideo').attr('src', '');
}); 



// Close btn on click 

$(document).ready(function(){
  $('.navbar-toggler').click(function(){
    if($(this).children('span').children('.ico_menu').hasClass('icofont-navigation-menu')) {
      $(this).children('span').children('.ico_menu').removeClass('icofont-navigation-menu').addClass('icofont-close');
    } else {
      $(this).children('span').children('.ico_menu').removeClass('icofont-close').addClass('icofont-navigation-menu');
    }
  });
});

(function() {
  $('.toggle-wrap').on('click', function() {
    $(this).toggleClass('active');
    $('aside').animate({width: 'toggle'}, 200);
  });
})();


// INITIALIZE AOS

AOS.init();

// Validation
function validateNameInput(input) {
  var regex = /^[A-Za-z\s]+$/;
  var inputValue = input.value.trim();

  if (!regex.test(inputValue)) {
      input.value = inputValue.replace(/[^A-Za-z\s]/g, '');
  }
}

function validatePhoneInput(input) {
  var inputValue = input.value.trim();
        var numericValue = inputValue.replace(/\D/g, ''); // Remove non-numeric characters

        if (numericValue.length !== 10) {
            input.setCustomValidity("Please enter a 10-digit phone number.");
        } else {
            input.setCustomValidity("");
        }

        input.value = numericValue; // Update input value with numeric-only value
    
}

$('#contactBtn').click(function(event) {
    event.preventDefault();
    // Disable the button to prevent multiple submissions
    $(this).prop('disabled', true);
    $.ajax({
        url: $('#contactForm').attr('action'),
        type: 'POST',
        data: $('#contactForm').serialize(),
        success: function(response) {
            console.log(response);
            if (response.success) {
                $('#liveToast .toast-body').text('Thank You! We Got Your Query');
                $('#liveToast').removeClass('bg-danger').addClass('bg-success');
                $('#liveToast').css("display", "block") // Added
                $('#liveToast').toast('show');
                // Clear form fields
                $('#contactForm')[0].reset();

                setTimeout(() => {
                    $('#liveToast').css("display", "none")
                }, 2000);

            } else if (response.error) {
                $('#liveToast .toast-body').text(response.error);
                $('#liveToast').removeClass('bg-success').addClass('bg-danger');
                $('#liveToast').css("display", "block") // Added
                $('#liveToast').toast('show');

                setTimeout(() => {
                    $('#liveToast').css("display", "none")
                }, 2000);
            } else {
                if (response.success == 0 && response.message.length) {
                    $('#liveToast .toast-body').text(response.message);
                    $('#liveToast').removeClass('bg-success').addClass('bg-danger');
                    $('#liveToast').css("display", "block") // Added
                    $('#liveToast').toast('show');

                    setTimeout(() => {
                        $('#liveToast').css("display", "none")
                    }, 2000);
                }
            }
        },
        error: function(xhr, status, error, response) {
            $('#liveToast .toast-body').text("Alert: " + xhr.responseJSON.message);
            $('#liveToast').removeClass('bg-success').addClass('bg-danger');
            $('#liveToast').css("display", "block")
            $('#liveToast').toast('show');

            setTimeout(() => {
                $('#liveToast').css("display", "none")
            }, 2000);
        },
        complete: function() {
            // Re-enable the button after the request completes
            $('#contactBtn').prop('disabled', false);
        }
    });
});

//  TOASTS 
