<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}} </title>
    <link rel="stylesheet" href="{{asset('css/client.css')}}">
    <script src="{{'js/client.js'}}" ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        .profile-img{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body class="">

{{-- Header --}}
<nav class="h-auto  z-[999] p-4 fixed w-full text-white" style="backdrop-filter: blur(10px);">
    <div class="flex justify-between w-full items-center pb-4">
        <span class="text-white font-light cursor-pointer flex-1" onclick="toggleSidebar()"><img
                src={{{ asset('images/icons8-menu-50.png') }}} alt="" srcset=""></span>
        <h1 class="text-center text-[#fc444a] font-light sm:text-[23px] text-[19px] xxl:text-[40px] flex-1">
            <span class="text-white">News</span> Forum
        </h1>
        <div class="flex justify-end gap-4 mr-2 text-white sm:text-md text-sm flex-1  " id="nav-right">
            <div id="userDropdown" class="z-10 hidden position-relative  bg-white divide-y divide-gray-100 rounded-lg shadow w-75 dark:bg-gray-700 dark:divide-gray-600" style="position: absolute;top: 50%">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div id="user-name"></div>
                    <div class="font-medium truncate" id="user-email"></div>
                </div>

                <div class="py-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="logout()">Log out</a>
                </div>
            </div>
        </div>
    </div>
    <hr class="w-[100%] mx-auto"/>
    <div class="w-full pt-5 font-thin px-8 flex justify-center gap-7 sm:text-[20px] sm:gap-9 text-sm items-center">
        <a href="{{route('home')}}"><p>Home</p></a>
        <a href="{{ route('page', 'Europe') }}"><p>Europe</p></a>
        <a href="{{ route('page', 'Afrique') }}"><p>Afrique</p></a>
        <a href="{{ route('page', 'Économie') }}"><p>Économie</p></a>
        <a href="{{ route('page', 'Sports') }}"><p>Sports</p></a>
        <script>
            const token = localStorage.getItem('token');

            if (token) {
                document.write('<a href="/favoris"><p>Favoris</p></a>');
            }
        </script>
    </div>
</nav>
<div id="sidebar" class="hidden sm:w-[30%] w-[60%] h-full bg-white z-[1000] flex items-center justify-start px-3 py-8 ">
    <p class="absolute right-5 top-5 cursor-pointer" onclick="toggleSidebar()"><img
            src={{{ asset('images/icons8-close-50.png') }}} alt="" srcset=""></p>
    <ul class="flex flex-col gap-5 relative">
        <a href="/"><p
                class="uppercase sm:text-[35px] text-[28px] font-light cursor-pointer hover:text-[#fc444a] hover:tracking-[0.2em]">
                Home</p></a>
        <a href="/page/Europe"><p
                class="uppercase sm:text-[35px] text-[28px] font-light cursor-pointer hover:text-[#fc444a] hover:tracking-[0.2em]">
                Europe</p></a>
        <a href="/page/Afrique"><p
                class="uppercase sm:text-[35px] text-[28px] font-light cursor-pointer hover:text-[#fc444a] hover:tracking-[0.2em]">
                Afrique</p></a>
        <a href="/page/Économie"><p
                class="uppercase sm:text-[35px] text-[28px] font-light cursor-pointer hover:text-[#fc444a] hover:tracking-[0.2em]">
                Économie</p></a>
        <a href="/page/Sports"><p
                class="uppercase sm:text-[35px] text-[28px] font-light cursor-pointer hover:text-[#fc444a] hover:tracking-[0.2em]">
                Sports</p></a>
        
    </ul>

</div>

<!-- ./header -->
{{-- Main --}}
<div class='w-[85%] mx-auto '>
    <div class='text-white relative pt-[9.5rem] ' id="main">
        {{$slot}}
    </div>
</div>
{{-- Main --}}

{{-- Footer --}}
<div class='w-full h-[240px] text-white'>
    <hr class='w-full text-slate-600 h-[0.1px] font-thin'/>
    <div class='w-[85%] mx-auto pt-[2.3rem] pb-2 '>
        <div class='w-[60%]'>
            <h1 class='text-3xl mb-4'>Subscribe to our <span class='text-[#fc444a]'>Newsletter</span> for <span
                    class='text-[#fc444a]'>daily updates!</span></h1>
            <form method="POST" action="{{route('add_subscriber')}}">
                <input
                    class='bg-black border-b mr-2 border-b-white outline-none text-2xl text-gray-400 my-4 w-[140%] sm:w-[50%]'
                    name="subscriber" type="email" placeholder='Email'/><br></br>
                <button type='submit'
                        class='my-3 uppercase text-xl font-light border p-1 hover:text-[#fc444a] hover:border-[#fc444a]'>
                    Subscribe
                </button>
            </form>
        </div>
    </div>

</div>

<footer class='text-center text-white bg-black mt-3 mb-[1.3rem]'>
    <p class='text-center font-thin text-slate-500'>&#169;2023-2024 Designed and Developed by
        <a href="https://github.com/kidusfmariam" target="_blank" class='text-[#fc444a]'> Team H</a>
    </p>
</footer>
{{-- Footer --}}
@livewireScripts
</body>
</html>
