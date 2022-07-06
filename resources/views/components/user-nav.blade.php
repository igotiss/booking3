<div class="container">

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid border border-info">
            <span class="navbar-brand" >Панель інструментів</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                    <li class="nav-item">
                        <a  @if(Route::currentRouteName()==='home') class="nav-link active"
                            @else class="nav-link "
                            @endif
                            href="{{route('home')}}">Усі об'яви</a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='stays.own_index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('stays.own_index')}}">Мої об'яви</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Бронювання</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Відгуки</a>
                    </li>
                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='profile.show') class="nav-link active"
                           @else class="nav-link "
                           @endif
                            class="nav-link" href="{{route('profile.show')}}">Налаштування</a>
                    </li>




                </ul>

            </div>
        </div>
    </nav>
</div>
