<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | SIPIKSI</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    <style>
        body{
            margin:0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background:#f5f3ff;
        }

        .login-wrapper{
            display:grid;
            grid-template-columns: 1.2fr 1fr;
            min-height:100vh;
        }

        /* LEFT SIDE */
        .login-left{
        background:
        linear-gradient(
            135deg,
         rgba(167,139,250,0.25),
         rgba(196,181,253,0.25)
        ),
        url('/images/latarkiri.png') center / cover no-repeat;

        color: white;
        padding: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }


            .login-left-content{
        max-width:560px;
        width:100%;
        background: rgba(255,255,255,0.20);
        backdrop-filter: blur(14px);
        border-radius:24px;
        padding:40px 36px;
        box-shadow: 0 25px 50px rgba(17,24,39,0.25);
    }

        .feature{
            display:flex;
            gap:12px;
            margin-bottom:14px;
            font-size:15px;
        }

        /* RIGHT SIDE */
        .login-right{
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px;
        }

            .login-card{
        width:100%;
        max-width:420px;
        background: white;
        padding: 32px 30px;
        border-radius: 20px;
        border: 1px solid rgba(167,139,250,0.25);
        box-shadow: 0 20px 45px rgba(17,24,39,0.12);
    }


        .login-card img{
            width:72px;
            display:block;
            margin:0 auto 12px;
        }

        .login-card h2{
            text-align:center;
            margin:0;
            color:#2e1065;
            font-weight:800;
        }

        .login-card p{
            text-align:center;
            color:#6b7280;
            font-size:13px;
            margin-bottom:24px;
        }

        .form-group{
            margin-bottom:14px;
        }

        .input{
            width:100%;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid rgba(167,139,250,0.4);
            background:#faf5ff;
            outline:none;
        }

        .input:focus{
            background:white;
            border-color:#a78bfa;
            box-shadow:0 0 0 4px rgba(167,139,250,0.25);
        }

        .login-btn{
            width:100%;
            padding:12px;
            border-radius:14px;
            border:none;
            background: linear-gradient(
                90deg,
                rgba(167,139,250,0.9),
                rgba(196,181,253,0.9)
            );
            font-weight:800;
            color:#2e1065;
            cursor:pointer;
        }

        .login-btn:hover{
            filter:brightness(0.97);
        }

        .extra{
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:13px;
            margin:12px 0 20px;
            color:#6b7280;
        }

        .extra a{
            color:#7c3aed;
            text-decoration:none;
            font-weight:600;
        }

            .login-left h1{
        margin:0 0 18px 0;
        font-size:44px;
        font-weight:900;
        letter-spacing:2px;
    }

    .feature{
        display:flex;
        align-items:flex-start;
        gap:12px;
        margin-bottom:14px;
        font-size:15px;
        line-height:1.6;
    }

        .login-card img{
    filter: drop-shadow(0 6px 14px rgba(0,0,0,0.15));
    }

    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT -->
    <div class="login-left">
        <div class="login-left-content">
            <h1>SIPIKSI</h1>
            <div class="feature">🖥️ <span>Sistem pendataan perangkat hardware terintegrasi</span></div>
            <div class="feature">📊 <span>Pemantauan kondisi dan penggunaan perangkat secara berkala</span></div>
            <div class="feature">⚙️ <span>Mendukung efisiensi pengelolaan aset perangkat keras</span></div>
            <div class="feature">🔐 <span>Menjamin keamanan dan keakuratan data inventaris</span></div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="login-right">
        <div class="login-card">

        <img src="/images/logpiksi.png"
            alt="Logo PIKSI"
            style="width:90px;margin:0 auto 14px;display:block;">

            <h2>Selamat Datang</h2>
            <p>Masuk ke sistem SIPIKSI</p>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <input type="email"
                           name="email"
                           class="input"
                           placeholder="Email"
                           value="<?php echo e(old('email')); ?>"
                           required autofocus>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                <div class="form-group">
                    <input type="password"
                           name="password"
                           class="input"
                           placeholder="Password"
                           required>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                <button type="submit" class="login-btn">MASUK</button>
            </form>

        </div>
    </div>

</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\inventaris-hardware\resources\views/auth/login.blade.php ENDPATH**/ ?>