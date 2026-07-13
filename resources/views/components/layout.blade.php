<!DOCTYPE html>
<html class="h-full bg-red-950" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>DND Helper</title>
    <link href="{{ asset('icons/d20_icon.png') }}" rel="icon" type="image/x-icon">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    @livewireStyles
</head>

<body class="min-h-full bg-black/30">
    <div class="min-h-full">
        <nav class="bg-red-950/50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="size-12" src="{{ asset('icons/d20_icon.png') }}" alt="D20 Logo" />
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <x-nav-link href="/" :active="request()->is('/')">
                                    Домой
                                </x-nav-link>
                                <x-nav-link href="/tracker" :active="request()->is('tracker')">
                                    Трекер
                                </x-nav-link>
                                <x-nav-link href="/effects" :active="request()->is('effects*')">
                                    Эффекты
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header
            class="relative bg-red-700/30 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white">{{ $heading }}</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 text-slate-100 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>

</html>
