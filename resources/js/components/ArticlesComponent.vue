<template>
  <div class="articles">
    <h2>Articles</h2>

    <!-- Add new article button -->
    <!-- <a href="articles/create" class="btn btn-success mb-2">Add New Article</a> -->
    <div class="d-flex justify-content-end mb-2 mr-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createArticle">
            Add New Article
        </button>
    </div>

    <!-- Create article Modal -->
    <div class="modal fade" id="createArticle" tabindex="-1" role="dialog" aria-labelledby="createArticleLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createArticleLabel">Create Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <create-article @article-submitted="addArticle"></create-article>
            </div>
        </div>
      </div>
    </div>

    <!-- Edit article Modal -->
    <div class="modal fade" id="editArticle" tabindex="-1" role="dialog" aria-labelledby="editArticleLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editArticleLabel">Edit Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <edit-article
                    :id="article.id"
                    :title="article.title"
                    :body="article.body"
                    @article-update="updateArticle"
                ></edit-article>
            </div>
        </div>
      </div>
    </div>

    <!-- Articles Cards -->
    <div v-for="article in articles" :key="article.id" class="card mb-3 shadow-sm">
      <div class="card-body">
        <h3 class="card-title">{{ article.title }}</h3>
        <p class="card-text">{{ article.body }}.</p>
        <a href="#" @click="editArticle(article)" class="btn btn-primary" data-toggle="modal" data-target="#editArticle">Edit</a>
        <a href="#" @click="deleteArticle(article)" class="btn btn-danger">delete</a>
      </div>
    </div>

    <!-- Bootstrap Pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li :class="[{disabled: !pagination.prev_page_url}, 'page-item']">
          <a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
        </li>
        <li class="page-item disabled">
          <a
            href="#"
            class="page-link text-dark"
          >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
        </li>
        <li :class="[{disabled: !pagination.next_page_url}, 'page-item']">
          <a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
        articles: [],
        pagination: {},
        article: {
            id: '',
            title: '',
            body: ''
        }
    };
  },

  created() {
    this.fetchArticles();

    //fadeout loader when page fully loaded
    $(window).on("load", function() {
      $(".loader-wrapper").fadeOut();
    });
  },

  methods: {
    //fetch with pagination
    fetchArticles(page_url = page_url || "api/articles") {
      axios
        .get(page_url)
        .then(response => {
          //response data will contain (data, meta, links) for pagination
          let articlesData = response.data;
          this.articles = articlesData.data;
          this.makePagination(articlesData.meta, articlesData.links);
        })
        .catch(err => console.log(err.response));
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },

    addArticle(article) {
        axios.post('/api/articles', article).then(response=> {
            alert('Post successfully added');
            $('#createArticle').modal('hide');
            this.fetchArticles();
        }).catch(err => console.log(err));
    },

    deleteArticle(article) {
      if (confirm("Are you Sure?")) {
        axios.delete(`api/articles/${article.id}`).then(response => {
          alert("Article Deleted");
          this.fetchArticles();
        });
      }
    },

    editArticle(article) {
        /* axios.get(`api/articles/${article.id}/edit`).then(response => {
            let article = response.data;
            this.article.id = article.id;
            this.article.title = article.title;
            this.article.body = article.body;
        }); */
        this.article.id = article.id;
        this.article.title = article.title;
        this.article.body = article.body;
    },

    updateArticle(article) {
        axios.patch(`api/articles/${article.id}`, article).then(response => {
            alert('Post successfully updated');
            $('#editArticle').modal('hide');
            this.fetchArticles();
        }).catch(err => console.log(err));
    }

    /*fetchArticles() {
             fetch('api/articles').then(response => response.json()).then(response => {
                this.articles = response.data;
                //console.log(response.data);
            });

            /* axios.get('api/articles').then(response => {
                this.articles = response.data.data;
                //console.log(response.data.data);
            });
        }*/
    }
};
</script>

<style lang="scss" scoped>
.articles {
  h2 {
    margin: 1rem 0;
  }

  a {
    user-select: none;
  }
}
</style>
