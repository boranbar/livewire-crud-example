<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    @livewireStyles
    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <h1 class="bg-dark text-white mb-0">Hashid Test</h1>
    <livewire:product-list />
</div>
<script src="{{mix('js/app.js')}}" defer></script>
@livewireScripts
@stack('scripts')
</body>
</html>
