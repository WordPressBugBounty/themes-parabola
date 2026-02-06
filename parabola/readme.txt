=============
Parabola WordPress Theme
Copyright 2013-26 Cryout Creations

Author: Cryout Creations
Requires at least: 4.5
Tested up to: 6.9
Stable tag: 2.4.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Welcome to a world of endless possibilities!
Parabola awaits you with a huge assortment of theme settings that enable you to take a fully responsive, clean and elegant design to even newer heights. You can edit everything: all text and background colors, font families and sizes, site widths and layouts.

You also have the power to show or hide various elements of the design and choose from over 30 social media icons. Harnessing the power of HTML5 and CSS3 you will enjoy a great design, subtle animations, a great front page fully equipped with a slider, columns, textareas and shortcode support. Among other editable goodies you'll find featured images, post excerpts, post formats, Google fonts, magazine and blog layouts, 8 widget areas, translation support and much more.


== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Parabola WordPress Theme bundles the following third-party resources:

Nivo Slider, Copyright Gilbert Pellegrom
Nivo Slider is licensed under the terms of the MIT license
Source: http://dev7studios.com/nivo-slider

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
FitVids is licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

TGM Plugin Activation, Copyright Thomas Griffin
Licensed under the terms of the GNU GPL v2-or-later license
Source: http://tgmpluginactivation.com/

== Bundled Fonts ==

The extra fonts included with the theme are also under GPLv3 compatible licenses:

Oswald, Copyright 2011-2012 Vernon Adams
Licensed under the SIL Open Font License, Version 1.1
Source: https://www.google.com/fonts/specimen/Oswald

Open Sans, Copyright Steve Matteson
Licensed under the Apache License v2.00
Source: https://www.google.com/fonts/specimen/Open+Sans

Bebas Neue, Copyright Dharma Type
Licensed under the SIL Open Font License, Version 1.1
Source: http://dharmatype.com/post/84312257192/bebas-neue

Yanone Kaffeesatz, Copyright 2010, Jan Gerner
Licensed under the SIL Open Font License, Version 1.1
Source: https://www.google.com/fonts/specimen/Yanone+Kaffeesatz

SquareFont, Copyright 2011, Bou Fonts
Licensed under the SIL Open Font License, version 1.1
Source: http://www.dafont.com/squarefont.font

Propaganda, Copyright 2011, Matthew Welch
Licensed under own MIT-like license - http://www.squaregear.net/fonts/license.shtml
Source: http://www.squaregear.net/fonts/propagnd.shtml

Elusive-Icons Webfont, Copyright 2013, Aristeides Stathopoulos
Licensed under the SIL Open Font License, Version 1.1
Source: http://shoestrap.org/downloads/elusive-icons-webfont/

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://pixabay.com/en/road-mountains-sunset-path-desert-1303617/
https://pixabay.com/en/monument-valley-lightning-storm-1593318/
https://pixabay.com/en/milky-way-stars-night-sky-923738/

https://pixabay.com/en/arizona-landscape-scenic-sunset-113684/
https://pixabay.com/en/sunset-red-sky-sun-afterglow-988556/
https://unsplash.com/search/desert?photo=KQvFT4xc-gQ

All other images bundled with the theme (used in the demo presentation page and admin section, as well as the social icons) are created by Cryout Creations and released with the theme under GPLv3 as well.


== Original Translations Contributors ==

Initial translations credits:
Czech - Jenik
Dutch - PaulW, Nazder, Peter Scheele
French - Varkhan
German - Lumbra
Hebrew - Shim
Hungarian - Szemcse
Italian - Mirko Milani
Portuguese (Brazil) - Andi Meurer
Romanian - Mihai
Russian - mig0s
Spanish - Ramón Pozo

For current translation contributors, see https://translate.wordpress.org/projects/wp-themes/parabola


== Changelog ==

= 2.4.3 =
* Fixed '_load_textdomain_just_in_time() was called incorrectly' notice introduced by WordPress 6.7
* Fixed missing list bullets in blocks
* Changed footer links to be protocol agnostic and avoid warnings from automated quality check tools
* Removed legacy eot and svg bundled font formats to reduce theme size
* Bumped compatibility with WordPress 6.9

= 2.4.2 = 
* Fixed XSS vulnerability allowing the output of unsanitized user names set by rogue editors/contributors - reported by stealthcopter on patchstack.com
* Fixed PHP 8.2+ deprecation notice about using ${var}
* Added new social icons: Bluesky, Mastodon and X
* Removed obsolete social icons: GooglePlus, Steam-old, Twitter-old, Youtube-old

= 2.4.1 =

* Added site title text on header image title and alt attributes
* Added support for locally embedded custom fonts and improved handling font inheritance between options
* Improved inner paragraphs spacing in blockquotes
* Improved breadcrumbs section detection to fix invalid breadcrumbs on non-home blog page
* Improved handling of posts without featured images when generating the presentation page posts-based columns and slider
* Improved inner-content padding/margin/border styling support for custom post types 
* Fixed header image non-clickable on mobile devices (since 2.2.2)
* Fixed Notice: Undefined index: WP_Widget_Recent_Comments in includes/theme-comments.php with WP CLI
* Fixed PHP 8.1 deprecation notice in includes/theme-comments.php
* Fixed PHP 8.1 deprecation notice in includes/theme-styles.php

= 2.4.0.1 =
* Fixed Google fonts not working in 2.4.0

= 2.4.0 =
* Fixed tables hide option not disabling all borders
* Fixed sidebar links color options not working
* Fixed parabola_nextpage_links() defined twice
* Fixed Fitvids sometimes interfering with Masonry layout
* Fixed color picker not working and rendered inline in the settings
* Fixed top menu accent triangles misplaced when a background color is used for the menu
* Fixed settings tooltips unreadable due to jQuery UI transparency and color changes since WordPress 5.6
* Fixed jQuery functions deprecation warnings from jQuery 3.5 update brought by WordPress 5.6
* Fixed mobile menu dropdowns not working correctly with jQuery 3.5
* Fixed jQuery functions deprecation warning in bundled NivoSlider
* Fixed jQuery undefined functions errors with WordPress 5.7
* Fixed admin page styling applies outside its elements (on media upload form)
* Added required extra sanitization and tested up to/required PHP headers
* Added 'parabola_mainnav_id' and 'parabola_mainnav_class' filters to ease support for mega menu plugins
* Cleaned up some unused code and moved some settings page code to the companion Serious Settings plugin (in v0.5.12)
* Removed legacy favicon functionality completely as this is no longer allowed in wp.org repository themes 
* Rewrote theme styles enqueue code to use current WordPress standards ***this can result in styles loading in incorrect order if you're using a child theme with old code
* Updated bundled FitVids script to v1.1.0

= 2.3.2.2 =
* Added support for WordPress 5.2 wp_body_open() hook
* Extended content image border option to apply to Gutenberg inserted images

= 2.3.2.1 =
* Fixed a typo in functions.php that caused unexpected output

= 2.3.2 =
* Added shortcodes support in the custom footer text field
* Fixed featured images not being responsive in post excerpts
* Fixed some fonts not being selectable in the Typography options
* Fixed comment paragraphs lacking margins

= 2.3.1 =
* Added 'parabola_header_crop' filter for 'header' image size crop position attribute
* Adjusted general lists bullet styling to improve compatibility with plugins and Gutenberg
* Improved large images support in sidebars
* Gutenberg editor tweaks and improvements:
	* Improved list appearance in blocks
	* Improved horizontal ruler (hr) styling to work with Gutenberg
	* Adjusted aligned elements styling to improve compatibility with Gutenberg
	* Fixed captions alignment and sizing in Gutenberg blocks
	* Fixed block galleries margins
	* Fixed cover image blocks text appearance

= 2.3.0 =
* Added WooCommerce breadcrumbs support
* Improved 'comments moderated' text positioning
* Improved slider captions by making the slides clickable through the captions
* Improved slider administration interface by hiding unused fields when slider shortcode is used
* Changed default excerpt ellipis value to avoid settings page issues on some servers
* Cleaned up use of obsolete constants
* Fixed moderated comments not being displayed
* Fixed quantity input being too short for double digits with WooCommerce 3.3+
* Fixed create_function() deprecation usage notifications in widgets.php with PHP 7.2+
* Fixed comment form fields center alignment on checkboxes and radio controls
* Fixed theme's column widgets cannot be saved after selecting a different image

= 2.2.2 =
* Added HTML markup auto-correction on presentation page extra text areas
* Switched to using the_archive_title() and the_archive_description() for section titles and descriptions in archive.php, author.php, category.php, tag.php
* Fixed editor styling option not controlling editor-style.css enqueue
* Improved masonry initiation to check if function is available
* Fixed 'Category page with intro' page template pagination not working when set on static home page
* Improved admin styling to correct overlapping dashboard elements outside of theme's page
* Adjusted comments list appearance
* Slighly increased headings font size
* Adjusted metas information letter spacing
* Fixed header widget area not visible (hidden behind menu) on 480 to 640 screen widths
* Added new social icons for Discord, Patreon, PayPal; updated social icons for Steam, Twitter, YouTube (the old ones are still available)
* Fixed importing color schemes without a scheme selected being possible and breaking all theme options

= 2.2.1 =
* Fixed notice in comments.php since 2.2.0
* Fixed colour schemes cannot be imported since 2.2.0
* Fixed read more button missing on presentation page columns (due to global variables cleanup)
* Fixed columns from posts listed by IDs limited by WordPress' global post count limit 
* Removed social scripts in the theme's admin page and replaced with simple social profile links

= 2.2.0 =
* Added Github and TripAdvisor social icons
* Added styling to disable Chrome's built-in blue border on focused form elements
* Added explicit support for WooCommerce 3.0 new product gallery
* Adjusted social styling to reduce interference with plugins
* Improved options save sanitization procedure
* Fixed some colour options not being protected to plugin interference
* Fixed responsive styling to account for submenu arrow indicator changes in 2.1.3
* Fixed menu items displayed in wrong order on RTL
* Fixed using HTML excerpt option disabling continue reading button
* Deprecated HTML excerpt option and disabled it on new theme installs
* Replaced @import usage with enqueue for font-faces style; relocated mobile styling from inline to enqueue
* Moved presentation page code to own function
* Made 'sidebar empty' messages visible only to users with permissions to manage widgets
* Removed the use of individual global options variables and adjusted all functions to use the global options array instead
* Renamed global $fonts and $socialNetworks variables to use 'parabola_' prefix
* Cleaned up theme-loop.php; renamed several functions for consistency:
	parabola_custom_excerpt_more()     ->	parabola_excerpt_morelink()
	parabola_continue_reading_link()   ->	parabola_excerpt_continuereading_link()
	parabola_auto_excerpt_more()       ->	parabola_excerpt_dots()
	parabola_trim_excerpt()            ->	parabola_excerpt_html()
	parabola_posted_on()               ->	parabola_meta_before()
	parabola_posted_after()            ->	parabola_meta_after()

= 2.1.3 =
* Added support for external sliders in the presentation page using shortcodes
* Fixed social icons URL double sanitization (breaking special cases)
* Improved menu styling to fix double arrow and extra padding when menu-related plugins are used
* Fixed frontend.js being unminifiable due to single line comments
* Improved headings and meta lines responsiveness by switching them to relative font sizes
* Renamed .mobile body class to avoid styling overlap with plugins
* Added 'parabola_pp_nosticky' filter for sticky posts inclusion in Presentation Page posts list

= 2.1.2 = 
* Fixed failsafe styling that overrode configured font size since 2.1.1 responsiveness improvement

= 2.1.1 =
* Added filters for hardcoded values: slider post-based excerpt length and read more button label
* Fixed multi-line breadcrumbs overlapping content
* Fixed breadcrumbs being visible on the homepage
* Improved font sizes responsiveness
* Added plugin interference failsafe for color codes in the theme settings
* Fixed enforced slider height creating blank space under the slider on certain screen sizes
* Fixed automatically generated menu dropdowns inaccessible on mobile devices with WordPress 4.7+

= 2.1.0 =
* Fixed submenu arrow indicator slightly out of alignment on mobile devices
* Added main navigation submenu existence indicators
* Added more specific declaration to comment reply buttons (for increased compatibility with bbPress)
* Re-bundled es_ES, de_DE, it_IT, fr_FR translations due to WordPress 90% completeness requirement 
* Fixed content search padding on 404 pages
* Fixed breadcrumbs line height with non-default font sizes
* Fixed incorrect escaping on $image_attributes[0] in theme-loop.php
* Replaced the_title() with the_title_attribute() in attachment.php

= 2.0.7 =
* Fixed Presentation Page columns aspect ratio on mobile
* Fixed content search aspect

= 2.0.6 =
* Further improved comments function for multiple plural forms
* Added implicit label and HTML5 'button' input to search in searchform.php (accessibility)
* Fixed search placeholder positioning on Safari
* Updated translation files

= 2.0.5 =
* Added masonry/magazine layout checks for different usage combinations to fix JS/slider issue introduced in 2.0.4
* Moved rtl.css file to /styles folder to prevent it from being loaded twice by parent themes
* Improved comments display function to take languages with multiple plural forms into account

= 2.0.4 =
* Added Masonry on/off option for compatibility
* Added Fitvids on/off option for compatibility
* Fixed font names with space on Safari limitation
* Fixed long search text underlapping search icon
* Fixed tags line height

= 2.0.3 =
* Fixed slider bullets changing size with font size
* Fixed comments line height being too small
* Decreased "Reply" button padding
* Added hover effects for comment headers
* Added label for search input in searchform.php (accessibility)
* Updated translations and included plural forms

= 2.0.2 =
* Added transition to links hover
* Escaped all theme options output
* Escaped all URLs in theme with esc_url()
* Escaped all get_bloginfo() instances

= 2.0.1 =
* Updated TGM-PA
* Updated default scheme with new options
* Fixed left side socials appearing as bars
* Fixed column images missing bottom padding
* Further tweaked some elements styling
* Brought back the 'Letter spacing' option (under Text Settings)
* Updated pot file

= 2.0.0 =
* PERFORMED A VISUAL REVAMP OF THE THEME TO BRING IT UP TO DATE WITH CURRENT DESIGN TRENDS
* Changed default site width, default content, headings and meta font sizes, default featured image sizes, some default colors
* Revamped the presentation page with new images, new column animations, added slider caption and navigation arrows animations, changed slider title, columns title and columns read more text to default 'headings' font, all text and heading fonts in the PP are taken from theme settings, removed blockquote from text areas for better shortcut/HTML tags support
* Increased padding and font size for inputs/selects/textareas
* Increased padding for all article containers
* Changed comments list and form appearance
* Changed 'Continue reading' button font size and padding
* Changed default site title font
* Changed top menu triangle direction
* Improved responsiveness
* Improved RTL support
* Updated theme screenshot
* Cleaned up compatibility CSS for old browsers
* Converted presentation page code to function blocks


= 1.8.0 =
* Added image size identifier for the recent post-based columns
* Added post formats support to breadcrumbs function
* Added author role meta, time updated and published meta to improve microformats
* Fixed social images improperly positioned lower when header top margin option is non-zero (again)
* Fixed multiple rows columns not clearing correctly on mobile devices
* Fixed missing rtl.css enqueue when using a child theme
* Merged style-frontpage.css into main style.css

= 1.7.4 =
* Moved Magazine Layout option under Layout section for better consistency
* Fixed social images improperly positioned lower when header top margin option is non-zero
* Removed links from demo presentation page content
* Updated theme URL for new site
* Updated theme news feed URL for new site structure
* Removed bundled ro_RO, es_ES, de_DE, it_IT, fr_FR, ru_RU translations in favour of WordPress Translate ones

= 1.7.3 =
* Restored ability to use presentation page columns without images

= 1.7.2.1 =
* (Failed) Resubmission of 1.7.2 due to repository publication issue

= 1.7.2 =
* Fixed typo in parabola_thumbnail_link() breaking featured images

= 1.7.1 =
* Optimized CSS layout and fixed several typos
* Reverted Masonry JS localization variable from cryout_ to parabola_ to avoid overlapping
* Updated enqueued scripts IDs from cryout_ to parabola_ to avoid overlapping
* Removed alt attribute from post thumbnail links and removed unused third parameter $post_image_id from parabola_thumbnail_link()
* Improved Maronry initialization (hopefully)
* Fixed magazine layout option overlapping presentation page posts per columns option
* Removed hidden leftover meta separator
* Added new WordPress.org theme tags (and removed deprecated ones)
* Added site title value to as header logo alt/title attributes
* Updated all instances of the search form (searchform.php, menu hooks) and replaced IDs with classes
* Added slider/columns border width option

= 1.7 =
* Added Masonry for magazine layout (two columns) post pages
* Added support for widgetized Presentation Page columns
* Fixed broken translation string in extra PP text description
* Fixed RTL screen-reader-text placement issue
* Updated breadcrumbs function code
* Fixed admin accordion not remembering last used section on WP 4.4+
* Cleaned up window.onload scripts
* Updated base translation files

= 1.6.1 =
* Added presentation page usage notice when static page is set
* Fixed WordPress 4.4.1 issue with plugin/theme notifications being moved in the Layout settings section
* Rebranded theme to use normal R in name
* Clarified customizer link info to indicate settings page is only available when theme is active
* Fixed header site title to not use H1 tag when homepage is static

= 1.6 =
* REMOVED THE THEME SETTINGS AND ADDED SUPPORT FOR THE SEPARATE THEME SETTINGS PLUGIN
* Integrated TGM-PA to recommend and auto-install the theme settings plugin
* Fixed settings page to handle changed H3 to H2 headings in WordPress 4.4
* Changed presentation page to be disabled by default (in lack of theme options on fresh install without plugin)
* Added above and below content area widget areas to page templates (including custom page with intro)
* NivoSlider-based gallery/slider plugin should no longer wrongfully add a stop button to the theme's slider
* Updated Dutch translation
* Fixed main menu centered option interfering with the mobile menu
* Fixed mobile menu sub-menu arrows and position for RTL
* Added version information to style/script enqueues on both frontend and dashboard (to fix caching issues between updates)
* Rewrote readme file and merged changelog into readme

= 1.5.1 =
* Fixed search double slash causing issues on some servers
* Fixed PHP notice related to browseragent check
* Fixed center multi-line menu change in 1.5 breaking submenu alignment
* Fixed text inside footer widgets not covered by general text options (and using styling defaults)
* Added theme information and settings page link in the customizer

= 1.5.0 =
* Preliminary WPML / Polylang support for custom theme options - presentation page content and socials (currently only tested with Polylang)
* Merged WooCommerce compatibility code and styling, including improvements provided by sjswebdesign.co.uk
* Theme now remembers the settings subsection you were on after saving (for easier navigation)
* Theme settings page is now responsive
* Added title-tag theme support (for WordPress 4.1)
* Added slide title to alt attribute
* Added presentation page column title to image alt attribute
* Fixed centred main menu alignment functionality for multi-line menus
* Removed baseline vertical alignment from styling reset to correct some weird alignment layouts
* (re)Fixed header social icons overlapped by header widget (when set)
* Shortened theme news in theme settings
* Visual changes for the import/export settings

= 1.4.3 =
* Fixed wp.media issue
* Fixed a weird save issue affecting only some servers caused by an apostrophe in the sample custom footer text
* Fixed translation namespace typo in comments (thanks to Mihai)
* Improved Customizer code for latest theme test unit checks
* Corrected title tag code to adhere to latest WordPress guidelines
* Replaced wp_convert_bytes_to_hr() (deprecated) with size_format()
* Replaced get_bloginfo(‘url’) with home_url() per latest WordPress guidelines
* Fixed mobile menu placeholder not visible on RTL sites
* Fixed max-width leftovers in editor-style.css (among other things making large images appear distorted in the editor)
* Fixed layout/image border option non-clickable on IE 11
* Fixed disappearing/shrinking images inside tables issue on Chrome
* Improved two somewhat untranslatable strings (that used esc_attr__() )
* Fixed PHP notice in settings page when theme news are not available
* Fixed slides count limitation when using custom posts by ID
* Fixed header social icons overlapped by header widget (when set)
* Fixed category page with intro to follow category excerpt option, not homepage excerpt option
* Added partial Hungarian translation
* Added partial Czech translation
* Added Romanian translation

= 1.4.2 =
* Removed the “template” meta tag from header
* Removed leftover author meta function from theme-meta.php
* Fixed theme still partially responsive after responsiveness disabled
* Fixed header widgets positioning
* Added option for presentation page posts column count
* Fixed multiple mobile menu issues on iOS and Windows Phone

= 1.4.1 =
* Fixed issues with main menu alignment
* Moved some extraneous JavaScript from main.php to admin.js
* Made all JavaScript files minify-able / Corrected JavaScript comments to handle newline removal (JS compression)
* Added an editing notice in style.css
* Clarified/reordered meta bar option in theme settings
* Added link to theme settings page in customizer

= 1.4.0 =
* Improved responsiveness (a bit more) for the whole theme and specifically the header area
* Fixed accent colours hint non-translatable
* Added zoom option to allow up to 3x zoom on mobile devices
* Added “Contact” social icon (same icon as Email) – can be used to link to the contact page/section/form
* Added “Phone” social icon for callable phone number links on touch-enabled devices
* Added new menu right align option to correctly display the menu items in the same order as left/center; the old right align menu item was kept under a different name to better handle multi-line menus
* Added a brand new mobile menu
* Added a header widget area
* Added header widget area size (can be set to: 60%, 50%, 33%, 25%; default to 33%)
* Improved custom comments compatibility (thanks to phpcodemonkey)
* Fixed breadcrumbs not handling tag pages
* Added options to disable presentation page slider and/or columns

= 1.3.4 =
* Implemented initial colour fields failsafe (to add back the hashtag when lost due to poorly written plugins)
* Fixed site title incorrect responsiveness on mobile devices
* Improved handling of empty site title and/or description (will no longer display a single dash in the browser title)
* Replaced the Presentation Page’s “Nothing Found” message when there are no published posts with an explanatory placeholder message
* Improved tables responsiveness
* Improved headings responsiveness
* Improved top menu responsiveness
* Improved support for non-Wordpress content (indirectly improved handling of WooCommerce pages – together with the updated child theme)
* Added German translation
* Updated Italian translation

= 1.3.3 =
* Fixed import/export settings not working on some rare occasions
* Fixed Google fonts to correctly handle SSL websites
* Changed default table cell alignment to top (instead of bottom)
* Added styling for all the HTML 5 input types
* Added failsafe functionality for CSS3 rgba() colours in older browsers
* Updated Spanish translation

= 1.3.2 =
* Fixed pagination buttons in “category page with intro” page template
* Fixed sidebars to correctly display the empty placeholders
* Fixed incorrect pagination on custom category pages
* Corrected presentation page columns responsiveness on larger mobile devices
* Fixed “continue reading” button on the presentation page
* Updated BebasNeue font to latest version (includes support for regional characters)
* Fixed display of future posts on “category page with intro” page template
* Fixed XSS vulnerability in frontend.js
* Checked and corrected WordPress 3.8 readiness (admin styling and theme tags)

= 1.3.1 =
* Added Steam social icon
* Disabled auto-redirect to theme’s settings page after install (requested by WordPress TRT)
* Some cosmetic changes (pagination, multi-page pages/posts pagination, sticky posts, author info)
* Fixed long multi-line breadcrumbs overlapping (reported by StelleDiPolvere)

= 1.3.0 =
* Improved styling to add better handling for plugin-generated custom post types
* Added mobile browser detection and added a new step of responsiveness for mobile browsers
* Updated Russian translation to 1.2.0
* Updated the media uploader; hopefully this fixes all reported issues with the media selector for slide/column images (the new media uploader is the one introduced in WordPress 3.5 so if you’re using an older version of WordPress now would be a good time to update).
* Beautified jQuery warning to make it less scary and intrusive

= 1.2.2 =
* Presentation page now displays latest posts by default (requested by WordPress TRT); this can be disabled in the theme settings
* Presentation page no longer overrides static page (requested by WordPress TRT); make sure you don’t select a static page under Settings > Reading or you will no longer see the presentation page

= 1.2.1 =
* Added posts count option for presentation page posts
* Added Russian translation for 1.1.1.1
* Added French translation for 1.2.0
* Improved auto image size to adhere to featured image size setting
* Fixed continue reading link / excerpt length for presentation page posts
* Updated mo/po for translations to feature all used functions (_n, _esc_attr__, _esc_html__, _esc_attr_e); hopefully new translations will no longer have missing strings;
* Fixed broken recaptcha forms

= 1.2.0 =
* Fixed images with captions always being left aligned (reported by Corey)
* Added Amazon and Yelp social icons
* Fixed “Category page with intro” page template does not process the <!–more–> tag
* Fixed post title alignment on posts with comments closed when using the magazine layout
* Moved the top menu background colour separately to each menu item
* (hopefully) Fixed iframe/object (Youtube/Vimeo) video enlargement on small embeds
* Added Dutch translation (v1.1.2)

= 1.1.2 =
* Fixed presentation page not appearing when frontpage is set to a static page
* Added menu items alignment option (center align is only possible with one-line menus)
* Added top menu background colour option
* Added accented triangles removal option
* Woocommerce compatibility for hide category titles option

= 1.1.1.1 =
* Fixed responsiveness issue introduced in 1.1.1

= 1.1.1 =
* Fixed double sidebar widgets

= 1.1.0 =
* Added two new colour schemes: grayscale and silver forest
* Added support for WordPress’ 3.6 galleries
* Added the (often requested) option to display the latest posts below the presentation page columns
* (officially) Added support for RTL languages
* Added the correct class/styling to the (experimental) HTML excerpts continue reading button
* Added default text placeholder on the sidebars when there are no widgets set, to inform the user on how to add widgets or hide the sidebar
* Rearranged content and page templates file to tidy up the theme folder a bit
* Rearranged the extra styles to the new style subfolder
* Changed the jQuery check function to further improve issues detection
* Fixed the attachment template to display the correct html layout
* Updated all existing colour schemes to use all available colour options
* Fixed the slider arrows always visible even when different option is set (reported by Michael)
* Fixed a typo (missing #) in style-mobile.css (reported by Ramón)
* Fixed the footer links to open in a new window
* Fixed the meta category list appearing one line too low when the author/date metas are hidden and the post is listed in a very long list of categories
* Fixed the vanishing colour presets when using a child theme
* Corrected the Reply button to works better with various colour schemes

= 1.0.2 =
* Fixed categories displaying both featured images and content image when full posts are displayed
* Fixed presentation page columns not fitting in one row on IE8 (getting sentimental about the past?)
* Move all static css out of the page source and into the style.css making it replaceable by custom CSS
* Fixed another tiny NextGEN compatibility issue
* Fixed uppercase option not affecting the mobile menu

= 1.0.1 =

* Fixed Featured image as header image functionality to display the correctly sized image in the header (reported by Fulco)
* Fixed hide/show of post information settings – they should all behave normally now
* Fixed “General Font” font setting
* Fixed issue when the Slider border color field was left empty
* Fixed Parabola Defaults color scheme resetting all settings to default
* Uppercase disable option now affects column headers as well (when images are not used)
* Improved usability of sub-section settings (in the Parabola Settings page)
* Added styling to the before content and after content widget areas
* Added Spanish translation

= 1.0 =
* Added colour schemes support and 12 built-in colour schemes: default, skyline, chocolate cake, shades of gray, night and day, so fresh and so clean, mid nightmare, bloody delight, retro icecream, autumn rose, bleached landscape and basket case
* Changed site description styling to be covered by the caps disable option
* Added two new font sizes for content and menu for better compatibility with fonts
* Fixed main menu (sub)-sub-menu font-size to be relative to configured font size
* Removed default background colour for site description
* Updated translation files with the new strings
* Add the first Parabola translation – Italian (thanks to Mirko)
* Presentation page column images should no longer enlarge on mobile devices
* Fixed (yet another) header responsiveness issue
* Fixed a compatibility issue with NextGen Gallery plugin
* Styled the <!–more–> and html excerpt continue reading links
* Improved presentation page to handle empty title and image column fields
* Improved featured image as header image functionality to display the correctly sized image in the header
* Improved dashboard jQuery check

= 0.9.9 =
* Added meta area background “accented” setting
* Added option to disable the uppercase styling used in the theme by default on certain elements
* Added category description styling
* Improved the RGB function converter to check all colour codes and only outputted on correct value (and avoid outputting black backgrounds/shadows on Firefox) – this also fixes the menu shadow option
* Improved site-description to only use padding-left when a background colour is set
* Updated the translation files for the latest strings
* Fixed mobile menu missing on iThings when using automatic menus

= 0.9.8 =
* Improved responsiveness (footer and other loose text, header and logo)
* Updated Nivo Slider for increased Presentation Page performance (thank you Vadim)
* Added Menu dropdown shadow setting (empty value by default)
* Fixed the <!–more–> tag for splitting content on the Blog page template
* Moved “Caption Border” and “Meta Area Background” options from the Graphics Settings all the way to the Color Settings where they belong

= 0.9.7.3 =
* Fixed the layout slider in the admin settings
* Adjusted header logo for mobile view
* Some small admin layout changes

= 0.9.7.2 =
* Approved in the themes repository
* Theme background colour options no longer override WP’s background colour option

= 0.9.7.1 =
* Fixed multi-level menus in top/footer menus to not display submenus (as they don’t support that)
* Fixed extremely long words don’t wrap in posts/pages/titles

= 0.9.7 =
* Improved hex2rgba function to not output wrong default colour on garbage input
* Fixed Jetpack comment form being too narow
* Fixed presentation page “hide X area” options applying on all pages (reported by Mag)
* Extended presentation page “hide main menu” option to include the top menu as well (if exists)
* Fixed top menu background colour on hover was never used (reported by Mag)
* Fixed jQuery version checking on WP 3.6 (reported by Detlef)
* Fixed admin accordion compatibility with WP 3.6.
* Fixed comments link appearing over plugins overlays (z-index too high)
* Fixed the (previously) fixed widget container max width

= 0.9.6 =
* ixed a little glitch related to the default site width value
* Fixed a missing sanity check for the logo upload image URL
* Added a secret method of hiding the slider on the presentation page: if not slides are defined or the post slide count is set to zero, the slider is no longer displayed
* Fixed widget styling to keep oversized content under control
* Fixed site title/description to not stick to the edge of the screen on mobile devices

= 0.9.5 =
* Fixed improper right padding on presentation page columns captions
* Fixed author top border colour to use the correct accent setting
* Fixed comment form not appearing at all under a certain configuration mix
* Fixed continue reading button wrong colours on some combinations
* Fixed widget title size smaller when title is link

= 0.9.4 =
* Removed all SEO options (thank the WordPress theme review team for this) – good thing there are lots of SEO plugins out there
* Moved presentation page colour settings under colour settings (and added two more for the slider)
* A couple of small magazine layout layout improvements
* Fixed image caption sizing
* Fixed some input field types missing some styling
* Changed meta area border setting to use accent colour
* Improved slider resizing on mobile devices
* Fixed a glitch on header/footer width on mobile devices
* Added IMDb social icon

= 0.9.1-0.9.3 =
* Undocumented changes

= 0.9 =
* Initial theme release
