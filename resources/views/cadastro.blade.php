<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #e5e5e5; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-8">
    <div class="max-w-md w-full mx-4">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-ifrs.png') }}" alt="Logo IFRS" class="h-20 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Criar Nova Conta</h1>
            <p class="text-gray-600">Sistema de Questionários - Aluno</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Cadastro de Aluno</h2>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('cadastrar.post') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 font-semibold mb-2">
                        Nome Completo *
                    </label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="nome" 
                        value="{{ old('nome') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d]"
                        placeholder="Seu nome completo"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">
                        Email *
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d]"
                        placeholder="seu.email@exemplo.com"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="senha" class="block text-gray-700 font-semibold mb-2">
                        Senha *
                    </label>
                    <input 
                        type="password" 
                        id="senha" 
                        name="senha" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d]"
                        placeholder="Mínimo 8 caracteres"
                        required
                    >
                    <p class="text-gray-500 text-sm mt-1">Mínimo de 8 caracteres</p>
                </div>

                <div class="mb-6">
                    <label for="senha_confirmation" class="block text-gray-700 font-semibold mb-2">
                        Confirmar Senha *
                    </label>
                    <input 
                        type="password" 
                        id="senha_confirmation" 
                        name="senha_confirmation" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a24d]"
                        placeholder="Digite a senha novamente"
                        required
                    >
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-6">
                    <p class="text-blue-800 text-sm">
                        ℹ️ Ao se cadastrar, você terá acesso aos questionários e conteúdos disponibilizados pelo professor.
                    </p>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-[#41a24d] hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition"
                >
                    Criar Conta
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Já tem uma conta? 
                    <a href="{{ route('login') }}" class="text-[#41a24d] hover:text-green-700 font-semibold">
                        Entrar aqui
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>