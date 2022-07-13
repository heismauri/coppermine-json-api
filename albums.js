const galleryArea = document.getElementById('gallery');
const galleryDataset = galleryArea.dataset;

fetch(`${galleryAPI}/albums/?limit=${galleryDataset.limit}`)
  .then((response) => response.json())
  .then((data) => {
    data.albums.forEach((album) => {
      const albumCard = `<div class="cpg-card album-${album.id}">
                          <a href="${data.domain}${album.path}" rel="nofollow">
                            <img class="cpg-thumbnail" src="${data.domain}${album.thumbnail_path}" alt="${album.title} thumbnail" title="${album.title}">
                          </a>
                          <div class="cpg-body">
                            <h5 class="cpg-title">
                              <a href="${data.domain}${album.path}" rel="nofollow">${album.title}</a>
                            </h5>
                          </div>
                        </div>`;
      galleryArea.insertAdjacentHTML('beforeend', albumCard);
    });
  });
