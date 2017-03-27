# Gantry-jnilla Quickstart - v 1.0.0

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

* **v 1.0.0 - 02/19/2016**
  * jn-animation: Code was simplified
  * jn-anchor: Is a new feature to add transitions to anchors by using a class.
  * jn-parallax: Is a new feature to add background parallax effect to elements by using a class.
  * jn-video: Is a new feature to add minimalistic video controls to video tags.
  * Demo page was updated






