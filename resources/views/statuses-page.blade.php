<!DOCTYPE html>
<meta charset="utf-8">
<html lang="ru"><head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
    <meta name="csrf-token" content="GtAnPZl9b8c1tjyIvS6hC7bfbhclbe0jzXvbZzKf">
    <meta name="csrf-param" content="_token">

    <title>Менеджер задач</title>

    <!-- Scripts -->
    <link rel="preload" as="style" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><link rel="modulepreload" href="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"><link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><script type="module" src="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="fixed w-full">
            <nav class="bg-white border-gray-200 py-2.5 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a href="https://php-task-manager-ru.hexlet.app" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>

                    <div class="flex items-center lg:order-2">
                        @if (Auth::user())
                        <form method="post" action="/logout">
                            @csrf
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">Выход</button>
                        </form>
                        @else
                        <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Вход
                        </a>
                        <a href="/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                               Регистрация
                        </a>
                        @endif
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
    <h1 class="mb-5">Статусы</h1>

    <div>
        @if(Auth::user())
        <a href="/task_statuses/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Создать статус
        </a>
        @endif
            </div>
            <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th style="color:#2861C3">ID</th>
                <th style="color:#2861C3">Имя</th>
                <th style="color:#2861C3">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr class="border-b border-dashed text-left">
                <td style="color:#2861C3">{{ $status->status_id }}</td>
                <td style="color:#2861C3">{{ $status->name }}</td>
                <td style="color:#2861C3">{{ $status->created_at }}</td>
                @if(Auth::user())
                <td>
                    <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="/task_statuses/{{ $status->status_id }}">
                        Удалить
                    </a>
                    <a class="text-blue-600 hover:text-blue-900" href="/task_statuses/{{ $status->status_id }}/edit">
                        Изменить
                    </a>
                </td>
                @endif
            </tr>
            @endforeach
            </tbody></table>
    
</div>
            </div>
        </section>
    </div>


</body></html>