<div class="container-center">
    <div class="card-login">
        <h2>Login</h2>
        <?php
            if (!empty($errorMessage)) {
               echo '<div>'. $errorMessage . '</div>';
            }
        ?>
        <form method="post" action="/login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/register">Register</a></p>
    </div>
</div>
