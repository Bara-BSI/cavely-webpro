<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="text-center text-white my-5">
            <h1><?php echo e($judul); ?></h1>
        </div>
        
        <div class="row">
        
            <div class="col-12 text-white bg-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-1"><h5 class="my-2 text-center">No</h5></div>
                    <div class="col-4"><h5 class="my-2">Game Name</h5></div>
                    <div class="col-1"><h5 class="my-2 text-center">Amount</h5></div>
                    <div class="col-2"><h5 class="my-2 text-right">Price</h5></div>
                    <div class="col-2"><h5 class="my-2 text-right">Sub Total</h5></div>
                    <div class="col-2"><h5 class="my-2 text-center">Action</h5></div>
                </div>
            </div>

            <?php
                $grandTotal = 0;
            ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                <?php if($loop->iteration % 2 == 1): ?>
                    <div class="col-12 pt-2 text-dark bg-light">
                        <div class="row d-flex align-items-center">                    
                            <div class="col-1 my-auto text-center"><h6><?php echo e($loop->iteration); ?></h6></div>                            
                            <div class="col-4 my-auto"><h6><?php echo e($game->where('id', $carts->games_id)->value('nama_game')); ?></h6></div>
                            <div class="col-1 my-auto text-center"><h6><?php echo e($carts->jumlah); ?></h6></div>
                            <div class="col-2 my-auto text-right"><h6><?php echo e($game->where('id', $carts->games_id)->value('harga')); ?></h6></div>
                            <div class="col-2 my-auto text-right"><h6><?php echo e($game->where('id', $carts->games_id)->value('harga') * $carts->jumlah); ?></h6></div>
                            <div class="col-2 my-auto text-center"><h6>
                                <form action="<?php echo e(route('frontend.cart.destroy', $carts->id)); ?>" method="post" style="display: inline-block">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="<?php echo e($carts->nama); ?>" title="Delete Data">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </h6></div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-12 pt-2 text-white bg-secondary">
                        <div class="row d-flex align-items-center">                      
                            <div class="col-1 my-auto text-center"><h6><?php echo e($loop->iteration); ?></h6></div>                            
                            <div class="col-4 my-auto"><h6><?php echo e($game->where('id', $carts->games_id)->value('nama_game')); ?></h6></div>
                            <div class="col-1 my-auto text-center"><h6><?php echo e($carts->jumlah); ?></h6></div>
                            <div class="col-2 my-auto text-right"><h6><?php echo e($game->where('id', $carts->games_id)->value('harga')); ?></h6></div>
                            <div class="col-2 my-auto text-right"><h6><?php echo e($game->where('id', $carts->games_id)->value('harga') * $carts->jumlah); ?></h6></div>
                            <div class="col-2 my-auto text-center"><h6>
                                <form action="<?php echo e(route('frontend.cart.destroy', $carts->id)); ?>" method="post" style="display: inline-block">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="<?php echo e($carts->nama); ?>" title="Delete Data">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </h6></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                    $grandTotal += $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <form action="<?php echo e(route('frontend.checkout.store')); ?>" method="post" class="form-horizontal col-12" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <div class="my-3">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9 d-inline-flex text-white">
                                <h3 class="mx-auto my-auto">Grand Total :</h3>
                                <h3 class="mx-auto my-auto d-inline-flex">
                                    <span class="mr-3">IDR</span>
                                    <?php echo e($grandTotal); ?>

                                </h3>
                                <input type="hidden" name="carts" value="<?php echo e($cart->pluck('id')); ?>">
                                <input type="hidden" name="total_harga" value="<?php echo e($grandTotal); ?>">
                                <input type="hidden" name="tanggal_checkout" value="<?php echo e(today()); ?>">
                                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                    Choose Payment Method
                                </button>
                            </div>
                            <div class="collapse col-12 mt-3" id="collapsePayment">
                                    <div class="card card-body text-center">
                                        <div class="form-group">
                                            <label for="payments_id">Payment Method</label>
                                            <select name="payments_id" id="payments_id" class="form-control <?php $__errorArgs = ['payments_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="" selected>--Choose Payment Method--</option>
                                                <?php $__currentLoopData = $payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($n->id); ?>"><?php echo e($n->nama_bank); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['payments_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <button type="submit" class="btn btn-success">Confirm Order</button>
                                    </div>
                                </div>
                        </div>
                    </div>
            </form>
                    
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/frontend/v_cart/create.blade.php ENDPATH**/ ?>