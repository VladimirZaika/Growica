# Task: Uniqueization of child wordpress theme wordpress\wp-content\themes\pure-theme (pure-theme)

## Task Context

We are customizing the child theme `pure-theme`. It is necessary to uniqueize the child theme, update css class names in scss files and php templates, update js and php function names

**Stack:** Docker, WordPress, Advanced Custom Fields (ACF Pro), PHP 8.1, JS, SCSS, MySQL.

---

## Acceptance Criteria (Definition of Done)

* [ ] ACF field group is registered via acf-json and stored at the path `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] The key for each group of registered json-acf fields must be updated in the folder `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] In all .scss, .css, .js, .php, .html, .json, .txt files, the placeholder brand must be replaced with the actual, real brand.

---

## Placeholders and their values

* `brand` => `nexus`.
* `domain` => `https://nexus.ai`.
* `gtag_id` => `G-444AW5568`.

---

## Step-by-step implementation plan (Instructions for AI)

### Step 1: Working with fields

ACF

* [ ] Open the file `wordpress\wp-content\themes\pure-theme\acf-json`.
* [ ] Update the names of json files and `key` keys inside each file to uniqueize acf field groups.

### Step 2: Replacing all placeholders with actual values

* [ ] Rename the theme folder name `pure-theme` at the path `wordpress\wp-content\themes\pure-theme` to the name `nexus-theme`.
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

* [ ] Open the file `wp-content/themes/nexus-portal/style.css`.
* [ ] Add styles for the table to the very end of the file:
* Table borders, paddings (`padding: 12px`), alternating row background (`:nth-child(even)`).
* Specification names must be bold.
* Use CSS variables of the parent theme for colors, if available.



---

## Constraints and rules for the Agent

* **Security:** Be sure to sanitize data output via `esc_html()` for text fields inside the table.
* **Code Style:** Adhere to WordPress Web Dev Standards (spaces inside parentheses: `if ( ! empty( $var ) )`).
* **Prohibited:** Do not modify parent theme files. Work strictly inside the folder of the child theme `pure-theme`.
* **Logging:** If the ACF plugin is not active, the function should not cause a Fatal Error, do a soft `return $content`.