var has_process_run_at_least_once = false;
var old_transition = '';
var has_background_img_url = false;
var darken_level = parseInt(darkify_bg_image_darken_to) / 100;
darken_level = darken_level.toFixed(1);
var darkify_secondary_bg_color = '';
darkify_init_keyboard_shortcut_listener();
darkify_init_os_mode_change_listener();

const darkify_observer = new MutationObserver(function (mutations) {
  darkify_init_processes();
});

const elements_class_changed = new MutationObserver(mutations => {
  if (document.readyState !== 'loading') {
    mutations.forEach(mutation => {
      var target = mutation.target;

      if (target.classList.contains("darkify_processed")) {
        if (!target.hasAttribute("data-darkify_preserved_classes")) {
          target.dataset.darkify_preserved_classes = target.classList.toString();
        } else {
          if (target.dataset.darkify_preserved_classes === target.classList.toString()) {
            return;
          }
        }

        target.dataset.darkify_preserved_classes = target.classList.toString();
        elements_class_changed.disconnect();
        target.classList.remove("darkify_processed");
        darkify_process_element(target);

        document.querySelectorAll("*:not(head, title, link, meta, script, style, defs, filter)").forEach(function (element) {
          elements_class_changed.observe(element, {
            'attributes': true,
            'attributeFilter': ["class"]
          });
        });
      }
    });
  }
});

const dark_mode_status_changed = new MutationObserver(mutations => {
  mutations.forEach(mutation => {
    if (mutation.type === 'attributes' && mutation.attributeName === "class") {
      document.querySelectorAll("*:not(head, title, link, meta, script, style, defs, filter)").forEach(function (element) {
        if (element.classList.contains("darkify_processed")) {
          if (darkify_disallowed_elements.length > 0) {
            if (element.matches(darkify_disallowed_elements)) {
              return;
            }
          }
          if (darkify_enable_bg_image_darken === '1') {
            darkify_darken_bg_image(element, darken_level);
          }
          if (darkify_enable_low_image_brightness === '1' || darkify_enable_image_grayscale === '1') {
            if (element.nodeName.toLowerCase() === "img") {
              darkify_img_brightness_and_grayscale(element);
            }
          }
          if (darkify_enable_invert_inline_svg === '1') {
            if (element.nodeName.toLowerCase() === "svg") {
              darkify_invert_inline_svg(element);
            }
          }
          if (darkify_enable_low_video_brightness === '1' || darkify_enable_video_grayscale === '1') {
            if (element.nodeName.toLowerCase() === "video") {
              darkify_video_brightness_and_grayscale(element);
            }
            if (element.nodeName.toLowerCase() === "iframe") {
              if (element.getAttribute("src") != null) {
                const src = element.getAttribute("src");
                if (src.includes("youtube") || src.includes('vimeo') || src.includes("dailymotion")) {
                  darkify_video_brightness_and_grayscale(element);
                }
              }
            }
          }
          if (element.hasAttribute("data-darkify_alpha_bg")) {
            darkify_fix_background_color_alpha(element);
          }
        }
      });
    }
  });
});

function darkify_change_state() {
  'use strict';

  if (darkify_is_this_admin_panel === '1') {
    localStorage.darkify_admin_panel_last_state = document.getElementsByTagName('html')[0].classList.contains("darkify_dark_mode_enabled") ? '1' : '0';
  } else {
    localStorage.darkify_last_state = document.getElementsByTagName("html")[0].classList.contains("darkify_dark_mode_enabled") ? '1' : '0';
  }
}

function darkify_switch_trigger() {
  'use strict';

  if (!has_process_run_at_least_once) {
    darkify_init_processes();
    darkify_init_observer();
  }
  if (document.getElementsByTagName("html")[0].classList.contains("darkify_dark_mode_enabled")) {
    document.getElementsByTagName("html")[0].classList.remove("darkify_dark_mode_enabled");
  } else {
    document.getElementsByTagName("html")[0].classList.add("darkify_dark_mode_enabled");
  }
  darkify_change_state();
}

function darkify_init_keyboard_shortcut_listener() {
  if (darkify_enable_keyboard_shortcut === '1') {
    document.onkeydown = function (event) {
      if (event.ctrlKey && event.altKey && event.keyCode === 68) {
        darkify_switch_trigger();
      }
    };
  }
}

function darkify_init_os_mode_change_listener() {
  if (darkify_is_this_admin_panel === '0' && darkify_enable_os_aware === '1') {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener("change", event => {
      var theme = event.matches ? "dark" : "light";
      if (theme === "dark") {
        document.getElementsByTagName("html")[0].classList.add('darkify_dark_mode_enabled');
      } else if (theme === "light") {
        document.getElementsByTagName("html")[0].classList.remove('darkify_dark_mode_enabled');
      }
      darkify_change_state();
    });
  }
}

function darkify_init_alternative_dark_mode_switch() {
  if (darkify_alternative_dark_mode_switch.length > 0) {
    const elements = document.querySelectorAll(darkify_alternative_dark_mode_switch);
    for (let i = 0; i < elements.length; i++) {
      const element = elements[i];
      element.addEventListener("click", () => {
        darkify_switch_trigger();
      });
    }
  }
}

function darkify_darken_bg_image(element, darkenLevel) {
  if (document.getElementsByTagName("html")[0].classList.contains('darkify_dark_mode_enabled')) {
    if (window.getComputedStyle(element, null).backgroundImage !== "none") {
      if (window.getComputedStyle(element, null).backgroundImage.includes("url")) {
        if (!window.getComputedStyle(element, null).backgroundImage.includes(`rgba(0, 0, 0, ${darkenLevel})`)) {
          element.style.setProperty('background-image', `linear-gradient(rgba(0, 0, 0, ${darkenLevel}), rgba(0, 0, 0, ${darkenLevel})), ${window.getComputedStyle(element, null).backgroundImage}`);
        }
      }
    }
  } else if (window.getComputedStyle(element, null).backgroundImage !== "none") {
    if (window.getComputedStyle(element, null).backgroundImage.includes(`rgba(0, 0, 0, ${darkenLevel})`)) {
      element.style.setProperty('background-image', window.getComputedStyle(element, null).backgroundImage.replace(`linear-gradient(rgba(0, 0, 0, ${darkenLevel}), rgba(0, 0, 0, ${darkenLevel})), `, ''));
    }
  }
}

function darkify_img_brightness_and_grayscale(element) {
  if (document.getElementsByTagName("html")[0].classList.contains("darkify_dark_mode_enabled")) {
    if (!element.classList.contains('darkify_changed_brightness_and_grayscale')) {
      element.dataset.darkify_preserved_filter = element.style.filter;
      element.classList.add("darkify_changed_brightness_and_grayscale");
      if (darkify_enable_low_image_brightness === '1' && darkify_enable_image_grayscale === '1') {
        element.style.filter = `brightness(${darkify_image_brightness_to}%) grayscale(${darkify_image_grayscale_to}%)`;
      } else {
        if (darkify_enable_low_image_brightness === '1') {
          element.style.filter = `brightness(${darkify_image_brightness_to}%)`;
        } else if (darkify_enable_image_grayscale === '1') {
          element.style.filter = `grayscale(${darkify_image_grayscale_to}%)`;
        }
      }
    }
  } else if (element.classList.contains("darkify_changed_brightness_and_grayscale")) {
    element.style.filter = element.dataset.darkify_preserved_filter;
    element.classList.remove("darkify_changed_brightness_and_grayscale");
    delete element.dataset.darkify_preserved_filter;
  }
}

function darkify_invert_inline_svg(element) {
  if (document.getElementsByTagName('html')[0].classList.contains('darkify_dark_mode_enabled')) {
    element.style.filter = "invert(1)";
    element.classList.add("darkify_inverted_inline_svg");
  } else if (element.classList.contains("darkify_inverted_inline_svg")) {
    element.style.filter = element.style.filter.replace("invert(1)", '');
    element.classList.remove('darkify_inverted_inline_svg');
  }
}

function darkify_video_brightness_and_grayscale(element) {
  if (document.getElementsByTagName('html')[0].classList.contains("darkify_dark_mode_enabled")) {
    if (!element.classList.contains("darkify_changed_video_brightness_and_grayscale")) {
      element.dataset.darkify_preserved_filter = element.style.filter;
      element.classList.add("darkify_changed_video_brightness_and_grayscale");
      
      if (darkify_enable_low_video_brightness === '1' && darkify_enable_video_grayscale === '1') {
        element.style.filter = "brightness(" + darkify_video_brightness_to + '%)' + ' ' + "grayscale(" + darkify_video_grayscale_to + '%)';
      } else {
        if (darkify_enable_low_video_brightness === '1') {
          element.style.filter = "brightness(" + darkify_video_brightness_to + '%)';
        } else if (darkify_enable_video_grayscale === '1') {
          element.style.filter = "grayscale(" + darkify_video_grayscale_to + '%)';
        }
      }
    }
  } else if (element.classList.contains("darkify_changed_video_brightness_and_grayscale")) {
    element.style.filter = element.dataset.darkify_preserved_filter;
    element.classList.remove('darkify_changed_video_brightness_and_grayscale');
    delete element.dataset.darkify_preserved_filter;
  }
}

function darkify_fix_background_color_alpha(element) {
  if (document.getElementsByTagName("html")[0].classList.contains('darkify_dark_mode_enabled')) {
    if (element.hasAttribute("data-darkify_alpha_bg")) {
      var alphaValue = element.dataset.darkify_alpha_bg.replace("rgba(", '').replace(')', '').split(',')[3].trim();
      var computedBackgroundColor = window.getComputedStyle(element, null).backgroundColor;
      
      if (!computedBackgroundColor.includes("rgba")) {
        element.style.setProperty("background-color", computedBackgroundColor.replace(')', ', ' + alphaValue + ')').replace("rgb", "rgba"), "important");
      }
    }
  } else if (element.hasAttribute("data-darkify_alpha_bg")) {
    element.style.backgroundColor = '';
  }
}

function darkify_elements_force_to_correct(element) {
  if (document.getElementsByTagName("html")[0].classList.contains("darkify_dark_mode_enabled")) {
    if (element.hasAttribute("data-darkify_preserved_bg") && element.hasAttribute("data-darkify_preserved_color")) {
      element.style.setProperty('background-color', element.dataset.darkify_preserved_bg);
      element.style.setProperty("color", element.dataset.darkify_preserved_color);
    }
  }
}

function darkify_implement_secondary_bg() {
  var maxAreaElement = null;
  var maxArea = 0;
  var elements = document.querySelectorAll("* :not(head, title, link, meta, script, style, defs, filter)");
  
  for (var i = 0; i < elements.length; i++) {
    var currentElement = elements[i];
    
    if (currentElement.hasAttribute("data-darkify_secondary_bg_finder")) {
      var secondaryBgValue = currentElement.dataset.darkify_secondary_bg_finder;
      
      if (secondaryBgValue !== "transparent" && secondaryBgValue !== "rgba(0, 0, 0, 0)") {
        var boundingRect = currentElement.getBoundingClientRect();
        var area = boundingRect.width * boundingRect.height;
        
        if (area > maxArea) {
          maxArea = area;
          maxAreaElement = secondaryBgValue;
        }
      }
    }
  }
  
  for (var i = 0; i < elements.length; i++) {
    var currentElement = elements[i];
    
    if (currentElement.hasAttribute("data-darkify_secondary_bg_finder")) {
      if (currentElement.classList.contains("darkify_style_all") || currentElement.classList.contains('darkify_style_bg_txt') || currentElement.classList.contains("darkify_style_bg_border") || currentElement.classList.contains('darkify_style_bg')) {
        var isDifferent = maxAreaElement !== currentElement.dataset.darkify_secondary_bg_finder;
        
        if (isDifferent) {
          currentElement.classList.add("darkify_style_secondary_bg");
        }
      }
      delete currentElement.dataset.darkify_secondary_bg_finder;
    }
  }
  
  darkify_secondary_bg_color = maxAreaElement;
}

function darkify_recheck_on_css_loaded_later() {
  document.querySelectorAll(".darkify_style_txt_border, .darkify_style_txt, .darkify_style_border").forEach(function (element) {
    var computedStyles = window.getComputedStyle(element, null);
    var backgroundColor = computedStyles.backgroundColor;

    if (backgroundColor !== 'rgba(0, 0, 0, 0)' && backgroundColor !== "rgba(255, 255, 255, 0)") {
      darkify_process_element(element);
    }
  });
}

function darkify_check_preloading() {
  var shouldDarkModeBeEnabled = false;
  var lastState = localStorage.darkify_last_state ? localStorage.darkify_last_state : 'not_set';
  var adminPanelLastState = localStorage.darkify_admin_panel_last_state ? localStorage.darkify_admin_panel_last_state : 'not_set';

  if (darkify_is_this_admin_panel === '1') {
    if (adminPanelLastState === '1') {
      shouldDarkModeBeEnabled = true;
    }
  } else {
    if (lastState === '1' || lastState === '0') {
      if (lastState === '1') {
        shouldDarkModeBeEnabled = true;
      }
    } else {
      if (darkify_enable_default_dark_mode === '1') {
        shouldDarkModeBeEnabled = true;
      }

      if (darkify_enable_time_based_dark === '1') {
        var currentDate = new Date();
        var startDate = new Date();
        var stopDate = new Date();

        startDate.setHours(parseInt(darkify_time_based_dark_start.split(':')[0]));
        startDate.setMinutes(parseInt(darkify_time_based_dark_start.split(':')[1]));

        stopDate.setHours(parseInt(darkify_time_based_dark_stop.split(':')[0]));
        stopDate.setMinutes(parseInt(darkify_time_based_dark_stop.split(':')[1]));

        if (parseInt(darkify_time_based_dark_stop.split(':')[0]) >= parseInt(darkify_time_based_dark_start.split(':')[0])) {
          if (currentDate.getTime() > startDate.getTime() && currentDate.getTime() < stopDate.getTime()) {
            shouldDarkModeBeEnabled = true;
          }
        } else if (currentDate.getHours() > 12) {
          if (currentDate.getTime() > startDate.getTime() && currentDate.getTime() > stopDate.getTime()) {
            shouldDarkModeBeEnabled = true;
          }
        } else if (currentDate.getTime() < startDate.getTime() && currentDate.getTime() < stopDate.getTime()) {
          shouldDarkModeBeEnabled = true;
        }
      }
    }
  }

  if (darkify_is_this_admin_panel === '0' && darkify_enable_os_aware === '1') {
    if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
      if (lastState !== '1' && lastState !== '0') {
        shouldDarkModeBeEnabled = true;
      }
    }
  }

  return shouldDarkModeBeEnabled;
}

function darkify_process_element(element) {
  var computedStyle = window.getComputedStyle(element, null);
  var oldTransition = '';

  if (computedStyle.transition !== 'all 0s ease 0s') {
    oldTransition = computedStyle.transition;
    element.style.setProperty('transition', 'none');
  }

  if (
    element.classList.contains('darkify_style_all') ||
    element.classList.contains('darkify_style_bg_txt') ||
    element.classList.contains('darkify_style_bg_border') ||
    element.classList.contains('darkify_style_txt_border') ||
    element.classList.contains('darkify_style_bg') ||
    element.classList.contains('darkify_style_txt') ||
    element.classList.contains('darkify_style_border') ||
    element.classList.contains('darkify_style_secondary_bg')
  ) {
    element.classList.remove('darkify_style_all');
    element.classList.remove('darkify_style_bg_txt');
    element.classList.remove('darkify_style_bg_border');
    element.classList.remove('darkify_style_txt_border');
    element.classList.remove('darkify_style_bg');
    element.classList.remove('darkify_style_txt');
    element.classList.remove('darkify_style_border');
    element.classList.remove('darkify_style_secondary_bg');
  }

  var nodeName = element.nodeName.toLowerCase();
  var backgroundColor = computedStyle.backgroundColor;
  var color = computedStyle.color;
  var borderColor = computedStyle.borderColor;
  var backgroundImage = computedStyle.backgroundImage;

  if (nodeName === 'body') {
    if (backgroundColor === 'rgba(0, 0, 0, 0)' || backgroundColor === 'rgba(255, 255, 255, 0)') {
      element.style.setProperty('background-color', 'rgb(255, 255, 255)');
      backgroundColor = window.getComputedStyle(element, null).backgroundColor;
    }
  }

  if (darkify_disallowed_elements.length > 0) {
    if (element.matches(darkify_disallowed_elements)) {
      if (oldTransition !== '') {
        element.style.setProperty('transition', oldTransition);
      }
      element.classList.add('darkify_processed');
      return;
    }
  }

  var hasBackgroundImgUrl = false;

  if (backgroundImage !== 'none') {
    if (backgroundImage.includes('url')) {
      hasBackgroundImgUrl = true;
      if (darkify_enable_bg_image_darken === '1') {
        darkify_darken_bg_image(element, darken_level);
      }
    }
  }

  if (
    backgroundColor !== 'rgba(0, 0, 0, 0)' &&
    backgroundColor !== 'rgba(255, 255, 255, 0)' &&
    !element.hasAttribute('data-darkify_secondary_bg_finder') &&
    !hasBackgroundImgUrl
  ) {
    element.dataset.darkify_secondary_bg_finder = backgroundColor;

    if (darkify_secondary_bg_color !== '') {
      var isSecondaryBgColorDifferent = darkify_secondary_bg_color !== element.dataset.darkify_secondary_bg_finder;

      if (isSecondaryBgColorDifferent) {
        element.classList.add('darkify_style_secondary_bg');
      }

      delete element.dataset.darkify_secondary_bg_finder;
    }
  }

  if (
    backgroundColor !== 'rgba(0, 0, 0, 0)' &&
    color !== 'rgba(0, 0, 0, 0)' &&
    borderColor !== 'rgba(0, 0, 0, 0)' &&
    backgroundColor !== 'rgba(255, 255, 255, 0)' &&
    color !== 'rgba(255, 255, 255, 0)' &&
    borderColor !== 'rgba(255, 255, 255, 0)' &&
    !hasBackgroundImgUrl
  ) {
    element.classList.add('darkify_style_all');
  } else {
    if (
      backgroundColor !== 'rgba(0, 0, 0, 0)' &&
      color !== 'rgba(0, 0, 0, 0)' &&
      backgroundColor !== 'rgba(255, 255, 255, 0)' &&
      color !== 'rgba(255, 255, 255, 0)' &&
      !hasBackgroundImgUrl
    ) {
      element.classList.add('darkify_style_bg_txt');
    } else {
      if (
        backgroundColor !== 'rgba(0, 0, 0, 0)' &&
        borderColor !== 'rgba(0, 0, 0, 0)' &&
        backgroundColor !== 'rgba(255, 255, 255, 0)' &&
        borderColor !== 'rgba(255, 255, 255, 0)' &&
        !hasBackgroundImgUrl
      ) {
        element.classList.add('darkify_style_bg_border');
      } else {
        if (
          color !== 'rgba(0, 0, 0, 0)' &&
          borderColor !== 'rgba(0, 0, 0, 0)' &&
          color !== 'rgba(255, 255, 255, 0)' &&
          borderColor !== 'rgba(255, 255, 255, 0)'
        ) {
          element.classList.add('darkify_style_txt_border');
        } else {
          if (
            backgroundColor !== 'rgba(0, 0, 0, 0)' &&
            backgroundColor !== 'rgba(255, 255, 255, 0)' &&
            !hasBackgroundImgUrl
          ) {
            element.classList.add('darkify_style_bg');
          } else {
            if (color !== 'rgba(0, 0, 0, 0)' && color !== 'rgba(255, 255, 255, 0)') {
              element.classList.add('darkify_style_txt');
            } else if (borderColor !== 'rgba(0, 0, 0, 0)' && borderColor !== 'rgba(255, 255, 255, 0)') {
              element.classList.add('darkify_style_border');
            }
          }
        }
      }
    }
  }

  if (backgroundImage !== 'none') {
    if (!hasBackgroundImgUrl) {
      if (
        !element.classList.contains('darkify_style_all') &&
        !element.classList.contains('darkify_style_bg_txt') &&
        !element.classList.contains('darkify_style_bg_border') &&
        !element.classList.contains('darkify_style_bg')
      ) {
        element.classList.add('darkify_style_bg');
      }
    }
  }

  if (nodeName === 'a') {
    element.classList.add('darkify_style_link');
  }

  if (nodeName === 'input' || nodeName === 'select' || nodeName === 'textarea') {
    element.classList.add('darkify_style_form_element');
  }

  if (nodeName === 'button') {
    element.classList.add('darkify_style_button');
  }

  if (
    darkify_enable_low_image_brightness === '1' ||
    darkify_enable_image_grayscale === '1'
  ) {
    if (nodeName === 'img') {
      darkify_img_brightness_and_grayscale(element);
    }
  }

  if (darkify_enable_invert_inline_svg === '1') {
    if (nodeName === 'svg') {
      darkify_invert_inline_svg(element);
    }
  }

  if (
    darkify_enable_low_video_brightness === '1' ||
    darkify_enable_video_grayscale === '1'
  ) {
    if (nodeName === 'video') {
      darkify_video_brightness_and_grayscale(element);
    }

    if (nodeName === 'iframe') {
      if (element.getAttribute('src') !== null) {
        const iframeSrc = element.getAttribute('src');
        if (iframeSrc.includes('youtube') || iframeSrc.includes('vimeo') || iframeSrc.includes('dailymotion')) {
          darkify_video_brightness_and_grayscale(element);
        }
      }
    }
  }

  if (backgroundColor.includes('rgba')) {
    element.dataset.darkify_alpha_bg = backgroundColor;
    darkify_fix_background_color_alpha(element);
  }

  if (oldTransition !== '') {
    setTimeout(function () {
      element.style.setProperty('transition', oldTransition);
    }, 0);
  }

  setTimeout(function () {
    elements_class_changed.observe(element, {
      'attributes': true,
      'attributeFilter': ['class']
    });
  }, 0);

  element.classList.add('darkify_processed');
}

function darkify_init_processes() {
  has_process_run_at_least_once = true;
  document.querySelectorAll("* :not(head, title, link, meta, script, style, defs, filter, .darkify_processed)").forEach(function (_0x389d7f) {
    darkify_process_element(_0x389d7f);
  });
}
function darkify_init_observer() {
  darkify_observer.observe(document, {
    'attributes': false,
    'childList': true,
    'characterData': false,
    'subtree': true
  });
  dark_mode_status_changed.observe(document.getElementsByTagName("html")[0x0], {
    'attributes': true
  });
  if (document.readyState !== "loading") {
    if (!has_process_run_at_least_once) {
      darkify_init_processes();
    }
    darkify_implement_secondary_bg();
    darkify_recheck_on_css_loaded_later();
  } else {
    document.addEventListener('DOMContentLoaded', function () {
      if (!has_process_run_at_least_once) {
        darkify_init_processes();
      }
      darkify_implement_secondary_bg();
      darkify_recheck_on_css_loaded_later();
    });
  }
}
if (darkify_check_preloading()) {
  document.getElementsByTagName("html")[0x0].classList.add('darkify_dark_mode_enabled');
  darkify_init_observer();
}

function darkify_init_processes() {
  has_process_run_at_least_once = true;
  document.querySelectorAll("*:not(head, title, link, meta, script, style, defs, filter, .darkify_processed)").forEach(function (element) {
    darkify_process_element(element);
  });
}

function darkify_init_observer() {
  darkify_observer.observe(document, {
    'attributes': false,
    'childList': true,
    'characterData': false,
    'subtree': true
  });
  
  dark_mode_status_changed.observe(document.getElementsByTagName("html")[0], {
    'attributes': true
  });

  if (document.readyState !== "loading") {
    if (!has_process_run_at_least_once) {
      darkify_init_processes();
    }
    darkify_implement_secondary_bg();
    darkify_recheck_on_css_loaded_later();
  } else {
    document.addEventListener('DOMContentLoaded', function () {
      if (!has_process_run_at_least_once) {
        darkify_init_processes();
      }
      darkify_implement_secondary_bg();
      darkify_recheck_on_css_loaded_later();
    });
  }
}

if (darkify_check_preloading()) {
  document.getElementsByTagName("html")[0].classList.add('darkify_dark_mode_enabled');
  darkify_init_observer();
}
