/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/lpToastify.js"
/*!*************************************!*\
  !*** ./assets/src/js/lpToastify.js ***!
  \*************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   show: () => (/* binding */ show)
/* harmony export */ });
/* harmony import */ var toastify_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! toastify-js */ "./node_modules/toastify-js/src/toastify.js");
/* harmony import */ var toastify_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(toastify_js__WEBPACK_IMPORTED_MODULE_0__);
/**
 * Utils functions
 *
 * @param url
 * @param data
 * @param functions
 * @since 4.3.0
 * @version 1.0.0
 */

const argsToastify = {
  text: '',
  gravity: lpData.toast.gravity,
  // `top` or `bottom`
  position: lpData.toast.position,
  // `left`, `center` or `right`
  className: `${lpData.toast.classPrefix}`,
  close: lpData.toast.close == 1,
  stopOnFocus: lpData.toast.stopOnFocus == 1,
  duration: lpData.toast.duration
};
const show = (message, status = 'success', argsCustom) => {
  let args = argsToastify;
  if (argsCustom) {
    args = {
      ...args,
      ...argsCustom
    };
  }
  const toastify = new (toastify_js__WEBPACK_IMPORTED_MODULE_0___default())({
    ...args,
    text: message,
    className: `${lpData.toast.classPrefix} ${status}`
  });
  toastify.showToast();
};

/***/ },

/***/ "./assets/src/js/utils.js"
/*!********************************!*\
  !*** ./assets/src/js/utils.js ***!
  \********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   debounce: () => (/* binding */ debounce),
/* harmony export */   eventHandlers: () => (/* binding */ eventHandlers),
/* harmony export */   fullScreenView: () => (/* binding */ fullScreenView),
/* harmony export */   getDataOfForm: () => (/* binding */ getDataOfForm),
/* harmony export */   getFieldKeysOfForm: () => (/* binding */ getFieldKeysOfForm),
/* harmony export */   listenElementCreated: () => (/* binding */ listenElementCreated),
/* harmony export */   listenElementViewed: () => (/* binding */ listenElementViewed),
/* harmony export */   lpAddQueryArgs: () => (/* binding */ lpAddQueryArgs),
/* harmony export */   lpAjaxParseJsonOld: () => (/* binding */ lpAjaxParseJsonOld),
/* harmony export */   lpClassName: () => (/* binding */ lpClassName),
/* harmony export */   lpFetchAPI: () => (/* binding */ lpFetchAPI),
/* harmony export */   lpGetCurrentURLNoParam: () => (/* binding */ lpGetCurrentURLNoParam),
/* harmony export */   lpOnElementReady: () => (/* binding */ lpOnElementReady),
/* harmony export */   lpSetLoadingEl: () => (/* binding */ lpSetLoadingEl),
/* harmony export */   lpShowHideEl: () => (/* binding */ lpShowHideEl),
/* harmony export */   mergeDataWithDatForm: () => (/* binding */ mergeDataWithDatForm),
/* harmony export */   toggleCollapse: () => (/* binding */ toggleCollapse),
/* harmony export */   toggleEnable: () => (/* binding */ toggleEnable)
/* harmony export */ });
/**
 * Utils functions
 *
 * @param url
 * @param data
 * @param functions
 * @since 4.2.5.1
 * @version 1.0.7
 */
const lpClassName = {
  hidden: 'lp-hidden',
  loading: 'loading',
  elCollapse: 'lp-collapse',
  elSectionToggle: '.lp-section-toggle',
  elTriggerToggle: '.lp-trigger-toggle',
  elBtnFullScreen: '.lp-btn-full-screen-view',
  elFullScreen: 'lp-full-screen-view',
  elBtnFullScreenClose: 'lp-full-screen-view__close'
};
const lpFetchAPI = (url, data = {}, functions = {}) => {
  if ('function' === typeof functions.before) {
    functions.before();
  }
  fetch(url, {
    method: 'GET',
    ...data
  }).then(response => response.json()).then(response => {
    if ('function' === typeof functions.success) {
      functions.success(response);
    }
  }).catch(err => {
    if ('function' === typeof functions.error) {
      functions.error(err);
    }
  }).finally(() => {
    if ('function' === typeof functions.completed) {
      functions.completed();
    }
  });
};

/**
 * Get current URL without params.
 *
 * @since 4.2.5.1
 */
const lpGetCurrentURLNoParam = () => {
  let currentUrl = window.location.href;
  const hasParams = currentUrl.includes('?');
  if (hasParams) {
    currentUrl = currentUrl.split('?')[0];
  }
  return currentUrl;
};
const lpAddQueryArgs = (endpoint, args) => {
  const url = new URL(endpoint);
  Object.keys(args).forEach(arg => {
    url.searchParams.set(arg, args[arg]);
  });
  return url;
};

/**
 * Listen element viewed.
 *
 * @param el
 * @param callback
 * @since 4.2.5.8
 */
const listenElementViewed = (el, callback) => {
  const observerSeeItem = new IntersectionObserver(function (entries) {
    for (const entry of entries) {
      if (entry.isIntersecting) {
        callback(entry);
      }
    }
  });
  observerSeeItem.observe(el);
};

/**
 * Listen element created.
 *
 * @param callback
 * @since 4.2.5.8
 */
const listenElementCreated = callback => {
  const observerCreateItem = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.addedNodes) {
        mutation.addedNodes.forEach(function (node) {
          if (node.nodeType === 1) {
            callback(node);
          }
        });
      }
    });
  });
  observerCreateItem.observe(document, {
    childList: true,
    subtree: true
  });
  // End.
};

/**
 * Listen element created.
 *
 * @param selector
 * @param callback
 * @since 4.2.7.1
 */
const lpOnElementReady = (selector, callback) => {
  const element = document.querySelector(selector);
  if (element) {
    callback(element);
    return;
  }
  const observer = new MutationObserver((mutations, obs) => {
    const element = document.querySelector(selector);
    if (element) {
      obs.disconnect();
      callback(element);
    }
  });
  observer.observe(document.documentElement, {
    childList: true,
    subtree: true
  });
};

// Parse JSON from string with content include LP_AJAX_START.
const lpAjaxParseJsonOld = data => {
  if (typeof data !== 'string') {
    return data;
  }
  const m = String.raw({
    raw: data
  }).match(/<-- LP_AJAX_START -->(.*)<-- LP_AJAX_END -->/s);
  try {
    if (m) {
      data = JSON.parse(m[1].replace(/(?:\r\n|\r|\n)/g, ''));
    } else {
      data = JSON.parse(data);
    }
  } catch (e) {
    data = {};
  }
  return data;
};

// status 0: hide, 1: show
const lpShowHideEl = (el, status = 0) => {
  if (!el) {
    return;
  }
  if (!status) {
    el.classList.add(lpClassName.hidden);
  } else {
    el.classList.remove(lpClassName.hidden);
  }
};

// status 0: hide, 1: show
const lpSetLoadingEl = (el, status) => {
  if (!el) {
    return;
  }
  if (!status) {
    el.classList.remove(lpClassName.loading);
  } else {
    el.classList.add(lpClassName.loading);
  }
};

// Toggle collapse section
const toggleCollapse = (e, target, elTriggerClassName = '', elsExclude = [], callback) => {
  if (!elTriggerClassName) {
    elTriggerClassName = lpClassName.elTriggerToggle;
  }

  // Exclude elements, which should not trigger the collapse toggle
  if (elsExclude && elsExclude.length > 0) {
    for (const elExclude of elsExclude) {
      if (target.closest(elExclude)) {
        return;
      }
    }
  }
  const elTrigger = target.closest(elTriggerClassName);
  if (!elTrigger) {
    return;
  }

  //console.log( 'elTrigger', elTrigger );

  const elSectionToggle = elTrigger.closest(`${lpClassName.elSectionToggle}`);
  if (!elSectionToggle) {
    return;
  }
  elSectionToggle.classList.toggle(`${lpClassName.elCollapse}`);
  if ('function' === typeof callback) {
    callback(elSectionToggle);
  }
};

// Get data of form
const getDataOfForm = form => {
  const dataSend = {};
  const formData = new FormData(form);
  for (const pair of formData.entries()) {
    const key = pair[0];
    const value = formData.getAll(key);
    if (!dataSend.hasOwnProperty(key)) {
      // Convert value array to string.
      dataSend[key] = value.join(',');
    }
  }
  return dataSend;
};

// Get field keys of form
const getFieldKeysOfForm = form => {
  const keys = [];
  const elements = form.elements;
  for (let i = 0; i < elements.length; i++) {
    const name = elements[i].name;
    if (name && !keys.includes(name)) {
      keys.push(name);
    }
  }
  return keys;
};

// Merge data handle with data form.
const mergeDataWithDatForm = (elForm, dataHandle) => {
  const dataForm = getDataOfForm(elForm);
  const keys = getFieldKeysOfForm(elForm);
  keys.forEach(key => {
    if (!dataForm.hasOwnProperty(key)) {
      delete dataHandle[key];
    } else if (dataForm[key][0] === '') {
      delete dataForm[key];
      delete dataHandle[key];
    }
  });
  dataHandle = {
    ...dataHandle,
    ...dataForm
  };
  return dataHandle;
};

/**
 * Event trigger
 * For each list of event handlers, listen event on document.
 *
 * eventName: 'click', 'change', ...
 * eventHandlers = [ { selector: '.lp-button', callBack: function(){}, class: object } ]
 *
 * @param eventName
 * @param eventHandlers
 */
const eventHandlers = (eventName, eventHandlers) => {
  document.addEventListener(eventName, e => {
    const target = e.target;
    let args = {
      e,
      target
    };
    eventHandlers.forEach(eventHandler => {
      args = {
        ...args,
        ...eventHandler
      };

      //console.log( args );

      // Check condition before call back
      if (eventHandler.conditionBeforeCallBack) {
        if (eventHandler.conditionBeforeCallBack(args) !== true) {
          return;
        }
      }

      // Special check for keydown event with checkIsEventEnter = true
      if (eventName === 'keydown' && eventHandler.checkIsEventEnter) {
        if (e.key !== 'Enter') {
          return;
        }
      }
      if (target.closest(eventHandler.selector)) {
        if (eventHandler.class) {
          // Call method of class, function callBack will understand exactly {this} is class object.
          eventHandler.class[eventHandler.callBack](args);
        } else {
          // For send args is objected, {this} is eventHandler object, not class object.
          eventHandler.callBack(args);
        }
      }
    });
  });
};

/**
 * Debounce - delays function execution until after `wait` ms of inactivity.
 *
 * Each call resets the timer. Only the last call in a burst executes.
 *
 * USE CASES:
 * - Search inputs, form validation, window resize
 * - Multiple elements need independent timers
 * - When you need to call with different arguments
 *
 * EXAMPLES:
 * const debouncedSearch = debounce( (query) => fetchResults(query), 300 );
 * searchInput.addEventListener('input', (e) => debouncedSearch(e.target.value));
 *
 * const debouncedResize = debounce( recalculateLayout, 250 );
 * window.addEventListener('resize', debouncedResize);
 *
 * ⚠️ Create ONCE outside event handlers, not inside.
 *
 * @param {Function} func - Function to debounce (can be anonymous)
 * @param {number}   wait - Milliseconds to wait (default: 500)
 * @return {Function} Debounced wrapper function
 * @since 4.3.7
 * @version 1.0.0
 */
const debounce = (func, wait = 500) => {
  let timer;
  return args => {
    clearTimeout(timer);
    timer = setTimeout(() => func(args), wait);
  };
};

/**
 * Initialize lp-toggle-enable components.
 *
 * Finds all `.lp-toggle-enable` elements and wires up toggle behavior.
 * Reads initial state from `data-enabled` attribute ("true"/"false").
 * Calls `data-on-toggle` callback (if provided via options) on state change.
 *
 * HTML structure:
 * <label class="lp-toggle-enable" data-enabled="true">
 *   <input type="checkbox" class="lp-toggle-enable__input" />
 *   <span class="lp-toggle-enable__track"></span>
 * </label>
 *
 * @param {string}   selector CSS selector for toggle elements (default: '.lp-toggle-enable')
 * @param {Function} onToggle Optional callback( el, isEnabled ) called on state change
 * @since 4.4.5
 * @version 1.0.0
 */
window.lpToggleEnableInit = 0;
const toggleEnable = (onToggle = null) => {
  if (window.lpToggleEnableInit) {
    return;
  }
  window.lpToggleEnableInit = 1;
  const selector = '.lp-toggle-enable';
  const updateUI = (toggle, isEnabled) => {
    toggle.classList.toggle('is-enabled', isEnabled);
    const input = toggle.querySelector('.lp-toggle-enable__input');
    if (input) {
      input.checked = isEnabled;
      input.value = isEnabled ? '1' : '0';
    }
  };

  // Delegate click handling via eventHandlers.
  eventHandlers('click', [{
    selector,
    callBack: args => {
      const {
        e,
        target
      } = args;
      const toggle = target.closest(selector);
      if (!toggle || toggle.classList.contains('is-disabled')) {
        return;
      }
      e.preventDefault();
      const isEnabled = !toggle.classList.contains('is-enabled');
      updateUI(toggle, isEnabled);
      if ('function' === typeof onToggle) {
        onToggle(toggle, isEnabled);
      }
    }
  }]);
};

/**
 * Initialize custom fullscreen view buttons.
 *
 * Delegates clicks on `.lp-btn-full-screen-view` buttons to
 * `lpToggleFullscreenView`. Reads the `data-target` attribute to find the
 * target element. Falls back to the button's parent element when
 * `data-target` is not provided.
 *
 * @since 4.4.5
 * @version 1.0.0
 */
window.lpFullScreenViewInit = 0;
const fullScreenView = () => {
  if (window.lpFullScreenViewInit) {
    return;
  }
  window.lpFullScreenViewInit = 1;
  let lastScrollY = 0;
  const lpToggleFullscreenView = (elTarget, elBtnFullScreen = null) => {
    const isFullscreen = elTarget.classList.contains(lpClassName.elFullScreen);
    if (isFullscreen) {
      elTarget.classList.remove(lpClassName.elFullScreen);
      document.documentElement.classList.remove('lp-full-screen-active');
      window.scrollTo(0, lastScrollY);
    } else {
      lastScrollY = window.scrollY;
      elTarget.classList.add(lpClassName.elFullScreen);
      document.documentElement.classList.add('lp-full-screen-active');
    }
    if (!isFullscreen) {
      if (!elTarget.querySelector(`.${lpClassName.elBtnFullScreenClose}`)) {
        const closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = lpClassName.elBtnFullScreenClose;
        closeButton.setAttribute('aria-label', 'Close');
        closeButton.innerHTML = lpData.i18n.closeButtonFullScreen || 'Close &times;';
        closeButton.addEventListener('click', e => {
          e.preventDefault();
          lpToggleFullscreenView(elTarget);
        });
        elTarget.appendChild(closeButton);
      }
    } else {
      const closeButton = elTarget.querySelector(`.${lpClassName.elBtnFullScreenClose}`);
      if (closeButton) {
        closeButton.remove();
      }
    }
  };
  eventHandlers('click', [{
    selector: lpClassName.elBtnFullScreen,
    callBack: args => {
      const {
        e,
        target
      } = args;
      const elBtnFullScreen = target.closest(lpClassName.elBtnFullScreen);
      if (!elBtnFullScreen) {
        console.log('No full screen button found');
        return;
      }
      e.preventDefault();
      let elTarget = null;
      const targetSelector = elBtnFullScreen.dataset.targetFullscreen;
      console.log(targetSelector);
      if (targetSelector) {
        elTarget = document.querySelector(targetSelector);
      }
      if (!elTarget) {
        console.log('No target element found');
        return;
      }
      lpToggleFullscreenView(elTarget, elBtnFullScreen);
    }
  }]);
};

/***/ },

/***/ "./node_modules/toastify-js/src/toastify.js"
/*!**************************************************!*\
  !*** ./node_modules/toastify-js/src/toastify.js ***!
  \**************************************************/
(module) {

/*!
 * Toastify js 1.12.0
 * https://github.com/apvarun/toastify-js
 * @license MIT licensed
 *
 * Copyright (C) 2018 Varun A P
 */
(function(root, factory) {
  if ( true && module.exports) {
    module.exports = factory();
  } else {
    root.Toastify = factory();
  }
})(this, function(global) {
  // Object initialization
  var Toastify = function(options) {
      // Returning a new init object
      return new Toastify.lib.init(options);
    },
    // Library version
    version = "1.12.0";

  // Set the default global options
  Toastify.defaults = {
    oldestFirst: true,
    text: "Toastify is awesome!",
    node: undefined,
    duration: 3000,
    selector: undefined,
    callback: function () {
    },
    destination: undefined,
    newWindow: false,
    close: false,
    gravity: "toastify-top",
    positionLeft: false,
    position: '',
    backgroundColor: '',
    avatar: "",
    className: "",
    stopOnFocus: true,
    onClick: function () {
    },
    offset: {x: 0, y: 0},
    escapeMarkup: true,
    ariaLive: 'polite',
    style: {background: ''}
  };

  // Defining the prototype of the object
  Toastify.lib = Toastify.prototype = {
    toastify: version,

    constructor: Toastify,

    // Initializing the object with required parameters
    init: function(options) {
      // Verifying and validating the input object
      if (!options) {
        options = {};
      }

      // Creating the options object
      this.options = {};

      this.toastElement = null;

      // Validating the options
      this.options.text = options.text || Toastify.defaults.text; // Display message
      this.options.node = options.node || Toastify.defaults.node;  // Display content as node
      this.options.duration = options.duration === 0 ? 0 : options.duration || Toastify.defaults.duration; // Display duration
      this.options.selector = options.selector || Toastify.defaults.selector; // Parent selector
      this.options.callback = options.callback || Toastify.defaults.callback; // Callback after display
      this.options.destination = options.destination || Toastify.defaults.destination; // On-click destination
      this.options.newWindow = options.newWindow || Toastify.defaults.newWindow; // Open destination in new window
      this.options.close = options.close || Toastify.defaults.close; // Show toast close icon
      this.options.gravity = options.gravity === "bottom" ? "toastify-bottom" : Toastify.defaults.gravity; // toast position - top or bottom
      this.options.positionLeft = options.positionLeft || Toastify.defaults.positionLeft; // toast position - left or right
      this.options.position = options.position || Toastify.defaults.position; // toast position - left or right
      this.options.backgroundColor = options.backgroundColor || Toastify.defaults.backgroundColor; // toast background color
      this.options.avatar = options.avatar || Toastify.defaults.avatar; // img element src - url or a path
      this.options.className = options.className || Toastify.defaults.className; // additional class names for the toast
      this.options.stopOnFocus = options.stopOnFocus === undefined ? Toastify.defaults.stopOnFocus : options.stopOnFocus; // stop timeout on focus
      this.options.onClick = options.onClick || Toastify.defaults.onClick; // Callback after click
      this.options.offset = options.offset || Toastify.defaults.offset; // toast offset
      this.options.escapeMarkup = options.escapeMarkup !== undefined ? options.escapeMarkup : Toastify.defaults.escapeMarkup;
      this.options.ariaLive = options.ariaLive || Toastify.defaults.ariaLive;
      this.options.style = options.style || Toastify.defaults.style;
      if(options.backgroundColor) {
        this.options.style.background = options.backgroundColor;
      }

      // Returning the current object for chaining functions
      return this;
    },

    // Building the DOM element
    buildToast: function() {
      // Validating if the options are defined
      if (!this.options) {
        throw "Toastify is not initialized";
      }

      // Creating the DOM object
      var divElement = document.createElement("div");
      divElement.className = "toastify on " + this.options.className;

      // Positioning toast to left or right or center
      if (!!this.options.position) {
        divElement.className += " toastify-" + this.options.position;
      } else {
        // To be depreciated in further versions
        if (this.options.positionLeft === true) {
          divElement.className += " toastify-left";
          console.warn('Property `positionLeft` will be depreciated in further versions. Please use `position` instead.')
        } else {
          // Default position
          divElement.className += " toastify-right";
        }
      }

      // Assigning gravity of element
      divElement.className += " " + this.options.gravity;

      if (this.options.backgroundColor) {
        // This is being deprecated in favor of using the style HTML DOM property
        console.warn('DEPRECATION NOTICE: "backgroundColor" is being deprecated. Please use the "style.background" property.');
      }

      // Loop through our style object and apply styles to divElement
      for (var property in this.options.style) {
        divElement.style[property] = this.options.style[property];
      }

      // Announce the toast to screen readers
      if (this.options.ariaLive) {
        divElement.setAttribute('aria-live', this.options.ariaLive)
      }

      // Adding the toast message/node
      if (this.options.node && this.options.node.nodeType === Node.ELEMENT_NODE) {
        // If we have a valid node, we insert it
        divElement.appendChild(this.options.node)
      } else {
        if (this.options.escapeMarkup) {
          divElement.innerText = this.options.text;
        } else {
          divElement.innerHTML = this.options.text;
        }

        if (this.options.avatar !== "") {
          var avatarElement = document.createElement("img");
          avatarElement.src = this.options.avatar;

          avatarElement.className = "toastify-avatar";

          if (this.options.position == "left" || this.options.positionLeft === true) {
            // Adding close icon on the left of content
            divElement.appendChild(avatarElement);
          } else {
            // Adding close icon on the right of content
            divElement.insertAdjacentElement("afterbegin", avatarElement);
          }
        }
      }

      // Adding a close icon to the toast
      if (this.options.close === true) {
        // Create a span for close element
        var closeElement = document.createElement("button");
        closeElement.type = "button";
        closeElement.setAttribute("aria-label", "Close");
        closeElement.className = "toast-close";
        closeElement.innerHTML = "&#10006;";

        // Triggering the removal of toast from DOM on close click
        closeElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            this.removeElement(this.toastElement);
            window.clearTimeout(this.toastElement.timeOutValue);
          }.bind(this)
        );

        //Calculating screen width
        var width = window.innerWidth > 0 ? window.innerWidth : screen.width;

        // Adding the close icon to the toast element
        // Display on the right if screen width is less than or equal to 360px
        if ((this.options.position == "left" || this.options.positionLeft === true) && width > 360) {
          // Adding close icon on the left of content
          divElement.insertAdjacentElement("afterbegin", closeElement);
        } else {
          // Adding close icon on the right of content
          divElement.appendChild(closeElement);
        }
      }

      // Clear timeout while toast is focused
      if (this.options.stopOnFocus && this.options.duration > 0) {
        var self = this;
        // stop countdown
        divElement.addEventListener(
          "mouseover",
          function(event) {
            window.clearTimeout(divElement.timeOutValue);
          }
        )
        // add back the timeout
        divElement.addEventListener(
          "mouseleave",
          function() {
            divElement.timeOutValue = window.setTimeout(
              function() {
                // Remove the toast from DOM
                self.removeElement(divElement);
              },
              self.options.duration
            )
          }
        )
      }

      // Adding an on-click destination path
      if (typeof this.options.destination !== "undefined") {
        divElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            if (this.options.newWindow === true) {
              window.open(this.options.destination, "_blank");
            } else {
              window.location = this.options.destination;
            }
          }.bind(this)
        );
      }

      if (typeof this.options.onClick === "function" && typeof this.options.destination === "undefined") {
        divElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            this.options.onClick();
          }.bind(this)
        );
      }

      // Adding offset
      if(typeof this.options.offset === "object") {

        var x = getAxisOffsetAValue("x", this.options);
        var y = getAxisOffsetAValue("y", this.options);

        var xOffset = this.options.position == "left" ? x : "-" + x;
        var yOffset = this.options.gravity == "toastify-top" ? y : "-" + y;

        divElement.style.transform = "translate(" + xOffset + "," + yOffset + ")";

      }

      // Returning the generated element
      return divElement;
    },

    // Displaying the toast
    showToast: function() {
      // Creating the DOM object for the toast
      this.toastElement = this.buildToast();

      // Getting the root element to with the toast needs to be added
      var rootElement;
      if (typeof this.options.selector === "string") {
        rootElement = document.getElementById(this.options.selector);
      } else if (this.options.selector instanceof HTMLElement || (typeof ShadowRoot !== 'undefined' && this.options.selector instanceof ShadowRoot)) {
        rootElement = this.options.selector;
      } else {
        rootElement = document.body;
      }

      // Validating if root element is present in DOM
      if (!rootElement) {
        throw "Root element is not defined";
      }

      // Adding the DOM element
      var elementToInsert = Toastify.defaults.oldestFirst ? rootElement.firstChild : rootElement.lastChild;
      rootElement.insertBefore(this.toastElement, elementToInsert);

      // Repositioning the toasts in case multiple toasts are present
      Toastify.reposition();

      if (this.options.duration > 0) {
        this.toastElement.timeOutValue = window.setTimeout(
          function() {
            // Remove the toast from DOM
            this.removeElement(this.toastElement);
          }.bind(this),
          this.options.duration
        ); // Binding `this` for function invocation
      }

      // Supporting function chaining
      return this;
    },

    hideToast: function() {
      if (this.toastElement.timeOutValue) {
        clearTimeout(this.toastElement.timeOutValue);
      }
      this.removeElement(this.toastElement);
    },

    // Removing the element from the DOM
    removeElement: function(toastElement) {
      // Hiding the element
      // toastElement.classList.remove("on");
      toastElement.className = toastElement.className.replace(" on", "");

      // Removing the element from DOM after transition end
      window.setTimeout(
        function() {
          // remove options node if any
          if (this.options.node && this.options.node.parentNode) {
            this.options.node.parentNode.removeChild(this.options.node);
          }

          // Remove the element from the DOM, only when the parent node was not removed before.
          if (toastElement.parentNode) {
            toastElement.parentNode.removeChild(toastElement);
          }

          // Calling the callback function
          this.options.callback.call(toastElement);

          // Repositioning the toasts again
          Toastify.reposition();
        }.bind(this),
        400
      ); // Binding `this` for function invocation
    },
  };

  // Positioning the toasts on the DOM
  Toastify.reposition = function() {

    // Top margins with gravity
    var topLeftOffsetSize = {
      top: 15,
      bottom: 15,
    };
    var topRightOffsetSize = {
      top: 15,
      bottom: 15,
    };
    var offsetSize = {
      top: 15,
      bottom: 15,
    };

    // Get all toast messages on the DOM
    var allToasts = document.getElementsByClassName("toastify");

    var classUsed;

    // Modifying the position of each toast element
    for (var i = 0; i < allToasts.length; i++) {
      // Getting the applied gravity
      if (containsClass(allToasts[i], "toastify-top") === true) {
        classUsed = "toastify-top";
      } else {
        classUsed = "toastify-bottom";
      }

      var height = allToasts[i].offsetHeight;
      classUsed = classUsed.substr(9, classUsed.length-1)
      // Spacing between toasts
      var offset = 15;

      var width = window.innerWidth > 0 ? window.innerWidth : screen.width;

      // Show toast in center if screen with less than or equal to 360px
      if (width <= 360) {
        // Setting the position
        allToasts[i].style[classUsed] = offsetSize[classUsed] + "px";

        offsetSize[classUsed] += height + offset;
      } else {
        if (containsClass(allToasts[i], "toastify-left") === true) {
          // Setting the position
          allToasts[i].style[classUsed] = topLeftOffsetSize[classUsed] + "px";

          topLeftOffsetSize[classUsed] += height + offset;
        } else {
          // Setting the position
          allToasts[i].style[classUsed] = topRightOffsetSize[classUsed] + "px";

          topRightOffsetSize[classUsed] += height + offset;
        }
      }
    }

    // Supporting function chaining
    return this;
  };

  // Helper function to get offset.
  function getAxisOffsetAValue(axis, options) {

    if(options.offset[axis]) {
      if(isNaN(options.offset[axis])) {
        return options.offset[axis];
      }
      else {
        return options.offset[axis] + 'px';
      }
    }

    return '0px';

  }

  function containsClass(elem, yourClass) {
    if (!elem || typeof yourClass !== "string") {
      return false;
    } else if (
      elem.className &&
      elem.className
        .trim()
        .split(/\s+/gi)
        .indexOf(yourClass) > -1
    ) {
      return true;
    } else {
      return false;
    }
  }

  // Setting up the prototype for the init object
  Toastify.lib.init.prototype = Toastify.lib;

  // Returning the Toastify function to be assigned to the window object/module
  return Toastify;
});


/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	const __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		const cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		const module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			const e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = (module) => {
/******/ 		const getter = module && module.__esModule ?
/******/ 			() => (module['default']) :
/******/ 			() => (module);
/******/ 		__webpack_require__.d(getter, { a: getter });
/******/ 		return getter;
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	// define getter/value functions for harmony exports
/******/ 	__webpack_require__.d = (exports, definition) => {
/******/ 		for(var key in definition) {
/******/ 			if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 				Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 			}
/******/ 		}
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	__webpack_require__.o = (obj, prop) => (Object.hasOwn(obj, prop));
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";
/*!****************************************!*\
  !*** ./assets/src/js/course-review.js ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils.js */ "./assets/src/js/utils.js");
/* harmony import */ var _lpToastify_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./lpToastify.js */ "./assets/src/js/lpToastify.js");
/**
 * JS handle course review
 *
 * @since 4.0.0
 * @version 1.0.3
 */


class CourseReview {
  static selectors = {
    classLoadMore: 'course-review-load-more',
    classLPTarget: '.lp-target',
    classCourseReviewsList: '.course-reviews-list',
    classReviewStars: '.review-stars',
    classChooseStar: '.choose-star',
    classWriteReview: '.write-a-review',
    classCourseReviewWrapper: '.course-review-wrapper',
    classClose: '.close',
    classSubmitReview: '.submit-review',
    classReviewForm: 'form.review-form',
    classReviewFields: '.review-fields'
  };
  init() {
    this.events();
  }
  events() {
    if (CourseReview._loadedEvents) {
      return;
    }
    CourseReview._loadedEvents = true;
    _utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('click', [{
      selector: `.${CourseReview.selectors.classLoadMore}:not(.loading)`,
      class: this,
      callBack: this.loadMoreReview.name
    }, {
      selector: CourseReview.selectors.classWriteReview,
      class: this,
      callBack: this.showFormReview.name
    }, {
      selector: CourseReview.selectors.classChooseStar,
      class: this,
      callBack: this.choiceStar.name
    }, {
      selector: CourseReview.selectors.classClose,
      class: this,
      callBack: this.closeFormReview.name
    }, {
      selector: CourseReview.selectors.classSubmitReview,
      class: this,
      callBack: this.submitFormReview.name
    }]);
    document.addEventListener('mouseover', e => {
      this.handleStarHover(e.target);
    });
  }
  loadMoreReview(args) {
    const {
      target
    } = args;
    const btnLoadMore = target.closest(`.${CourseReview.selectors.classLoadMore}:not(.loading)`);
    if (!btnLoadMore) {
      return;
    }
    _utils_js__WEBPACK_IMPORTED_MODULE_0__.lpSetLoadingEl(btnLoadMore, true);
    const elLPTarget = btnLoadMore.closest(CourseReview.selectors.classLPTarget);
    if (!elLPTarget) {
      return;
    }
    const dataObj = JSON.parse(elLPTarget.dataset.send);
    const dataSend = {
      ...dataObj
    };
    if (!dataSend.args.hasOwnProperty('paged')) {
      dataSend.args.paged = 1;
    } else {
      dataSend.args.paged++;
    }
    elLPTarget.dataset.send = JSON.stringify(dataSend);
    const callBack = {
      success: response => {
        const {
          data
        } = response;
        const paged = parseInt(data.paged);
        const totalPages = parseInt(data.total_pages);
        const newEl = document.createElement('div');
        newEl.innerHTML = data.content || '';
        const elListCourse = elLPTarget.querySelector(CourseReview.selectors.classCourseReviewsList);
        elListCourse.insertAdjacentHTML('beforeend', newEl.querySelector(CourseReview.selectors.classCourseReviewsList).innerHTML);
        if (paged >= totalPages - 1) {
          btnLoadMore.remove();
        }
      },
      error: error => {
        console.log(error);
      },
      completed: () => {
        _utils_js__WEBPACK_IMPORTED_MODULE_0__.lpSetLoadingEl(btnLoadMore, false);
      }
    };
    window.lpAJAXG.fetchAJAX(dataSend, callBack);
  }
  showFormReview(args) {
    const {
      target
    } = args;
    const elBtnShowForm = target.closest(CourseReview.selectors.classWriteReview);
    if (!elBtnShowForm) {
      return;
    }
    const form = document.querySelector(CourseReview.selectors.classCourseReviewWrapper);
    if (!form) {
      return;
    }
    form.classList.add('active');
  }
  choiceStar(args) {
    const {
      target
    } = args;
    const elChoiceStar = target.closest(CourseReview.selectors.classChooseStar);
    if (!elChoiceStar) {
      return;
    }
    const form = target.closest('form');
    const elRatingChose = form ? form.querySelector('input[name="rating"]') : null;
    if (elRatingChose) {
      elRatingChose.value = elChoiceStar.dataset.star;
    }
  }
  closeFormReview(args) {
    const {
      e,
      target
    } = args;
    const elClose = target.closest(CourseReview.selectors.classClose);
    if (!elClose) {
      return;
    }
    const elFormWrapper = elClose.closest(CourseReview.selectors.classCourseReviewWrapper);
    if (!elFormWrapper) {
      return;
    }
    e.preventDefault();
    elFormWrapper.classList.remove('active');
  }
  submitFormReview(args) {
    const {
      e,
      target
    } = args;
    const elBtnSubmit = target.closest(CourseReview.selectors.classSubmitReview);
    if (!elBtnSubmit) {
      return;
    }
    const form = elBtnSubmit.closest(CourseReview.selectors.classReviewForm);
    if (!form) {
      return;
    }
    e.preventDefault();
    _utils_js__WEBPACK_IMPORTED_MODULE_0__.lpSetLoadingEl(elBtnSubmit, 1);
    const elLPTarget = elBtnSubmit.closest(CourseReview.selectors.classLPTarget);
    if (!elLPTarget) {
      return;
    }
    const dataObj = JSON.parse(elLPTarget.dataset.send);
    const dataSend = {
      ...dataObj
    };
    const courseId = dataSend.args.course_id;
    dataSend.args = _utils_js__WEBPACK_IMPORTED_MODULE_0__.mergeDataWithDatForm(form, dataSend.args);
    if (courseId) {
      dataSend.args.course_id = courseId;
    }
    const callBack = {
      success: response => {
        const {
          data,
          status,
          message
        } = response;
        _lpToastify_js__WEBPACK_IMPORTED_MODULE_1__.show(message, status);
        if ('success' === status) {
          setTimeout(() => {
            window.location.reload();
          }, 1000);
        }
      },
      error: error => {
        _lpToastify_js__WEBPACK_IMPORTED_MODULE_1__.show(error.message || error, 'error');
      },
      completed: () => {
        _utils_js__WEBPACK_IMPORTED_MODULE_0__.lpSetLoadingEl(elBtnSubmit, false);
      }
    };
    window.lpAJAXG.fetchAJAX(dataSend, callBack);
  }

  /**
   * Show rating when hover on star
   * Show rating choice when click on star
   */
  handleStarHover(target) {
    const elChooseStar = target.closest(CourseReview.selectors.classChooseStar);
    if (elChooseStar) {
      const starNumber = parseInt(elChooseStar.dataset.star);
      const elReviewStars = elChooseStar.closest(CourseReview.selectors.classReviewStars);
      this.updateStarHover(elReviewStars, starNumber);
    } else {
      const elReviewFields = document.querySelectorAll(CourseReview.selectors.classReviewFields);
      if (!elReviewFields.length) {
        return;
      }
      elReviewFields.forEach(elReviewField => {
        const elRatingChoice = elReviewField.querySelector('input[name="rating"]');
        const starChoice = elRatingChoice ? elRatingChoice.value : 0;
        const elReviewStars = elReviewField.querySelector(CourseReview.selectors.classReviewStars);
        this.updateStarHover(elReviewStars, starChoice);
      });
    }
  }
  updateStarHover(elReviewStars, starNumber) {
    if (!elReviewStars) {
      return;
    }
    for (let i = 1; i < 6; i++) {
      const elReviewStar = elReviewStars.querySelector(`li[data-star="${i}"]`);
      if (!elReviewStar) {
        continue;
      }
      const elReviewStarSpan = elReviewStar.querySelector('span');
      if (!elReviewStarSpan) {
        continue;
      }
      if (i <= starNumber) {
        elReviewStarSpan.classList.add('hover');
      } else {
        elReviewStarSpan.classList.remove('hover');
      }
    }
  }
}
const courseReview = new CourseReview();
courseReview.init();
})();

/******/ })()
;
//# sourceMappingURL=course-review.js.map