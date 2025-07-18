<!DOCTYPE html>
<html class="h-full dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @routes
    @vite(['resources/js/app.ts'])
    @inertiaHead
</head>

<body class="bg-gray-100 dark:bg-blue-950 font-sans leading-none text-gray-700 dark:text-gray-100 antialiased">
    @inertia
</body>

</html>
