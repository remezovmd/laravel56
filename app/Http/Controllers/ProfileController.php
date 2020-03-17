<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Storage;
use File;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Показать страницу профиля.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }
	
	/**
     * Сохранить ФИО, дату рождения и фото в БД.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		if (null !== $request->file('photo')) {												//Если в запросе есть фото
			$photoPath = DB::table('users')->where('id', $request->id)->value('photo');		
			Storage::delete($photoPath);													//Удалить старое фото с сервера
			$photoPath = Storage::putFile('photos', $request->file('photo'), 'public');		//Добавить новое фото на сервер
			DB::table('users')																//Сохранить информацию в БД
            ->where('id', $request->id)
            ->update(
				['name' => $request->name,
				'DOB' => $request->DOB,
				'photo' => $photoPath]
			);
		}
		else {																				//Если в запросе нет фото
			DB::table('users')																//Сохранить информацию в БД (не изменяя поле photo)
				->where('id', $request->id)
				->update(
					['name' => $request->name,
					'DOB' => $request->DOB]
				);
		}
		return view('profile');
    }
}
