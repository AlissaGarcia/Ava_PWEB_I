<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistema de Notas Acadêmicas')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navegação -->
    <nav class="bg-white shadow-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo/Home -->
                <div class="flex items-center">
                    <a href="@auth{{ route('dashboard') }}@else{{ url('/') }}@endauth" 
                       class="flex items-center space-x-2 text-indigo-600 hover:text-indigo-700">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-13-4h8m-8 3h8m-8 3h5"></path>
                        </svg>
                        <span class="font-bold text-lg">Notas Acadêmicas</span>
                    </a>
                </div>

                <!-- Menu para usuários autenticados -->
                @auth
                    <div class="flex items-center space-x-6">
                        <!-- Links principais -->
                        <a href="{{ route('dashboard') }}" 
                           class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium 
                                  @if(Route::currentRouteName() === 'dashboard') text-indigo-600 @endif">
                            Dashboard
                        </a>
                        <a href="{{ route('notes.index') }}" 
                           class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium
                                  @if(str_contains(Route::currentRouteName(), 'notes')) text-indigo-600 @endif">
                            Minhas Notas
                        </a>
                        <a href="{{ route('notes.trash') }}" 
                           class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1
                                  @if(Route::currentRouteName() === 'notes.trash') text-indigo-600 @endif">
                            <span>🗑️</span>
                            <span>Lixeira</span>
                            @if(auth()->user()->notes()->onlyTrashed()->exists())
                                <span class="ml-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full">
                                    {{ auth()->user()->notes()->onlyTrashed()->count() }}
                                </span>
                            @endif
                        </a>

                        <!-- Menu do Usuário -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="hidden group-hover:block absolute right-0 mt-0 w-48 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Meu Perfil
                                </a>
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Configurações
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Menu para visitantes -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                            Registrar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Header (com slot opcional) -->
    @if(isset($header))
        <header class="bg-white shadow border-b border-gray-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Conteúdo Principal -->
    <main class="min-h-screen">
        <!-- Exibir mensagens de sucesso/erro -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-4 rounded-lg">
                    <div class="flex">
                        <svg class="h-5 w-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-4 rounded-lg">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Conteúdo da página -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 mt-20 py-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8">
                <div>
                    <h3 class="text-white font-semibold mb-4">Sistema de Notas</h3>
                    <p class="text-sm">Um sistema seguro e confiável para gerenciar suas notas acadêmicas.</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Links Úteis</h3>
                    <ul class="space-y-2 text-sm">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a></li>
                            <li><a href="{{ route('notes.index') }}" class="hover:text-white">Minhas Notas</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white">Registrar</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Suporte</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Ajuda</a></li>
                        <li><a href="#" class="hover:text-white">Contato</a></li>
                        <li><a href="#" class="hover:text-white">Privacidade</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Sistema de Notas Acadêmicas. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
