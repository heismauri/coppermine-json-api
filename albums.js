const galleryArea = document.getElementById('gallery');
const limit = galleryArea.dataset.limit;

fetch(`https://arianagrandechile.com/galeria/api/albums/?limit=${limit}`)
  .then(response => response.json())
  .then((data) => {
    data.albums.forEach((album) => {
      const albumCard = `<div class="cpg-card album-${album.id}">
                          <a href="${data.domain}thumbnails.php?album=${album.id}" rel="nofollow">
		                        <img class="cpg-thumbnail" src="${data.domain}${album.thumbnail}" alt="${album.title} thumbnail" title="${album.title}">
                          </a>
		                      <div class="cpg-body">
                            <h5 class="cpg-title">
			                        <a href="${data.domain}${album.url}" rel="nofollow">${album.title}</a>
		                        </h5>
                          </div>
	                      </div>`
      galleryArea.insertAdjacentHTML('beforeend', albumCard);
    });
  });
