<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-6 mb-5">
        <h1 class="text-center">Manage Game Medias for <?php echo e($game->nama_game); ?> by <?php echo e($user->nama); ?></h1>

        <form action="<?php echo e(route('media.upload')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="games_id" value="<?php echo e($game->id); ?>">
            <div class="form-group">
                <label for="file">Add Media</label>
                <input type="file" name="file" id="file" multiple class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="<?php echo e(route('backend.game.index')); ?>">
                <button type="button" class="btn btn-secondary">Back</button>
            </a>
        </form>
        <hr>

        <h2>Existing Medias</h2>
        <ul class="list-group">
            <b>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>No</span>
                    <span>Media</span>
                    <span>Type</span>
                    <span>Action</span>
                </li>
            </b>
            
            <?php if($game_media->count() > 0): ?>
                <?php $__currentLoopData = $game_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo e($loop->iteration); ?></span>
                    <?php if($media->jenis == 'image'): ?>
                        <img src="<?php echo e(asset('storage/media/' . $media->nama)); ?>" alt="Media" width="200">
                    <?php else: ?>
                        <video src="<?php echo e(asset('storage/media/' . $media->nama)); ?>" width="200"></video>
                    <?php endif; ?>
                    
                    <span><?php echo e($media->jenis); ?></span>
                    <form action="<?php echo e(route('media.delete', [$media->id])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-xl-6 mb-5">
        <h1 class="text-center">Reviews</h1>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Review Date</th>
                        <th>Description</th>
                        <th>Grade</th>
                        <?php if(Auth::user()->role == 0): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->find($row->users_id)->nama); ?></td>
                            <td><?php echo e($row->tanggal_ulasan); ?></td>
                            <td><?php echo e($row->deskripsi); ?></td>
                            <td><?php echo e($row->nilai); ?></td>
                            <?php if(Auth::user()->role == 0): ?>
                                <td>
                                    <form action="<?php echo e(route('review.delete', ['games_id' => $row->games_id, 'users_id' => $row->users_id])); ?>" method="post" style="display: inline-block">
                                        <?php echo method_field('delete'); ?>
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm mb-1" data-konf-delete="<?php echo e($row->nama); ?>" title="Hapus Data">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/backend/v_game/show.blade.php ENDPATH**/ ?>