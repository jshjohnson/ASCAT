Mixd CSS Framework
==================

Here lies Mixd's framework for beginning any front end build &mdash; containing HTML, Sass &amp; CSS files, jQuery and a pattern/module library. Users of this framework should follow the guidelines below which complement its architecture, based around Jonathan Snook's [SMACSS](http://smacss.com/) and Jake Archibald's [Sass-IE](http://jakearchibald.github.com/sass-ie/) concept.

## License

- This work is licensed under a [Creative Commons Attribution-NonCommercial 3.0 Unported License](http://creativecommons.org/licenses/by-nc/3.0/deed.en_US)
- You must attribute the work in the manner specified by the author or licensor (but not in any way that suggests that they endorse you or your use of the work)

## External Libraries

This framework makes use of the following external libraries or services

- [Normalize.css](http://necolas.github.com/normalize.css/)
- [Griddle](http://necolas.github.com/griddle/)
- [Fontello](http://fontello.com/)
- [jQuery](http://jquery.com/)
- [Modernizr](http://modernizr.com/)
- [Selectivizr](http://selectivizr.com/)
- [jQuery Placeholder](https://github.com/mathiasbynens/jquery-placeholder)
- [FitVids](http://fitvidsjs.com/)
- [ExpandingTextareas](https://github.com/bgrins/ExpandingTextareas)

## General

- **This is a mobile-first framework**
- **This framework uses [Sass](http://sass-lang.com/)** to generate CSS 
- All site assets must be placed within the `/assets/` folder
- Working `.scss` / Sass files are found in the `/assets/scss` folder
- All primary styles are placed in the `/core` folder
- HTML Classes follow [BEM](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) naming conventions
- Practise OOCSS principles and **never be afraid to use CSS classes** where appropriate

#### Read
* [goo.gl/q1rR5](http://goo.gl/q1rR5)

## Pre-Processing

- *`/assets/scss`*
- We recommend [CodeKit](http://incident57.com/codekit/) as a compiler for Mac
- Directly compiled stylesheets sit at root level, with all other separations inside sub folders
- CSS must compile to the `/assets/css` folder and will be minified/compressed upon launch
- Helper mixins have been provided in the `/config` folder under `mixins.scss` &mdash; to speed up development in common areas e.g. outputting `background-image` gradients with all vendor prefixes
- Utilise these as you see fit or consider using [Compass](http://compass-style.org/) for more comprehensive mixins libraries

## Configuration

- *`/assets/scss/config`*
- **This is a good starting point** 
- Global variables are set in `vars.scss` e.g. colours, font families etc. Place **any variables** you create during the project here
- Major breakpoints are managed centrally here using the convention `$bp1`, `$bp2` etc.
- Mixins are defined in `mixins.scss`. Place **any mixins** you create during the project here under *Project-Specific Mixins*

## Media Queries

- Write `@media` declarations in context using the methods outlined in [Sass-IE](http://jakearchibald.github.com/sass-ie/)
- Keeping `@media` queries per selector allows for easier maintenance and extaction of modules
- `respond-min` and `respond-max` mixins have been provided in `utils.scss` to easily create `min` and `max` media queries from inside selectors, allowing nesting
- Create breakpoints **when content requires**, not based on device or screen size
- Always set breakpoints in `ems` for fexibility
- Reference all major breakpoints using the corresponding `$bp` variable
- Use minor breakpoints as you see fit on a case-by-case basis
- Work primarily mobile-first, unless using a `max-width` query will bring significantly leaner code and it **does not** contain any background images or fonts
- Never separate media queries into their own stylesheet/per breakpoint
- **Keeping to this process is vital** due to how the framework compiles styles for old Internet Explorer

#### Read
- [goo.gl/uwyT6](http://goo.gl/uwyT6)
- [goo.gl/yG00v](http://goo.gl/yG00v)

#### Example:

	.media__img {
	
		// global syles
		margin-bottom: 1.5em;
		
		// at major breakpoint 1
		@include respond-min($bp1) {
			float: left;
			margin-bottom: 0; }
			
		// at a different, minor breakpoint
		@include respond-min(39em) {
			float: right; }
	}

## Core partials

Although this framework doesn't strictly follow the [SMACSS](http://smacss.com/) categorision pattern, it is heavily infuenced by it's methodology. As long as you stick to the practices set out in SMACSS, you won't go wrong.

Contrary to to guidelines set out in SMACSS, this framework does not include `theme` and `state` stylesheets, instead these abstractions should be included with `modules.scss` in a logical cascading order. This helps keep all modular code in context whilst maintaining the cascading benefits of the SMACSS method.

### Base

- */assets/scss/core/base.scss*
- [Normalize.css](http://necolas.github.com/normalize.css/) is used to create consistency across all browsers
- *Project Defaults* are set as reasonable starting point, but should be changed if required

#### Icon Fonts

- Use [Fontello](http://goo.gl/UV0Lm) to compile your icon font with project-specific glyphs
- When exporting, name the font "Fontello" and upload all font files to `/assets/fonts`
- Paste icon codes/classes taken from `Fontello-codes.css` in the downloaded zip file, into `theme.scss`
- Icon classes should be prefixed with `.icon-`
- The classes `.icon-large` and `.icon-pad` can be used to extend icons
- The `.icon` class can be `@extended` when adding a class isn't reasonable e.g. on lots of `<li>`'s

##### Read
- [goo.gl/38esp](http://goo.gl/38esp)

### Layout

- */assets/scss/core/layout.scss*
- Layout rules define major content areas or layout components e.g. header, container or grids
- *Layout* is reserved for layout components only and should only be styled as such

##### Read
- [goo.gl/S5inY](http://goo.gl/S5inY)

#### Griddle

This framework uses Nicolas Gallagher's [Griddle](http://necolas.github.com/griddle/) for layout. Grids are created at each breakpoint within `layout.scss` and defined using classes on each grid column to determine which proportion is taken at which breakpoint e.g.

	<div class="grid">
		<article class="grid__cell unit-1-2--bp2 unit-1-3--bp4">
				<h3 class="zero--top">one of three</h3>
				<p>This unit is one-of-two after $bp2 and one of 3 after $bp4.</p>
		</article>

		<article class="grid__cell unit-1-2--bp2 unit-1-3--bp4">
				<h3 class="zero--top">one of three</h3>
				<p>This unit is one-of-two after $bp2 and one of 3 after $bp4.</p>
		</article>

		<article class="grid__cell unit-1-2--bp2 unit-1-3--bp4">
				<h3 class="zero--top">one of three</h3>
				<p>This unit is one-of-two after $bp2 and one of 3 after $bp4.</p>
		</article>
	</div>

### Modules

- */assets/scss/core/modules.scss*
- **This is where the bulk of your CSS will go** and contains objects &amp; modules
- **Objects** are abstractions, created as classes to provide one re-useable element of styling e.g. `.nav--inline` turns lists inline
- **Modules** are an extension of objects but are more specific parts of a page e.g. `.nav--tertiary`. The two are used/work together
- Modules sit inside layout components and can be moved to a different part of the page without breaking
- When building modules consider existing objects, future reuse and create abstractions if necessary
- **Don't modify a base object** once created. Either extend it for your module or don't use it
- Always use classes (**never IDs**) to define modules.
- Always define background, typography, colour and other 'theme' styling as separate abstractions *after* thier related module
- Always define element states such as `:hover` and `:focus` *after* both the module and theme styles

##### Read
- [goo.gl/0iUwg](http://goo.gl/0iUwg)
- [goo.gl/QKEuz](http://goo.gl/QKEuz)

#### Default Objects

- Navigation objects `.nav-inline`, `.nav-divided` and `.nav-stacked` are supplied by default, referencing mixins in `mixins.scss`
- `.media` and `.island` objects are also included

##### Read
- [goo.gl/QjtO6](http://goo.gl/QjtO6)
- [goo.gl/Xf6MJ](http://goo.gl/Xf6MJ)
- [goo.gl/1XYHG](http://goo.gl/1XYHG)

#### Media Queries

- Modules should contain **all** `@media` declarations in context, nested within each module
- This allows a developer to instantly see how a modules changes, with one point of reference for *layout* in `modules.scss` and one for *theme* in `theme.scss`
- **Utilise mixins** to create abstractions and re-include these at a given breakpoint, rather than redefining them

##### Correct:

	// this object turns lists inline
	@mixin nav-inline {
		li,
		a {
			display: inline-block;
			*display:inline;
	        zoom:1; }	
	}
	
	// object class
	.nav-inline {
		@include nav-inline; }
		
	// tertiary navigation module
	.nav-tertiary {
	
		// global syles
		margin-bottom: 1.5em;
		
		// turn .nav-tertiary to an inline list at breakpoint 2
		@include respond-min($bp2) {
			@include nav-inline;
		}
	}

##### Incorrect:

	// this object turns lists inline
	.nav-inline {
		li,
		a {
			display: inline-block;
			*display:inline;
	        zoom:1; }	
	}
	
	// tertiary navigation module
	.nav-tertiary {
	
		// global syles
		margin-bottom: 1.5em;
		
		// turn .nav-tertiary to an inline list at breakpoint 2
		@include respond-min($bp2) {
			li,
			a {
				// redefining what's above
				display: inline-block;
				*display:inline;
		        zoom:1; }	
		}
	}


#### Mixd Modules

- */assets/scss/libs/mixd-modules.scss*
- The Mixd Module Library contains mixins for common modules and details of accompanying markup
- Should you produce any potentially reuseable/useful modules, update this file in the [master repository](https://github.com/Mixd/Mixd-CSS-Framework) after project completion
- This allows for greater reuse of code between projects.
- Modules should **only** contain structure and layout (defined by explicit CSS properties) with **no theme styles** 
- *Theme* for each module can then be added on a per-project basis, with a full view of that project's cascade prior to styling
- If necessary, **include any mixins** used within a module so it can be added to any new project without missing dependencies
- When using new modules check for existing mixins and/or refactor if necessary

##### Example

	/* List Block
	----------------------------------*/
	// useful object mixin
	@mixin list-two-cols {
		li {
			float: left;
			width: 50%; }
	}
	
	// Module
	.list-block {
		@include respond-min($bp1) {
			// change list to two columns at breakpoint 1
			@include list-two-cols;
		}
	}

### Overrides

- */assets/scss/libs/overrides.scss*
- Contains helper classes and style trumps which will always want to override previously  defined styles.
- Helper Classes are used to alter global typographic styles when required or unset defaults e.g. `.list-unset` removes `list-style` and `margin-left` from any `<ul>` or `<ol>`
- Style trumps are used when you want to globally override and elements style, e.g. error states which would always be displayed in red.
- `!important` is used often here, as you'll *always* want these rules to trump out previously defined rules.

### CMS

- */assets/scss/core/cms.scss*
- CMS styles are specific to the CMS (here, WordPress) being used including any plugins
- If using WordPress, add a `.wp-content` class to the containing element of `<?php the_content(); ?>`

### Modernizr

- */assets/scss/core/modernizr.scss*
* Modernizr styles offer fallbacks for non-supporting browsers
* Use `.no-` selectors (**always code for better browsers first**)
* Utilise Sass nesting for browser capabilities

#### Example

	.no-svg {
		.logo {
			/* styles */ }
			
		.sprite {
			/* styles */ }
	}


### Internet Explorer

- */assets/scss/all-old-ie.scss*
- IE8 and below is served styles via `all-old-ie.scss`
- **Styles are compiled automatically** with media queries stripped-out
- Set which layout you want old IE to take using the `$mqs-up-to` variable in `all-old-ie.scss`
- **Never polyfill IE with media query support**
- Add additional IE styles/fixes to the bottom of `all-old-ie.scss` using relevant classes on the `<html>` element
- A print stylesheet `print-old-ie.scss` is created for IE, containing global typographic/layout styles. These are then overwritten by `print.css` as per modern browsers, meaning you only have to worry about working with one print stylesheet
- Utilise Sass nesting for browser versions

#### Example

	.lt-ie9 {
		.fix {
			/* styles */ }
			
		.another-fix {
			/* styles */ }
	}

## Images

- Always aim for resolution independence, using SVG images, icon fonts and CSS wherever possible
- **Compile all images in a sprite** and utilise the `sprite` mixin
- When using SVG, code for better browsers first and provide fallbacks using Modernizr

#### Read
- [goo.gl/FVHzp](http://goo.gl/FVHzp)

## Javascript

- */assets/js/scripts.js*
- Plugins are stored in a separate file `assets/js/plugins.js` and imported into `scripts.js` using Codekit.
- To minimise http requests, **do not** load-in any additional JavaScript files. Use codekit to include partials into `scripts.js`.
- [Modernizr](http://modernizr.com/) is included to determine browser capabilities and provide appropriate fallbacks
- [Selectivizr](http://selectivizr.com/) is included to add attribute/pseudo selector support in old IE
- Other plugins in operation by default are [jQuery Placeholder](https://github.com/mathiasbynens/jquery-placeholder), [FitVids](http://fitvidsjs.com/) and [ExpandingTextareas](https://github.com/bgrins/ExpandingTextareas)


## Mixd Pattern library
- *patterns.html*
- The Mxd Pattern Library contains markup for common modules or components used within projects
- Check here before writing markup to see if you can reuse an existing module
- Should you produce any potentially reuseable/useful markup, update this file in the [master repository](https://github.com/Mixd/Mixd-CSS-Framework) after project completion
- This allows for greater reuse of code between projects.

---------------------------------------

# General CSS notes, advice and guidelines

Listen below are some general rules to adhere to when using this framework or when completing any front end work. Extracts are taken from [CSS Guidelines](https://github.com/csswizardry/CSS-Guidelines/blob/master/CSS%20Guidelines.md) written by Harry Roberts.

## Syntax and formatting

Use multi-line CSS to help with version control (diffing single line CSS is a nightmare) and order CSS declarations by relevance, **not** alphabetically.

Always use a trailing semi-colon on the last declaration in a ruleset to avoid any potential confusion and syntax errors over the life of the document.

Here is the preferred convention and structure for defining CSS rules, comments and nested elements within Sass:

	/* Tertiary Nav
	----------------------------------*/
	.nav--tertiary {
		a {
			padding: 0 .75em; }
			
		:first-child a {
			padding-left: 0; }	
	}
	
	/* Blocked Nav Object
	----------------------------------*/
	.nav--blocked a {
		display: block;
		padding: .5em; }

### BEM Syntax

The framework uses the [BEM](http://bem.info) methodology for class naming. The notation used in this framework is heavily influenced by Harry Roberts' [MindBEMding article](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/).

- Use single hyphens to deliminate blocks: `.thisIsBad{}`, `.this_is_also_bad{}` but `.this-is-correct{}`.
- Use double underscores for descendants of a block i.e. `.block__element`.
- Use double hyphens for block modifiers i.e. `.block--modifier`

#### Example:

	.media{} /* Block */
	.media__img /* Element */
	.media--flipped /* Modifier */

#### Read

- [bem.info](http://bem.info)
- [csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/)
- [nicolasgallagher.com/about-html-semantics-front-end-architecture/](http://nicolasgallagher.com/about-html-semantics-front-end-architecture/)

## Comments

Comment as much as you can as often as you can. Where it might be useful, include a commented piece of markup which can help put the current CSS into context.

Be verbose, go wild, CSS will be minified before it hits live servers.

## Building components

When building a new component write markup **before** CSS. This means you can visually see which CSS properties are naturally inherited and thus avoid reapplying redundant styles. Look for existing modules or objects to work with before beginning and always comment a new module with a title.

## OOCSS

When building components try and keep a DRY, OO frame of mind. **Adding classes is not a crime** - use them wisely and efficiently.

Instead of building dozens of unique components, try and spot repeated design patterns abstract them; build these skeletons as base objects and then peg classes onto these to extend their styling for more unique circumstances.

If you have to build a new component split it into structure (modules) and skin (theme); build the structure of the component using very generic classes to reuse that construct and then use more specific classes to skin it up and add design treatments.

#### Read

* [csswizardry.com/&hellip;/the-nav-abstraction](http://csswizardry.com/2011/09/the-nav-abstraction)
* [stubbornella.org/&hellip;/the-media-object-saves-hundreds-of-lines-of-code](http://stubbornella.org/content/2010/06/25/the-media-object-saves-hundreds-of-lines-of-code)

## Layout

All components should be left totally free of widths; your components should always remain fluid and their widths should be governed by a grid system.

Heights should **never** be be applied to elements. Heights should only be applied to things which had dimensions _before_ they entered the site (i.e. images and sprites). Never ever set heights on `<p>`s, `<ul>`s, `<div>`s, anything. You can normally achieve the desired effect with `line-height` which is far more flexible.

Grid systems should be thought of as shelves. They contain content but are not content in themselves. You put up your shelves then fill them with your stuff.

You should never apply any styles to a grid or layout container, they are for layout purposes only. Nest modules inside layout components.

## Sizing

**Never use pixels** unless unavoidable. Use a combination of `ems`, `rems` and percentages. Only use `rems` if you need to reference a base measure e.g. to make padding equal more easily 

#### Read

* [csswizardry.com/&hellip;/measuring-and-sizing-uis-2011-style](http://csswizardry.com/2011/12/measuring-and-sizing-uis-2011-style)

## Font sizing

Set a *relevant* default font-size on the `<html>` element to supply global typographic elements. From there, use `ems` to define font sizing &mdash; **do not define any font sizes in pixels**. Define line heights unitlessly everywhere **unless** you are trying to align text to known heights.

Do not use `rems` for font-sizing unless absolutely necessary due to compound nesting. If using `rems` - provide pixel/<`em>` fallback for IE using the Modernizr `.no-remunit` class. 

Avoid defining font sizes over and over; to achieve this have a predefined scale of font sizes tethered to classes. Recycle these rather than having to declare styles over and over.

Before writing another font-size declaration, see if a class for it already exists.

#### Read

* [csswizardry.com/&hellip;/pragmatic-practical-font-sizing-in-css](http://csswizardry.com/2012/02/pragmatic-practical-font-sizing-in-css)

## Shorthand

It might be tempting to use declarations like `background: red;` but in doing so what you are actually saying is *I want no image to scroll, aligned top left and repeating X and Y and a background colour of red*. Nine times out of ten this won't cause any issues but that one time it does is annoying enough to warrant not using such shorthand. Instead use `background-color: red;`.

Similarly, declarations like `margin: 0;` are nice and short, but **be explicit**. If you're actually only really wanting to affect the margin on the bottom of an element then it is more appropriate to use `margin-bottom: 0;`.

Be explicit in which properties you set and take care to not inadvertently unset others with shorthand. E.g. if you only want to remove the bottom margin on an element then there is no sense in blitzing all margins with `margin: 0;`.

Shorthand is good, but easily misused.

## Selectors

Keep selectors efficient and portable.

Heavily location-based selectors are bad for a number of reasons. For example, take `.sidebar h3 span {}`. This selector is too location-based and thus that `span` cannot be moved outside of a `h3` outside of `.sidebar` and maintain styling.

Selectors which are too long also introduce performance issues; the more checks in a selector (e.g. `.sidebar h3 span` has three checks, `.content ul p a` has four), the more work the browser has to do.

Make sure styles aren't dependent on location where possible, and make sure selectors are nice and short.

**Remember:** classes are neither semantic or insemantic; they are sensible or insensible! Stop stressing about *semantic* class names and pick something sensible and futureproof.

#### Read

* [speakerdeck.com/&hellip;/breaking-good-habits](http://speakerdeck.com/u/csswizardry/p/breaking-good-habits)
* [csswizardry.com/&hellip;/writing-efficient-css-selectors](http://csswizardry.com/2011/09/writing-efficient-css-selectors)

### Over-qualified selectors

An over-qualified selector is one like `div.promo`. You could probably get the same effect from just using `.promo`. Of course sometimes you will _want_ to qualify a class with an element (e.g. if you have a generic `.error` class that needs to look different when applied to different elements (e.g. `.error { color: red; }` `div.error { padding: 14px; }`), but generally avoid it where possible.

Another example of an over-qualified selector might be `ul.nav li a {}`. As above, you can instantly drop the `ul` and because `.nav` is a list, any `a` _must_ be in an `li` &mdash; getting `ul.nav li a {}` down to just `.nav a{}`.

## Be explicit, don't make assumptions

Instead of using selectors to drill down the DOM to an element, it is often best to put a class on the element you explicitly want to style. Let's take a specific example.

Imagine you have a promotional banner with a class of `.promo` and in there there is some text and call-to-action link. If there is just one `a` in the whole of `.promo` then it may be tempting to style that call-to-action via `.promo a {}`.

The problem here should be obvious in that as soon as you add a simple text link (or any other link for that matter) to the `.promo` container it will inherit the call-to-action styling, whether you want it to or not. In this case you would be best to explicitly add a class (e.g. `.cta`) to the link you want to affect.

Be explicit; target the element you want to affect, not its parent. Never assume that markup won't change.

### Key selectors should (typically) never be a type selector or an object/abstraction class

You should never find yourself writing selectors whose key selector is a type selector (e.g. `.header ul {}`) or a base object (e.g. `.header .nav {}`). This is because you can never guarantee that there will only ever be one `ul` or `.nav` in that `.header`, the key selector is too loose/too broad.

It would be more appropriate to give the element in question an explicit class targeting that one and that one only, so `.header .nav {}` would be replaced with `.site-nav`, for example.

The only time where a type selector may be appropriate is if you have a situation like this:

    a {
        color:red; }
        
    .promo {
        background-color: red; 
        color: white; }
    
    .promo a {
        color: white; }

In this case you _know_ that every `a` in `.promo` needs a blanket rule because it would be unreadable without.

**Write selectors that target what you want, not what happens to be there already.**


## IDs and classes

**Do not use IDs in CSS** at all. They can be used in your markup for JS and fragment-identifiers but use only classes for styling. Do not use a single ID in this (or any other) stylesheet.

Classes come with the benefit of being reusable and they have a nice, low specificity.

#### Read

* [csswizardry.com/&hellip;/when-using-ids-can-be-a-pain-in-the-class](http://csswizardry.com/2011/09/when-using-ids-can-be-a-pain-in-the-class)


## `!important`

It is okay to use `!important` on helper classes only. To add `!important` preemptively is fine, e.g. `.error { color: red !important; }`, as you know you will **always** want this rule to take precedence.

Using `!important` reactively, e.g. to get yourself out of nasty specificity situations, is not advised. Rework your CSS and try to combat these issues by refactoring your selectors. Keeping your selectors short and avoiding IDs will help out here massively.


## Magic numbers and absolutes

A magic number is a number which is used because *it just works*. These are bad because they rarely work for any real reason and are not usually very futureproof or flexible/forgiving. They tend to fix symptoms and not problems.

For example, using `.dropdown-nav li:hover ul { top: 37px; }` to move a dropdown to the bottom of the nav on hover is bad, as 37px is a magic number. 37px only works here because in this particular scenario the `.dropdown-nav` happens to be 37px tall.

Instead use `.dropdown-nav li:hover ul{ top: 100%; }` which means no matter how tall the `.dropdown-nav` gets, the dropdown will always sit 100% from the top.

Every time you hard code a number think twice; if you can avoid it by using keywords or aliases (i.e. `top:100%` to mean *all the way from the top*) or &mdash; even better &mdash; no measurements at all then you probably should.

Every hard-coded measurement you set is a commitment you might not necessarily want to keep.

## Debugging

If you run into a CSS problem **take code away before you start adding more** in a bid to fix it. The problem exists in CSS that is already written, more CSS isn't the right answer!

Delete chunks of markup and CSS until your problem goes away, then you can determine which part of the code the problem lies in.

It can be tempting to put an `overflow: hidden;` on something to hide the effects of a layout quirk, but overflow was probably never the problem; **fix the problem, not its symptoms.**