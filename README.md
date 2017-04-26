# Gantry-Jnilla Quickstart - v 1.2.0

Joomla! 3.x quickstart package for rapid site and template development with a core hacked version of Gantry Framework and part of the Jnilla Framework - Use it under your own responsibility.

## Abstract:

This is a work in proggress, feel free to use it, collaborate, report issues or request new features. We don't have any release schedule or planification "yet", we will release/update as soon as we require/desire. 

This project is based in the latest Joomla! 3.x version and yes you read right, this project uses a core hacked version of Gantry Framework, you should not update Grantry we will do that for you and update the repo. We removed a lot of bloat and unwanted featured from Gantry and we have the intention to remove it completely in the near future.

Documentation can be seen here (temporally): https://docs.google.com/document/d/1fwoWNdjGUZXvyGXyqzgGibaM6pZFhA_t-k9fc_2Cvu0/edit#heading=h.lgi9d83xl2u6


## Development

Default login information is user = "myadmin" and pass ="myadmin".

The folder <code>site</code> is an uncompressed Akeeba backup, so it is ready to download and install.

The file <code>build.php</code> is a PHP console script to prepare and build the source from the most recent akeeba backup.

You will requiere to create the file <code>build_vars.php</code> (same folder as <code>build.php</code>) to store configuration vars requiered by the build.php script.

**Example: build_vars.php**
<code>
<?php 
$source_dir = '/path/to/my/development/installation';
?>
</code>

After build the source do not <code>git add</code> the following resources:

* <code>site/configuration.php</code>
* <code>site/installation</code>

These resources will be rejected on any pull resquest. We do like to keep a single database version (ours) and let the people collaborate on any other file.

## How to collaborate

* Clone the repository to a local folder
* Create the file <code>build_vars.php</code> and setup the var <code>$source_dir</code>
* Copy the <code>site</code> folder to your local server
* Install the site
* Do any changes
* Create a new Akeeba backup
* Open the CLI, move to the repository folder and run <code>php build.php</code>
* Now you can commit and do a regular PR

## Change log

* **v 1.2.1 - 04/26/2017**
  * (fix) Minor modification to com_content overrides.
  * (rem) Demo blog menu item and articles were removed.
  * (fix) jn-hud. Cookie state bug fixed.
  * (fix) Minor edit to jnila system plugin.
  
  
* **v 1.2.0 - 04/25/2017**
  * (rem) Removed legacy favion support
  * (add) Added basic favicon support
  * (fix) Minor modifications to jn-animations.
  * (add) New library jn-video-background. Add video backgrounds with mobile fallback support.
  * (add) New library jn-window-height. set an element the actual window height.
  * (fix) Fix jn-drawer panels positioning. Toggle buttons will toggle and not only open.
  * (add) New library jn-carousel. Enhanced version of the bootstrap carousel with resposive indicators and thumbnails.
  * (add) New Library jn-masonry. Arrange elements in the masonry fashion, define number of columns per device type and automatically calculates columns sizes.
  * (fix) jn-parallax. Top trigger reduced from 25% to 0%. Some elements on above 25% fail to trigger after a page reload affecting elements like logos and menus on top of the page.
  * (fix) jn-hud, .less and .js compiler behavior will be activated manually and not automatically with an administrator login.
  * (fix) Template sections jn-before and jn-after now have 8 rows by default.
  * (fix) No more login to access developer behavior. 
  * (fix) Jnilla System Plugin now have the option "Development Mode" it enables the de js, less and developer tools behavior such as jn-hud. Also on development mode js, css and favicons are forced to reload.
  * (fix) Minir modifications to jn-hud presentation
  * (rem) The library menu-line-breaker.js was removed. This functionality will be replaced in the near future with something more elegant.
  * (rem) The menu-dropdown.js was removed. This functionality will be replaced in the near future with something more elegant.
  * (rem) The library jn-icheck was removed due it problematic nature. This feature will be replaced with a custom solution in the near future.
  * (fix) The file responsive-videos.js was repurposed and renamed to responsive-iframe-videos.js.
  * (add) New library jn-responsive. Make elements responsive based on the elements aspect ratios and parent width. ideal for iframe based video players.
  * (fix) Minor modifications to jn-holder.
  * (fix) Default content menu structure and demos where simplified.
  * (fix) Updated extensions.
  * (add) A new user "client" was created. This is a simplified user account to improve user experience of regular, non-advanced users.
  * (fix) images folder was cleaned and simplified.

  
* **v 1.0.0 - 02/19/2017**
  * jn-animation: Code was simplified
  * jn-anchor: Is a new feature to add transitions to anchors by using a class.
  * jn-parallax: Is a new feature to add background parallax effect to elements by using a class.
  * jn-video: Is a new feature to add minimalistic video controls to video tags.
  * Demo page was updated






