# craft-instagram-feed
A plugin for Craft CMS that allows you to retrieve your Instagram feed.

## Installation
Upload the instagramfeed/ directory to your plugins/ directory.

Go to plugins and install/enable Instagram Feed.

Next, go to settings and enter your Instagram user id and access token.


## Usage
instagramfeed has two available methods for you to call.

getFeed(int numberOfPostsToRetrieve)

returns a multidimensional array of your instagram posts. Each post has four elements you can access.
- link (the link to your instagram post)
- url (the url of the image)
- likes (the number of likes the post recieved)
- comments (the number of comments the post recieved)
```
{% for image in craft.instagramfeed.getFeed(8) %}
    {{ image.link }}
    {{ image.url }}
    {{ image.likes }}
    {{ image.comments }}
{% endfor %}
```
