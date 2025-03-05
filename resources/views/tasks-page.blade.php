<!DOCTYPE html>
<html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="QBgufX5RVQYSHAyIdoNyJwalRrMnBS8aP7sCSC8L">
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
            <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a href="https://php-task-manager-ru.hexlet.app" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                    </a>

                    <div class="flex items-center lg:order-2">
                        @auth
                        <form method="post" action="/logout">
                            @csrf
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">Выход</button>
                        </form>
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
    <h1 class="mb-5">Задачи</h1>

    <div class="w-full flex items-center">
        <div>
            <form method="GET" action="{{ route('tasks.page') }}">
            <div class="flex">
                <select class="rounded border-gray-300" name="filter[status_id]" id="filter[status_id]">
                    <option value="" selected>Статус</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ request("filter.status_id") == $status->id ? "selected" : "" }}>{{ $status->name }}</option>
                    @endforeach
                </select>
                <select class="rounded border-gray-300" name="filter[created_by_id]" id="filter[created_by_id]">
                    <option value="" selected="selected">Автор</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request("filter.created_by_id") == $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                <select class="rounded border-gray-300" name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                    <option value="" selected="selected">Исполнитель</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request("filter.assigned_to_id") == $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="submit">Применить</button>
                
            </div></form>
        </div>

        <div class="ml-auto">
            @auth
                        <a href="/tasks/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                Создать задачу            </a>
            @endauth
        </div>
        </div>

    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Автор</th>
                <th>Исполнитель</th>
                <th>Дата создания</th>
                            </tr>
        </thead>
                <tbody>
                    @foreach ($tasks->slice($page * 15 - 15, 15) as $task)
                    <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td>
                                <a class="text-blue-600 hover:text-blue-900" href="/tasks/{{ $task->id }}">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $task->author->name }}</td>
                            <td>{{ $task->performer->name }}</td>
                            <td>{{ $task->created_at }}</td>
                            @auth
                                <td>
                                    @can('update', $task)
                                    <form method="POST" action="{{ route('task.destroy', $task->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                 <button type="submit" class="text-red-600 hover:text-red-900">
                        Удалить
                    </button>
                </form>
                                @endcan
                                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('task.update.page', $task->id) }}">
                                        Изменить
                                    </a>
                                </td>
                            @endauth
                        </tr>
                        @endforeach

            </tbody></table>

    <div class="mt-4">
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    Showing
                    <span class="font-medium">{{ count($tasks) == 0 ? 0 : 15 * ($page - 1) + 1 }}</span>
                    to
                        <span class="font-medium">{{ 15 * ($page - 1) + count($tasks->slice($page * 15 - 15, 15)) }}</span>
                                        of
                    <span class="font-medium">{{ count($tasks) }}</span>
                    results
                </p>
            </div>

            <div>
                    
                    
                                            
                        
                        @if (count($tasks) > 15)
                        <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                        @if ($page == 1)
                        <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </span>
                        @else
                        <a href="/tasks?page={{ $page-1 }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="&amp;laquo; Previous">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        @endif
                            @for ($i=1;$i <= ceil(count($tasks) / 15);$i++)
                                @if ($i == $page)
                                <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $i }}</span>
                                    </span>
                                @else
                                <a href="/tasks?page={{ $i }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page {{ $i }}">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor
                        </span>
                        @if ($page >= ceil(count($tasks) / 15))
                        <span aria-disabled="true" aria-label="Next &amp;raquo;">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </span> 
                        @else
                        <a href="/tasks?page={{ $page + 1 }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        @endif
                        @endif
            </span>
            </div>
        </div>
    </nav>

    </div>
</div>
            </div>
        </section>
    </div>


</body></html>