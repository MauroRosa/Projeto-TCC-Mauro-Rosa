<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Professor - IFRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="IFRS" class="h-12 md:h-16">
                <div>
                    <h1 class="text-lg md:text-xl font-bold text-gray-800">Painel do Professor</h1>
                    <p class="text-sm text-gray-600">Sistema de Língua Portuguesa</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 text-sm md:text-base">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('sair') }}">
                    @csrf
                    <button type="submit" class="text-white px-4 py-2 rounded text-sm md:text-base"
                            style="background-color: #cd2129;"
                            onmouseover="this.style.backgroundColor='#a71b22'"
                            onmouseout="this.style.backgroundColor='#cd2129'">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">Bem-vindo, Professor!</h2>

        <!-- Cards de Ações -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Gerenciar Questionários -->
            <a href="{{ route('professor.painel') }}" 
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Questionários</h3>
                    <svg class="w-12 h-12" style="color: #41a24d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">Crie, edite e gerencie seus questionários</p>
                <div class="text-sm font-semibold" style="color: #41a24d;">
                    Gerenciar →
                </div>
            </a>

            <!-- Gerenciar Conteúdos -->
            <a href="{{ route('professor.conteudos.index') }}" 
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Conteúdos</h3>
                    <svg class="w-12 h-12" style="color: #41a24d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-gray-600 mb-4">Adicione materiais de estudo para os alunos</p>
                <div class="text-sm font-semibold" style="color: #41a24d;">
                    Gerenciar →
                </div>
            </a>

            <!-- Estatísticas -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Estatísticas</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total de Questionários:</span>
                        <span class="font-bold text-2xl" style="color: #41a24d;">{{ $totalQuestionarios ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Questionários Ativos:</span>
                        <span class="font-bold text-2xl" style="color: #41a24d;">{{ $questionariosAtivos ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="mt-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Ações Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('professor.questionarios.create') }}" 
                   class="text-white px-6 py-4 rounded-lg font-semibold text-center"
                   style="background-color: #41a24d;"
                   onmouseover="this.style.backgroundColor='#358a3f'"
                   onmouseout="this.style.backgroundColor='#41a24d'">
                    + Criar Novo Questionário
                </a>
                
                <a href="{{ route('professor.conteudos.create') }}" 
                   class="text-white px-6 py-4 rounded-lg font-semibold text-center"
                   style="background-color: #41a24d;"
                   onmouseover="this.style.backgroundColor='#358a3f'"
                   onmouseout="this.style.backgroundColor='#41a24d'">
                    + Adicionar Conteúdo
                </a>
            </div>
        </div>
    </div>
</body>
</html>