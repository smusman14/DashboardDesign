 <?php
  include 'connect.php';


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql =  "insert into `dashboarddesign`.`userprofile` (username, email, phone, password) 
        values ('$username', '$email', '$phone', '$password')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
      header('location: display.php');
    }
  }

  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <title>Profile Details Form</title>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Tailwind CSS -->
   <script src="https://cdn.tailwindcss.com"></script>
 </head>

 <body class="bg-gray-100 flex items-center justify-center min-h-screen">

   <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
     <h2 class="text-2xl font-bold mb-6 text-center">Profile Details</h2>
     <form id="profileForm" novalidate method="post" onsubmit="return validation()">

       <div class="mb-4">
         <label for="name" class="form-label">Profile Name</label>
         <input type="text" id="name" name="username" class="form-control" required>
         <div class="text-red-600 text-sm mt-1 hidden" id="nameError">Name is required.</div>
       </div>

       <div class="mb-4">
         <label for="email" class="form-label">Profile Email</label>
         <input type="email" id="email" name="email" class="form-control" required>
         <div class="text-red-600 text-sm mt-1 hidden" id="emailError">Enter a valid email address.</div>
       </div>

       <div class="mb-4">
         <label for="number" class="form-label">Profile Number</label>
         <input type="tel" id="number" name="phone" class="form-control" required>
         <div class="text-red-600 text-sm mt-1 hidden" id="numberError">Enter a valid 10-digit number.</div>
       </div>

       <div class="mb-4">
         <label for="password" class="form-label">Profile Password</label>
         <input type="password" name="password" id="password" class="form-control" required>
         <div class="text-red-600 text-sm mt-1 hidden" id="passwordError">Password must be at least 6 characters.</div>
       </div>

       <button type="submit" name="submit" class="btn btn-primary w-full">Submit</button>
     </form>
   </div>

   <script>
     function validation() {
       // Clear error messages
       ['nameError', 'emailError', 'numberError', 'passwordError'].forEach(id => {
         document.getElementById(id).classList.add('hidden');
       });

       const name = document.getElementById('name').value.trim();
       const email = document.getElementById('email').value.trim();
       const number = document.getElementById('number').value.trim();
       const password = document.getElementById('password').value.trim();

       let valid = true;

       if (name === '') {
         document.getElementById('nameError').classList.remove('hidden');
         valid = false;
       }

       const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       if (!emailRegex.test(email)) {
         document.getElementById('emailError').classList.remove('hidden');
         valid = false;
       }

       const numberRegex = /^\d{10}$/;
       if (!numberRegex.test(number)) {
         document.getElementById('numberError').classList.remove('hidden');
         valid = false;
       }

       if (password.length < 6) {
         document.getElementById('passwordError').classList.remove('hidden');
         valid = false;
       }

       // 🔁 Agar valid false hai, to form submit nahi hoga
       return valid;
     }
   </script>
 </body>

 </html>