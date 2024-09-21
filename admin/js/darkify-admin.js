(function ($) {
    "use strict";
    $(document).on("click", "#switcher_shortcode_copy", function (e) {
      e.preventDefault();
      /* Get the text field */
      $(this).siblings("#switcher_shortcode").select();
      /* Select the text field */
      document.execCommand("copy");
      $(".switcher_shortcode_after_copy").animate(
        {
        opacity: 1,
        bottom: 25,
        },
        300
      );
      setTimeout(function () {
        jQuery(".switcher_shortcode_after_copy").animate(
        {
          opacity: 0,
        },
        200
        );
        jQuery(".switcher_shortcode_after_copy").animate(
        {
          bottom: 0,
        },
        0
        );
      }, 2000);
      });
  
  })(jQuery);