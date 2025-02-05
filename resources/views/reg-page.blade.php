<!DOCTYPE html>
<html lang="ru"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="FFP3Fz2S3TLt18t7EzZRqOsqIJVXjy3vDgYLeV1J">

        <title>TaskManager</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">

        <!-- Scripts -->
        <link rel="preload" as="style" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><link rel="modulepreload" href="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"><link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><script type="module" src="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"></script>    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!--   -->

        <h2 class="text-center"><a href="https://php-task-manager-ru.hexlet.app">Менеджер задач</a></h2>

        <!-- Validation Errors -->
        
        <form method="POST" action="/register">
            @csrf
            <!-- <input type="hidden" name="_token" value="FFP3Fz2S3TLt18t7EzZRqOsqIJVXjy3vDgYLeV1J" autocomplete="off"> -->
            <!-- Name -->
            @if(session('error'))
            <div class="mb-4">
            <div class="font-medium text-red-600">
                {{ session('error')['errorTitle'] }}
            </div>

            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                <li>{{ session('error')['errorContent'] }}</li>
            </ul>
            </div>
            @endif
            <div>
                <label class="block font-medium text-sm text-gray-700" for="name">
    Имя
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="name" type="text" name="name" required="required" autofocus="autofocus" value="{{ session('name') ?? '' }}">
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="email">
    Email
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="email" type="email" name="email" required="required" value="{{ session('email') ?? '' }}">
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password">
    Пароль
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
    Подтверждение
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required="required">
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/login">
                    Уже зарегистрированы?
                </a>

                <button type="submit" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
    Зарегистрировать
</button>
            </div>
        </form>
    </div>
</div>
        </div>
    

</body></html>