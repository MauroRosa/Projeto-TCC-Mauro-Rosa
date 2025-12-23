<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Questão - <?php echo e($questionario->titulo); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <img src="<?php echo e(asset('images/logo-ifrs.png')); ?>" alt="IFRS" class="h-12 md:h-16">
                <div>
                    <h1 class="text-lg md:text-xl font-bold text-gray-800">Adicionar Questão</h1>
                    <p class="text-sm text-gray-600"><?php echo e($questionario->titulo); ?></p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 text-sm md:text-base"><?php echo e(auth()->user()->name); ?></span>
                <form method="POST" action="<?php echo e(route('sair')); ?>">
                    <?php echo csrf_field(); ?>
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
            <a href="<?php echo e(route('professor.questoes.index', $questionario->id)); ?>" class="font-semibold" style="color: #41a24d;">
                ← Voltar para Questões
            </a>
        </div>

        <!-- Formulário -->
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Nova Questão</h2>

            <?php if($errors->any()): ?>
                <div class="border text-white px-4 py-3 rounded mb-6" style="background-color: #cd2129;">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($erro); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('professor.questoes.store', $questionario->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

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
                    ><?php echo e(old('enunciado')); ?></textarea>
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
                    
                    <?php $__currentLoopData = ['A', 'B', 'C', 'D', 'E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Alternativa <?php echo e($letra); ?> <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="alternativa_<?php echo e(strtolower($letra)); ?>" 
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                                placeholder="Digite a alternativa <?php echo e($letra); ?>..."
                                required
                            ><?php echo e(old('alternativa_' . strtolower($letra))); ?></textarea>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <option value="A" <?php echo e(old('resposta_correta') == 'A' ? 'selected' : ''); ?>>A</option>
                        <option value="B" <?php echo e(old('resposta_correta') == 'B' ? 'selected' : ''); ?>>B</option>
                        <option value="C" <?php echo e(old('resposta_correta') == 'C' ? 'selected' : ''); ?>>C</option>
                        <option value="D" <?php echo e(old('resposta_correta') == 'D' ? 'selected' : ''); ?>>D</option>
                        <option value="E" <?php echo e(old('resposta_correta') == 'E' ? 'selected' : ''); ?>>E</option>
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
                        value="<?php echo e(old('conteudo_linguistico')); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2"
                        placeholder="Ex: Interpretação de texto, Concordância verbal, etc."
                        required
                    >
                </div>

                <!-- Botões -->
                <div class="flex flex-col md:flex-row justify-end space-y-2 md:space-y-0 md:space-x-4">
                    <a href="<?php echo e(route('professor.questoes.index', $questionario->id)); ?>" 
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
</html><?php /**PATH C:\Users\Mauro Rosa\Desktop\tcc-mauro\resources\views/professor/questionarios/create.blade.php ENDPATH**/ ?>