# Task: Uniqueization of child wordpress theme wordpress\wp-content\themes\pure-theme (pure-theme)

## Task Context

We are customizing the child theme `pure-theme`. It is necessary to uniqueize the child theme, update css class names in scss files and php templates, update js and php function names

**Stack:** Docker, WordPress, Advanced Custom Fields (ACF Pro), PHP 8.1, JS, SCSS, MySQL.

---

## Acceptance Criteria (Definition of Done)

* [ ] ACF field group is registered via acf-json and stored at the path `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] The key for each group of registered json-acf fields must be updated in the folder `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] In all .scss, .css, .js, .php, .html, .json, .txt files, the placeholder `brand`, `gtag_id`, `domain` must be replaced with the actual, real brand.
* [ ] All indentations in the SCSS styles located at `wordpress\wp-content\themes\pure-theme\src\scss` must be updated.
* [ ] The theme name must be updated to the current one. All paths must reflect the current theme name; for example, it used to be `wordpress\wp-content\themes\nexus-theme\src\scss` and is now `wordpress\wp-content\themes\pure-theme\src\scss`.

---

## Placeholders and their values

* `brand` => `nexus`.
* `domain` => `https://nexus.ai`.
* `gtag_id` => `G-444AW5568`.

---

## Step-by-step implementation plan (Instructions for AI)

### Step 1: Working with fields ACF

* [ ] Open the file `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] Update the names of json files and `key` keys inside each file to uniqueize acf field groups.

### Step 2: Replacing all placeholders with actual values

* [ ] Be sure to maintain proper capitalization when replacing placeholders. If a placeholder begins with a capital letter, its value must also begin with a capital letter. For example, if the placeholder is `brand`, the value should be `nexus`; if the placeholder is `Brand`,
* [ ] Rename the theme folder name `pure-theme` at the path `wordpress\wp-content\themes\pure-theme` to the name `nexus-theme`.
* [ ] Update all lines containing `src` that include `pure-theme` and replace them with `nexus-theme`.
* [ ] inside the `wordpress\wp-content\themes\pure-theme` theme, the new path of which will now look like `wordpress\wp-content\themes\nexus-theme`, perform the following actions. In all theme files, replace placeholders `brand`, `domain`, `gtag_id` with actual values from the section ## Placeholders and their values.
* [ ] Uniqueize the `style.css` file at the path `wordpress\wp-content\themes\pure-theme\style.css`. Uniqueize and update the following values:
  * `Theme Name:` specify the actual brand
  * `Theme URI:` specify the actual domain
  * `Description:` generate a short description up to 100 characters.
  * `Author:` generate author name.
  * `Author URI:` generate a link to the author's website.
  * `Template:` specify the name of the parent theme.
  * `Version:` generate theme version.
  * `Text Domain:` specify the actual brand



### Step 3: Styling (CSS)

* [ ] Update the `src` for fonts in the file `wordpress\wp-content\themes\pure-theme\src\scss\base\fonts.scss`. The `src` for fonts should now use the updated name of the child theme, `nexus-theme`, instead of `pure-theme`. For example, `/wp-content/themes/pure-theme/fonts/Raleway/Raleway-Regular.woff2` should be changed to `/wp-content/themes/nexus-theme/fonts/Raleway/Raleway-Regular.woff2`.
 * [ ] Update all spacing values: `gap, margin, margin-top, margin-bottom, margin-left, margin-right, padding, padding-top, padding-bottom, padding-left, padding-right`. You need to change the values by randomly decreasing or increasing the spacing by `10–15%` of the current value.  All values must be wrapped in the `rem()` function, for example, `rem(24)`. All spacing values are located in the `scss` files within the parent folder at the path `wordpress\wp-content\themes\pure-theme\src\scss`.

---

## Constraints and rules for the Agent

* **Security:** Be sure to sanitize data output via `esc_html()` for text fields inside the table.
* **Code Style:** Adhere to WordPress Web Dev Standards (spaces inside parentheses: `if ( ! empty( $var ) )`).
* **Prohibited:** Do not modify parent theme files. Work strictly inside the folder of the child theme `pure-theme`.
* **Logging:** If the ACF plugin is not active, the function should not cause a Fatal Error, do a soft `return $content`.