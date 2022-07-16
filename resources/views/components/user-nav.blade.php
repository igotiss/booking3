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
                            href="{{route('home')}}">Усі оголошення</a>
                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='stays.own_index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('stays.own_index')}}">Мої оголошення</a>
                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='booking.index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('booking.index')}}">Керування бронюваннями</a>

                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='booking.own-index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('booking.own-index')}}">Мої бронювання</a>
                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='feedback.index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('feedback.index')}}">Відгуки</a>
                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='messages.index') class="nav-link active"
                           @else class="nav-link "
                           @endif
                           href="{{route('messages.index')}}">Системні повідомлення</a>
                    </li>

                    <li class="nav-item">
                        <a @if(Route::currentRouteName()==='profile.show') class="nav-link active"
                           @else class="nav-link "
                           @endif
                            class="nav-link" href="{{route('profile.show')}}">Керувати аккаунтом</a>
                    </li>




                </ul>

            </div>
        </div>
    </nav>
</div>
