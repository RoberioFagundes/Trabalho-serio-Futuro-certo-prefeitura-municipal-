

<?php $__env->startSection('formulario_secretaria'); ?>
    <div class="container">
        <h2>Novo Agendamento para <?php echo e($pessoa->nome); ?></h2>

        <form action="<?php echo e(route('agendamentos.store_pessoas_cadastradas')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="pessoa_id" value="<?php echo e($pessoa->id); ?>">

            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="dataInput" name="dataInput" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="horaInput" required>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacaoInput" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="arquivoInput" class="form-label">Arquivo:</label>
                <input type="file" name="arquivoInput" class="form-control" id="arquivoInput">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('secretaria.layout_secretaria.pagina_inicialSecretaria', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sistemaagendamento\resources\views/secretaria/sistema/agendamento/create_pessoas_cadastradas.blade.php ENDPATH**/ ?>