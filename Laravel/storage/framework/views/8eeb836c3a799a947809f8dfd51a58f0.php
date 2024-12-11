

<?php $__env->startSection('title', 'Agregar Estudiante'); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-5 mx-auto mt-4">
        <h3>Añadir Estudiante</h3>
        <form action="<?php echo e(route('estudiantes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="clase_id" class="form-label">Clase</label>
                <select class="form-select" id="clase_id" name="clase_id" required>
                    <option value="">Seleccionar Clase</option>
                    <?php $__currentLoopData = $clases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($clase->id); ?>"><?php echo e($clase->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <br>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success btn-lg">Agregar estudiante</button>
            </div>
        </form>
    </div>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\examenFinal-Laravel\resources\views/create.blade.php ENDPATH**/ ?>