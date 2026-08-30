/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/utils.js"
/*!********************************!*\
  !*** ./assets/src/js/utils.js ***!
  \********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   debounce: () => (/* binding */ debounce),
/* harmony export */   eventHandlers: () => (/* binding */ eventHandlers),
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
/* harmony export */   toggleCollapse: () => (/* binding */ toggleCollapse)
/* harmony export */ });
/**
 * Utils functions
 *
 * @param url
 * @param data
 * @param functions
 * @since 4.2.5.1
 * @version 1.0.6
 */
const lpClassName = {
  hidden: 'lp-hidden',
  loading: 'loading',
  elCollapse: 'lp-collapse',
  elSectionToggle: '.lp-section-toggle',
  elTriggerToggle: '.lp-trigger-toggle'
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
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
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
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*********************************************!*\
  !*** ./assets/src/js/admin/mcp-api-keys.js ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils.js */ "./assets/src/js/utils.js");

(function () {
  'use strict';

  const cfg = window.lpMcpApiKeysSettings || {};
  if (!cfg.is_mcp_keys_section) {
    return;
  }
  const ajaxHandle = window.lpAJAXG;
  if (!ajaxHandle || typeof ajaxHandle.fetchAJAX !== 'function') {
    return;
  }
  const elSubmit = document.querySelector('#lp-mcp-key-submit');
  const elStatus = document.querySelector('#lp-mcp-key-status');
  const elReveal = document.querySelector('#lp-mcp-key-reveal');
  const elConsumerKey = document.querySelector('#lp-mcp-consumer-key');
  const elConsumerSecret = document.querySelector('#lp-mcp-consumer-secret');
  const lpDataAdmin = window.lpDataAdmin || {};
  const i18n = cfg.i18n || lpDataAdmin.i18n || {};
  const actions = cfg.actions || {};
  const setStatus = (message = '', isError = false) => {
    if (!elStatus) {
      return;
    }
    elStatus.textContent = message;
    elStatus.style.color = isError ? '#b32d2e' : '#1e1e1e';
  };
  const setLoadingState = (el, isLoading) => {
    if (!el) {
      return;
    }
    el.disabled = !!isLoading;
    el.classList.toggle('loading', !!isLoading);
  };
  const refreshKeysTable = async () => {
    const currentList = document.querySelector('.lp-mcp-key-list');
    if (!currentList) {
      return;
    }
    try {
      const response = await fetch(window.location.href, {
        method: 'GET',
        credentials: 'same-origin',
        cache: 'no-store'
      });
      if (!response.ok) {
        return;
      }
      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const newList = doc.querySelector('.lp-mcp-key-list');
      if (newList && currentList.parentNode) {
        currentList.replaceWith(newList);
      }
    } catch {
      // Keep current UI state when table refresh fails.
    }
  };
  const renderCredentials = keyData => {
    if (!keyData || !keyData.consumer_key || !keyData.consumer_secret || !elConsumerKey || !elConsumerSecret || !elReveal) {
      return;
    }
    elConsumerKey.value = keyData.consumer_key;
    elConsumerSecret.value = keyData.consumer_secret;
    elReveal.style.display = 'block';
  };
  const runRequest = (dataSend, callbacks = {}) => {
    ajaxHandle.fetchAJAX(dataSend, {
      success: response => {
        if (typeof callbacks.success === 'function') {
          callbacks.success(response);
        }
      },
      error: error => {
        if (typeof callbacks.error === 'function') {
          callbacks.error(error);
        }
      },
      completed: () => {
        if (typeof callbacks.completed === 'function') {
          callbacks.completed();
        }
      }
    });
  };
  const onSubmitKey = () => {
    if (!elSubmit) {
      return;
    }
    const elUser = document.querySelector('#lp-mcp-key-user');
    const elDescription = document.querySelector('#lp-mcp-key-description');
    const elPermissions = document.querySelector('#lp-mcp-key-permissions');
    const dataSend = {
      action: actions.create || 'mcp_create_api_key',
      user_id: elUser ? elUser.value : '',
      description: elDescription ? elDescription.value : '',
      permissions: elPermissions ? elPermissions.value : 'read'
    };
    setLoadingState(elSubmit, true);
    setStatus(i18n.processing || 'Processing...', false);
    runRequest(dataSend, {
      success: response => {
        const status = response?.status || '';
        const message = response?.message || i18n.request_failed || 'Request failed.';
        if (status !== 'success') {
          setStatus(message, true);
          return;
        }
        setStatus(message, false);
        renderCredentials(response?.data?.key || null);
        refreshKeysTable();
      },
      error: () => setStatus(i18n.request_failed || 'Request failed.', true),
      completed: () => setLoadingState(elSubmit, false)
    });
  };
  const onCopy = async elCopy => {
    const targetId = elCopy?.dataset?.target || '';
    if (!targetId) {
      return;
    }
    const input = document.querySelector(`#${targetId}`);
    if (!input) {
      return;
    }
    try {
      if (navigator.clipboard?.writeText) {
        await navigator.clipboard.writeText(input.value);
      } else {
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');
      }
      setStatus(i18n.copy_success || 'Copied.', false);
    } catch {
      setStatus(i18n.copy_fallback || 'Copy this value manually.', false);
    }
  };
  _utils_js__WEBPACK_IMPORTED_MODULE_0__.eventHandlers('click', [{
    selector: '.lp-mcp-copy',
    callBack: args => {
      const {
        target
      } = args;
      const elCopy = target.closest('.lp-mcp-copy');
      if (elCopy) {
        onCopy(elCopy);
      }
    }
  }, {
    selector: '#lp-mcp-key-submit',
    callBack: () => {
      onSubmitKey();
    }
  }]);
})();
})();

/******/ })()
;
//# sourceMappingURL=mcp-api-keys.js.map