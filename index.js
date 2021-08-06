const galleryArea = document.getElementById('gallery');
const limit = 8;

fetch(`https://yourdomain.com/gallery/api-json.php?limit=${limit}`)
  .then(response => response.json())
  .then((data) => {
    data.albums.forEach((album) => {
      const albumCard = `<div class="cpg-album-card album-${album.id}">
		                      <img alt="${album.title}" src="${album.thumbnail}">
		                      <h2 class="cpg-album-title">
			                      <a href="${data.domain}/thumbnails.php?album=${album.id}" rel="nofollow">${album.title}</a>
		                      </h2>
	                      </div>`
      galleryArea.insertAdjacentHTML('beforeend', albumCard);
    });
  });
