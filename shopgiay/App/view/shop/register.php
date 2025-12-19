<style>
    .register-container {
        max-width: 400px;
        margin: 40px auto;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    .register-container img.swoosh {
        width: 60px;
        display: block;
        margin: 0 auto 20px;
    }
    .register-container h2 {
        font-weight: 700;
        font-size: 24px;
        text-align: center;
        letter-spacing: -0.5px;
        margin-bottom: 25px;
    }
    .register-container p.sub-text {
        color: #707072;
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
    }
    .form-control-nike {
        border-radius: 4px;
        border: 1px solid #e5e5e5;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .form-control-nike:focus {
        border-color: #111;
        box-shadow: none;
        outline: none;
    }
    .btn-register {
        background: #111;
        color: #fff;
        width: 100%;
        padding: 12px;
        border-radius: 3px;
        font-weight: 500;
        text-transform: uppercase;
        margin-top: 20px;
        border: none;
    }
    .btn-register:hover { background: #333; }
    .terms-text {
        font-size: 12px;
        color: #8d8d8d;
        text-align: center;
        margin-top: 15px;
    }
    .terms-text a { color: #8d8d8d; text-decoration: underline; }
</style>

<div class="register-container px-3">
    <svg class="swoosh" viewBox="0 0 24 24" fill="#111"><path d="M21 8.719L7.836 14.303C6.74 14.768 5.818 15 5.075 15c-.836 0-1.445-.295-1.819-.884-.485-.76-.273-1.982.559-3.272.494-.754 1.122-1.446 1.734-2.108-.144.234-1.415 2.349-.025 3.345.275.2.666.298 1.147.298.386 0 .829-.063 1.316-.19L21 8.719z"></path></svg>
    
    <h2>BECOME A PKD MEMBER</h2>
    <p class="sub-text">Create your Nike Member profile and get first access to the very best of Nike products, inspiration and community.</p>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicate_email'): ?>
        <div class="alert-nike">
            Email này đã được sử dụng. Vui lòng sử dụng email khác.
        </div>
    <?php endif; ?>

    <form action="index.php?page=auth_register" method="POST">
        <input type="email" name="email" class="form-control-nike w-100" placeholder="Email address" required>
        <input type="password" name="password" class="form-control-nike w-100" placeholder="Password" required>
        <input type="text" name="first_name" class="form-control-nike w-100" placeholder="First Name" required>
        <input type="text" name="last_name" class="form-control-nike w-100" placeholder="Last Name" required>
        
        <div class="d-flex gap-2 mb-3">
            <input type="date" name="birthday" class="form-control-nike flex-grow-1">
        </div>

        <select name="gender" class="form-control-nike w-100">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <p class="terms-text">
            By creating an account, you agree to PKD's <a href="#">Privacy Policy</a> and <a href="#">Terms of Use</a>.
        </p>

        <button type="submit" class="btn-register">Join Us</button>

        <p class="text-center mt-3" style="font-size: 14px;">
            Already a Member? <a href="index.php?page=login" class="text-dark fw-bold text-decoration-none">Sign In.</a>
        </p>
    </form>
</div>