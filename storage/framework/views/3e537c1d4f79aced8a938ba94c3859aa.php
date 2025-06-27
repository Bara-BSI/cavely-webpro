<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-12">
            <a href="<?php echo e(route('backend.game.create')); ?>">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Game
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
                                    <?php if(Auth::user()->role == 0): ?>
                                        <th>Publisher</th>                                        
                                    <?php endif; ?>
                                    <th>Game Name</th>
                                    <th>Release Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Genre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <?php if(Auth::user()->role == 0): ?>
                                            <td><?php echo e($user->find($row->users_id)->nama); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($row->nama_game); ?></td>
                                        <td><?php echo e($row->tanggal_rilis); ?></td>
                                        <td><?php echo e($row->harga); ?></td>
                                        <td>
                                            <?php if($row->status == 0): ?>
                                                <span class="badge badge-secondary">Inactive</span>
                                            <?php elseif($row->status == 1): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php elseif($row->status == 2): ?>
                                                <span class="badge badge-warning">Coming Soon</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($row->deskripsi); ?></td>
                                        <td>
                                            <?php
                                                $genres = DB::table('game_genres')->where('games_id', $row->id)->pluck('genres_id');
                                            ?>
                                            <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $genre_name = DB::table('genres')->where('id', $genre_id)->value('nama_genre');
                                                ?>
                                                <span class="badge badge-info">
                                                    <b>
                                                        <?php echo e($genre_name); ?>

                                                    </b>
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('backend.game.edit', $row->id)); ?>" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm mb-1"><i class="far fa-edit"> Edit</i></button>
                                            </a>
                                            <a href="<?php echo e(route('backend.game.show', $row->id)); ?>" title="Show Game Medias and Reviews">
                                                <button type="button" class="btn btn-warning btn-sm mb-1">
                                                    <i class="fas fa-plus"></i> Detail
                                                </button>
                                            </a>
                                            <form action="<?php echo e(route('backend.game.destroy', $row->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo method_field('delete'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm mb-1" data-konf-delete="<?php echo e($row->nama); ?>" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Delete
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
<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/htdocs/laravel10/cavely-stable/resources/views/backend/v_game/index.blade.php ENDPATH**/ ?>