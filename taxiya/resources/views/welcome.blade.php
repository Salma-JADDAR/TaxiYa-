@extends('layouts.app')

@section('title', 'Bienvenue')

@section('content')
<!-- Hero Section -->
<div class="relative -mt-24 pt-32 pb-20 overflow-hidden">
    <!-- Abstract Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 left-0 -ml-20 -mt-20 w-[600px] h-[600px] bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 -ml-20 -mb-20 w-[600px] h-[600px] bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto relative z-10 px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Context Text -->
            <div class="space-y-8 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-4 py-1.5 rounded-full font-semibold text-sm">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span>
                    Le 1er réseau de Grands Taxis connectés
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 leading-tight">
                    Voyagez vers <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-orange-600">
                        tous les horizons
                    </span>
                </h1>
                
                <p class="text-xl text-gray-600 leading-relaxed max-w-lg">
                    Fini l'attente interminable en station. Réservez votre place, choisissez votre confort et partez à l'heure prévue.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('trajets.index') }}" class="group bg-gray-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-gray-800 transition shadow-xl hover:shadow-2xl flex items-center justify-center gap-3">
                        <span>Rechercher un trajet</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#comment-ca-marche" class="bg-white text-gray-800 border-2 border-gray-100 px-8 py-4 rounded-2xl font-bold hover:border-yellow-200 hover:bg-yellow-50 transition flex items-center justify-center gap-3">
                        <i class="fas fa-play-circle text-yellow-500 text-xl"></i>
                        <span>Comment ça marche</span>
                    </a>
                </div>

                <div class="flex items-center gap-8 pt-4 border-t border-gray-200/50">
                    <div>
                        <span class="block text-3xl font-bold text-gray-900">8M+</span>
                        <span class="text-gray-500 text-sm">Voyageurs quotidiens</span>
                    </div>
                    <div>
                        <span class="block text-3xl font-bold text-gray-900">100%</span>
                        <span class="text-gray-500 text-sm">Couverture nationale</span>
                    </div>
                </div>
            </div>

            <!-- Interactive Search Card -->
            <div class="relative perspective-1000">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-3xl blur opacity-30"></div>
                <div class="relative bg-white p-8 rounded-3xl shadow-2xl border border-gray-100 transform rotate-y-12 hover:rotate-0 transition-transform duration-500">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">
                            <i class="fas fa-search-location text-yellow-500 mr-2"></i>
                            Où allez-vous ?
                        </h3>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Disponible</span>
                    </div>

                    <form action="{{ route('trajets.index') }}" method="GET" class="space-y-5">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Départ</label>
                            <div class="relative">
                                <i class="fas fa-map-marker-alt absolute left-4 top-3.5 text-gray-400"></i>
                                <input type="text" name="depart" placeholder="Ex: Casablanca" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition font-medium">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Arrivée</label>
                            <div class="relative">
                                <i class="fas fa-location-arrow absolute left-4 top-3.5 text-gray-400"></i>
                                <input type="text" name="arrivee" placeholder="Ex: Marrakech" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition font-medium">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Date</label>
                            <div class="relative">
                                <i class="far fa-calendar-alt absolute left-4 top-3.5 text-gray-400"></i>
                                <input type="date" name="date" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 transition font-medium">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-yellow-500/30 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <span>Voir les trajets</span>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features -->
<div class="bg-white py-20" id="comment-ca-marche">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">L'expérience Grand Taxi, <br>niveau supérieur</h2>
            <p class="text-gray-500">Nous avons gardé ce qui fonctionne et amélioré tout le reste.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-yellow-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl text-yellow-500 mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-couch"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Choix de la place</h3>
                <p class="text-gray-500 leading-relaxed">
                    Préférez-vous être devant à côté du chauffeur ou derrière près de la fenêtre ? Choisissez votre siège exact sur l'app.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-yellow-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl text-yellow-500 mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Départs garantis</h3>
                <p class="text-gray-500 leading-relaxed">
                    Plus besoin d'attendre que le taxi se remplisse. Les horaires sont fixés à l'avance et le départ est garanti.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="group p-8 rounded-3xl bg-gray-50 hover:bg-yellow-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-2xl text-yellow-500 mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Transparence totale</h3>
                <p class="text-gray-500 leading-relaxed">
                    Prix fixes, identité du chauffeur vérifiée et avis des autres voyageurs. Voyagez en toute sérénité.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>
@endsection