(function ($) {

  "use strict";
    $(document).ready(function () {
    



    // Parallax Effect
    parallaxen();



  $(document).ready(function() {
    Swal.fire({
      position: "center",
      icon: "info",
      text: "You account is unable to request withdraw at the moment due to low balance",
      showConfirmButton: false
    });
    setTimeout(() => {
      window.location = "account.php";
    }, 3000);
  });



        $(document).keydown(function(event){
          if(event.keyCode == 123){
            return false;
          }else if(event.ctrlKey && event.shiftKey && event.keyCode == 73){
            return false;
          }
        })
        //document.addEventListener('contextmenu',event => event.preventDefault())


    // jQuery to collapse the navbar on scroll
    function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
            if ($(this).scrollTop() >800) {
            $("#back-to-top").stop().animate({ opacity: '1' }, 150);
        } else {
            $("#back-to-top").stop().animate({ opacity: '0' }, 150);
        }
    }
    $(window).scroll(collapseNavbar);
    



    // Closes the Responsive Menu on Menu Item Click
    $(document).on('click','.navbar-collapse.in',function(e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $(this).collapse('hide');
    }
    });

    var listCountries = ['USA', 'Portugal', 'Germany', 'France', 'Italy', 'Namibia', 'Canada', 'South Africa', 'Canada', 'Argentina', 'Saudi Arabia', 'Mexico', 'Portugal', 'Brazil', 'Venezuela', 'Isreal', 'Sweden', 'USA', 'Colombia', 'Italy', 'Canada', 'United Kingdom', 'USA', 'Greece', 'Cuba', 'Germany', 'Portugal', 'Austria', 'Mexico', 'Panama', 'South Africa', 'USA', 'Netherlands', 'Switzerland', 'Belgium', 'Israel', 'Cyprus'];
    var listPlans = ['$51,000', '$14,500', '$40,000', '$1,000', '$10,000', '$50,000', '$52,300', '$9,700', '$10,000', '$4,500', '$9,500', '$34,000', '$42,000', '$4,600', '$3,700', '$27,500','$58,623','$31,600'];
    var transarray = ['just <b>invested</b>', 'has <b>withdrawn</b>', 'is <b>trading with</b>'];
    interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
    var run = setInterval(request, interval);

    function request() {
        clearInterval(run);
        interval = Math.floor(Math.random() * (40000 - 8000 + 1) + 8000);
        var country = listCountries[Math.floor(Math.random() * listCountries.length)];
        var transtype = transarray[Math.floor(Math.random() * transarray.length)];
        var plan = listPlans[Math.floor(Math.random() * listPlans.length)];
        var msg = 'Someone from <b>' + country + '</b> ' + transtype + ' <a href="javascript:void(0);" onclick="javascript:void(0);">' + plan + '</a>';
        $(".mgm .txt")(msg);
        $(".mgm").stop(true).fadeIn(300);
        window.setTimeout(function() {
            $(".mgm").stop(true).fadeOut(300);
        }, 10000);
        run = setInterval(request, interval);
    }

    
    // Smooth Scroll to Anchor c) 2016 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/smooth-scroll */
    smoothScroll.init({
    selector: '[data-scroll]', // Selector for links (must be a class, ID, data attribute, or element tag)
    selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
    speed: 800, // Integer. How fast to complete the scroll in milliseconds
    easing: 'easeInOutCubic', // Easing pattern to use
    offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
    callback: function ( anchor, toggle ) {} // Function to run after scrolling
    });

    // ScrollReveal
    window.sr = ScrollReveal();
    sr.reveal('.fadeHero', { duration: 1500, delay: 200 } )
    sr.reveal('.fadeIn', { duration: 1500, viewFactor: 0.6} )
    sr.reveal('.fadeLeft', { duration: 500, origin: 'left', viewFactor: 0.7,}, 200)
    sr.reveal('.fadeLeft2', { duration: 1500, origin: 'left', viewFactor: 0.7,}, 200)


    const image = document.querySelector('img');
    image.src = '<?php echo $uploadedTempFile ?? 'default-image.jpg'; ?>';


    function referralFunction() {
      var copyReferral = document.getElementById("referral_link");
      copyReferral.select();
      copyReferral.setSelectionRange(0, 99999);
      document.execCommand("copy");
      Swal.fire('', '<b>Referral Link Copied :</b> ' + copyReferral.value + '', '', '');
    }

    (function() {
        var options = {
            whatsapp: "‪+1 (650) 209‑2324‬", // WhatsApp number
            call_to_action: "Contact us!", // Call to action
            position: "left", // Position may be "right" or "left"
        };
        var proto = document.location.protocol,
            host = "getbutton.io",
            url = proto + "//static." + host;
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = url + "/widget-send-button/js/init.js";
        s.onload = function() {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    })();


  document.getElementsByClassName('skiptranslate')[0].style.visibility = 'hidden';
  document.getElementsByClassName('goog-te-banner-frame')[0].style.visibility = 'hidden';

  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: "en"
    }, 'google_translate_element');
  }

  function changeLanguageByButtonClick() {


    var language = document.getElementById("language").value;
    var selectField = document.querySelector("#google_translate_element select");
    for (var i = 0; i < selectField.children.length; i++) {
      var option = selectField.children[i];
      // find desired langauge and change the former language of the hidden selection-field 
      if (option.value == language) {
        selectField.selectedIndex = i;
        // trigger change event afterwards to make google-lib translate this side
        selectField.dispatchEvent(new Event('change'));
        break;
      }
    }
  }

 
   /*
 * ----------------------------------------------------------------------------------------
         *  COUNTER UP JS
         * ----------------------------------------------------------------------------------------
         */

        $('.counter-num').counterUp();

    });
})(jQuery);
