# How to change permalink for Post Types

In this, I am chaging `post` post type's permalink

- By default, post's URL is `https://yoursite.com/post-slug/`
- By adding this code it will become `https://yoursite.com/post/post-slug/`

## What to modify if you want to change other post types

1. Add OR edit the slug `post` at here. Use your desired slug in `init` action.

   > add_rewrite_rule( '^post/([^/]+)/?$', 'index.php?name=$matches[1]', 'top' );

2. Now change the condition as per your new slug in `post_link` filter

![image](https://user-images.githubusercontent.com/19459637/147411129-13980750-d22b-4790-8088-8cd31fbe8e00.png)

