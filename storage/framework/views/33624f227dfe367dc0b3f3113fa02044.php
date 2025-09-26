


<?php $__env->startSection('formulario_secretaria'); ?>
<form method="post" action="<?php echo e(route('pessoas.update', $pessoaDados->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="container">
        <div class="row g-3">
            
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

            <!-- Card da Coluna 1 -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Dados do cidadão</h5>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                        <div class="mb-3">
                            <label for="nomeInput" class="form-label">Nome:</label>
                            <input type="text" name="nomeInput" class="form-control" id="nomeInput" value="<?php echo e($pessoaDados->nome); ?>">
                            <?php $__errorArgs = ['nomeInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="observacaoInput" class="form-label">CPF:</label>
                            <input type="text" name="cpfInput" id="cpfInput" value="<?php echo e($pessoaDados->cpf); ?>" class="form-control" placeholder="campo opcional">
                            <?php $__errorArgs = ['cpfInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                         <div class="mb-3">
                            <label for="observacaoInput" class="form-label">RG:</label>
                            <input type="text" name="RgInput" id="RgInput" value="<?php echo e($pessoaDados->rg); ?>" class="form-control" placeholder="campo opcional">
                            <?php $__errorArgs = ['RgInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="dataInput" class="form-label">Data de Nascimento:</label>
                            <input type="date" value="<?php echo e($pessoaDados->data_nascimento); ?>"
                                name="dataInput"
                                id="dataInput"
                                value="<?php echo e(old('dataInput')); ?>"
                                class="form-control <?php $__errorArgs = ['dataInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                
                                    
                        </div>


                        <div class="mb-3">
                            <label for="horaInput" class="form-label">Cartão do SUS:</label>
                            <input type="text" name="SusInput" value="<?php echo e($pessoaDados->cartao_sus); ?>" class="form-control" id="horaInput" placeholder="campo opcional">
                            <?php $__errorArgs = ['Hora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                 <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="cpfInput" class="form-label">telefone:</label>
                            <input type="telefone" name="TelefoneInput" value="<?php echo e($pessoaDados->telefone); ?>" class="form-control" id="telefoneInput" data-mask="telefone" >
                            <?php $__errorArgs = ['cpfInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card da Coluna 2 -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Endereço do Cidadão</h5>

                        <div class="mb-3">
                            <label for="estadoInput" class="form-label">Estado</label>
                            <input type="text" id="estadoInput" value="<?php echo e($pessoaDados->endereco_cidadaos->estado); ?>" name="estadoInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="cidadeInput" class="form-label">Cidade</label>
                            <input type="text" id="cidadeInput" value="<?php echo e($pessoaDados->endereco_cidadaos->cidade); ?>" name="cidadeInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="bairroInput" class="form-label">Bairro</label>
                            <input type="text" id="bairroInput" value="<?php echo e($pessoaDados->endereco_cidadaos->bairro); ?>" name="bairroInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="ruaInput" class="form-label">Rua</label>
                            <input type="text" name="ruaInput" id="ruaInput" value="<?php echo e($pessoaDados->endereco_cidadaos->rua); ?>" class="form-control">
                        </div>

                         <div class="mb-3">
                           <button type="submit" class="btn btn-primary btn-lg mt-3">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<?php $__env->stopSection(); ?>

 

<?php echo $__env->make('secretaria.layout_secretaria.pagina_inicialSecretaria', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sistemaagendamento\resources\views/secretaria/sistema/Pessoa/edit.blade.php ENDPATH**/ ?>