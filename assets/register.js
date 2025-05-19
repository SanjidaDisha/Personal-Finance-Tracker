function validateForm() {
      let valid = true;
      document.querySelectorAll(".error").forEach(e => e.innerText = "");

      let fname = document.getElementById("firstname").value.trim();
      if (fname.length < 2 || !/^[a-zA-Z][a-zA-Z .-]*$/.test(fname)) {
        document.getElementById("fnameErr").innerText = "Valid first name required.";
        valid = false;
      }

      let lname = document.getElementById("lastname").value.trim();
      if (lname.length < 2 || !/^[a-zA-Z][a-zA-Z .-]*$/.test(lname)) {
        document.getElementById("lnameErr").innerText = "Valid last name required.";
        valid = false;
      }

      let email = document.getElementById("email").value.trim();
      if (!email.includes("@") || email.length < 5) {
        document.getElementById("emailErr").innerText = "Enter a valid email.";
        valid = false;
      }

      let pass = document.getElementById("password").value;
      if (pass.length < 6) {
        document.getElementById("passErr").innerText = "Password must be 6+ characters.";
        valid = false;
      }

      let cpass = document.getElementById("confirmPassword").value;
      if (cpass !== pass) {
        document.getElementById("confirmPassErr").innerText = "Passwords do not match.";
        valid = false;
      }

      if (!document.getElementById("male").checked && !document.getElementById("female").checked) {
        document.getElementById("genderErr").innerText = "Select your gender.";
        valid = false;
      }

      let dob = document.getElementById("dob").value;
      if (!dob) {
        document.getElementById("dobErr").innerText = "Enter your date of birth.";
        valid = false;
      }

      return valid;
    }