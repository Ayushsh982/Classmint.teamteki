/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	const __webpack_require__ = {};
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
/*!***************************************************!*\
  !*** ./assets/src/apps/js/frontend/lp-configs.js ***!
  \***************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   classNames: () => (/* binding */ classNames),
/* harmony export */   isQuestionCorrect: () => (/* binding */ isQuestionCorrect),
/* harmony export */   questionBlocks: () => (/* binding */ questionBlocks),
/* harmony export */   questionChecker: () => (/* binding */ questionChecker),
/* harmony export */   questionFooterButtons: () => (/* binding */ questionFooterButtons),
/* harmony export */   questionTitleParts: () => (/* binding */ questionTitleParts),
/* harmony export */   quizStartBlocks: () => (/* binding */ quizStartBlocks)
/* harmony export */ });
const {
  Hook
} = LP;
const classNames = {
  Quiz: {
    Result: ['quiz-result'],
    Content: ['quiz-content'],
    Questions: ['quiz-questions'],
    Buttons: ['quiz-buttons'],
    Attempts: ['quiz-attempts']
  }
};
const questionCheckers = {
  single_choice() {},
  multi_choice() {},
  true_or_false() {}
};
const isQuestionCorrect = {
  fill_in_blank() {
    return true;
  }
};

/**
 * Question blocks.
 *
 * Allow to sort the blocks of question
 */
const questionBlocks = function () {
  return LP.Hook.applyFilters('question-blocks', ['title', 'content', 'answer-options', 'explanation', 'hint', 'buttons']);
};
const questionFooterButtons = function () {
  return LP.Hook.applyFilters('question-footer-buttons', ['instant-check']);
};
const questionTitleParts = function () {
  return LP.Hook.applyFilters('question-title-parts', ['index', 'title', 'hint', 'edit-permalink']);
};
const questionChecker = function (type) {
  const c = LP.Hook.applyFilters('question-checkers', questionCheckers);
  return type && c[type] ? c[type] : function () {
    return {};
  };
};
const quizStartBlocks = function () {
  const blocks = Hook.applyFilters('quiz-start-blocks', {
    meta: true,
    description: true,
    custom: 'Hello'
  });
};
(window.LP = window.LP || {}).config = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=lp-configs.js.map