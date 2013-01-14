# Focus Lab LLC’s EE Master Config

The purpose of this repository is to share our quick multi-environment
setup for ExpressionEngine 2. We use this on every EE project to quickly
and easily get support for multiple servers setup. This enables us to
deploy any of our sites to any server with minimal changes or updates to
any code or settings.

## Introduction

At Focus Lab we work in multiple environments for every ExpressionEngine
site we build. (For the sake of simplicity we’ll just define an
environment as “any server running an instance of your site.”) In order
for ExpressionEngine to support quick and easy deployments across
environments, you need to use a robust config file. This is our approach
to doing just that. A big strength in this approach is that we can
ignore our local environment config file from Git. That way each local
developer has their own config overrides that won’t affect the main
repository.

The folder structure for a given project is the following:

    /config
       - config.{env}.php
       - config.env.php
       - config.master.php
    /public_html
    /system

Where `{env}` is a shorthand hand for our environment. We typically have
4 environments. Production, Staging, Shared development & Local
development. That in mind, our files are:

    config.dev.php
    config.env.php
    config.local.php
    config.master.php
    config.prod.php
    config.stage.php

## Concept

There are three primary pieces to this structure. Environment
declaration, master config values & environment-specific config values.

### Environment Declaration

This file is the starting point of your environment setup. Based on the
`HTTP_HOST` variable in PHP we define the environment (this may change
if you’re using a load balance environment or EE’s MSM module). This is
handled in the `config.env.php` file.

We approach the environment from the top down. We define all
environments based on the domain and then set our default to “local”
which allows our local developers to use whatever domain they choose
(eg: mysite.dev, mysite.local, etc).

Three constants are defined in our environment declaration file. They
are:

-   `ENV`
-   `ENV_FULL`
-   `ENV_DEBUG`

**`ENV`**

This is the short-hand name of your environment. It needs to directly
reflect the naming convention of your environment-specific file (seen
below) such as `config.local.php`. This value is used as a conditional
occasionally in the master config file.

**`ENV_FULL`**

This is the full name of your environment. There are no requirements on
this value. We simply use it in our templates from time to time (“You
are currently in the *Staging* environment”).

**`ENV_DEBUG`**

This is our boolean debug flag used frequently in our master config
file. It allows us to keep debug settings “on” in specific environments.
You can see how this is used in the master config file.

### Master Config file

Our `config.master.php` file contains the bulk of the data for our
setup. These are default configuration settings for our EE projects.
Here we break up config settings into logical groups and add/remove as
needed per project. In plain English, this is what the
`config.master.php` document does/says:

    If EE is looking for database credentials
        Load our environment-specific file (eg: config.prod.php)
        Define our DB cache directory
        Merge our expressionengine/config/database.php array with our environment-specific db array
        Unset our environment-specific array now that it's been used as needed
    End if

    If EE is looking for config array values
        Define our base paths (as inspired by Matt Weinberg)
        Define our template config settings
        Define our Debug settings
        Define our Performance-impacting settings
        Define any 3rd party settings
        Define any member-specific settings
        Define some final, miscellaneous settings
        Load our environment-specific config file (eg: config.prod.php)
        Setup some global variables for template use: {global:env} and {global:env_full}
        Merge our Global Variables arrays then our Config arrays
    End if

**Override Options**

You can find a list of available configuration override options here on
the EE Wiki page [EE 2 Config Overrides](http://expressionengine.com/wiki/EE_2_Config_Overrides). You can alternatively find
individual setting array keys by “inspecting” elements within EE’s
Control Panel and taking note of the input names. Third party developers
may also include config override support in their add-ons.

**Templates Settings**

You can now change the location of your templates directory. Find
`$env_config['tmpl_file_basepath']` around line `132` in the
`config.master.php` and change the value as needed.

**Global Variables**

You can define a set of template global variables in the
`config.master.php` file as well. Around line `232` you will see that
there are 2 variables available as an example. You can add anything here
that you prefer, such as default date format strings etc.

### Environment-Specific Config

The final piece to the equation is the environment-specific file. This
file include the database credentials and any desired config overrides
or global variables. This is the simplest and shortest of the three
files.

There are three possible arrays to use here. They are `$env_db`,
`env_config` and `$env_global`.

**`$env_db`**

This is just for your database credentials for the environment. **What
makes this convenient is that we ignore our `config.local.php` file from
Git.** That way each local developer has their own config overrides that
won’t affect the main repository.

    $env_db['hostname'] = '';
    $env_db['username'] = '';
    $env_db['password'] = '';
    $env_db['database'] = '';

**`$env_config`**

This array allows you to override any config value from EE or from the
master config file. This is useful for changing things that may be
unique to a test environment. A good example would be the
**webmaster\_email** setting. If a single developer wants to receive all
system emails to themselves when developing locally, they might use the
following:

    $env_config['webmaster_email'] = 'me@domain.com';

**`$env_global`**

This array is for defining global variables available within your EE
templates. An example of how this can be used is the idea of using
Google Analytics (GA) to track stats on your site. In the past we’ve
used GA for tracking Staging and Production environments separately.
Doing this was simple because we could define the GA key per-environment
as needed.

    $env_global['global:google_analytics'] = 'UA-XXXXXXX-XX';

This gives you variables like `{global:google_analytics}` in your EE
templates.

## Setup

-   First, make sure you’re working in an pre-existing EE install (even
    if you just installed EE a few minutes ago). You can’t setup this
    config until after EE is installed.
-   Copy the `/config` directory to the same directory level as your
    `system` directory (we recommend [above web root](http://expressionengine.com/user_guide/installation/best_practices.html#moving-the-system-directory-above-webroot))
-   Modify `config.env.php` to reflect your environments and domains.
    You can remove and add environments as needed
-   Update each `config.{env}.php` file with each environment’s database
    credentials as needed
-   Create config overrides and global variables for each environment as
    needed
-   Add the following code to the bottom of
    `system/expressionengine/config/config.php` (be sure not to delete
    other config settings already in this file):

<!-- -->

    /**
     * Require the Focus Lab, LLC Master Config file
     */
    require $_SERVER['DOCUMENT_ROOT'] . '/../config/config.master.php';


    /* End of file config.php */
    /* Location: ./system/expressionengine/config/config.php */

-   Replace the contents of your
    `system/expressionengine/config/database.php` file with the contents
    in of the same file in this repository

### Above webroot vs within webroot

The instructions above are for setting up the config **above** webroot
(your “public\_html”, “htdocs”, etc directory). This is recommended for
security. However, if you’re unable to do this due to hosting restraints
Alex Ball has written about the changes necessary to support this. You
can read [his step-by-step here.](http://alexball.tv/blog/using-focus-labs-master-config-in-webroot/)

### MSM Support

MSM is a tricky one due to the variety of ways the server directory
structure can be setup. We recommend keeping each site’s “public”
directory siblings to one another, so the relative paths are all
identical and accurate. Alternatively, you can define paths in each
site’s `index.php` file as recommended in this gist:
[https://gist.github.com/d27570a3e52bdf656f54](https://gist.github.com/d27570a3e52bdf656f54).

## Contributions

If you’re interested in making this better please feel free to [fork](http://help.github.com/fork-a-repo/)
the code [on GitHub](https://github.com/focuslabllc/ee-master-config) and send [pull requests](http://help.github.com/send-pull-requests/). Also, we’d love to
track any potential issues through the repository’s [Issues tracker](https://github.com/focuslabllc/ee-master-config/issues).

## Support

We are happy to answer questions as needed and able, but there is no
official support for using this config setup. Use it at your own risk
with the understanding that our responses to any inquires will fall
behind any commitments we may have at the time.

**We are also available for private consultation if you would like
assistance getting this setup for your EE site.**

dev@focuslabllc.com

## Legal

### Disclaimer Of Warranty

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND,
EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF
QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR
A PARTICULAR PURPOSE.

### Limitations Of Liability

YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE
SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE
SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM,
OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY
RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL
RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED TO THE RISKS OF
PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS,
OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.