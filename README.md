# GFB's Author Biography Widget
This plugin is an extract from [globalfoodbook.com](http://globalfoodbook.com).

This plugin is built to help other site owners who require this an author bio tool with flexible options.

It is implemented to allow easy setup and customization of a blogs author bio.

It is best used with food and cook recipe theme made with woo themes.

## Installation
1. Change directory to your plugins directory and then:

        git clone git@github.com:globalfoodbook/gfb_author_bio.git

OR

1. Upload /gfb_author_bio to the /wp-content/plugins directory
2. Activate the plugin through the Plugins menu in WordPress

## Usage
TODO: Write usage instructions here

## Contributing
1. Fork it ( https://github.com/[my-github-username]/gfb_author_bio )
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create a new Pull Request

## Pushing plugin to wordpress svn repo
1. Clone this repo
          git clone git@github.com:globalfoodbook/gfb_author_bio.git
2. cd path/to/gfb_author_bio
3. vim .git/config
4. Add the code below:
          [svn-remote "svn"]
                  url = http://plugins.svn.wordpress.org/plugin_name/trunk
                  fetch = :refs/remotes/git-svn
5. Then merge the master into the new branch:
          `git svn fetch svn
          git checkout -b svn git-svn
          git merge master
          git svn dcommit`
6. Then rebase that branch to the master, and you can dcommit from the master to svn
          `git checkout master
          git rebase svn
          git branch -d svn
          git svn dcommit`
