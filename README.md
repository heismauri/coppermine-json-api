# Coppermine RESTful API
A php file with a secure connection that dumps a JSON response based on its parameters. This is useful to connect your WordPress or other platform with your Coppermine gallery. Moreover, it is protected against SQL injections.

Most impotantly, your gallery widget will update every time the page is loaded, and will not cache its response.

## Installation
Paste the all the files from this repo on a new folder called `api` on the root of your gallery folder.
```
https://yourgallery.url/api/index.php
```
Paste the `albums.js` or `pictures.js` file to your current WordPress theme. *(You can rename the JavaScript if you want)*

Include the next tags on the place you would like to display your latest updated albums or latest uploaded pictures based on what script you have choosen.

```html
<div id="gallery" data-limit="8"></div>
<script src="PATH/albums.js"></script>
```

`gallery` refers to the tag where all the albums will be appended to. On the other hand, `albums.js` or `pictures.js` refers to the script name who reads the JSON response from your gallery.

If you are only going to use the API on your main site, this line can be deleted:

```php
// db-connection.php
header('Access-Control-Allow-Origin: *');
```

## Configuration
Set your domain url in a new variable called `galleryAPI` variable located on the header of your theme.

```js
// your-theme/header.php
<script type="text/javascript">
  const galleryAPI = "https://yourgallery.url/api";
</script>
```

The `limit` variable has to be set in the `data` tag that the gallery will be printed into.

## Example output

```json
{
  "albums": [
    {
      "id": 436,
      "title": "07.22 @ Premios Juventud (Show)",
      "picture_id": 20193,
      "thumbnail": "/albums/userpics/10001/thumb_hg8a0267_0769968c-3880-4289-b3dd-ff689a7ed8f0_dfe4b75a-d3bf.jpg"
    },
    {
      "id": 435,
      "title": "07.22 @ Premios Juventud (Pink Carpet)",
      "picture_id": 39482,
      "thumbnail": "/albums/userpics/10001/thumb_hg8a0404_92665c3c-d1da-4331-8579-5eb468a3f522_9ecae83c-bb95-.jpg"
    },
    {
      "id": 434,
      "title": "07.13 @ MTV MIAW",
      "picture_id": 21293,
      "thumbnail": "/albums/userpics/10001/thumb_775681612VC00173_2021_MTV_M.jpg"
    },
    {
      "id": 419,
      "title": "TINI TINI TINI",
      "picture_id": 23913,
      "thumbnail": "/albums/userpics/10001/thumb_ce293a113092957_6021444adb525.jpg"
    }
  ],
  "domain": "https://yourgallery.url/api"
}
```
