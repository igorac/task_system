<header class="bg-purple">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="display-4 text-center text-white py-3">Task System</h1>
    @if ($auth) 
      <div class="d-flex">
        <p class="info-user mr-3"><i class="fa fa-user"></i> <span class="text-username">{{Auth::user()->name}}</span></p>
        <p class="link-logout text-white"><i class="fas fa-sign-out-alt mr-2"></i><a class="text-white" href=" {{ route('logout') }}">Sair</a></p>
      </div>
    @endif

  </div>
</header>
