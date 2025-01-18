<!DOCTYPE html>
<html lang="ru"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="wuNqy0P6TTzSdzkwsgo1NxUUjDCs8RDGN9ZLDJXS">

        <title>TaskManager</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">

        <!-- Scripts -->
        <link rel="preload" as="style" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><link rel="modulepreload" href="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"><link rel="stylesheet" href="https://php-task-manager-ru.hexlet.app/build/assets/app.4885a691.css"><script type="module" src="https://php-task-manager-ru.hexlet.app/build/assets/app.42df0f0d.js"></script>    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-center"><a href="https://php-task-manager-ru.hexlet.app">Менеджер задач</a></h2>

        <!-- Session Status -->
        
        <!-- Validation Errors -->
        
        <form method="POST" action="https://php-task-manager-ru.hexlet.app/login">
            <input type="hidden" name="_token" value="wuNqy0P6TTzSdzkwsgo1NxUUjDCs8RDGN9ZLDJXS" autocomplete="off">
            <!-- Email Address -->
            <div>
                <label class="block font-medium text-sm text-gray-700" for="email">
    Email
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="email" type="email" name="email" required="required" autofocus="autofocus">
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700" for="password">
    Пароль
</label>

                <input class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="current-password">
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="https://php-task-manager-ru.hexlet.app/forgot-password">
                        Забыли пароль?
                    </a>
                
                <button type="submit" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-3">
    Войти
</button>
            </div>
        </form>
    </div>
</div>
        </div>
    

</body></html>
