<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"><h2>Новости</h2></div>
            <div class="card-body">
               <form id="uploadForm" v-on:submit="saveForm()" enctype='multipart/form-data'>
                   <input type="hidden" name="_method" value="PATCH">
                   <div class="form-group row">
                       <label for="title" class="col-md-2 col-form-label text-md-right">Заголовок</label>
                       <div class="col-md-10">
                           <input id='title' type="text" v-model="article.title" class="form-control" name='title'>
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="abbrText" class="col-md-2 col-form-label text-md-right">Сокращенный текст</label>
                       <div class="col-md-6">
                           <textarea id='abbrText' v-model="article.abbrText" class="form-control" name='abbrText' rows=5></textarea>
                       </div>
                       <div class="col-md-4">
                           <label for="file">Фото</label><br />
                           <input id="file" type="file" v-on:change="fillPhotoPath()" class="form-control-file" name='photo'>
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="fullText" class="col-md-2 col-form-label text-md-right">Полный текст</label>
                       <div class="col-md-6">
                           <textarea id='fullText' v-model="article.fullText" class="form-control" name="fullText" rows=10></textarea>
                       </div>
                       <div class="col-md-4">
                           <img id="preview" :src="'storage/'+article.photo" width = 100%>
                       </div>
                   </div>
                   <div class="form-group row">
                   </div>
                   <div class="form-group row">
                       <div class="col-md-4 text-md-right"><button class="btn btn-success">Сохранить</button></div>
                       <div class="col-md-4"><router-link to="/" class="btn btn-danger">Отмена</router-link></div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</template>
<script>
    import {imgPreview} from '../preview.js';
    export default {
        // Получение данных из API
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
            // Отправка данных из формы в API
            saveForm() {
                event.preventDefault();
                var app = this;
                const data = new FormData(document.getElementById('uploadForm'))
                var imagefile = document.querySelector('#file');
                data.append('file', imagefile.files[0]);
                axios.post('/articles/' + app.articleId, data, {headers: {'Content-Type': 'multipart/form-data'}}) //отправляем POST, потому-что laravel не понимает PATCH и добавляем <input type="hidden" name="_method" value="PATCH"> в форму
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удается сохранить статью");
                    });
            },
            // Превью выбранной картинки
            fillPhotoPath() {
                imgPreview('#file', '#preview');
            },            
        }
    }
</script>