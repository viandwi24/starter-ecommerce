@php
    $topMenu = [
        [ 'text' => 'Home', 'link' => route('home') ],
        [ 'text' => 'Contact Us', 'link' => route('home') ],
        [ 'text' => 'Register', 'link' => route('home') ],
        [ 'text' => 'Login', 'link' => route('home') ],
    ];
    $actionMenu = [
        [ 'link' => route('home'), 'icon' => 'fa fa-shopping-cart text-xl' ],
    ];
@endphp

<!-- Navbar -->
<nav id="navbar" class="navbar">
    <div id="navbar-top" class="bg-red-100">
        <x-container>
            <ul class="flex justify-end space-x-3">
                @foreach ($topMenu as $item)
                    <li>
                        <a href="{{ $item['link'] }}" class="text-xs text-muted">
                            {{ $item['text'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </x-container>
    </div>
    <div id="navbar-bottom" class="bg-red-500">
        <x-container class="flex py-4 text-white">
            <a href="{{ route('home') }}" class="brand self-center text-2xl font-semibold">
                {{ env('APP_NAME', 'ESHOP') }}
            </a>
            <form action="" class="w-1/5 pl-4">
                <input
                    type="text"
                    placeholder="Search Product..."
                    class="
                        w-full
                        py-2 px-4 text-sm
                        rounded outline-none transition-all duration-300
                        bg-red-400 text-white placeholder-white
                        hover:text-primary hover:bg-red-200 hover:placeholder-primary
                        focus:text-primary focus:bg-red-200 focus:placeholder-primary
                    "
                >
            </form>
            <ul class="menu flex-1 flex justify-end items-center space-x-2">
                @foreach ($actionMenu as $item)
                    <li>
                        <a href="{{ $item['link'] }}" class="transition-colors duration-300 text-white hover:text-black">
                            @isset($item['text'])
                                {!! $item['text'] !!}
                            @endisset
                            @isset($item['icon'])
                                <i class="{{ $item['icon'] }} text-xl"></i>
                            @endisset
                        </a>
                    </li>
                @endforeach
                {{-- <li>
                    <a href="" class="transition-colors duration-300 text-white hover:text-black">
                        <i class="fa fa-shopping-cart text-xl"></i>
                    </a>
                </li> --}}
                <li class="px-4">
                    <div class="h-5 w-0.5 bg-white"></div>
                </li>
                {{-- auth nav --}}
                @auth('customer')
                    <li>
                        <a href="" class="transition-colors duration-300 text-white hover:text-black">
                            {{-- <span class="text-xs">Rp 10000</span> --}}
                            <i class="fa fa-user text-xl"></i>
                        </a>
                    </li>
                @endauth
                @guest('customer')
                <li>
                    <x-button text="Register" tag="a" size="sm" color="navbar-secondary" />
                </li>
                    <li>
                        <x-button text="Login" tag="a" size="sm" color="navbar-primary" />
                    </li>
                @endguest
            </ul>
        </x-container>
    </div>
</nav>


@push('scripts')
    <script>
        const navbar = document.querySelector('#navbar');
        const navbarTop = document.querySelector('#navbar-top');
        const navbarBottom = document.querySelector('#navbar-bottom');
        const navbarBaseHeight = navbarTop.offsetHeight;
        const navbarTopBaseHeight = navbarTop.clientHeight;
        const offset = 20;
        const onWindowScroll = function() {
            const requiredClass = ['fixed', 'w-full', 'z-20', 'top-0', 'left-0']
            // keep navbarBottom fixed top when scroll down
            if (window.scrollY > navbarBottom.offsetHeight + offset) {
                const result = (navbarTopBaseHeight + navbarBottom.clientHeight);
                if (navbarTop.clientHeight !== result) {
                    navbarTop.style.height = `${result}px`;
                }
                if (!navbarBottom.classList.contains(requiredClass[0])) {
                    navbarBottom.classList.add(...requiredClass);
                    navbarBottom.animate([
                        { transform: 'translateY(-10vh)' },
                        { transform: 'translateY(0)' },
                    ], {
                        duration: 300,
                        easing: 'ease-out',
                    });
                }
            } else if (window.scrollY < (navbarBottom.offsetHeight * 2) + offset) {
                navbarTop.style.height = `${navbarTopBaseHeight}px`;
                navbarBottom.classList.remove(...requiredClass);
            }
            // console.log({
            //     s: window.scrollY ,
            //     nb: navbarBottom.offsetHeight
            // })
        };
        window.addEventListener('scroll', onWindowScroll);
        window.addEventListener('DOMContentLoaded', onWindowScroll);
    </script>
@endpush
