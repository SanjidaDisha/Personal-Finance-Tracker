<?php
session_start();
// Check if session or cookie is set
if (!isset($_SESSION['status']) && !isset($_COOKIE['status'])) {
    header('Location: signin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Profile - Finance Tracker</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/Profile management.css">
</head>
<body>

  <!-- Responsive Navbar -->
  <header class="navbar">
    <div class="logo">FinanceTracker</div>
    <nav class="nav-links" id="navLinks">
      <a href="landing-page.php">Home</a>
      <a href="Dashboard.php">Dashboard</a>
      <a href="Profile-management.php">Profile</a>
      <a href="debt-tracking.php">Debt</a>
      <a href="tax-categories.php">Tax</a>
      <a href="account-linking.php">Accounts</a>
      <a href="reports.php">Reports</a>
      <a href="../controller/Logout.php">Logout</a>
    </nav>
    <div class="hamburger" id="hamburger"><i class="fas fa-bars"></i></div>
  </header>

  <!-- View Profile -->
  <div class="container section" id="viewProfile">
    <h2>View Profile</h2>
    <div style="text-align:center; margin-bottom: 20px;">
      <div class="profile-pic-container">
        <img id="avatar" src="https://via.placeholder.com/120" class="profile-pic">
        <div class="change-avatar-btn" onclick="showScreen('changeAvatar')">Change</div>
      </div>
      <div class="value-label"><strong>Name:</strong> <span id="v_name">—</span></div>
      <div class="value-label"><strong>Email:</strong> <span id="v_email">—</span></div>
      <div class="value-label"><strong>Gender:</strong> <span id="v_gender">—</span></div>
      <div class="value-label"><strong>Country:</strong> <span id="v_country">—</span></div>
      <div class="value-label"><strong>Date of Birth:</strong> <span id="v_dob">—</span></div>
      <div class="value-label"><strong>Age:</strong> <span id="v_age">—</span></div>
    </div>
    <div class="links">
      <button onclick="showScreen('editProfile')">Edit Profile</button>
      <button onclick="showScreen('updatePassword')">Update Password</button>
    </div>
  </div>

  <!-- Edit Profile -->
  <div class="container section" id="editProfile">
    <h2>Edit Profile</h2>
    <form onsubmit="return validateProfileEdit()" method="POST" action="../controller/Profile managementcontroller.php">
      <div class="field"><label>Name:</label><input type="text" name="name" id="e_name"></div>
      <div class="field"><label>Email:</label><input type="email" name="email" id="e_email"></div>
      <div class="field">
        <label>Gender:</label>
        <select name="gender" id="e_gender">
          <option value="">Select</option>
          <option>Male</option>
          <option>Female</option>
          <option>Other</option>
        </select>
      </div>
      <div class="field"><label>Country:</label><input type="text" name="country" id="e_country"></div>
      <div class="field"><label>Date of Birth:</label><input type="date" name="dob" id="e_dob"></div>
      <button type="submit" name="edit_profile">Save Changes</button>
      <button type="button" onclick="showScreen('viewProfile')">Cancel</button>
    </form>
  </div>

  <!-- Change Avatar -->
  <div class="container section" id="changeAvatar">
    <h2>Change Avatar</h2>
    <input type="file" id="avatarInput" accept="image/*">
    <button onclick="updateAvatar()">Set as Profile Picture</button>
    <button onclick="showScreen('viewProfile')">Cancel</button>
  </div>

  <!-- Update Password -->
  <div class="container section" id="updatePassword">
    <h2>Update Password</h2>
    <form onsubmit="return validatePasswordUpdate()" method="POST" action="../controller/Profile managementcontroller.php">
      <div class="field"><label>New Password:</label><input type="password" name="new_password" id="new_password"></div>
      <div class="field"><label>Confirm Password:</label><input type="password" name="confirm_password" id="confirm_password"></div>
      <button type="submit" name="update_password">Save Changes</button>
      <button type="button" onclick="showScreen('viewProfile')">Cancel</button>
    </form>
  </div>

  
  <script src="../assets/Profile management.js"></script>

</body>
</html>
