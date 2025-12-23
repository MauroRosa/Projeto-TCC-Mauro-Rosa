<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Questionário - Professor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <img src="{{ asset('images/logo-ifrs.png') }}" alt="IFRS" class="h-12 md:h-16">
                <h1 class="text-lg md:text-xl font-bold text-gray-800">Editar Questionário</h1>
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

        <!-- Formulário -->
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Questionário</h2>

            @if($errors->any())
                <div class="border text-white px-4 py-3 rounded mb-6" style="background-color: #cd2129;">
                    <ul>
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('professor.questionarios.update', $questionario->id) }}">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div class="mb-6">
                    <label for="titulo" class="block text-gray-700 font-semibold mb-2">
                        Título do Questionário <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo"
                        value="{{ old('titulo', $questionario->titulo) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                        required
                    >
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label for="descricao" class="block text-gray-700 font-semibold mb-2">
                        Descrição (opcional)
                    </label>
                    <textarea 
                        name="descricao" 
                        id="descricao"
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                    >{{ old('descricao', $questionario->descricao) }}</textarea>
                </div>

                <!-- Botões -->
                <div class="flex flex-col md:flex-row justify-end space-y-2 md:space-y-0 md:space-x-4">
                    <a href="{{ route('professor.questionarios.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center">
                        Cancelar
                    </a>
                    <button 
                        type="submit"
                        class="text-white px-6 py-3 rounded-lg font-semibold"
                        style="background-color: #41a24d;"
                        onmouseover="this.style.backgroundColor='#358a3f'"
                        onmouseout="this.style.backgroundColor='#41a24d'">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>