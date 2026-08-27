# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

LearnPress Prerequisites Courses is a WordPress add-on for [LearnPress](https://github.com/LearnPress/learnpress) LMS. It enforces prerequisite course completion before a user can enroll in, purchase, or view content of a course. Requires LearnPress >= 4.3.2.7.

## Build & Development Commands

```bash
# Install dependencies
npm install
composer install     # includes dev tools (phpcs/wpcs)

# Build JS (production, outputs .min.js)
npm run build

# Watch JS (development, outputs .js)
npm run start

# Compile SCSS → CSS, generate RTL, minify, and create release zip
gulp                 # runs full pipeline: clearAll → styles → createRTLCss → minCss → copyFilesToRelease → zipRelease

# Watch SCSS only
gulp watch

# Full release build (composer update --no-dev + build + makepot + gulp)
npm run build-makepot-zip

# Development release (starts webpack watch, then runs build-makepot-zip in parallel)
npm run release
```

### Linting & Formatting

```bash
# PHP lint (WordPress-Core standard with exclusions defined in phpcs.xml)
composer lint

# PHP auto-fix
composer format

# JS format
npm run format

# Generate .pot translation file
npm run makepot
```

**Note:** `phpcs.xml` file paths reference `./incs/` and `./templates/` and `learnpress-woo-payment.php` — these are inherited from another addon and need updating if you want phpcs to scan this addon's actual files (`./inc/`, `learnpress-prerequisites-courses.php`).

## Architecture

### Plugin Bootstrap Chain

1. **`learnpress-prerequisites-courses.php`** — Entry point. Defines constants, creates `LP_Addon_Prerequisites_Courses_Preload` singleton. Waits for `learn-press/ready` action before loading addon code.
2. **`inc/load.php`** — `LP_Addon_Prerequisites_Courses` extends `LP_Addon` (from LearnPress core). Contains business logic: checking prerequisite conditions, generating HTML messages, managing course meta keys.
3. **`inc/PrerequisiteHook.php`** — `LearnPress\Prerequisite\PrerequisiteHook` registers all WordPress/LearnPress filters and actions. Handles enrollment, purchase, and content-view gating.

### PSR-4 Autoloading

Namespace `LearnPress\Prerequisite\` maps to `inc/` via Composer. Core LearnPress models (`CourseModel`, `UserModel`, `UserCourseModel`) are imported from the parent plugin.

### Key WordPress Hooks

| Hook | Purpose |
|------|---------|
| `learn-press/user/can-enroll/course` | Block enrollment if prerequisites not passed |
| `learn-press/user/can-purchase/course` | Block purchase (unless "Allow Purchase" enabled) |
| `learnpress/course/can-view-content` | Block content viewing for incomplete prerequisites |
| `learnpress/course/metabox/tabs` | Add "Prerequisites Course" tab in course editor |
| `learn-press/frontend-default-styles` | Register prerequisite CSS |

### Course Meta Keys

- `_lp_course_prerequisite` — Array of prerequisite course IDs
- `_lp_prerequisite_allow_purchase` — `yes`/`no`, allows buying without completing prerequisites

### Asset Pipeline

- SCSS source: `assets/src/scss/` → compiled to `assets/dist/css/` (with RTL and minified variants)
- JS: Webpack via `@wordpress/scripts`, output to `assets/dist/js/` (currently no JS entry points configured)
- CSS is registered via `LP_Asset_Key` and conditionally loads minified vs unminified based on `LP_Debug::is_debug()`

### Release Output

`gulp default` produces a zip at `release/learnpress-prerequisites-courses_<version>.zip` excluding dev files (node_modules, src, config files).