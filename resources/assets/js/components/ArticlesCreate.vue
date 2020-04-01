<template>
 <div class="col-md-10">
        <div class="card">
            <div class="card-header"><h2>Новости</h2></div>
            <div class="card-body">
                <form id="uploadForm" v-on:submit="saveForm()" enctype='multipart/form-data'>
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
                            <label for="file">Фото</label>
                            <input id="file" type="file" v-on:change="fillPhotoPath()" class="form-control-file" name='photo'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fullText" class="col-md-2 col-form-label text-md-right">Полный текст</label>
                        <div class="col-md-6">
                            <textarea id='fullText' v-model="article.fullText" class="form-control" name="fullText" rows=10></textarea>
                        </div>
                        <div class="col-md-4">
                            <img id="preview" src="" width = 100%>
                        </div>
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
        data: function () {
            return {
                article: {
                    title: '',
                    abbrText: '',
                    fullText: '',
                }
            }
        },
        methods: {
            //Отправка данных из формы в API
            saveForm() {
                event.preventDefault();
                var app = this;
                var newArticle = app.article;
                const data = new FormData(document.getElementById('uploadForm'))
                var imagefile = document.querySelector('#file');
                data.append('file', imagefile.files[0]);
                axios.post('/articles', data, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Не удается создать статью");
                    });
            },
             // Превью выбранной картинки
            fillPhotoPath() {
                imgPreview('#file', '#preview');
            },   
        }
    }
</script>