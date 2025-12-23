<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Questão - {{ $questionario->titulo }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="IFRS" class="h-12 md:h-16">
                <div>
                    <h1 class="text-lg md:text-xl font-bold text-gray-800">Adicionar Questão</h1>
                    <p class="text-sm text-gray-600">{{ $questionario->titulo }}</p>
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
            <a href="{{ route('professor.questoes.index', $questionario->id) }}" class="font-semibold" style="color: #41a24d;">
                ← Voltar para Questões
            </a>
        </div>

        <!-- Formulário -->
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Nova Questão</h2>

            @if($errors->any())
                <div class="border text-white px-4 py-3 rounded mb-6" style="background-color: #cd2129;">
                    <ul>
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('professor.questoes.store', $questionario->id) }}" enctype="multipart/form-data">
                @csrf

                <!-- Enunciado -->
                <div class="mb-6">
                    <label for="enunciado" class="block text-gray-700 font-semibold mb-2">
                        Enunciado da Questão <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="enunciado" 
                        id="enunciado"
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                        placeholder="Digite o enunciado da questão..."
                        required
                    >{{ old('enunciado') }}</textarea>
                </div>

                <!-- Imagem (opcional) -->
                <div class="mb-6">
                    <label for="imagem" class="block text-gray-700 font-semibold mb-2">
                        Imagem (opcional)
                    </label>
                    <input 
                        type="file" 
                        name="imagem" 
                        id="imagem"
                        accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none"
                    >
                    <p class="text-sm text-gray-500 mt-1">Formatos: JPG, PNG. Máx: 2MB</p>
                </div>

                <!-- Alternativas -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700 mb-3">Alternativas</h3>
                    
                    @foreach(['A', 'B', 'C', 'D', 'E'] as $letra)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Alternativa {{ $letra }} <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="alternativa_{{ strtolower($letra) }}" 
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Digite a alternativa {{ $letra }}..."
                                required
                            >{{ old('alternativa_' . strtolower($letra)) }}</textarea>
                        </div>
                    @endforeach
                </div>

                <!-- Resposta Correta -->
                <div class="mb-6">
                    <label for="resposta_correta" class="block text-gray-700 font-semibold mb-2">
                        Resposta Correta <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="resposta_correta" 
                        id="resposta_correta"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                        required
                    >
                        <option value="">Selecione a resposta correta</option>
                        <option value="A" {{ old('resposta_correta') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('resposta_correta') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('resposta_correta') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('resposta_correta') == 'D' ? 'selected' : '' }}>D</option>
                        <option value="E" {{ old('resposta_correta') == 'E' ? 'selected' : '' }}>E</option>
                    </select>
                </div>

                <!-- Conteúdo Linguístico -->
                <div class="mb-6">
                    <label for="conteudo_linguistico" class="block text-gray-700 font-semibold mb-2">
                        Conteúdo Linguístico Abordado <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="conteudo_linguistico" 
                        id="conteudo_linguistico"
                        value="{{ old('conteudo_linguistico') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                        placeholder="Ex: Interpretação de texto, Concordância verbal, etc."
                        required
                    >
                </div>

                <!-- Botões -->
                <div class="flex flex-col md:flex-row justify-end space-y-2 md:space-y-0 md:space-x-4">
                    <a href="{{ route('professor.questoes.index', $questionario->id) }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center">
                        Cancelar
                    </a>
                    <button 
                        type="submit"
                        class="text-white px-6 py-3 rounded-lg font-semibold"
                        style="background-color: #41a24d;"
                        onmouseover="this.style.backgroundColor='#358a3f'"
                        onmouseout="this.style.backgroundColor='#41a24d'">
                        Salvar Questão
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>