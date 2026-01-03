<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In</title>
  <link rel="stylesheet" href="signin.css" />
</head>
<body>
  <div class="signin-container">
    <h2>Sign In</h2>

    <?php if (isset($_GET['error'])): ?>
      <p style="color: red; text-align: center;">Login failed: <?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['login']) && $_GET['login'] === 'success'): ?>
      <p style="color: green; text-align: center;">Login successful!</p>
    <?php endif; ?>

    <form class="signin-form" method="POST" action="login.php">
      <label for="role">I am a:</label>
      <select id="role" name="role" required>
        <option value="" disabled selected>Select</option>
        <option value="farmer">Farmer</option>
        <option value="cooperative">Cooperative</option>
      </select>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />

      <button type="submit">Sign In</button>
    </form>

    <div class="signup-link">
      <p>Don't have an account?</p>
      <a href="signuppage.html" class="signup-button">Sign Up</a>
    </div>
  </div>
</body>
</html>
