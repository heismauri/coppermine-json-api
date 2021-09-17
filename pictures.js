const galleryArea = document.getElementById('gallery');
const limit = galleryArea.dataset.limit;

fetch(`${galleryAPI}/pictures/?limit=${limit}`)
  .then(response => response.json())
  .then((data) => {
    data.pictures.forEach((picture) => {
      const pictureCard = `<div class="cpg-card picture-${picture.id}">
                          <a href="${data.domain}${picture.path}" rel="nofollow">
		                        <img class="cpg-thumbnail" src="${data.domain}${picture.thumbnail_path}" alt="${picture.album_title} thumbnail" title="${picture.album_title}">
                          </a>
	                      </div>`
      galleryArea.insertAdjacentHTML('beforeend', pictureCard);
    });
  });
