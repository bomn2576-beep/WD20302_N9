<style>
    .login-container { max-width: 400px; margin: 40px auto; padding: 20px; font-family: "Helvetica Neue", sans-serif; }
    .btn-black { background: #111; color: #fff; width: 100%; padding: 12px; border: none; margin-top: 20px; font-weight: bold; }
    .alert-nike { background: #fae9e9; color: #d71920; padding: 10px; margin-bottom: 15px; text-align: center; font-size: 14px; border: 1px solid #f1c4c4; }
</style>

<div class="login-container">
    <h2 class="text-center fw-bold mb-4">YOUR ACCOUNT FOR EVERYTHING NIKE</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert-nike">
            <?php 
                if ($_GET['error'] == 'notfound') echo "Email không tồn tại trong hệ thống!";
                if ($_GET['error'] == 'wrongpass') echo "Mật khẩu không chính xác!";
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=auth_login" method="POST">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email address" required style="padding: 12px;">
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required style="padding: 12px;">
        
        <div class="d-flex justify-content-between mb-3" style="font-size: 12px;">
            <label><input type="checkbox"> Keep me signed in</label>
            <a href="#" class="text-secondary text-decoration-none">Forgotten your password?</a>
        </div>

        <button type="submit" class="btn-black">SIGN IN</button>
        
        <p class="text-center mt-4" style="font-size: 14px;">
            Not a Member? <a href="index.php?page=register" class="text-dark fw-bold text-decoration-none">Join Us.</a>
        </p>
    </form>
</div>