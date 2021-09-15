const albumAreas = document.querySelectorAll('figure#album');

albumAreas.forEach((albumArea) => {
  const id = albumArea.dataset.id;
  const limit = albumArea.dataset.limit;
  const picturesArea = albumArea.querySelector('ul');
  const breadcrumbsArea = albumArea.querySelector('nav');

  fetch(`https://arianagrandechile.com/galeria/api/album/?id=${id}&limit=${limit}`)
    .then(response => response.json())
    .then((data) => {
      data.pictures.forEach((picture) => {
        const pictureLi = `<li class="cpg-card picture-${picture.id} list-inline-item">
                            <a href="${data.domain}${picture.path}" rel="nofollow">
                              <img class="cpg-thumbnail" src="${data.domain}${picture.thumbnail_path}" alt="${data.title} thumbnail" title="${data.title}">
                            </a>
                          </li>`
        picturesArea.insertAdjacentHTML('beforeend', pictureLi);
      });
      data.breadcrumbs.forEach((category) => {
        const breadcrumb = `<li class="breadcrumb-item"><a href="${data.domain}${category.path}" rel="nofollow">${category.name}</a></li>`;
        breadcrumbsArea.insertAdjacentHTML('beforeend', breadcrumb);
      });
      const albumUrl = `<li class="breadcrumb-item active"><a href="${data.domain}${data.path}" rel="nofollow">${data.title}</a></li>`
      breadcrumbsArea.insertAdjacentHTML('beforeend', albumUrl);
    });
})
