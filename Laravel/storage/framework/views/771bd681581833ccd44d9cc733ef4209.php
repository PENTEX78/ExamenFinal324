

<?php $__env->startSection('title', 'Lista de Estudiantes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Div para el botón con el ícono arriba del texto -->
    <div class="text-center mb-4">
        <a href="<?php echo e(route('estudiantes.create')); ?>" class="btn btn-primary btn-lg" style="font-size: 30px";>
            <!-- Ícono encima del texto -->
            <i class="fa-solid fa-user-plus d-block" style="font-size: 50px;"></i>
            Añadir Estudiante
        </a>
    </div>
<div class="col-10 mx-auto mt-5">
    <table class="table table-bordered text-dark mx-auto table-hover">
        <thead>
            <tr class="text-secondary">
                <th class="fs-5">Nombre</th>
                <th class="fs-5">Apellido</th>
                <th class="fs-5">Fecha de Nacimiento</th>
                <th class="fs-5">Clase</th>
                <th class="text-center fs-5">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $estudiantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estudiante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="fs-5"><?php echo e($estudiante->nombre); ?></td>
                <td class="fs-5"><?php echo e($estudiante->apellido); ?></td>
                <td class="fs-5"><?php echo e($estudiante->fecha_nacimiento); ?></td>
                <td class="fs-5"><?php echo e($estudiante->clase->nombre ?? 'Sin clase'); ?></td>
                <td class="text-center">
                    <!-- Boton para ver las notas y materias -->
                    <a href="<?php echo e(route('estudiantes.materias', $estudiante->id)); ?>" class="btn btn-info text-white"><i class="fa-solid fa-eye"></i> Ver Notas</a>
                    <!-- Botón Editar -->
                    <a href="<?php echo e(route('estudiantes.edit', $estudiante)); ?>" class="btn btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                    <!-- Botón Eliminar con formulario -->
                    <form action="<?php echo e(route('estudiantes.destroy', $estudiante)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\examenFinal-Laravel\resources\views/index.blade.php ENDPATH**/ ?>