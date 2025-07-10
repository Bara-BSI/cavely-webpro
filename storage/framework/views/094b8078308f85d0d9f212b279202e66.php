<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-12">
            <?php if(Auth::user()->role == 0): ?>
                <a href="<?php echo e(route('backend.checkout.create')); ?>">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Confirmed Orders
                    </button>
                </a>                
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($judul); ?></h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <?php if(Auth::user()->role == 0): ?>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Receipt Date</th>
                                        <th>User</th>
                                        <th>Games</th>
                                        <th>Amount</th>
                                        <th>Total Price</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($row->tanggal_checkout); ?></td>
                                            <td>
                                                <?php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('users_id');
                                                ?>
                                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $carts_user_name = DB::table('users')->where('id', $cart_id)->value('nama');
                                                    ?>
                                                    <div>
                                                        <b>
                                                            <?php echo e($carts_user_name); ?>

                                                        </b>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('games_id');
                                                ?>
                                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $carts_game_name = DB::table('games')->where('id', $cart_id)->value('nama_game');
                                                    ?>
                                                    <div>
                                                        <b>
                                                            <?php echo e($carts_game_name); ?>

                                                        </b>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('jumlah');
                                                ?>
                                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <b>
                                                            <?php echo e($cart_id); ?>

                                                        </b>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><?php echo e($row->total_harga); ?></td>
                                            <td><?php echo e($payment->find($row->payments_id)->nama_bank); ?></td>
                                            <td>
                                                <form action="<?php echo e(route('backend.checkout.destroy', $row->id)); ?>" method="post" style="display: inline-block">
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
                            <?php else: ?>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Inputted Game</th>
                                        <th>Amount</th>
                                        <th>Receipt Date</th>
                                        <th>Receipt ID</th>
                                        <th>Total Price</th>
                                        <th>Payment Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($user->find($row->users_id)->nama); ?></td>
                                            <td><?php echo e($game->find($row->games_id)->nama_game); ?></td>
                                            <td><?php echo e($row->jumlah); ?></td>
                                            <td><?php echo e($checkout->find($row->checkouts_id)->tanggal_checkout); ?></td>
                                            <td><?php echo e($checkout->find($row->checkouts_id)->id); ?></td>
                                            <td>
                                                <?php
                                                    $jumlah = $row->jumlah;
                                                    $harga = $game->find($row->games_id)->harga;
                                                    $total = $jumlah * $harga;
                                                ?>
                                                <?php echo e($total); ?>

                                            </td>
                                            <td><?php echo e($payment->find($checkout->find($row->checkouts_id)->payments_id)->nama_bank); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            <?php endif; ?>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/backend/v_checkout/index.blade.php ENDPATH**/ ?>