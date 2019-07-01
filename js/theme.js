const appli = {
    SELECTOR: {
        elActu: document.querySelector('#actu'),
        elVinyle: document.querySelector('#type-musicaux')
    },

    PROPERTIES: {
        urlApiRest: '',
        categoryID: '',
        postPerPage: 9,
        offset: 0,
        totalPage: 0,
        currentPage: 1,
        etatScroll: false
    },

    EVENT: {
        defile: function(){
            document.addEventListener('scroll', function(){
                appli.displayPosts();
            })
        },
        defileVinyle: function(){
            document.addEventListener('scroll', function(){
                appli.displayVinyles();
            })
        }
    },

    init: function () {
        if (this.SELECTOR.elActu !== null) {
            // dataset.url pour récup le data-url de la div #actu du html  (category.php)
            this.PROPERTIES.urlApiRest = this.SELECTOR.elActu.dataset.url;
            this.PROPERTIES.categoryID = this.SELECTOR.elActu.dataset.categoryid;

            if (this.PROPERTIES.urlApiRest !== '' && !isNaN(this.PROPERTIES.categoryID) && this.PROPERTIES.categoryID !== '') {
                this.infiniteScrollActu();
                this.EVENT.defile();
            }
        }

        

        if (this.SELECTOR.elVinyle !== null) {
            
            this.PROPERTIES.urlApiRest = this.SELECTOR.elVinyle.dataset.url;
            this.PROPERTIES.categoryID = this.SELECTOR.elVinyle.dataset.categoryid;
            console.log(isNaN(this.PROPERTIES.categoryID));
            if (this.PROPERTIES.urlApiRest !== '' && !isNaN(this.PROPERTIES.categoryID) && this.PROPERTIES.categoryID !== '') {
                this.infiniteScrollVinyle();
                this.EVENT.defileVinyle();
            }
        }
    },

    infiniteScrollActu: async function () {
        this.PROPERTIES.offset = (this.PROPERTIES.currentPage - 1) * this.PROPERTIES.postPerPage;

        response = await fetch(this.PROPERTIES.urlApiRest + '?post_status=publish&_embed=true&per_page='
            + this.PROPERTIES.postPerPage + '&offset=' + this.PROPERTIES.offset+'&categories='
            + this.PROPERTIES.categoryID);

        this.PROPERTIES.totalPage = response.headers.get('X-wp-TotalPages');

        data = await response.json();

        if (data.length > 0) {
            for (post of data) {
                this.SELECTOR.elActu.innerHTML +=
                    `<div class="col-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="${post._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url}" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title">${post.title.rendered}</h5>
                                <p class="card-text">${post.excerpt.rendered}</p>
                                <a href="${post.link}" class="btn btn-primary">Lire l'article</a>
                            </div>
                        </div>
                    </div>`;

            }
            this.PROPERTIES.currentPage += 1;
            this.PROPERTIES.etatScroll = false;
        }
    },

    infiniteScrollVinyle: async function () {
        this.PROPERTIES.offset = (this.PROPERTIES.currentPage - 1) * this.PROPERTIES.postPerPage;

        response = await fetch(this.PROPERTIES.urlApiRest + '?post_status=publish&_embed=true&per_page='
            + this.PROPERTIES.postPerPage + '&offset=' + this.PROPERTIES.offset+'&type_musicaux='
            + this.PROPERTIES.categoryID);

        this.PROPERTIES.totalPage = response.headers.get('X-wp-TotalPages');

        data = await response.json();

        if (data.length > 0) {
            for (post of data) {
                this.SELECTOR.elVinyle.innerHTML +=
                    `<div class="col-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="${post._embedded['wp:featuredmedia'][0].media_details.sizes.medium.source_url}" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title">${post.title.rendered}</h5>
                                <p class="card-text">${post.excerpt.rendered}</p>
                                <a href="${post.link}" class="btn btn-primary">Lire l'article</a>
                            </div>
                        </div>
                    </div>`;

            }
            this.PROPERTIES.currentPage += 1;
            this.PROPERTIES.etatScroll = false;
        }
    },

    displayPosts : function(){
        pageHeight = document.documentElement.offsetHeight;
        windowHeight = window.innerHeight;
        scrollPosition = window.scrollY ||  window.pageYOffset 
            || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0 );

        if (pageHeight <= windowHeight + scrollPosition) {
            if (this.PROPERTIES.currentPage <= this.PROPERTIES.totalPage) {
                if (this.PROPERTIES.etatScroll === false) {
                    this.PROPERTIES.etatScroll = true;
                    this.infiniteScrollActu();
                }
            }
        }
    },

    displayVinyles : function(){
        pageHeight = document.documentElement.offsetHeight;
        windowHeight = window.innerHeight;
        scrollPosition = window.scrollY ||  window.pageYOffset 
            || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0 );
           
        if (pageHeight <= windowHeight + scrollPosition) {
            console.log('ou');
            if (this.PROPERTIES.currentPage <= this.PROPERTIES.totalPage) {
                if (this.PROPERTIES.etatScroll === false) {
                    this.PROPERTIES.etatScroll = true;
                    this.infiniteScrollVinyle();
                }
            }
        }
    }

}

window.onload = appli.init();