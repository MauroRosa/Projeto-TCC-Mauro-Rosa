<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Questionários - TCC Mauro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #e5e5e5;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="Logo IFRS" class="h-12">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Meus Questionários</h1>
                    <p class="text-sm text-gray-600">{{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('professor.painel') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                    ← Voltar
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-[#cd2129] hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Mensagens -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Botão Criar Novo -->
        <div class="mb-6">
            <a href="{{ route('professor.questionarios.create') }}" class="inline-block bg-[#41a24d] hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                + Criar Novo Questionário
            </a>
        </div>

        <!-- Lista de Questionários -->
        @if($questionarios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($questionarios as $questionario)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <!-- Status Badge -->
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $questionario->ativo ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $questionario->ativo ? '🟢 Ativo' : '⚫ Inativo' }}
                    </span>
                    <span class="text-gray-500 text-sm">{{ $questionario->questoes_count }} questões</span>
                </div>

                <!-- Título e Descrição -->
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $questionario->titulo }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $questionario->descricao ?: 'Sem descrição' }}</p>

                <!-- Data -->
                <p class="text-xs text-gray-500 mb-4">Criado em: {{ $questionario->created_at->format('d/m/Y') }}</p>

                <!-- Botões de Ação -->
                <div class="flex gap-2">
                    <a href="{{ route('professor.questionarios.show', $questionario->id) }}" class="flex-1 bg-[#41a24d] hover:bg-green-700 text-white text-center px-4 py-2 rounded-lg text-sm font-semibold transition">
                        Abrir
                    </a>
                    <a href="{{ route('professor.questionarios.edit', $questionario->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        Editar
                    </a>
                    <form action="{{ route('professor.questionarios.destroy', $questionario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este questionário?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-[#cd2129] hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Nenhum questionário criado</h3>
            <p class="text-gray-600 mb-6">Comece criando seu primeiro questionário!</p>
            <a href="{{ route('professor.questionarios.create') }}" class="inline-block bg-[#41a24d] hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                + Criar Primeiro Questionário
            </a>
        </div>
        @endif
    </main>
</body>
</html>