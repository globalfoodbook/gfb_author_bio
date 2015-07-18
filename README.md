# Global Food Book's Author Biography Widget

Contributors: (kengimel)
Tags: newsletter, food-cook, recipe plugin, mailchimp
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This makes it easy to setup a brief synopsis of the author's biography on the sidebar. Best used in food & cook theme or woothemes.

## Description
This plugin provides simple author bio box to give visitors to your website a quick/brief information on the author background.

This plugin is an extract from [globalfoodbook.com](http://globalfoodbook.com) and is contributed back as opensource material (available free of charge).

This plugin is built to help other site owners who require this author bio tool with flexible configurable options.

It is implemented to allow easy setup and customization of a blog's author bio sidebar widget.

It is best used with food and cook recipe theme made with woothemes.

## Installation

1. Upload /mailchimp-woothemes-subscribe to the /wp-content/plugins directory
2. Activate the plugin through the Plugins menu in WordPress

## Frequently Asked Questions

### Can I use my gravatar E-mail?

Yes. Simple go to the widget menu in the admin, add your E-mail into Gravatar Email textfield.

### Can I alter Image size?

Yes. the default is 140 and you can change it to a size that fits you.

### Is possible to change the poistion of the image?

 Yes, By selecting left or right in the admin area will alter the image alignment.

### Can i restrict what page displays this widget?

 Yes, this plugin provides basic home and single page options. We advise you install jetpack's visibility plugin for better restrictions options.

## Screenshots

1. Edit the widget within the admin widget area.
2. View the output sidebar on the frontend of your site.

## Changelog

### 1.0
* Initial Release

## Upgrade Notice

### 1
* Initial Release

## Arbitrary section

#### Adding Screenshots to the wordpress repo

1. Rename each screenshot for each step like this. For step 1 the screenshot is screenshot-1.png.
2. The banner image is named as banner-772x250.png.
3. Use an SVN client like smart svn or rapid svn etc to uploads these iamges to the /assets folder.
4. After this commit and all will be picked up.

#### Contributing

If you would like to contribute to our suite of plugins, head on over to [Global Food Book Labs](https://github.com/globalfoodbook). Feel free to fork and contribute back.

1. Fork it (https://github.com/globalfoodbook/gfb-author-bio-widget)
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create a new Pull Request

#### Pushing plugin to wordpress svn repo

1. Clone this repo

          `git clone git@github.com:globalfoodbook/gfb-author-bio-widget.git`

2. cd path/to/gfb-author-bio-widget
3. vim .git/config
4. Add the code below:

          [svn-remote "svn"]
                  url = http://plugins.svn.wordpress.org/[plugin_name]/trunk
                  fetch = :refs/remotes/git-svn

5. Then merge the master into the new branch:

          `git svn fetch svn`
          `git checkout -b svn git-svn`
          `git merge master`
          `git svn dcommit --username [wordpress.org username]`

6. Then rebase that branch to the master, and you can dcommit from the master to svn

          `git checkout master`
          `git rebase svn`
          `git branch -d svn`
          `git svn dcommit --username [wordpress.org username]`
