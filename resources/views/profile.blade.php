@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Профиль пользователя</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<form enctype="multipart/form-data" method="POST" action="{{ route('profile-update') }}" aria-label="{{ __('Profile') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="DOB" class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

                            <div class="col-md-6">
                                <input id="DOB" type="date" class="form-control" name="DOB" value="{{ $user->DOB }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Фото') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control-file" name="photo">
                            </div>
                        </div>
                        @if (Null !== $user->photo)
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <img id="preview" src="storage/{{$user->photo}}" width = 100%>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Сохранить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
