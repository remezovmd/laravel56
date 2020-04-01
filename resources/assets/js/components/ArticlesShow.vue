<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"><h2>Новости</h2></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3>{{ article.title }}</h3>
                        <i>{{ article.created_at }}</i>
                    </div>
                    <div class="col-md-4">
                        <div><img :src="'storage/'+article.photo" width='100%'></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="font-size: 1.2rem" class="text-justify">{{ article.fullText }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4"><router-link to="/" class="btn btn-danger">Назад</router-link></div>
                </div>
             </div>
        </div>
    </div>
</template>
<script>
    export default {
        // Заполнение полей формы данными из API
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.articleId = id;
            axios.get('/articles/' + id)
                .then(function (resp) {
                    app.article = resp.data;
                })
                .catch(function () {
                    alert("Не удается загрузить статью")
                });
        },
        data: function () {
            return {
                articleId: null,
                article: {
                    title: '',
                    abbrText: '',
                    fullText: '',
                }
            }
        },
               
        methods: {
          
        }
    }
</script>