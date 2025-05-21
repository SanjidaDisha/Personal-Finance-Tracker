// Show one section and hide others
function showScreen(id) {
  const sections = document.querySelectorAll(".section");
  sections.forEach(section => {
    section.style.display = "none";
  });

  const active = document.getElementById(id);
  if (active) {
    active.style.display = "block";
  }
}

// Save profile edits
function saveProfile() {
  const name = document.getElementById("e_name").value;
  const email = document.getElementById("e_email").value;
  const gender = document.getElementById("e_gender").value;
  const country = document.getElementById("e_country").value;
  const dob = document.getElementById("e_dob").value;

  if (!name || !email || !gender || !country || !dob) {
    alert("Please fill out all fields.");
    return;
  }

  document.getElementById("v_name").textContent = name;
  document.getElementById("v_email").textContent = email;
  document.getElementById("v_gender").textContent = gender;
  document.getElementById("v_country").textContent = country;
  document.getElementById("v_dob").textContent = dob;

  // Calculate and update age
  const birthDate = new Date(dob);
  const today = new Date();
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    age--;
  }
  document.getElementById("v_age").textContent = age;

  showScreen("viewProfile");
}

// Set new avatar
function updateAvatar() {
  const input = document.getElementById("avatarInput");
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("avatar").src = e.target.result;
      showScreen("viewProfile");
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    alert("Please select an image.");
  }
}

// Change password (simulated)
function updatePassword() {
  const newPassword = document.getElementById("new_password").value;
  const confirmPassword = document.getElementById("confirm_password").value;

  if (!newPassword || !confirmPassword) {
    alert("Please enter both password fields.");
    return;
  }

  if (newPassword !== confirmPassword) {
    alert("Passwords do not match.");
    return;
  }

  alert("Password updated successfully!");
  showScreen("viewProfile");
}

// Hamburger toggle
document.addEventListener("DOMContentLoaded", function () {
  showScreen("viewProfile");

  const hamburger = document.getElementById("hamburger");
  const navLinks = document.getElementById("navLinks");

  if (hamburger && navLinks) {
    hamburger.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });
  }
});
