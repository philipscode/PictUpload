<?php if (!empty($errors)): ?>
<div class="errors">
    <p><?=$errors[0]?></p>
</div>
<?php endif; ?>
<form action="" method="post">
    <div class="form-container">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="author[name]" placeholder="Username" required>
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="author[email]" placeholder="user@example.com" required>
        <label for="password">Enter your password:</label>
        <input type="password" id="password" name="author[password]" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </div>
</form>