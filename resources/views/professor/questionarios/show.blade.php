<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questões - {{ $questionario->titulo }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="IFRS" class="h-12 md:h-16">
                <div>
                    <h1 class="text-lg md:text-xl font-bold text-gray-800">{{ $questionario->titulo }}</h1>
                    <p class="text-sm text-gray-600">Gerenciar Questões</p>
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
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('professor.questionarios.index') }}" class="font-semibold" style="color: #41a24d;">
                ← Voltar para Questionários
            </a>
        </div>

        <!-- Informações do Questionário -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $questionario->titulo }}</h2>
                    @if($questionario->descricao)
                        <p class="text-gray-600 mt-2">{{ $questionario->descricao }}</p>
                    @endif
                    <p class="text-sm text-gray-500 mt-2">
                        Total de questões: <span class="font-bold">{{ $questionario->questoes->count() }}</span>
                    </p>
                </div>
                <a href="{{ route('professor.questoes.create', $questionario->id) }}" 
                   class="text-white px-6 py-3 rounded-lg font-semibold text-center w-full md:w-auto"
                   style="background-color: #41a24d;"
                   onmouseover="this.style.backgroundColor='#358a3f'"
                   onmouseout="this.style.backgroundColor='#41a24d'">
                    + Adicionar Questão
                </a>
            </div>
        </div>

        <!-- Mensagens -->
        @if(session('sucesso'))
            <div class="border text-white px-4 py-3 rounded mb-6" style="background-color: #41a24d;">
                {{ session('sucesso') }}
            </div>
        @endif

        <!-- Lista de Questões -->
        @if($questionario->questoes->count() > 0)
            <div class="space-y-4">
                @foreach($questionario->questoes as $index => $questao)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-800 mb-3">
                                    Questão {{ $index + 1 }}
                                </h3>
                                <p class="text-gray-700 mb-3">{{ $questao->enunciado }}</p>
                                
                                @if($questao->imagem_url)
                                    <img src="{{ asset('storage/' . $questao->imagem_url) }}" 
                                         alt="Imagem da questão" 
                                         class="max-w-full h-auto rounded mb-3 max-h-64 object-contain">
                                @endif

                                <div class="grid grid-cols-1 gap-2 mb-3">
                                    <div class="flex items-start">
                                        <span class="font-bold mr-2 {{ $questao->resposta_correta == 'A' ? 'text-green-600' : '' }}">A)</span>
                                        <span class="{{ $questao->resposta_correta == 'A' ? 'text-green-600 font-semibold' : '' }}">{{ $questao->alternativa_a }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="font-bold mr-2 {{ $questao->resposta_correta == 'B' ? 'text-green-600' : '' }}">B)</span>
                                        <span class="{{ $questao->resposta_correta == 'B' ? 'text-green-600 font-semibold' : '' }}">{{ $questao->alternativa_b }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="font-bold mr-2 {{ $questao->resposta_correta == 'C' ? 'text-green-600' : '' }}">C)</span>
                                        <span class="{{ $questao->resposta_correta == 'C' ? 'text-green-600 font-semibold' : '' }}">{{ $questao->alternativa_c }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="font-bold mr-2 {{ $questao->resposta_correta == 'D' ? 'text-green-600' : '' }}">D)</span>
                                        <span class="{{ $questao->resposta_correta == 'D' ? 'text-green-600 font-semibold' : '' }}">{{ $questao->alternativa_d }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="font-bold mr-2 {{ $questao->resposta_correta == 'E' ? 'text-green-600' : '' }}">E)</span>
                                        <span class="{{ $questao->resposta_correta == 'E' ? 'text-green-600 font-semibold' : '' }}">{{ $questao->alternativa_e }}</span>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Conteúdo Linguístico:</span> {{ $questao->conteudo_linguistico }}
                                </p>
                            </div>

                            <form method="POST" action="{{ route('professor.questoes.destroy', [$questionario->id, $questao->id]) }}" 
                                  onsubmit="return confirm('Excluir esta questão?')" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white px-4 py-2 rounded text-sm"
                                        style="background-color: #cd2129;"
                                        onmouseover="this.style.backgroundColor='#a71b22'"
                                        onmouseout="this.style.backgroundColor='#cd2129'">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-600 mb-4">Nenhuma questão adicionada ainda.</p>
                <a href="{{ route('professor.questoes.create', $questionario->id) }}" class="font-semibold" style="color: #41a24d;">
                    Adicionar primeira questão →
                </a>
            </div>
        @endif
    </div>
</body>
</html>