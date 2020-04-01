<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"><h2>Новости</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <router-link :to="{name: 'createArticle'}" class="btn btn-success">Добавить</router-link>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr v-for="article, index in articles.data">
                            <td>
                                <div class="row">
                                    <div class="col-md-8">
                                        <router-link :to="{name: 'showArticle', params: {id: article.id}}">
                                            <h3>{{ article.title }}</h3>
                                        </router-link>
                                        <i>{{ article.created_at }}</i>
                                        <div>{{ article.abbrText }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div><img :src="'storage/'+article.photo" width='100%'></div>
                                        <br />
                                        <router-link :to="{name: 'editArticle', params: {id: article.id}}" class="btn btn-sm btn-default">
                                            Изменить
                                        </router-link>
                                        <a href="#"
                                            class="btn btn-sm btn-danger"
                                            v-on:click="deleteEntry(article.id, index)">
                                            Удалить
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div id='pageBar' class='col-md-12 justify-content-center'>
                        <button
                            class="btn btn-sm btn-primary"
                            v-bind:disabled="articles.prev_page_url===null ? true : false"
                            v-on:click="loadData(articles.prev_page_url)">
                            <-
                        </button>
                        <span>  {{articles.current_page}} из {{articles.last_page}} </span>
                        <button
                            class="btn btn-sm btn-primary"
                            v-bind:disabled="articles.next_page_url===null ? true : false"
                            v-on:click="loadData(articles.next_page_url)">
                            ->
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
               articles: []
            }
        },
        //Первичная загрузка данных
        mounted() {
            var app = this;
            var articles;
            axios.get('/articles')
                .then(function (resp) {
                    app.articles = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удается загрузить статьи");
                });
        },
        methods: {
            //Удаление статьи
            deleteEntry(id, index) {
                if (confirm("Действительно удалить?")) {
                    var app = this;
                    axios.delete('/articles/' + id)
                        .then(function (resp) {
                            app.articles.data.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Не удается удалить статью");
                        });
                }
            },
            //Загрузка страницы
            loadData(url) {
                var app = this;
                var articles;
                axios.get(url)
                    .then(function (resp) {
                        app.articles = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удается загрузить статьи");
                    });
            }
        }
    }
</script>