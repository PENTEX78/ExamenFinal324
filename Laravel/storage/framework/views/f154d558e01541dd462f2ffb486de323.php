

<?php $__env->startSection('title', 'Ver Notas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Materias y Notas de <?php echo e($estudiante->nombre); ?> <?php echo e($estudiante->apellido); ?></h1>
    <table class="table table-bordered">
        <tr>
            <th>Materia</th>
            <th>Nota</th>
            <th>Fecha</th>
            <th class="text-center">Opciones</th>
        </tr>
        <?php $__currentLoopData = $estudiante->notas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($nota->materia->nombre); ?></td>
            <td><?php echo e($nota->id_nota); ?></td>
            <td><?php echo e($nota->fecha); ?></td>
            <td class="text-center">
                <!-- Botón para editar la nota -->
                <a href="<?php echo e(route('notas.edit', $nota->id)); ?>" class="btn btn-warning btn-sm text-white"><i class="fa-solid fa-pen"></i> Editar</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <!-- Botón centrado -->
    <div class="d-flex justify-content-center mt-4">
        <a href="<?php echo e(route('estudiantes.index')); ?>" class="btn btn-secondary btn-lg">Volver</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\examenFinal-Laravel\resources\views/materias.blade.php ENDPATH**/ ?>