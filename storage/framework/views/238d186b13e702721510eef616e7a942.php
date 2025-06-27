<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-12">
            <a href="<?php echo e(route('backend.cart.create')); ?>">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Cart
                </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($judul); ?></h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Inputted Game</th>
                                    <th>Amount</th>
                                    <th>Has been paid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($user->find($row->users_id)->nama); ?></td>
                                        <td><?php echo e($game->find($row->games_id)->nama_game); ?></td>
                                        <td><?php echo e($row->jumlah); ?></td>
                                        <td>
                                            <?php if($row->checkouts_id == null): ?>
                                                No
                                            <?php else: ?>
                                                Yes
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('backend.cart.edit', $row->id)); ?>" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Ubah</i></button>
                                            </a>
                                            <form action="<?php echo e(route('backend.cart.destroy', $row->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo method_field('delete'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="<?php echo e($row->nama); ?>" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Hapus
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
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/backend/v_cart/index.blade.php ENDPATH**/ ?>