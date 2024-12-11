

<?php $__env->startSection('title', 'Editar Nota'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Editar Nota</h3>
    <form action="<?php echo e(route('notas.update', $nota->id)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="materia" class="form-label">Materia</label>
            <input type="text" class="form-control" id="materia" value="<?php echo e($nota->materia->nombre); ?>" disabled>
        </div>

        <div class="mb-3">
            <label for="id_nota" class="form-label">Nota</label>
            <input type="number" class="form-control" id="id_nota" name="id_nota" value="<?php echo e($nota->id_nota); ?>" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\examenFinal-Laravel\resources\views/editNota.blade.php ENDPATH**/ ?>