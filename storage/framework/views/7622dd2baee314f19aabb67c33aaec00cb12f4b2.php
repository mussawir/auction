<?php $__env->startSection('content'); ?>
    <section class="login-wrap">
        <div class="pra-reg">
            <h1>Supplier Login</h1>

            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>

                <div class="box">
                    <div style="padding-top: 50px;"></div>
                    <?php if(Session::has('warning')): ?>
                        <div class="alert alert-warning">
                            <strong><?php echo e(Session::get('warning')); ?></strong>
                        </div>
                    <?php endif; ?>
                        <div class="row-reg not-reg <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="block-inp">
                            <label class="label-log">E-Mail Address</label>
                                <i class="fa fa-envelope key-i"></i>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>"  style="    height: 32px;">
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row-reg not-reg <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <div class="block-inp">
                            <label class="label-log">Password</label>
                                <i class="fa fa-key key-i"></i>
                                <input type="password" name="password"  style="    height: 32px;">
                                <?php if($errors->has('password')): ?>
                                    <span class="text-danger">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php /*<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>*/ ?>

                        <div class="row-reg not-reg">
                            <div class="btn sub-reg text-center">
                                <button type="submit">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                            <p>
                                <a class="pull-right" href="<?php echo e(url('/password/reset')); ?>">Forgot Your Password?</a>
                            </p>
                        </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>