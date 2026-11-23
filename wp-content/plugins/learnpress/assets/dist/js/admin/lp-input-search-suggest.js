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
/* harmony import */ var toastify_js_src_toastify_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! toastify-js/src/toastify.css */ "./node_modules/toastify-js/src/toastify.css");
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
/* harmony export */   resetForm: () => (/* binding */ resetForm),
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
 * @version 1.0.8
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
  }).then(response => 'function' === typeof functions.checkResponse ? functions.checkResponse(response) : response).then(response => response.json()).then(response => {
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
 * Reset all fields of form to empty, select to first option.
 * Not use form.reset(), because it restores values rendered by server (e.g. from URL params).
 *
 * @param elForm
 */
const resetForm = elForm => {
  if (!elForm) {
    return;
  }
  Array.from(elForm.elements).forEach(elField => {
    const tagName = elField.tagName;
    const type = elField.type;
    if (tagName === 'SELECT') {
      elField.selectedIndex = 0;
    } else if (type === 'checkbox' || type === 'radio') {
      elField.checked = false;
    } else if ((tagName === 'INPUT' || tagName === 'TEXTAREA') && !['hidden', 'button', 'submit', 'reset'].includes(type)) {
      elField.value = '';
    }
  });
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
 * @param capture Use capture phase (default: false/bubble). Set true when
 * the event may be stopped by a container calling stopPropagation() before
 * it bubbles up to document (e.g. Headless UI DialogPanel on click).
 */
const eventHandlers = (eventName, eventHandlers, capture = false) => {
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
  }, capture);
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

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/toastify-js/src/toastify.css"
/*!*****************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/toastify-js/src/toastify.css ***!
  \*****************************************************************************************/
(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _css_loader_dist_runtime_sourceMaps_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../css-loader/dist/runtime/sourceMaps.js */ "./node_modules/css-loader/dist/runtime/sourceMaps.js");
/* harmony import */ var _css_loader_dist_runtime_sourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_loader_dist_runtime_sourceMaps_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1__);
// Imports


var ___CSS_LOADER_EXPORT___ = _css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_1___default()((_css_loader_dist_runtime_sourceMaps_js__WEBPACK_IMPORTED_MODULE_0___default()));
// Module
___CSS_LOADER_EXPORT___.push([module.id, `/*!
 * Toastify js 1.12.0
 * https://github.com/apvarun/toastify-js
 * @license MIT licensed
 *
 * Copyright (C) 2018 Varun A P
 */

.toastify {
    padding: 12px 20px;
    color: #ffffff;
    display: inline-block;
    box-shadow: 0 3px 6px -1px rgba(0, 0, 0, 0.12), 0 10px 36px -4px rgba(77, 96, 232, 0.3);
    background: -webkit-linear-gradient(315deg, #73a5ff, #5477f5);
    background: linear-gradient(135deg, #73a5ff, #5477f5);
    position: fixed;
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
    border-radius: 2px;
    cursor: pointer;
    text-decoration: none;
    max-width: calc(50% - 20px);
    z-index: 2147483647;
}

.toastify.on {
    opacity: 1;
}

.toast-close {
    background: transparent;
    border: 0;
    color: white;
    cursor: pointer;
    font-family: inherit;
    font-size: 1em;
    opacity: 0.4;
    padding: 0 5px;
}

.toastify-right {
    right: 15px;
}

.toastify-left {
    left: 15px;
}

.toastify-top {
    top: -150px;
}

.toastify-bottom {
    bottom: -150px;
}

.toastify-rounded {
    border-radius: 25px;
}

.toastify-avatar {
    width: 1.5em;
    height: 1.5em;
    margin: -7px 5px;
    border-radius: 2px;
}

.toastify-center {
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    max-width: fit-content;
    max-width: -moz-fit-content;
}

@media only screen and (max-width: 360px) {
    .toastify-right, .toastify-left {
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        max-width: fit-content;
    }
}
`, "",{"version":3,"sources":["webpack://./node_modules/toastify-js/src/toastify.css"],"names":[],"mappings":"AAAA;;;;;;EAME;;AAEF;IACI,kBAAkB;IAClB,cAAc;IACd,qBAAqB;IACrB,uFAAuF;IACvF,6DAA6D;IAC7D,qDAAqD;IACrD,eAAe;IACf,UAAU;IACV,wDAAwD;IACxD,kBAAkB;IAClB,eAAe;IACf,qBAAqB;IACrB,2BAA2B;IAC3B,mBAAmB;AACvB;;AAEA;IACI,UAAU;AACd;;AAEA;IACI,uBAAuB;IACvB,SAAS;IACT,YAAY;IACZ,eAAe;IACf,oBAAoB;IACpB,cAAc;IACd,YAAY;IACZ,cAAc;AAClB;;AAEA;IACI,WAAW;AACf;;AAEA;IACI,UAAU;AACd;;AAEA;IACI,WAAW;AACf;;AAEA;IACI,cAAc;AAClB;;AAEA;IACI,mBAAmB;AACvB;;AAEA;IACI,YAAY;IACZ,aAAa;IACb,gBAAgB;IAChB,kBAAkB;AACtB;;AAEA;IACI,iBAAiB;IACjB,kBAAkB;IAClB,OAAO;IACP,QAAQ;IACR,sBAAsB;IACtB,2BAA2B;AAC/B;;AAEA;IACI;QACI,iBAAiB;QACjB,kBAAkB;QAClB,OAAO;QACP,QAAQ;QACR,sBAAsB;IAC1B;AACJ","sourcesContent":["/*!\n * Toastify js 1.12.0\n * https://github.com/apvarun/toastify-js\n * @license MIT licensed\n *\n * Copyright (C) 2018 Varun A P\n */\n\n.toastify {\n    padding: 12px 20px;\n    color: #ffffff;\n    display: inline-block;\n    box-shadow: 0 3px 6px -1px rgba(0, 0, 0, 0.12), 0 10px 36px -4px rgba(77, 96, 232, 0.3);\n    background: -webkit-linear-gradient(315deg, #73a5ff, #5477f5);\n    background: linear-gradient(135deg, #73a5ff, #5477f5);\n    position: fixed;\n    opacity: 0;\n    transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);\n    border-radius: 2px;\n    cursor: pointer;\n    text-decoration: none;\n    max-width: calc(50% - 20px);\n    z-index: 2147483647;\n}\n\n.toastify.on {\n    opacity: 1;\n}\n\n.toast-close {\n    background: transparent;\n    border: 0;\n    color: white;\n    cursor: pointer;\n    font-family: inherit;\n    font-size: 1em;\n    opacity: 0.4;\n    padding: 0 5px;\n}\n\n.toastify-right {\n    right: 15px;\n}\n\n.toastify-left {\n    left: 15px;\n}\n\n.toastify-top {\n    top: -150px;\n}\n\n.toastify-bottom {\n    bottom: -150px;\n}\n\n.toastify-rounded {\n    border-radius: 25px;\n}\n\n.toastify-avatar {\n    width: 1.5em;\n    height: 1.5em;\n    margin: -7px 5px;\n    border-radius: 2px;\n}\n\n.toastify-center {\n    margin-left: auto;\n    margin-right: auto;\n    left: 0;\n    right: 0;\n    max-width: fit-content;\n    max-width: -moz-fit-content;\n}\n\n@media only screen and (max-width: 360px) {\n    .toastify-right, .toastify-left {\n        margin-left: auto;\n        margin-right: auto;\n        left: 0;\n        right: 0;\n        max-width: fit-content;\n    }\n}\n"],"sourceRoot":""}]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ },

/***/ "./node_modules/css-loader/dist/runtime/api.js"
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
(module) {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
module.exports = function (cssWithMappingToString) {
  var list = [];

  // return the list of modules as css string
  list.toString = function toString() {
    return this.map(function (item) {
      var content = "";
      var needLayer = typeof item[5] !== "undefined";
      if (item[4]) {
        content += "@supports (".concat(item[4], ") {");
      }
      if (item[2]) {
        content += "@media ".concat(item[2], " {");
      }
      if (needLayer) {
        content += "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {");
      }
      content += cssWithMappingToString(item);
      if (needLayer) {
        content += "}";
      }
      if (item[2]) {
        content += "}";
      }
      if (item[4]) {
        content += "}";
      }
      return content;
    }).join("");
  };

  // import a list of modules into the list
  list.i = function i(modules, media, dedupe, supports, layer) {
    if (typeof modules === "string") {
      modules = [[null, modules, undefined]];
    }
    var alreadyImportedModules = {};
    if (dedupe) {
      for (var k = 0; k < this.length; k++) {
        var id = this[k][0];
        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }
    for (var _k = 0; _k < modules.length; _k++) {
      var item = [].concat(modules[_k]);
      if (dedupe && alreadyImportedModules[item[0]]) {
        continue;
      }
      if (typeof layer !== "undefined") {
        if (typeof item[5] === "undefined") {
          item[5] = layer;
        } else {
          item[1] = "@layer".concat(item[5].length > 0 ? " ".concat(item[5]) : "", " {").concat(item[1], "}");
          item[5] = layer;
        }
      }
      if (media) {
        if (!item[2]) {
          item[2] = media;
        } else {
          item[1] = "@media ".concat(item[2], " {").concat(item[1], "}");
          item[2] = media;
        }
      }
      if (supports) {
        if (!item[4]) {
          item[4] = "".concat(supports);
        } else {
          item[1] = "@supports (".concat(item[4], ") {").concat(item[1], "}");
          item[4] = supports;
        }
      }
      list.push(item);
    }
  };
  return list;
};

/***/ },

/***/ "./node_modules/css-loader/dist/runtime/sourceMaps.js"
/*!************************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/sourceMaps.js ***!
  \************************************************************/
(module) {

"use strict";


module.exports = function (item) {
  var content = item[1];
  var cssMapping = item[3];
  if (!cssMapping) {
    return content;
  }
  if (typeof btoa === "function") {
    var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(cssMapping))));
    var data = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(base64);
    var sourceMapping = "/*# ".concat(data, " */");
    return [content].concat([sourceMapping]).join("\n");
  }
  return [content].join("\n");
};

/***/ },

/***/ "./node_modules/toastify-js/src/toastify.css"
/*!***************************************************!*\
  !*** ./node_modules/toastify-js/src/toastify.css ***!
  \***************************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !../../style-loader/dist/runtime/styleDomAPI.js */ "./node_modules/style-loader/dist/runtime/styleDomAPI.js");
/* harmony import */ var _style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../style-loader/dist/runtime/insertBySelector.js */ "./node_modules/style-loader/dist/runtime/insertBySelector.js");
/* harmony import */ var _style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../style-loader/dist/runtime/setAttributesWithoutAttributes.js */ "./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js");
/* harmony import */ var _style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! !../../style-loader/dist/runtime/insertStyleElement.js */ "./node_modules/style-loader/dist/runtime/insertStyleElement.js");
/* harmony import */ var _style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! !../../style-loader/dist/runtime/styleTagTransform.js */ "./node_modules/style-loader/dist/runtime/styleTagTransform.js");
/* harmony import */ var _style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _css_loader_dist_cjs_js_toastify_css__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! !!../../css-loader/dist/cjs.js!./toastify.css */ "./node_modules/css-loader/dist/cjs.js!./node_modules/toastify-js/src/toastify.css");

      
      
      
      
      
      
      
      
      

var options = {};

options.styleTagTransform = (_style_loader_dist_runtime_styleTagTransform_js__WEBPACK_IMPORTED_MODULE_5___default());
options.setAttributes = (_style_loader_dist_runtime_setAttributesWithoutAttributes_js__WEBPACK_IMPORTED_MODULE_3___default());

      options.insert = _style_loader_dist_runtime_insertBySelector_js__WEBPACK_IMPORTED_MODULE_2___default().bind(null, "head");
    
options.domAPI = (_style_loader_dist_runtime_styleDomAPI_js__WEBPACK_IMPORTED_MODULE_1___default());
options.insertStyleElement = (_style_loader_dist_runtime_insertStyleElement_js__WEBPACK_IMPORTED_MODULE_4___default());

var update = _style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_css_loader_dist_cjs_js_toastify_css__WEBPACK_IMPORTED_MODULE_6__["default"], options);




       /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_css_loader_dist_cjs_js_toastify_css__WEBPACK_IMPORTED_MODULE_6__["default"] && _css_loader_dist_cjs_js_toastify_css__WEBPACK_IMPORTED_MODULE_6__["default"].locals ? _css_loader_dist_cjs_js_toastify_css__WEBPACK_IMPORTED_MODULE_6__["default"].locals : undefined);


/***/ },

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js"
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
(module) {

"use strict";


var stylesInDOM = [];
function getIndexByIdentifier(identifier) {
  var result = -1;
  for (var i = 0; i < stylesInDOM.length; i++) {
    if (stylesInDOM[i].identifier === identifier) {
      result = i;
      break;
    }
  }
  return result;
}
function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];
  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var indexByIdentifier = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3],
      supports: item[4],
      layer: item[5]
    };
    if (indexByIdentifier !== -1) {
      stylesInDOM[indexByIdentifier].references++;
      stylesInDOM[indexByIdentifier].updater(obj);
    } else {
      var updater = addElementStyle(obj, options);
      options.byIndex = i;
      stylesInDOM.splice(i, 0, {
        identifier: identifier,
        updater: updater,
        references: 1
      });
    }
    identifiers.push(identifier);
  }
  return identifiers;
}
function addElementStyle(obj, options) {
  var api = options.domAPI(options);
  api.update(obj);
  var updater = function updater(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap && newObj.supports === obj.supports && newObj.layer === obj.layer) {
        return;
      }
      api.update(obj = newObj);
    } else {
      api.remove();
    }
  };
  return updater;
}
module.exports = function (list, options) {
  options = options || {};
  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];
    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDOM[index].references--;
    }
    var newLastIdentifiers = modulesToDom(newList, options);
    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];
      var _index = getIndexByIdentifier(_identifier);
      if (stylesInDOM[_index].references === 0) {
        stylesInDOM[_index].updater();
        stylesInDOM.splice(_index, 1);
      }
    }
    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ },

/***/ "./node_modules/style-loader/dist/runtime/insertBySelector.js"
/*!********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/insertBySelector.js ***!
  \********************************************************************/
(module) {

"use strict";


var memo = {};

/* istanbul ignore next  */
function getTarget(target) {
  if (typeof memo[target] === "undefined") {
    var styleTarget = document.querySelector(target);

    // Special case to return head of iframe instead of iframe itself
    if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
      try {
        // This will throw an exception if access to iframe is blocked
        // due to cross-origin restrictions
        styleTarget = styleTarget.contentDocument.head;
      } catch (e) {
        // istanbul ignore next
        styleTarget = null;
      }
    }
    memo[target] = styleTarget;
  }
  return memo[target];
}

/* istanbul ignore next  */
function insertBySelector(insert, style) {
  var target = getTarget(insert);
  if (!target) {
    throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
  }
  target.appendChild(style);
}
module.exports = insertBySelector;

/***/ },

/***/ "./node_modules/style-loader/dist/runtime/insertStyleElement.js"
/*!**********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/insertStyleElement.js ***!
  \**********************************************************************/
(module) {

"use strict";


/* istanbul ignore next  */
function insertStyleElement(options) {
  var element = document.createElement("style");
  options.setAttributes(element, options.attributes);
  options.insert(element, options.options);
  return element;
}
module.exports = insertStyleElement;

/***/ },

/***/ "./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js"
/*!**********************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/setAttributesWithoutAttributes.js ***!
  \**********************************************************************************/
(module, __unused_webpack_exports, __webpack_require__) {

"use strict";


/* istanbul ignore next  */
function setAttributesWithoutAttributes(styleElement) {
  var nonce =  true ? __webpack_require__.nc : 0;
  if (nonce) {
    styleElement.setAttribute("nonce", nonce);
  }
}
module.exports = setAttributesWithoutAttributes;

/***/ },

/***/ "./node_modules/style-loader/dist/runtime/styleDomAPI.js"
/*!***************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/styleDomAPI.js ***!
  \***************************************************************/
(module) {

"use strict";


/* istanbul ignore next  */
function apply(styleElement, options, obj) {
  var css = "";
  if (obj.supports) {
    css += "@supports (".concat(obj.supports, ") {");
  }
  if (obj.media) {
    css += "@media ".concat(obj.media, " {");
  }
  var needLayer = typeof obj.layer !== "undefined";
  if (needLayer) {
    css += "@layer".concat(obj.layer.length > 0 ? " ".concat(obj.layer) : "", " {");
  }
  css += obj.css;
  if (needLayer) {
    css += "}";
  }
  if (obj.media) {
    css += "}";
  }
  if (obj.supports) {
    css += "}";
  }
  var sourceMap = obj.sourceMap;
  if (sourceMap && typeof btoa !== "undefined") {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  }

  // For old IE
  /* istanbul ignore if  */
  options.styleTagTransform(css, styleElement, options.options);
}
function removeStyleElement(styleElement) {
  // istanbul ignore if
  if (styleElement.parentNode === null) {
    return false;
  }
  styleElement.parentNode.removeChild(styleElement);
}

/* istanbul ignore next  */
function domAPI(options) {
  if (typeof document === "undefined") {
    return {
      update: function update() {},
      remove: function remove() {}
    };
  }
  var styleElement = options.insertStyleElement(options);
  return {
    update: function update(obj) {
      apply(styleElement, options, obj);
    },
    remove: function remove() {
      removeStyleElement(styleElement);
    }
  };
}
module.exports = domAPI;

/***/ },

/***/ "./node_modules/style-loader/dist/runtime/styleTagTransform.js"
/*!*********************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/styleTagTransform.js ***!
  \*********************************************************************/
(module) {

"use strict";


/* istanbul ignore next  */
function styleTagTransform(css, styleElement) {
  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css;
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild);
    }
    styleElement.appendChild(document.createTextNode(css));
  }
}
module.exports = styleTagTransform;

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
/******/ 			id: moduleId,
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
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			const getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter/value functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			if(Array.isArray(definition)) {
/******/ 				var i = 0;
/******/ 				while(i < definition.length) {
/******/ 					var key = definition[i++];
/******/ 					var binding = definition[i++];
/******/ 					if(!__webpack_require__.o(exports, key)) {
/******/ 						if(binding === 0) {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, value: definition[i++] });
/******/ 						} else {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, get: binding });
/******/ 						}
/******/ 					} else if(binding === 0) { i++; }
/******/ 				}
/******/ 			} else {
/******/ 				for(var key in definition) {
/******/ 					if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 						Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 					}
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.hasOwn(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/nonce */
/******/ 	(() => {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	})();
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";
/*!**************************************************!*\
  !*** ./assets/src/js/lp-input-search-suggest.js ***!
  \**************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   LpInputSearchSuggest: () => (/* binding */ LpInputSearchSuggest)
/* harmony export */ });
/* harmony import */ var lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lpAssetsJsPath/utils.js */ "./assets/src/js/utils.js");
/* harmony import */ var lpAssetsJsPath_lpToastify_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lpAssetsJsPath/lpToastify.js */ "./assets/src/js/lpToastify.js");
/**
 * Input search suggest (autocomplete): type to search, click a result to select it.
 *
 * HTML is printed by AdminInputSearchSuggest::layout() (PHP):
 * <div class="lp-wrap-input-search-suggest">
 *   <input type="text" class="lp-input-search-suggest">
 *   <input type="hidden" class="lp-input-search-suggest-value" name="...">
 *   <div class="lp-search-suggest-result"><div class="lp-target" data-send="..."></div></div>
 * </div>
 *
 * Keyboard on the text input: ArrowDown/ArrowUp move through the list, Enter selects the active item,
 * Escape closes the list.
 *
 * Multiple select (wrapper has data-type-select="multiple", items have a checkbox):
 * selecting an item toggles its ID in the hidden input (ex: 1,2,3), the list stays open
 * until a click outside or Escape. Focusing the input without a keyword lists the selected items (checked).
 * Search results: the selected items are listed first, followed by the results not selected yet.
 * Event detail has more: ids (array), item: { id, text, checked }.
 * The button "Clear all" (first row of the list) unselects all items: hidden input is empty, item is null.
 *
 * When an item is selected, event `lp-search-suggest-selected` is dispatched on the wrapper (bubbles),
 * detail: { id, text, elWrap }.
 *
 * @since 4.4.14
 * @version 1.0.0
 */


class LpInputSearchSuggest {
  static selectors = {
    elWrap: '.lp-wrap-input-search-suggest',
    elInput: '.lp-input-search-suggest',
    elInputValue: '.lp-input-search-suggest-value',
    elResult: '.lp-search-suggest-result',
    elItem: '.lp-search-suggest-item',
    elLPTarget: '.lp-target',
    elCheckbox: '.lp-search-suggest-checkbox',
    elActions: '.lp-search-suggest-actions',
    elBtnClearAll: '.lp-search-suggest-clear-all'
  };
  static typeSelectMultiple = 'multiple';

  // Class of the items selected (multiple select).
  static classItemSelected = 'is-selected';
  static eventSelected = 'lp-search-suggest-selected';

  // Class of the item chosen with the keyboard.
  static classItemActive = 'is-active';
  static debounceWait = 500;
  constructor() {
    // One debounced function per input, so components on the same page do not cancel each other.
    this.debouncedFetches = new WeakMap();
    // Token per input, changed on every typing/selection: older pending or running requests become stale.
    this.tokens = new WeakMap();
    // Multiple select: items selected of each wrapper, Map( id => <li> ), to list them again on focus.
    this.itemsSelected = new WeakMap();
    // Multiple select: row of the button "Clear all" of each wrapper, to print it in the lists built by JS.
    this.elsActions = new WeakMap();
  }
  init() {
    this.events();
  }
  events() {
    // Check and attach events only once.
    if (LpInputSearchSuggest._loadedEvents) {
      return;
    }
    LpInputSearchSuggest._loadedEvents = this;
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('input', [{
      selector: LpInputSearchSuggest.selectors.elInput,
      callBack: this.handleInput.bind(this)
    }]);
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('focusin', [{
      selector: LpInputSearchSuggest.selectors.elInput,
      callBack: this.handleFocus.bind(this)
    }]);
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('keydown', [{
      selector: LpInputSearchSuggest.selectors.elInput,
      callBack: this.handleKeydown.bind(this)
    }]);
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('click', [{
      selector: LpInputSearchSuggest.selectors.elItem,
      callBack: this.selectItem.bind(this)
    }, {
      selector: LpInputSearchSuggest.selectors.elBtnClearAll,
      callBack: this.clearAll.bind(this)
    }, {
      // Any click: close the lists the click is outside of.
      selector: 'body',
      callBack: this.closeOutside.bind(this)
    }]);
  }

  /**
   * Get elements of the component which contains the element.
   *
   * @param {HTMLElement} el Element inside the wrapper.
   * @return {Object|null} Elements, null if the structure is invalid.
   */
  getElements(el) {
    const {
      selectors
    } = LpInputSearchSuggest;
    const elWrap = el.closest(selectors.elWrap);
    if (!elWrap) {
      return null;
    }
    const elInput = elWrap.querySelector(selectors.elInput);
    const elInputValue = elWrap.querySelector(selectors.elInputValue);
    const elResult = elWrap.querySelector(selectors.elResult);
    const elLPTarget = elResult?.querySelector(selectors.elLPTarget);
    if (!elInput || !elInputValue || !elLPTarget) {
      return null;
    }
    return {
      elWrap,
      elInput,
      elInputValue,
      elResult,
      elLPTarget
    };
  }

  /**
   * Change the token of the input, so pending and running requests of it are ignored.
   *
   * @param {HTMLElement} elInput The text input.
   * @return {number} The new token.
   */
  newToken(elInput) {
    const token = (this.tokens.get(elInput) || 0) + 1;
    this.tokens.set(elInput, token);
    return token;
  }

  /**
   * Called when the user types.
   *
   * @param {Object} args Event arguments.
   */
  handleInput(args) {
    const els = this.getElements(args.target);
    if (!els) {
      return;
    }
    const {
      elWrap,
      elInput,
      elInputValue,
      elResult,
      elLPTarget
    } = els;
    const isMultiple = this.isMultiple(elWrap);
    if (isMultiple) {
      // Keep the items selected before the list is replaced.
      this.getItemsSelected(els);
    } else {
      // The text changed, so the selected ID is no longer valid.
      elInputValue.value = elInput.value;
    }
    const token = this.newToken(elInput);

    // Empty text: no request. Multiple: list the items selected, single: clear the list.
    if (elInput.value.trim() === '') {
      this.setLoading(elWrap, elLPTarget, 0);
      if (isMultiple) {
        this.renderItemsSelected(els);
        return;
      }
      elLPTarget.innerHTML = '';
      lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 0);
      return;
    }
    let debouncedFetch = this.debouncedFetches.get(elInput);
    if (!debouncedFetch) {
      debouncedFetch = lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.debounce(params => {
        this.fetchSuggest(params.elInput, params.token);
      }, LpInputSearchSuggest.debounceWait);
      this.debouncedFetches.set(elInput, debouncedFetch);
    }
    debouncedFetch({
      elInput,
      token
    });
  }

  /**
   * Show the list again when the input is focused and still has results.
   * Multiple select without a keyword: list the items selected (checked).
   *
   * @param {Object} args Event arguments.
   */
  handleFocus(args) {
    const els = this.getElements(args.target);
    if (!els) {
      return;
    }
    if (this.isMultiple(els.elWrap) && els.elInput.value.trim() === '') {
      this.renderItemsSelected(els);
      return;
    }
    if (els.elLPTarget.innerHTML === '') {
      return;
    }
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(els.elResult, 1);
  }

  /**
   * Keyboard on the text input, like a select:
   * ArrowDown/ArrowUp move the active item, Enter selects it, Escape closes the list.
   *
   * @param {Object} args Event arguments.
   */
  handleKeydown(args) {
    const {
      e
    } = args;
    if (!['ArrowDown', 'ArrowUp', 'Enter', 'Escape'].includes(e.key)) {
      return;
    }
    const els = this.getElements(args.target);
    if (!els) {
      return;
    }
    const {
      elResult,
      elLPTarget
    } = els;
    const {
      selectors,
      classItemActive
    } = LpInputSearchSuggest;
    const elItems = Array.from(elLPTarget.querySelectorAll(selectors.elItem));
    const isOpen = elItems.length > 0 && !elResult.classList.contains(lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpClassName.hidden);
    const indexActive = elItems.findIndex(elItem => elItem.classList.contains(classItemActive));
    if (e.key === 'Escape') {
      if (isOpen) {
        e.preventDefault();
        lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 0);
      }
      return;
    }
    if (e.key === 'Enter') {
      // Without an active item, Enter keeps its default behavior.
      if (isOpen && indexActive >= 0) {
        e.preventDefault();
        this.chooseItem(elItems[indexActive]);
      }
      return;
    }
    if (!elItems.length) {
      return;
    }

    // Do not move the caret of the input.
    e.preventDefault();

    // The list was closed: open it again, keep the active item.
    if (!isOpen) {
      lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 1);
      if (indexActive >= 0) {
        return;
      }
    }

    // Stop at the first/last item, like a select.
    let indexNew;
    if (e.key === 'ArrowDown') {
      indexNew = Math.min(indexActive + 1, elItems.length - 1);
    } else {
      indexNew = indexActive < 0 ? elItems.length - 1 : Math.max(indexActive - 1, 0);
    }
    elItems.forEach((elItem, index) => {
      elItem.classList.toggle(classItemActive, index === indexNew);
    });
    elItems[indexNew].scrollIntoView?.({
      block: 'nearest'
    });
  }

  /**
   * Fetch the list of suggestions.
   *
   * @param {HTMLElement} elInput The text input.
   * @param {number}      token   Token created when the user typed.
   */
  fetchSuggest(elInput, token) {
    const els = this.getElements(elInput);
    if (!els) {
      return;
    }
    const {
      elWrap,
      elResult,
      elLPTarget
    } = els;
    // The user typed again, selected an item or cleared the text while waiting/fetching.
    const isStale = () => this.tokens.get(elInput) !== token;
    const search = elInput.value.trim();
    if (isStale() || search === '') {
      return;
    }
    const dataSend = window.lpAJAXG.getDataSetCurrent(elLPTarget);
    dataSend.args.search = search;
    dataSend.args.paged = 1;
    window.lpAJAXG.setDataSetCurrent(elLPTarget, dataSend);
    this.setLoading(elWrap, elLPTarget, 1);
    window.lpAJAXG.fetchAJAX(dataSend, {
      success: response => {
        if (isStale()) {
          return;
        }
        const {
          status,
          message,
          data
        } = response;
        if (status === 'error') {
          lpAssetsJsPath_lpToastify_js__WEBPACK_IMPORTED_MODULE_1__.show(message, 'error');
          return;
        }

        // Multiple: get the items selected before the list is replaced.
        const itemsSelected = this.isMultiple(elWrap) ? this.getItemsSelected(els) : null;
        elLPTarget.innerHTML = data?.content || '';
        if (itemsSelected) {
          this.prependItemsSelected(els, itemsSelected);
        }
        this.syncItemsChecked(els);
        lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 1);
      },
      error: error => {
        lpAssetsJsPath_lpToastify_js__WEBPACK_IMPORTED_MODULE_1__.show(error?.message || error, 'error');
      },
      completed: () => {
        // The loading is handled by the newer request, the selection or the clearing.
        if (isStale()) {
          return;
        }
        this.setLoading(elWrap, elLPTarget, 0);
      }
    });
  }

  /**
   * Called when an item of the list is clicked.
   *
   * @param {Object} args Event arguments.
   */
  selectItem(args) {
    this.chooseItem(args.target.closest(LpInputSearchSuggest.selectors.elItem));
  }

  /**
   * Select an item: fill the inputs, close the list, dispatch the event.
   *
   * @param {HTMLElement|null} elItem Item of the list.
   */
  chooseItem(elItem) {
    const els = elItem ? this.getElements(elItem) : null;
    if (!els) {
      return;
    }
    const {
      elWrap,
      elInput,
      elInputValue,
      elResult,
      elLPTarget
    } = els;
    const id = elItem.dataset.id || '';
    const text = elItem.dataset.text || '';
    if (elItem.dataset.typeSelect === LpInputSearchSuggest.typeSelectMultiple) {
      this.toggleItem(elItem, els);
      return;
    }
    elInput.value = text;
    elInputValue.value = id;

    // Cancel pending/running requests and remove the list, it does not match the new text.
    this.newToken(elInput);
    this.setLoading(elWrap, elLPTarget, 0);
    elLPTarget.innerHTML = '';
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 0);
    elWrap.dispatchEvent(new CustomEvent(LpInputSearchSuggest.eventSelected, {
      bubbles: true,
      detail: {
        id,
        text,
        elWrap
      }
    }));
  }

  /**
   * Multiple select: check/uncheck an item, the hidden input has the IDs separated by comma (ex: 1,2,3).
   * The list stays open and the keyword is kept.
   *
   * @param {HTMLElement} elItem Item of the list.
   * @param {Object}      els    Elements of the component.
   */
  toggleItem(elItem, els) {
    const {
      elWrap,
      elInputValue
    } = els;
    const id = elItem.dataset.id || '';
    const text = elItem.dataset.text || '';
    if (id === '') {
      return;
    }
    const itemsSelected = this.getItemsSelected(els);
    let ids = this.getIds(elInputValue);
    const checked = !ids.includes(id);
    if (checked) {
      ids.push(id);
      itemsSelected.set(id, elItem.cloneNode(true));
    } else {
      ids = ids.filter(idSelected => idSelected !== id);
      itemsSelected.delete(id);
    }
    elInputValue.value = ids.join(',');
    this.syncItemsChecked(els);
    elWrap.dispatchEvent(new CustomEvent(LpInputSearchSuggest.eventSelected, {
      bubbles: true,
      detail: {
        id: elInputValue.value,
        ids,
        item: {
          id,
          text,
          checked
        },
        text,
        elWrap
      }
    }));
  }

  /**
   * Multiple select: called when the button "Clear all" is clicked, unselect all items.
   * With a keyword the list stays open and the rows stay in place unchecked;
   * without a keyword (list of the items selected) the list is emptied and closed.
   *
   * @param {Object} args Event arguments.
   */
  clearAll(args) {
    const {
      e,
      target
    } = args;
    const els = this.getElements(target);
    if (!els) {
      return;
    }
    e.preventDefault();
    const {
      elWrap,
      elInput,
      elInputValue
    } = els;
    this.getElActions(els);
    elInputValue.value = '';
    this.itemsSelected.get(elWrap)?.clear();
    this.syncItemsChecked(els);
    // The button is hidden now, keep the focus in the component.
    elInput.focus?.();
    elWrap.dispatchEvent(new CustomEvent(LpInputSearchSuggest.eventSelected, {
      bubbles: true,
      detail: {
        id: '',
        ids: [],
        item: null,
        text: '',
        elWrap
      }
    }));
  }

  /**
   * Multiple select: get the row of the button "Clear all" (a clone, to print in the lists built by JS).
   * It is printed by PHP in every list, remember it when it is seen.
   *
   * @param {Object} els Elements of the component.
   * @return {HTMLElement|null} The row, null if no list was printed yet.
   */
  getElActions(els) {
    const {
      elWrap,
      elLPTarget
    } = els;
    const elActions = elLPTarget.querySelector(LpInputSearchSuggest.selectors.elActions);
    if (elActions) {
      this.elsActions.set(elWrap, elActions.cloneNode(true));
    }
    return this.elsActions.get(elWrap) || null;
  }

  /**
   * Check the component is multiple select.
   *
   * @param {HTMLElement} elWrap The wrapper.
   * @return {boolean} True if multiple select.
   */
  isMultiple(elWrap) {
    const {
      selectors,
      typeSelectMultiple
    } = LpInputSearchSuggest;
    if (elWrap.dataset.typeSelect === typeSelectMultiple) {
      return true;
    }

    // The wrapper is not marked (ex: custom layout): detect by the items of the list
    // or by the args sent via AJAX, so a new search never clears the items selected.
    let isMultiple = !!elWrap.querySelector(`${selectors.elItem}[data-type-select="${typeSelectMultiple}"]`);
    if (!isMultiple) {
      try {
        const dataSend = JSON.parse(elWrap.querySelector(selectors.elLPTarget)?.dataset.send || '{}');
        isMultiple = dataSend?.args?.type_select === typeSelectMultiple;
      } catch (e) {
        isMultiple = false;
      }
    }
    if (isMultiple) {
      elWrap.dataset.typeSelect = typeSelectMultiple;
    }
    return isMultiple;
  }

  /**
   * Get the IDs selected from the hidden input.
   *
   * @param {HTMLElement} elInputValue The hidden input.
   * @return {string[]} IDs.
   */
  getIds(elInputValue) {
    return elInputValue.value.split(',').map(id => id.trim()).filter(id => id !== '');
  }

  /**
   * Multiple select: get the items selected of the component, Map( id => <li> ).
   * Items of the current list which are selected (ex: printed by PHP) are added,
   * items which are no longer in the hidden input are removed.
   *
   * @param {Object} els Elements of the component.
   * @return {Map} Items selected.
   */
  getItemsSelected(els) {
    const {
      elWrap,
      elInputValue,
      elLPTarget
    } = els;
    // The list is about to be replaced: remember the row of the button "Clear all" too.
    this.getElActions(els);
    let itemsSelected = this.itemsSelected.get(elWrap);
    if (!itemsSelected) {
      itemsSelected = new Map();
      this.itemsSelected.set(elWrap, itemsSelected);
    }
    const ids = this.getIds(elInputValue);
    elLPTarget.querySelectorAll(LpInputSearchSuggest.selectors.elItem).forEach(elItem => {
      const id = elItem.dataset.id || '';
      if (ids.includes(id) && !itemsSelected.has(id)) {
        itemsSelected.set(id, elItem.cloneNode(true));
      }
    });
    itemsSelected.forEach((elItem, id) => {
      if (!ids.includes(id)) {
        itemsSelected.delete(id);
      }
    });
    return itemsSelected;
  }

  /**
   * Multiple select: show the list of the items selected (checked), in the order of the hidden input.
   *
   * @param {Object} els Elements of the component.
   */
  renderItemsSelected(els) {
    const {
      elInputValue,
      elResult,
      elLPTarget
    } = els;
    const itemsSelected = this.getItemsSelected(els);
    elLPTarget.innerHTML = '';
    if (!itemsSelected.size) {
      lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 0);
      return;
    }
    const elList = document.createElement('ul');
    elList.className = 'lp-search-suggest-list';
    const elActions = this.elsActions.get(els.elWrap);
    if (elActions) {
      elList.appendChild(elActions.cloneNode(true));
    }
    this.getIds(elInputValue).forEach(id => {
      const elItem = itemsSelected.get(id);
      if (elItem) {
        elList.appendChild(elItem.cloneNode(true));
      }
    });
    elLPTarget.appendChild(elList);
    this.syncItemsChecked(els);
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elResult, 1);
  }

  /**
   * Multiple select: put the items selected at the top of the list of results,
   * followed by the results which are not selected yet.
   *
   * @param {Object} els           Elements of the component.
   * @param {Map}    itemsSelected Items selected, Map( id => <li> ).
   */
  prependItemsSelected(els, itemsSelected) {
    const {
      elInputValue,
      elLPTarget
    } = els;
    // No list: the content is a message (ex: error).
    const elList = elLPTarget.querySelector('.lp-search-suggest-list');
    if (!elList || !itemsSelected.size) {
      return;
    }

    // Results already selected are listed at the top only.
    elList.querySelectorAll(LpInputSearchSuggest.selectors.elItem).forEach(elItem => {
      if (itemsSelected.has(elItem.dataset.id || '')) {
        elItem.remove();
      }
    });

    // After the row of the button "Clear all".
    const elActions = elList.querySelector(LpInputSearchSuggest.selectors.elActions);
    const elFirst = elActions ? elActions.nextSibling : elList.firstChild;
    this.getIds(elInputValue).forEach(id => {
      const elItem = itemsSelected.get(id);
      if (elItem) {
        elList.insertBefore(elItem.cloneNode(true), elFirst);
      }
    });
  }

  /**
   * Multiple select: check the items of the list which are in the hidden input, uncheck the others.
   *
   * @param {Object} els Elements of the component.
   */
  syncItemsChecked(els) {
    const {
      elWrap,
      elInputValue,
      elLPTarget
    } = els;
    if (!this.isMultiple(elWrap)) {
      return;
    }
    const {
      selectors,
      classItemSelected,
      classItemActive
    } = LpInputSearchSuggest;
    const ids = this.getIds(elInputValue);
    elLPTarget.querySelectorAll(selectors.elItem).forEach(elItem => {
      const checked = ids.includes(elItem.dataset.id || '');
      const elCheckbox = elItem.querySelector(selectors.elCheckbox);
      elItem.classList.toggle(classItemSelected, checked);
      if (elCheckbox) {
        elCheckbox.checked = checked;
      }
    });

    // The button "Clear all" is shown only when an item is selected.
    elLPTarget.querySelectorAll(selectors.elActions).forEach(elActions => {
      lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elActions, ids.length > 0 ? 1 : 0);
    });

    // Items cloned from an older list must not stay active.
    this.itemsSelected.get(elWrap)?.forEach(elItem => elItem.classList.remove(classItemActive));
  }

  /**
   * Close the lists when clicking outside of their component.
   *
   * @param {Object} args Event arguments.
   */
  closeOutside(args) {
    const {
      selectors
    } = LpInputSearchSuggest;
    const elWrapClicked = args.target.closest(selectors.elWrap);
    document.querySelectorAll(selectors.elWrap).forEach(elWrap => {
      if (elWrap === elWrapClicked) {
        return;
      }
      lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpShowHideEl(elWrap.querySelector(selectors.elResult), 0);
    });
  }

  /**
   * Show/hide loading.
   *
   * @param {HTMLElement} elWrap     The wrapper.
   * @param {HTMLElement} elLPTarget The target of the AJAX content.
   * @param {number}      status     1: show, 0: hide.
   */
  setLoading(elWrap, elLPTarget, status) {
    lpAssetsJsPath_utils_js__WEBPACK_IMPORTED_MODULE_0__.lpSetLoadingEl(elWrap, status);
    window.lpAJAXG.showHideLoading(elLPTarget, status);
  }
}
new LpInputSearchSuggest().init();
})();

/******/ })()
;
//# sourceMappingURL=lp-input-search-suggest.js.map