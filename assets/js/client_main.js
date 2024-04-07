"use strict";

var darkify_switch_unique_id = darkify_data.darkify_switch_unique_id;
var darkify_is_this_admin_panel = darkify_data.darkify_is_this_admin_panel;
var darkify_enable_default_dark_mode =
  darkify_data.darkify_enable_default_dark_mode;
var darkify_enable_os_aware = darkify_data.darkify_enable_os_aware;
var darkify_enable_keyboard_shortcut =
  darkify_data.darkify_enable_keyboard_shortcut;
var darkify_enable_time_based_dark =
  darkify_data.darkify_enable_time_based_dark;
var darkify_time_based_dark_start = darkify_data.darkify_time_based_dark_start;
var darkify_time_based_dark_stop = darkify_data.darkify_time_based_dark_stop;
var darkify_alternative_dark_mode_switch =
  darkify_data.darkify_alternative_dark_mode_switch;
var darkify_enable_low_image_brightness =
  darkify_data.darkify_enable_low_image_brightness;
var darkify_image_brightness_to = darkify_data.darkify_image_brightness_to;
var darkify_enable_image_grayscale =
  darkify_data.darkify_enable_image_grayscale;
var darkify_image_grayscale_to = darkify_data.darkify_image_grayscale_to;
var darkify_disallowed_grayscale_images =
  darkify_data.darkify_disallowed_grayscale_images;
var darkify_enable_bg_image_darken =
  darkify_data.darkify_enable_bg_image_darken;
var darkify_bg_image_darken_to = darkify_data.darkify_bg_image_darken_to;
var darkify_enable_invert_inline_svg =
  darkify_data.darkify_enable_invert_inline_svg;
var darkify_enable_low_video_brightness =
  darkify_data.darkify_enable_low_video_brightness;
var darkify_video_brightness_to = darkify_data.darkify_video_brightness_to;
var darkify_enable_video_grayscale =
  darkify_data.darkify_enable_video_grayscale;

let has_process_run_at_least_once = false;
let old_transition = "";
let has_background_img_url = false;

const darkify_disallowed_grayscale_images_arr =
  darkify_disallowed_grayscale_images.trim().length > 0
    ? darkify_disallowed_grayscale_images.split(",")
    : [];

let darken_level = parseInt(darkify_bg_image_darken_to) / 100;
darken_level = darken_level.toFixed(1);

let darkify_secondary_bg_color = "";



darkify_init_keyboard_shortcut_listener();
darkify_init_os_mode_change_listener();

const darkify_observer = new MutationObserver(function (mutationsList) {
  darkify_init_processes();
});

const elements_class_changed = new MutationObserver((mutationsList) => {
  if (document.readyState !== "loading") {
    mutationsList.forEach((mutation) => {
      const target = mutation.target;

      if (target.classList.contains("darkifycessed")) {
        if (!target.hasAttribute("data-darkify_preserved_classes")) {
          target.dataset.darkify_preserved_classes =
            target.classList.toString();
        } else {
          if (
            target.dataset.darkify_preserved_classes ===
            target.classList.toString()
          ) {
            return;
          }
        }

        target.dataset.darkify_preserved_classes = target.classList.toString();
        elements_class_changed.disconnect();
        target.classList.remove("darkifycessed");
        darkifycess_element(target);

        document
          .querySelectorAll(
            "*:not(head, title, link, meta, script, style, defs, filter)"
          )
          .forEach((element) => {
            elements_class_changed.observe(element, {
              attributes: true,
              attributeFilter: ["class"],
            });
          });
      }
    });
  }
});

const dark_mode_status_changed = new MutationObserver((mutationsList) => {
  mutationsList.forEach((mutation) => {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      document
        .querySelectorAll(
          "*:not(head, title, link, meta, script, style, defs, filter)"
        )
        .forEach((element) => {
          if (element.classList.contains("darkifycessed")) {
            if (darkify_enable_bg_image_darken === "1") {
              darkify_darken_bg_image(element, darken_level);
            }
            if (
              (darkify_enable_low_image_brightness === "1" ||
                darkify_enable_image_grayscale === "1") &&
              element.nodeName.toLowerCase() === "img"
            ) {
              darkify_img_brightness_and_grayscale(element);
            }

            if (
              darkify_enable_invert_inline_svg === "1" &&
              element.nodeName.toLowerCase() === "svg"
            ) {
              darkify_invert_inline_svg(element);
            }
            if (
              darkify_enable_low_video_brightness === "1" ||
              darkify_enable_video_grayscale === "1"
            ) {
              if (element.nodeName.toLowerCase() === "video") {
                darkify_video_brightness_and_grayscale(element);
              }
              if (
                element.nodeName.toLowerCase() === "iframe" &&
                element.getAttribute("src") != null
              ) {
                const srcAttribute = element.getAttribute("src");
                if (
                  srcAttribute.includes("youtube") ||
                  srcAttribute.includes("vimeo") ||
                  srcAttribute.includes("dailymotion")
                ) {
                  darkify_video_brightness_and_grayscale(element);
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
  if (darkify_is_this_admin_panel === "1") {
    localStorage.darkify_admin_panel_last_state = document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
      ? "1"
      : "0";
  } else {
    localStorage.darkify_last_state = document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
      ? "1"
      : "0";
  }
}

function darkify_switch_trigger() {
  if (!has_process_run_at_least_once) {
    darkify_init_processes();
    darkify_init_observer();
  }

  const htmlElement = document.getElementsByTagName("html")[0];

  if (htmlElement.classList.contains("darkify_dark_mode_enabled")) {
    htmlElement.classList.remove("darkify_dark_mode_enabled");
  } else {
    htmlElement.classList.add("darkify_dark_mode_enabled");
  }

  darkify_change_state();
}

function darkify_init_keyboard_shortcut_listener() {
  if (darkify_enable_keyboard_shortcut === "1") {
    document.onkeydown = function (event) {
      if (event.ctrlKey && event.altKey && event.keyCode === 0x44) {
        darkify_switch_trigger();
      }
    };
  }
}

function darkify_init_os_mode_change_listener() {
  if (darkify_is_this_admin_panel === "0" && darkify_enable_os_aware === "1") {
    window
      .matchMedia("(prefers-color-scheme: dark)")
      .addEventListener("change", (event) => {
        const mode = event.matches ? "dark" : "light";
        const htmlElement = document.getElementsByTagName("html")[0];
        if (mode === "dark") {
          htmlElement.classList.add("darkify_dark_mode_enabled");
        } else if (mode === "light") {
          htmlElement.classList.remove("darkify_dark_mode_enabled");
        }

        darkify_change_state();
      });
  }
}

function darkify_init_alternative_dark_mode_switch() {
  if (darkify_alternative_dark_mode_switch.length > 0) {
    const elements = document.querySelectorAll(
      darkify_alternative_dark_mode_switch
    );
    for (let i = 0; i < elements.length; i++) {
      const element = elements[i];
      element.addEventListener("click", () => {
        darkify_switch_trigger();
      });
    }
  }
}

function get_bg_color_to_preserve(element, fromDataset) {
  let color = window.getComputedStyle(element, null).backgroundColor;
  if (!fromDataset) {
    color = element.dataset.darkify_preserved_bg;
  }
  if (
    (color === "transparent" ||
      color === "rgba(0, 0, 0, 0)" ||
      color === "rgba(255,255,255,0)") &&
    element.parentNode.nodeType === 1
  ) {
    color = get_bg_color_to_preserve(element.parentNode, false);
  } else if (
    element.parentNode.nodeType === 1 &&
    element.parentNode.hasAttribute("data-darkify_preserved_bg") &&
    window.getComputedStyle(element.parentNode, null).backgroundColor === color
  ) {
    color = get_bg_color_to_preserve(element.parentNode, false);
  }
  return color;
}

function get_txt_color_to_preserve(element, fromDataset) {
  let color = window.getComputedStyle(element, null).color;
  if (!fromDataset) {
    color = element.dataset.darkify_preserved_color;
  }
  if (
    (color === "transparent" ||
      color === "rgba(0, 0, 0, 0)" ||
      color === "rgba(255,255,255,0)") &&
    element.parentNode.nodeType === 1
  ) {
    color = get_txt_color_to_preserve(element.parentNode, false);
  } else if (
    element.parentNode.nodeType === 1 &&
    element.parentNode.hasAttribute("data-darkify_preserved_color") &&
    window.getComputedStyle(element.parentNode, null).color === color
  ) {
    color = get_txt_color_to_preserve(element.parentNode, false);
  }
  return color;
}

function darkify_darken_bg_image(element, level) {
  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
  ) {
    if (
      window.getComputedStyle(element, null).backgroundImage !== "none" &&
      window.getComputedStyle(element, null).backgroundImage.includes("url") &&
      !window
        .getComputedStyle(element, null)
        .backgroundImage.includes("rgba(0, 0, 0, " + level + ")")
    ) {
      element.style.setProperty(
        "background-image",
        "linear-gradient(rgba(0, 0, 0, " +
          level +
          "), rgba(0, 0, 0, " +
          level +
          ")), " +
          window.getComputedStyle(element, null).backgroundImage
      );
    }
  } else if (
    window.getComputedStyle(element, null).backgroundImage !== "none" &&
    window
      .getComputedStyle(element, null)
      .backgroundImage.includes("rgba(0, 0, 0, " + level + ")")
  ) {
    element.style.setProperty(
      "background-image",
      window
        .getComputedStyle(element, null)
        .backgroundImage.replace(
          "linear-gradient(rgba(0, 0, 0, " +
            level +
            "), rgba(0, 0, 0, " +
            level +
            ")), ",
          ""
        )
    );
  }
}

function darkify_img_is_disallowed_for_brightness_and_grayscale(element, type) {
  if (type === "grayscale") {
    if (darkify_disallowed_grayscale_images_arr.length > 0) {
      for (let i = 0; i < darkify_disallowed_grayscale_images_arr.length; i++) {
        if (darkify_disallowed_grayscale_images_arr[i].trim().length > 0) {
          const url = darkify_disallowed_grayscale_images_arr[i];
          const pathname = new URL(url).pathname;

          if (
            element.getAttribute("src") != null &&
            element.getAttribute("src").includes(pathname)
          ) {
            return true;
          }

          if (
            element.getAttribute("srcset") != null &&
            element.getAttribute("srcset").includes(pathname)
          ) {
            return true;
          }
        }
      }
    }
  }
  return false;
}
function darkify_img_brightness_and_grayscale(element) {
  var disallowedBrightness =
    darkify_img_is_disallowed_for_brightness_and_grayscale(
      element,
      "brightness"
    );
  var disallowedGrayscale =
    darkify_img_is_disallowed_for_brightness_and_grayscale(
      element,
      "grayscale"
    );

  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
  ) {
    if (
      !element.classList.contains("darkify_changed_brightness_and_grayscale")
    ) {
      element.dataset.darkify_preserved_filter = element.style.filter;
      element.classList.add("darkify_changed_brightness_and_grayscale");

      if (
        darkify_enable_low_image_brightness === "1" &&
        darkify_enable_image_grayscale === "1" &&
        !disallowedBrightness &&
        !disallowedGrayscale
      ) {
        element.style.filter =
          "brightness(" +
          darkify_image_brightness_to +
          "%)" +
          " " +
          "grayscale(" +
          darkify_image_grayscale_to +
          "%)";
      } else {
        if (
          darkify_enable_low_image_brightness === "1" &&
          !disallowedBrightness
        ) {
          element.style.filter =
            "brightness(" + darkify_image_brightness_to + "%)";
        } else if (
          darkify_enable_image_grayscale === "1" &&
          !disallowedGrayscale
        ) {
          element.style.filter =
            "grayscale(" + darkify_image_grayscale_to + "%)";
        }
      }
    }
  } else if (
    element.classList.contains("darkify_changed_brightness_and_grayscale")
  ) {
    element.style.filter = element.dataset.darkify_preserved_filter;
    element.classList.remove("darkify_changed_brightness_and_grayscale");
    delete element.dataset.darkify_preserved_filter;
  }
}

function darkify_invert_image(element) {
  if (element.classList.contains("darkify_inverted_image")) {
    element.style.filter = element.style.filter.replace("invert(1)", "");
    element.classList.remove("darkify_inverted_image");
  }
}

function darkify_invert_inline_svg(element) {
  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
  ) {
    element.style.filter = "invert(1)";
    element.classList.add("darkify_inverted_inline_svg");
  } else if (element.classList.contains("darkify_inverted_inline_svg")) {
    element.style.filter = element.style.filter.replace("invert(1)", "");
    element.classList.remove("darkify_inverted_inline_svg");
  }
}

function darkify_video_brightness_and_grayscale(element) {
  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
  ) {
    if (
      !element.classList.contains(
        "darkify_changed_video_brightness_and_grayscale"
      )
    ) {
      element.dataset.darkify_preserved_filter = element.style.filter;
      element.classList.add("darkify_changed_video_brightness_and_grayscale");

      if (
        darkify_enable_low_video_brightness === "1" &&
        darkify_enable_video_grayscale === "1"
      ) {
        element.style.filter =
          "brightness(" +
          darkifyVideoBrightnessTo +
          "%)" +
          " " +
          "grayscale(" +
          darkifyVideoGrayscaleTo +
          "%)";
      } else {
        if (darkify_enable_low_video_brightness === "1") {
          element.style.filter =
            "brightness(" + darkifyVideoBrightnessTo + "%)";
        } else if (darkify_enable_video_grayscale === "1") {
          element.style.filter = "grayscale(" + darkifyVideoGrayscaleTo + "%)";
        }
      }
    }
  } else if (
    element.classList.contains("darkify_changed_video_brightness_and_grayscale")
  ) {
    element.style.filter = element.dataset.darkify_preserved_filter;
    element.classList.remove("darkify_changed_video_brightness_and_grayscale");
    delete element.dataset.darkify_preserved_filter;
  }
}

function darkify_fix_background_color_alpha(element) {
  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled")
  ) {
    if (element.hasAttribute("data-darkify_alpha_bg")) {
      const alphaValue = element.dataset.darkify_alpha_bg
        .replace("rgba(", "")
        .replace(")", "")
        .split(",")[3]
        .trim();
      const backgroundColor = window.getComputedStyle(
        element,
        null
      ).backgroundColor;

      if (!backgroundColor.includes("rgba")) {
        element.style.setProperty(
          "background-color",
          backgroundColor
            .replace(")", ", " + alphaValue + ")")
            .replace("rgb", "rgba"),
          "important"
        );
      }
    }
  } else if (element.hasAttribute("data-darkify_alpha_bg")) {
    element.style.backgroundColor = "";
  }
}
function darkify_elements_force_to_correct(element) {
  if (
    document
      .getElementsByTagName("html")[0]
      .classList.contains("darkify_dark_mode_enabled") &&
    element.hasAttribute("data-darkify_preserved_bg") &&
    element.hasAttribute("data-darkify_preserved_color")
  ) {
    element.style.setProperty(
      "background-color",
      element.dataset.darkify_preserved_bg
    );
    element.style.setProperty("color", element.dataset.darkify_preserved_color);
  }
}

function darkify_implement_secondary_bg() {
  let maxAreaElement = null;
  let maxArea = 0;

  const elements = document.querySelectorAll(
    "* :not(head, title, link, meta, script, style, defs, filter)"
  );

  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    if (element.hasAttribute("data-darkify_secondary_bg_finder")) {
      const secondaryBgColor = element.dataset.darkify_secondary_bg_finder;
      if (
        secondaryBgColor !== "transparent" &&
        secondaryBgColor !== "rgba(0, 0, 0, 0)"
      ) {
        const boundingRect = element.getBoundingClientRect();
        const area = boundingRect.width * boundingRect.height;
        if (area > maxArea) {
          maxArea = area;
          maxAreaElement = secondaryBgColor;
        }
      }
    }
  }

  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    if (element.hasAttribute("data-darkify_secondary_bg_finder")) {
      if (
        element.classList.contains("darkify_style_all") ||
        element.classList.contains("darkify_style_bg_txt") ||
        element.classList.contains("darkify_style_bg_border") ||
        element.classList.contains("darkify_style_bg")
      ) {
        const isDifferentSecondaryBg =
          maxAreaElement !== element.dataset.darkify_secondary_bg_finder;
        if (isDifferentSecondaryBg) {
          element.classList.add("darkify_style_secondary_bg");
        }
      }
      delete element.dataset.darkify_secondary_bg_finder;
    }
  }

  darkify_secondary_bg_color = maxAreaElement;
}

function darkify_recheck_on_css_loaded_later() {
  document
    .querySelectorAll(
      ".darkify_style_txt_border, .darkify_style_txt, .darkify_style_border"
    )
    .forEach(function (element) {
      const computedStyle = window.getComputedStyle(element, null);
      const backgroundColor = computedStyle.backgroundColor;
      if (
        backgroundColor !== "rgba(0, 0, 0, 0)" &&
        backgroundColor !== "rgba(255, 255, 255, 0)"
      ) {
        darkifycess_element(element);
      }
    });
}

function darkify_check_preloading() {
  let isPreloaded = false;
  const lastState = localStorage.darkify_last_state
    ? localStorage.darkify_last_state
    : "not_set";
  const adminPanelLastState = localStorage.darkify_admin_panel_last_state
    ? localStorage.darkify_admin_panel_last_state
    : "not_set";

  if (darkify_is_this_admin_panel === "1") {
    if (adminPanelLastState === "1") {
      isPreloaded = true;
    }
  } else {
    if (lastState === "1" || lastState === "0") {
      if (lastState === "1") {
        isPreloaded = true;
      }
    } else {
      if (darkify_enable_default_dark_mode === "1") {
        isPreloaded = true;
      }
      if (darkify_enable_time_based_dark === "1") {
        const currentDate = new Date();
        const darkStart = new Date();
        const darkStop = new Date();
        darkStart.setHours(
          parseInt(darkify_time_based_dark_start.split(":")[0])
        );
        darkStart.setMinutes(
          parseInt(darkify_time_based_dark_start.split(":")[1])
        );
        darkStop.setHours(parseInt(darkify_time_based_dark_stop.split(":")[0]));
        darkStop.setMinutes(
          parseInt(darkify_time_based_dark_stop.split(":")[1])
        );

        if (
          parseInt(darkify_time_based_dark_stop.split(":")[0]) >=
          parseInt(darkify_time_based_dark_start.split(":")[0])
        ) {
          if (
            currentDate.getTime() > darkStart.getTime() &&
            currentDate.getTime() < darkStop.getTime()
          ) {
            isPreloaded = true;
          }
        } else if (currentDate.getHours() > 12) {
          if (
            currentDate.getTime() > darkStart.getTime() &&
            currentDate.getTime() > darkStop.getTime()
          ) {
            isPreloaded = true;
          }
        } else if (
          currentDate.getTime() < darkStart.getTime() &&
          currentDate.getTime() < darkStop.getTime()
        ) {
          isPreloaded = true;
        }
      }
    }
  }

  if (
    darkify_is_this_admin_panel === "0" &&
    darkify_enable_os_aware === "1" &&
    window.matchMedia &&
    window.matchMedia("(prefers-color-scheme: dark)").matches &&
    lastState !== "1" &&
    lastState !== "0"
  ) {
    isPreloaded = true;
  }

  return isPreloaded;
}

function darkifycess_element(element) {
  var computedStyle = window.getComputedStyle(element, null);
  var old_transition = "";

  if (computedStyle.transition !== "all 0s ease 0s") {
    old_transition = computedStyle.transition;
    element.style.setProperty("transition", "none");
  }

  if (
    element.classList.contains("darkify_style_all") ||
    element.classList.contains("darkify_style_bg_txt") ||
    element.classList.contains("darkify_style_bg_border") ||
    element.classList.contains("darkify_style_txt_border") ||
    element.classList.contains("darkify_style_bg") ||
    element.classList.contains("darkify_style_txt") ||
    element.classList.contains("darkify_style_border") ||
    element.classList.contains("darkify_style_secondary_bg")
  ) {
    element.classList.remove("darkify_style_all");
    element.classList.remove("darkify_style_bg_txt");
    element.classList.remove("darkify_style_bg_border");
    element.classList.remove("darkify_style_txt_border");
    element.classList.remove("darkify_style_bg");
    element.classList.remove("darkify_style_txt");
    element.classList.remove("darkify_style_border");
    element.classList.remove("darkify_style_secondary_bg");
  }

  var nodeName = element.nodeName.toLowerCase();
  var backgroundColor = computedStyle.backgroundColor;
  var color = computedStyle.color;
  var borderColor = computedStyle.borderColor;
  var backgroundImage = computedStyle.backgroundImage;

  if (
    nodeName === "body" &&
    (backgroundColor === "rgba(0, 0, 0, 0)" ||
      backgroundColor === "rgba(255, 255, 255, 0)")
  ) {
    element.style.setProperty("background-color", "rgb(255, 255, 255)");
    backgroundColor = window.getComputedStyle(element, null).backgroundColor;
  }
  var has_background_img_url = false;
  if (backgroundImage !== "none" && backgroundImage.includes("url")) {
    has_background_img_url = true;
    if (darkify_enable_bg_image_darken === "1") {
      darkify_darken_bg_image(element, darken_level);
    }
  }
  if (
    backgroundColor !== "rgba(0, 0, 0, 0)" &&
    backgroundColor !== "rgba(255, 255, 255, 0)" &&
    !has_background_img_url
  ) {
    if (!element.hasAttribute("data-darkify_secondary_bg_finder")) {
      element.dataset.darkify_secondary_bg_finder = backgroundColor;
    }
    if (darkify_secondary_bg_color !== "") {
      var isSecondaryBgColorDifferent =
        darkify_secondary_bg_color !==
        element.dataset.darkify_secondary_bg_finder;
      if (isSecondaryBgColorDifferent) {
        element.classList.add("darkify_style_secondary_bg");
      }
      delete element.dataset.darkify_secondary_bg_finder;
    }
  }
  if (
    backgroundColor !== "rgba(0, 0, 0, 0)" &&
    color !== "rgba(0, 0, 0, 0)" &&
    borderColor !== "rgba(0, 0, 0, 0)" &&
    backgroundColor !== "rgba(255, 255, 255, 0)" &&
    color !== "rgba(255, 255, 255, 0)" &&
    borderColor !== "rgba(255, 255, 255, 0)" &&
    has_background_img_url === false
  ) {
    element.classList.add("darkify_style_all");
  } else {
    if (
      backgroundColor !== "rgba(0, 0, 0, 0)" &&
      color !== "rgba(0, 0, 0, 0)" &&
      backgroundColor !== "rgba(255, 255, 255, 0)" &&
      color !== "rgba(255, 255, 255, 0)" &&
      has_background_img_url === false
    ) {
      element.classList.add("darkify_style_bg_txt");
    } else {
      if (
        backgroundColor !== "rgba(0, 0, 0, 0)" &&
        borderColor !== "rgba(0, 0, 0, 0)" &&
        backgroundColor !== "rgba(255, 255, 255, 0)" &&
        borderColor !== "rgba(255, 255, 255, 0)" &&
        has_background_img_url === false
      ) {
        element.classList.add("darkify_style_bg_border");
      } else {
        if (
          color !== "rgba(0, 0, 0, 0)" &&
          borderColor !== "rgba(0, 0, 0, 0)" &&
          color !== "rgba(255, 255, 255, 0)" &&
          borderColor !== "rgba(255, 255, 255, 0)"
        ) {
          element.classList.add("darkify_style_txt_border");
        } else {
          if (
            backgroundColor !== "rgba(0, 0, 0, 0)" &&
            backgroundColor !== "rgba(255, 255, 255, 0)" &&
            has_background_img_url === false
          ) {
            element.classList.add("darkify_style_bg");
          } else {
            if (
              color !== "rgba(0, 0, 0, 0)" &&
              color !== "rgba(255, 255, 255, 0)"
            ) {
              element.classList.add("darkify_style_txt");
            } else if (
              borderColor !== "rgba(0, 0, 0, 0)" &&
              borderColor !== "rgba(255, 255, 255, 0)"
            ) {
              element.classList.add("darkify_style_border");
            }
          }
        }
      }
    }
  }
  if (
    backgroundImage !== "none" &&
    !has_background_img_url &&
    !element.classList.contains("darkify_style_all") &&
    !element.classList.contains("darkify_style_bg_txt") &&
    !element.classList.contains("darkify_style_bg_border") &&
    !element.classList.contains("darkify_style_bg")
  ) {
    element.classList.add("darkify_style_bg");
  }

  if (nodeName === "a") {
    element.classList.add("darkify_style_link");
  }

  if (
    nodeName === "input" ||
    nodeName === "select" ||
    nodeName === "textarea"
  ) {
    element.classList.add("darkify_style_form_element");
  }

  if (nodeName === "button") {
    element.classList.add("darkify_style_button");
  }

  if (
    (darkify_enable_low_image_brightness === "1" ||
      darkify_enable_image_grayscale === "1") &&
    nodeName === "img"
  ) {
    darkify_img_brightness_and_grayscale(element);
  }

  if (darkify_enable_invert_inline_svg === "1" && nodeName === "svg") {
    darkify_invert_inline_svg(element);
  }

  if (
    darkify_enable_low_video_brightness === "1" ||
    darkify_enable_video_grayscale === "1"
  ) {
    if (nodeName === "video") {
      darkify_video_brightness_and_grayscale(element);
    }

    if (nodeName === "iframe") {
      const srcAttribute = element.getAttribute("src");
      if (srcAttribute !== null) {
        if (
          srcAttribute.includes("youtube") ||
          srcAttribute.includes("vimeo") ||
          srcAttribute.includes("dailymotion")
        ) {
          darkify_video_brightness_and_grayscale(element);
        }
      }
    }
  }

  if (backgroundColor.includes("rgba")) {
    element.dataset.darkify_alpha_bg = backgroundColor;
    darkify_fix_background_color_alpha(element);
  }

  if (old_transition !== "") {
    setTimeout(function () {
      element.style.setProperty("transition", old_transition);
    }, 0);
  }

  setTimeout(function () {
    elements_class_changed.observe(element, {
      attributes: true,
      attributeFilter: ["class"],
    });
  }, 0);

  element.classList.add("darkifycessed");
}

function darkify_init_processes() {
  has_process_run_at_least_once = true;
  document
    .querySelectorAll(
      "* :not(head, title, link, meta, script, style, defs, filter, .darkifycessed)"
    )
    .forEach(function (element) {
      darkifycess_element(element);
    });
}

function darkify_init_observer() {
  darkify_observer.observe(document, {
    attributes: false,
    childList: true,
    characterData: false,
    subtree: true,
  });

  dark_mode_status_changed.observe(document.getElementsByTagName("html")[0], {
    attributes: true,
  });

  if (document.readyState !== "loading") {
    if (!has_process_run_at_least_once) {
      darkify_init_processes();
    }
    darkify_implement_secondary_bg();
    darkify_recheck_on_css_loaded_later();
  } else {
    document.addEventListener("DOMContentLoaded", function () {
      if (!has_process_run_at_least_once) {
        darkify_init_processes();
      }
      darkify_implement_secondary_bg();
      darkify_recheck_on_css_loaded_later();
    });
  }
}

if (darkify_check_preloading()) {
  document
    .getElementsByTagName("html")[0]
    .classList.add("darkify_dark_mode_enabled");
  darkify_init_observer();
}
