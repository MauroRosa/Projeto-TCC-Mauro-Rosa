<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema IFRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <img src="https://ifrs.edu.br/riogrande/wp-content/themes/ifrs-portal-theme-riogrande/img/logo.svg" 
                 alt="IFRS Logo" 
                 class="h-20 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Criar Conta</h1>
            <p class="text-gray-600 mt-2">Cadastro de Aluno</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($erro); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('cadastrar')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">
                    Nome Completo
                </label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome"
                    value="<?php echo e(old('nome')); ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    E-mail
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    value="<?php echo e(old('email')); ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="senha">
                    Senha (mínimo 8 caracteres)
                </label>
                <input 
                    type="password" 
                    name="senha" 
                    id="senha"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="senha_confirmation">
                    Confirmar Senha
                </label>
                <input 
                    type="password" 
                    name="senha_confirmation" 
                    id="senha_confirmation"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <button 
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200"
            >
                Cadastrar
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">Já tem uma conta?</p>
            <a href="<?php echo e(route('login')); ?>" class="text-green-600 hover:text-green-800 font-semibold">
                Faça login aqui
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\tcc-mauro\resources\views/autenticacao/cadastro.blade.php ENDPATH**/ ?>