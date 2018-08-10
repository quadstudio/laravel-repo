@if(isset($repository) && $repository->canDraw())
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <a class="navbar-brand mb-1" href="#">@lang('repo::messages.filters')</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFilter"
                aria-controls="navbarFilter" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarFilter">
            <form method="get" action="" class="form-inline my-2 my-lg-0">
                {{ $repository->toHtml() }}
                <div class="input-group mb-1">
                    <button class="btn btn-ferroli mr-1" type="submit">
                        <i class="fa fa-search"></i>
                        <span>@lang('repo::messages.search_button')</span>
                    </button>
                    <a href="{{ route(Route::currentRouteName(), isset($route_param) ? $route_param : []) }}"
                       class="btn btn-secondary">
                        <i class="fa fa-repeat"></i>
                        <span>@lang('repo::messages.reset_button')</span>
                    </a>
                </div>
            </form>

        </div>
    </nav>
@endif