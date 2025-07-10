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
            
                <div class="my-3 col-12">
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
                            
                            <button class="btn btn-primary" id="pay-button">
                                Proceed
                            </button>
                        </div>
                        
                    </div>
                </div>
            
        </div>
    </div>
    <script>
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('<?php echo e($snapToken); ?>', {
                onSuccess: function(result) {
                    alert("payment success!");
                    console.log(result);
                    window.location.href = "<?php echo e(route('order.complete')); ?>";
                },
                onPending: function(result) {
                    alert("waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function(result) {
                    alert("you closed the popup without finishing the payment!");
                    console.log(result);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.v_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel10/cavely-stable/resources/views/frontend/v_cart/create.blade.php ENDPATH**/ ?>