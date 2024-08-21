<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($title) ? "$title - ". config('app.name') : config('app.name') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>
<body class="bg-slate-100 dark:bg-slate-700 font-sans antialiased scroll-smooth">
@livewire('partials.header')
{{ $slot }}
@livewire('partials.footer')
@livewireScripts
</body>
</html>
