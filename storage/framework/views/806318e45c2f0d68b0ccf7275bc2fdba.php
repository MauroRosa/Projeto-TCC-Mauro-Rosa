<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Aluno</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold">Painel do Aluno</h1>
        <p>Bem-vindo, <?php echo e(auth()->user()->name); ?>!</p>
        
        <form method="POST" action="<?php echo e(route('sair')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded mt-4">
                Sair
            </button>
        </form>
    </div>
</body>
</html><?php /**PATH C:\Users\Mauro Rosa\Desktop\tcc-mauro\resources\views/aluno/painel.blade.php ENDPATH**/ ?>