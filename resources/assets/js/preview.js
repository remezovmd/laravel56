export function imgPreview(fileSelector, previewSelector) {
    let file = document.querySelector(fileSelector),        // Выбираем нужные
    preview = document.querySelector(previewSelector);  // элементы

    if(file.files.length === 0) // Если ничего не выбрано - выходим
    return;

    let f = file.files[0],     // Берём первый файл
    fr = new FileReader(); // Создаём объект чтения файлов

    // В свойсте type mime (что-то типа image/png)
    if(f.type.indexOf('image') === -1) // Если файл не является изображением - выходим
    return;

    fr.onload = e => {
        if(getComputedStyle(preview, null).display === 'none') // Если нужно - показываем img
        preview.style.display = 'block';

        preview.src = e.target.result; // В src будет что-то типа data:image/jpeg;base64,....
    }
    fr.readAsDataURL(f); // Читаем blob выбранного файла
} 