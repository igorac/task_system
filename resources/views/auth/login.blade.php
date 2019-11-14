@extends('layouts.app')
@section('title', 'Login')

@section('menu')
  @component('components.menu', ['auth' => FALSE])
  @endcomponent
@endsection

@section('body')
<section class="container my-5">
  <div class="card">
    <div class="card-header bg-purple">
      <h5 class="card-title text-white text-center mt-2">Entrar no sistema</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('login.do') }}" method="post">
        
        @csrf

        <div class="form-group">
          <label for="name">Login</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
      
        <div class="form-group">
          <label for="name">Senha</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
      
        <div class="text-right">
          <button type="submit" class="btn bg-purple text-white">Entrar</button>
          <button type="reset" class="btn bg-purple text-white">Cancelar</button>
        </div>
       
      </form>
    </div>
  </div>
      
  @if ($errors->all())
    @foreach ($errors->all() as $erro)
      <div class="alert alert-danger my-3" role="alert">{{ $erro }}</div>
    @endforeach
  @endif

</section>
@endsection
