<html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">

    <title>Менеджер задач</title>

    <!-- Scripts -->
    <link rel="preload" as="style" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><link rel="modulepreload" href="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"><link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><script type="module" src="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
    <header class="fixed w-full">
            <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a href="/" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>
                    <div class="flex items-center lg:order-2">
                        @auth
                        <a href="/logout" data-method="post" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Выход
                            </a>
                        @endauth
                        @guest
                        <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Вход
                        </a>
                        <a href="/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                               Регистрация
                        </a>
                        @endguest
                    </div>

                    <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="/tasks" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Задачи                                </a>
                            </li>
                            <li>
                                <a href="/task_statuses" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Статусы                                </a>
                            </li>
                            <li>
                                <a href="/labels" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Метки                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <section class="bg-white">
            <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                                <div class="grid col-span-full">
    <h1 class="mb-5">Изменение метки</h1>

    <form class="w-50" method="POST" action="/labels/{{ $label->id }}"><input type="hidden" name="_method" id="_method" value="PATCH"><input type="hidden" name="_token" value="pgxAZY6IVH1vWcT6mW7AHe4b4siHqAEEP2km7jyv">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex flex-col">
        <div>
            <label for="name">Имя</label>
        </div>
        <div class="mt-2">
            <input class="rounded border-gray-300 w-1/3" type="text" name="name" id="name" value="{{ $label->name }}">
        </div>
                <div class="mt-2">
            <label for="description">Описание</label>
        </div>
        <div class="mt-2">
            <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" id="description">{{ $label->description }}</textarea>
        </div>
                <div class="mt-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Обновить</button>
        </div>
    </div>
    </form>
</div>
            </div>
        </section>
    </div>


</body></html>
<!DOCTYPE html>