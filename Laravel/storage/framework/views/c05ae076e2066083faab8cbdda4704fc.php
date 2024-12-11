

<?php $__env->startSection('title', 'Agregar Materia'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="text-center mb-4">Gestión de Materias</h1>

    
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="<?php echo e(route('materias.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label for="nombre" class="form-label">Nombre de la Materia</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre de la materia" required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Guardar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Listado de Materias</h2>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($materia->nombre); ?></td>
                        <td class="text-center">
                            <form action="<?php echo e(route('materias.destroy', $materia)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\alexm\OneDrive\Escritorio\examenFinal-Laravel\resources\views/createMateria.blade.php ENDPATH**/ ?>