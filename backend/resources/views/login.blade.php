@extends('layouts.entete')
@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-10 col-lg-6 mt-5">
            <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary mt-5" action="{{ route('soumission')}}" method="POST">
                @csrf
                <div class="container d-flex justify-content-center align-items-center mb-4">
                    <img class="rounded-circle" src="{{ asset('images/11.jpeg')}}" alt="" width="150px" height="150px">
                </div>
                <div class="form-floating mb-3">
                    <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="floatingInput"
                    placeholder="name@example.com"
                    />
                    <label for="floatingInput">Addresse e-mail</label>
                    <div class="text-danger">
                        @error("email")
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="Password"
                    />
                    <label for="floatingPassword">Mot de passe </label>
                    <div class="text-danger">
                        @error("password")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me" /> Se souvenir de  moi
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">
                    Se connecter
                </button>
                <hr class="my-4" />
                <small class="text-body-secondary">En cliquant vous vous conformez aux règles d'utilisation de ctte application</small>
            </form>
          </div>
    </div>

@endsection

