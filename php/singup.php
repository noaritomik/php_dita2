<?php include('header.php');?>

<div>

            <form class="form-signin" action="register.php" method="post">

              <div class="row">
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="form3Example1" class="form-control"  placeholder="Name" name="name"/>
                    <label class="form-label" for="form3Example1">Name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="form3Example2" class="form-control" placeholder="Surname" name="surname"/>
                    <label class="form-label" for="form3Example2">Surname</label>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="form3Example2" class="form-control" placeholder="Username" name="username"/>
                    <label class="form-label" for="form3Example2">Username</label>
                  </div>
                </div>
              </div>

               <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control" placeholder="Email" name="email"/>
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" placeholder="Password" name="password"/>
                <label class="form-label" for="form3Example4">Password</label>
              </div>

           

              <!-- Submit button -->
              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" name="submit">
                Sign up
              </button>
              
              
              <small>Already have account? <a href="login.php">Log In</a></small>
              

            </form>

</div>

<?php include('footer.php');?>