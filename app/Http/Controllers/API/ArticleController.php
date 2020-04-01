<?php
namespace App\Http\Controllers\API;
 
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Storage;

 
class ArticleController extends Controller
{
    //Показать все новости (по 10 настранице)
    public function index()
    {
        return Article::where('title', '!=', '')->Paginate(10);
    }
 
    //Показать новость по ID
    public function show($id)
    {
        return Article::findOrFail($id);
    }
 
    //Сохранить измененную новость
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
                
        $photoPath = $article->photo;
		if (null !== $request->file('photo')) {												//Если в запросе добавлено фото
			Storage::delete($photoPath);													//Удалить старое фото с сервера
			$photoPath = Storage::putFile('articles_img', $request->file('photo'), 'public');		//Добавить новое фото на сервер
        }
        $article->title = $request->title;
        $article->abbrText = $request->abbrText;
        $article->fullText = $request->fullText;
        $article->photo = $photoPath;
        $article->Save();
 
        return response()->json([
            'message' => 'Article updated'
        ],200);
    }
    
    //Добавить новость
    public function store(Request $request)
    {
        $photoPath = "";
		if (null !== $request->file('photo')) {												        //Если в запросе добавлено фото
			$photoPath = Storage::putFile('articles_img', $request->file('photo'), 'public');		//Добавить новое фото на сервер
        }
        
        $article = Article::create([
            'title' => $request->title,
            'abbrText' => $request->abbrText,
            'fullText' => $request->fullText,
            'photo' => $photoPath,

        ]);
        return response()->json([
            'message' => 'Article added'
        ],201);
    }
 
    //Удалить новость
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if (null !== $article->photo) {
            Storage::delete($article->photo);
        } 
        $article->delete();
        
        return response()->json([
            'message' => 'Article deleted'
        ],200);
    }
}
