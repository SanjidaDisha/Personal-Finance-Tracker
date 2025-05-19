function showScreen(screenId) {
      document.querySelectorAll('.section').forEach(screen => {
        screen.classList.remove('active');
      });
      document.getElementById(screenId).classList.add('active');
    }

    function saveProfile() {
      alert("Profile updated successfully!");
      showScreen('viewProfile');
    }

    function updateAvatar() {
      const avatarInput = document.getElementById('avatarInput');
      const avatarImage = document.getElementById('avatar');
      const file = avatarInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          avatarImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }

    function updatePassword() {
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      if (newPassword === confirmPassword) {
        alert("Password updated successfully!");
        showScreen('viewProfile');
      } else {
        alert("Passwords do not match!");
      }
    }

    // Initial screen
    showScreen('viewProfile');