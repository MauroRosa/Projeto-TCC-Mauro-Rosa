<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Questão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #e5e5e5; }
    </style>
</head>
<body class="min-h-screen">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="Logo IFRS" class="h-12">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Adicionar Questão</h1>
                    <p class="text-sm text-gray-600">{{ $questionario->titulo }}</p>
                </div>
            </div>
            <a href="{{ route('professor.questionarios.show', $questionario->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                ← Voltar
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('professor.questoes.store', $questionario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="enunciado" class="block text-gray-700 font-semibold mb-2">
                        Enunciado da Questão *
                    </label>
                    <textarea 
                        id="enunciado" 
                        name="enunciado" 
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d] @error('enunciado') border-red-500 @enderror"
                        placeholder="Digite o enunciado da questão..."
                        required
                    >{{ old('enunciado') }}</textarea>
                    @error('enunciado')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="imagem" class="block text-gray-700 font-semibold mb-2">
                        Imagem (Opcional)
                    </label>
                    <input 
                        type="file" 
                        id="imagem" 
                        name="imagem" 
                        accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d] @error('imagem') border-red-500 @enderror"
                    >
                    @error('imagem')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Formatos: JPG, PNG, GIF (máx. 2MB)</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-4">Alternativas *</label>
                    
                    @foreach(['A', 'B', 'C', 'D', 'E'] as $letra)
                    <div class="mb-4">
                        <label for="alternativa_{{ strtolower($letra) }}" class="block text-gray-700 font-semibold mb-2">
                            Alternativa {{ $letra }}
                        </label>
                        <textarea 
                            id="alternativa_{{ strtolower($letra) }}" 
                            name="alternativa_{{ strtolower($letra) }}" 
                            rows="2"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d] @error('alternativa_' . strtolower($letra)) border-red-500 @enderror"
                            placeholder="Digite a alternativa {{ $letra }}..."
                            required
                        >{{ old('alternativa_' . strtolower($letra)) }}</textarea>
                        @error('alternativa_' . strtolower($letra))
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Resposta Correta *
                    </label>
                    <div class="flex gap-4">
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $letra)
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="radio" 
                                name="resposta_correta" 
                                value="{{ $letra }}"
                                {{ old('resposta_correta') == $letra ? 'checked' : '' }}
                                class="w-5 h-5 text-[#41a24d] focus:ring-[#41a24d]"
                                required
                            >
                            <span class="ml-2 text-gray-700 font-semibold">{{ $letra }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('resposta_correta')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="conteudo_linguistico" class="block text-gray-700 font-semibold mb-2">
                        Conteúdo Linguístico *
                    </label>
                    <input 
                        type="text" 
                        id="conteudo_linguistico" 
                        name="conteudo_linguistico" 
                        value="{{ old('conteudo_linguistico') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d] @error('conteudo_linguistico') border-red-500 @enderror"
                        placeholder="Ex: Interpretação de Texto, Concordância Verbal, Ortografia..."
                        required
                    >
                    @error('conteudo_linguistico')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Este conteúdo será usado para sugestões de estudo aos alunos</p>
                </div>

                <div class="flex gap-3">
                    <button 
                        type="submit" 
                        class="flex-1 bg-[#41a24d] hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                    >
                        Salvar Questão
                    </button>
                    <a 
                        href="{{ route('professor.questionarios.show', $questionario->id) }}" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition"
                    >
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>