# Coppermine JSON API
A php file with a secure connection that dumps a JSON response based on its parameters. This is useful to connect your Wordpress or other platform with your Coppermine gallery. Moreover, it is protected against SQL injections.

Most impotantly, your gallery widget will update every time the page is loaded, and will not cache its response.

## Installation
Paste the `api-json.php` on the root of your gallery folder.
```
https://yourdomain.com/gallery/api-json.php
```
Paste the `index.js` file to your current Wordpress theme. *(You can rename the JavaScript if you want)*

Include the next tags on the place you would like to display your latest updated albums.

```HTML
<div id="gallery"></div>
<script src="index.js"></script>
```

`gallery` refers to the tag where all the albums will be appended to. On the other hand, `index.js` refers to the script name who reads the JSON response from your gallery.

If you are only going to use the API on your main site, this line can be deleted:

```php
header('Access-Control-Allow-Origin: *');
```

## Configuration
Set your domain url in the `$domain` variable located on the `api-json.php` file.

The `limit` variable has to be set in the `index.js` file, by default it was set to `8`.

The album card tags and organization can also be changed in the same JavaScript file.
