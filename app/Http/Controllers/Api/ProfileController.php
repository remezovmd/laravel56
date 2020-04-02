<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //Показать профиль пользователя
    public function show(Request $request)
    {
       return User::findOrFail(Auth::user()->id);
    }
    
    //Изменить профиль пользователя
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $photoPath = $user->photo;
		if (null !== $request->file('photo')) {	
            echo 'photo';											//Если в запросе добавлено фото
			Storage::delete($photoPath);													//Удалить старое фото с сервера
			$photoPath = Storage::putFile('photos', $request->file('photo'), 'public');		//Добавить новое фото на сервер
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->photo = $photoPath;
        $user->Save();
        
        return response()->json([
            'message' => 'Profile updated'
        ],200);
    }
    
    
}
