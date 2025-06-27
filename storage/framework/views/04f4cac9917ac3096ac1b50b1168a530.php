<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-12">
            <a href="<?php echo e(route('backend.user.create')); ?>">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add User
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($row->nama); ?></td>
                                        <td><?php echo e($row->email); ?></td>
                                        <td>
                                            <?php if($row->role == 1): ?>
                                                <span class="badge badge-success">Publisher</span>
                                            <?php elseif($row->role == 0): ?>
                                                <span class="badge badge-primary">Admin</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Customer</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($row->status == 1): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php elseif($row->status == 0): ?>
                                                <span class="badge badge-secondary">NonAktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('backend.user.edit', $row->id)); ?>" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Ubah</i></button>
                                            </a>
                                            <form action="<?php echo e(route('backend.user.destroy', $row->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo method_field('delete'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="<?php echo e($row->nama); ?>" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <form action="<?php echo e(route('backend.laporan.cetakuser')); ?>" method="post" 
                            class="form-horizontal" target="_blank">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/backend/v_user/index.blade.php ENDPATH**/ ?>