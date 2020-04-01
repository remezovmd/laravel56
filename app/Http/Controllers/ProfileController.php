<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\User;
use Auth;

class ProfileController extends Controller
{
    //Показать страницу профиля.
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile', ['user' => $user]);
    }
	

    //Сохранить ФИО, дату рождения и фото в БД.
    public function update(Request $request)
    {
		$user = User::findOrFail(Auth::user()->id);
		$photoPath = $user->photo;
		if (null !== $request->file('photo')) {												//Если в запросе добавлено фото
			Storage::delete($photoPath);													//Удалить старое фото с сервера
			$photoPath = Storage::putFile('photos', $request->file('photo'), 'public');		//Добавить новое фото на сервер
		}
		$user->name = $request->name;														//Обновить поля в БД
		$user->DOB = $request->DOB;
		$user->photo = $photoPath;
		
		$user->save();
			
		return view('profile', ['user' => $user]);
    }
}
