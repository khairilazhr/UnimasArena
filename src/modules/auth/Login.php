<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  body {
    background-image: url('/UnimasArena/src/Resources/Image/background.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }
  </style>
  
</head>
<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <div class="mb-md-5 mt-md-4 pb-5">
  
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                
                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                echo "<p class='text-danger'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);  // remove the error message from session
                }
                ?>


                <form action="login_process.php" method="POST">
                <div class="form-outline form-white mb-4">
                  <input type="email" id="user_email" name="user_email" class="form-control form-control-lg" />
                  <label class="form-label" for="user_email">Email</label>
                </div>
  
                <div class="form-outline form-white mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" />
                  <label class="form-label" for="password">Password</label>
                </div>
  
                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="forgotPassword.php">Forgot password?</a></p>
  
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </form>
                
     
  
              </div>
  
              <div>
                <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>