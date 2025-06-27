<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('image/cavely2.png')); ?>">
    <title>Cavely</title>
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('backend/dist/css/style.min.css')); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .navbar {
            background-color: #1B1E2A;
            opacity: 0.75;
            height: 102px;
        }

        .bg-login {
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url(<?php echo e(asset('image/bg_login.png')); ?>);
        }

        .bg-login2 {
            background: rgba(89, 154, 148, 0.75) !important;
        }

        .bg-login3 {
            background: rgba(89, 154, 148, 0) !important;
        }

        .btn-transparent {
            background: transparent !important;
            color: rgba(0, 0, 0, 0.5) !important;
        }

    </style>
</head>

<body>
    
    <div class="w-100 bg-login" style="min-height: 100vh">
        <nav class="navbar row">
            <div class="col-lg-10 col-md-8 col-sm-6"></div>
            <div class="col-lg-1">
                <a href="<?php echo e(route('backend.beranda')); ?>">
                    <img src="<?php echo e(asset('image/cavely2.png')); ?>" alt="logo" width="100px" height="100px" style="margin-top: 1px; margin-right: 10px;">
                </a>
            </div>
        </nav>
        <div class="container bg-login3 text-white">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-login3">
                        <form action="<?php echo e(route('frontend.user.store')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <h1 class="card-title text-white text-center"><?php echo e($judul); ?></h1>
                                <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <h2>Choose Role :</h2>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary" data-toggle="collapse">
                                                <input type="radio" name="role" id="customer" value="2"> Customer
                                            </label>
                                            <label class="btn btn-secondary" data-toggle="collapse">
                                                <input type="radio" name="role" id="developer" value="1"> Developer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row collapse" id="collapseInput">
                                    <div class="col-md-4">
                                        
                                        <div class="form-group">
                                            <label for="foto">Photo</label>
                                            <img class="foto-preview">
                                            <input type="file" name="foto" id="foto" class="form-control <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onchange="previewFoto()">
                                            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback alert-danger">
                                                    <?php echo e($message); ?>

                                                </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
    
                                    <div class="col-md-8 bg-login2 py-2">
                                        
    
                                        <div class="form-group">
                                            <label for="nama">Name</label>
                                            <input type="text" name="nama" id="nama" value="<?php echo e(old('nama')); ?>" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Name">
                                            <?php $__errorArgs = ['nama'];
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
    
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Email">
                                            <?php $__errorArgs = ['email'];
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
    
                                        <div class="form-group">
                                            <label for="hp">Phone Number</label>
                                            <input type="text" name="hp" id="hp" onkeypress="return hanyaAngka(event)" value="<?php echo e(old('hp')); ?>" class="form-control <?php $__errorArgs = ['hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Phone Number">
                                            <?php $__errorArgs = ['hp'];
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
    
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Birth Date</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>" class="form-control <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Birth Date">
                                            <?php $__errorArgs = ['tanggal_lahir'];
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
    
                                        <div class="form-group">
                                            <label for="countries_id">Country</label>
                                            <select name="countries_id" id="countries_id" class="form-control <?php $__errorArgs = ['countries_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="" selected>--Choose Country--</option>
                                                <?php $__currentLoopData = $negara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($n->id); ?>"><?php echo e($n->nama_negara); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['countries_id'];
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
    
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                is-invalid
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Password">
                                            <?php $__errorArgs = ['password'];
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
    
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
    
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <a href="<?php echo e(route('backend.login')); ?>">
                                        <button type="button" class="btn btn-secondary">Login Instead</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo e(asset('backend/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo e(asset('backend/libs/popper.js/dist/umd/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/libs/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    // $('[data-toggle="tooltip"]').tooltip();
    // $(".preloader").fadeOut();
    // // ============================================================== 
    // // Login and Recover Password 
    // // ============================================================== 
    // $('#to-recover').on("click", function() {
    //     $("#loginform").slideUp();
    //     $("#recoverform").fadeIn();
    // });
    // $('#to-login').click(function(){
        
    //     $("#recoverform").hide();
    //     $("#loginform").fadeIn();
    // });

    $(document).ready(function() {
    $('input[name="role"]').change(function() {
        if (!$('#collapseInput').hasClass('show')) {
            $('#collapseInput').collapse('show');
        }

        $('.btn-group-toggle label').removeClass('active btn-warning').addClass('btn-secondary'); // Reset all buttons

        // Style only the checked button
        if ($(this).is(':checked')) {
            $(this).parent('label').addClass('active btn-warning').removeClass('btn-secondary');
        }
    });


});






    </script>


</body>

</html><?php /**PATH /srv/www/htdocs/laravel10/cavely-stable/resources/views/frontend/v_user/create.blade.php ENDPATH**/ ?>