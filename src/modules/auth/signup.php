<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body,
    .card h1,
    .form-field label,
    .form-field input,
    .card input[type="submit"] {
      font-family: Tahoma, sans-serif;
    }

  body{
    background-image: url('/UnimasArena/src/Resources/Image/background.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .card {
  background-color: #232323;
  padding: 20px;
  border-radius: 5px;
  width: 350px;
  display: flex;
  flex-direction: column;
}

.card h1{
  text-align: center;
  color: white;
}

.form-field {
  margin-bottom: 10px;
}

.form-field label {
  color: #fff;
  display: inline-block;
  width: 100%;
  text-align: left;
  margin-bottom: 5px;
}

.form-field input {
  flex-grow: 1;
  border-radius: 5px;
  padding: 10px;
  background-color:white;
  color: black;
  font-size: 16px;
  transition: all 0.3s ease;
  width: 93%;
}

.form-field input:focus {
  box-shadow: 0 0 5px 0 #fff;
}

.card input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.card input[type="submit"]:hover {
  background-color: #3e8e41;
}
.signup-link {
  color: white;
}
p {
      font-family: Tahoma, sans-serif;
      color: white;
    }

  </style>
</head>

<body>
<div class="card">
  <h1>Sign Up</h1>
  <form id="signup" action="register.php" method="POST">
    <div class="form-field">
      <label for="fn">First Name</label>
      <input type="text" id="fname" name="fname" required>
    </div>
    <div class="form-field">
      <label for="ln">Last Name</label>
      <input type="text" id="lname" name="lname" required>
    </div>
    <div class="form-field">
      <label for="u-email">Email</label>
      <input type="email" id="user_email" name="user_email" required>
    </div>
    <div class="form-field">
      <label for="pwd">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div>
      <input type="submit" value="Register">
    </div>
    <div>
     <p class="signup-link">Already have an account? <a href="Login.html">Login</a></p>
    </div>
  </form>
</div>

</body>
</html>