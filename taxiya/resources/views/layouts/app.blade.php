<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaxiYa - @yield('title', 'Le Grand Taxi Réinventé')</title>
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="glass-nav fixed w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('trajets.index') }}" class="flex items-center gap-2 group">
                <div class="bg-yellow-500 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform">
                    <i class="fas fa-taxi text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800 tracking-tight">Taxi<span class="text-yellow-500">Ya</span></span>
            </a>
            
            <!-- Navigation Links -->
            <div class="flex items-center gap-6">
                @auth
                    <div class="hidden md:flex items-center gap-3 bg-gray-100 px-4 py-2 rounded-full">
                        <div class="w-8 h-8 bg-yellow-200 rounded-full flex items-center justify-center text-yellow-700 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="font-medium text-sm">{{ Auth::user()->name }}</span>
                    </div>

                    @if(Auth::user()->type === 'chauffeur')
                        <a href="{{ route('trajets.create') }}" class="hidden md:flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5 rounded-xl font-medium hover:bg-gray-800 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-plus"></i>
                            <span>Publier</span>
                        </a>
                    @endif

                    <a href="{{ route('reservations.index') }}" class="text-gray-600 hover:text-yellow-600 font-medium transition relative group">
                        Mes Réservations
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-yellow-500 transition-all group-hover:w-full"></span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition ml-2" title="Déconnexion">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-yellow-500 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-yellow-400 transition shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-24 pb-12 px-4 sm:px-6">
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-start gap-3 animate-fade-in-down">
                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm flex items-start gap-3 animate-fade-in-down">
                <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-yellow-500 text-white w-8 h-8 rounded flex items-center justify-center">
                            <i class="fas fa-taxi text-sm"></i>
                        </div>
                        <span class="text-2xl font-bold text-white">Taxi<span class="text-yellow-500">Ya</span></span>
                    </div>
                    <p class="text-gray-400 leading-relaxed max-w-sm">
                        La première plateforme digitale pour les Grands Taxis au Maroc. 
                        Voyagez confortablement, réservez simplement.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('trajets.index') }}" class="hover:text-yellow-500 transition">Rechercher un trajet</a></li>
                        <li><a href="#" class="hover:text-yellow-500 transition">Devenir Chauffeur</a></li>
                        <li><a href="#" class="hover:text-yellow-500 transition">Comment ça marche</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2"><i class="fas fa-envelope text-yellow-500"></i> support@taxiya.ma</li>
                        <li class="flex items-center gap-2"><i class="fas fa-phone text-yellow-500"></i> +212 5 22 00 00 00</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; {{ date('Y') }} TaxiYa. Tous droits réservés.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>