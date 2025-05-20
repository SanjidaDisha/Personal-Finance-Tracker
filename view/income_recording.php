<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location:../view/signin.php");
  exit();
}
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Income Recording - FinanceTracker</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/incomeRecording.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">FinanceTracker</div>
    <div class="user">
      <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['email']); ?>!</span>
      <button class="profile-btn" onclick="window.location.href='profile.php'">👤</button>
    </div>
  </header>

    <?php
  if (isset($_SESSION['income_errors']) && count($_SESSION['income_errors']) > 0) {
      echo '<div class="error-messages">';
      echo '<ul>';
      foreach ($_SESSION['income_errors'] as $error) {
          echo '<li>' . htmlspecialchars($error) . '</li>';
      }
      echo '</ul>';
      echo '</div>';
      unset($_SESSION['income_errors']);
  }
  ?>

  <nav class="tabs">
    <button class="active" data-tab="paycheck">Paycheck Log</button>
    <button data-tab="recurring">Recurring Income</button>
    <button data-tab="sidehustle">Side Hustle</button>
  </nav>

  <main>
    <!-- PAYCHECK TAB -->
    <section id="paycheck" class="tab-content active">
      <h2>Paycheck Log</h2>
      <form action="../controller/income_controller.php" method="POST" onsubmit="return validatePaycheck()">
        <input type="hidden" name="type" value="paycheck" />
        <label>Payee</label>
        <input type="text" name="payee" id="payee" required />
        <label>Amount (₹)</label>
        <input type="number" name="amount" id="amount" min="0" required />
        <label>Date</label>
        <input type="date" name="date" id="payDate" required />
        <button type="submit">Add Paycheck</button>
      </form>
    </section>

    <!-- RECURRING TAB -->
    <section id="recurring" class="tab-content">
      <h2>Recurring Income</h2>
      <form action="../controller/income_controller.php" method="POST" onsubmit="return validateRecurring()">
        <input type="hidden" name="type" value="recurring" />
        <label>Source</label>
        <input type="text" name="source" id="recurringSource" required />
        <label>Amount (₹)</label>
        <input type="number" name="amount" id="recurringAmount" min="0" required />
        <label>Frequency</label>
        <select name="frequency" id="recurringFrequency">
          <option value="Monthly">Monthly</option>
          <option value="Bi-Weekly">Bi-Weekly</option>
          <option value="Weekly">Weekly</option>
        </select>
        <label>Start Date</label>
        <input type="date" name="startDate" id="recurringStartDate" required />
        <button type="submit">Set Recurring</button>
      </form>
    </section>

    <!-- SIDE HUSTLE TAB -->
    <section id="sidehustle" class="tab-content">
      <h2>Side Hustle</h2>
      <form action="../controller/income_controller.php" method="POST" onsubmit="return validateSide()">
        <input type="hidden" name="type" value="side" />
        <label>Description</label>
        <input type="text" name="desc" id="sideDescription" required />
        <label>Amount (₹)</label>
        <input type="number" name="amount" id="sideAmount" min="0" required />
        <label>Date</label>
        <input type="date" name="date" id="sideDate" required />
        <button type="submit">Log Side Hustle</button>
      </form>
    </section>

    <!-- FORECAST SECTION -->
    <section class="forecast">
      <h2>Income Forecast</h2>
      <p id="forecast1">Next 1 Month: ₹0</p>
      <p id="forecast3">Next 3 Months: ₹0</p>
      <p id="forecast6">Next 6 Months: ₹0</p>
    </section>
  </main>

  <script src="../assets/incomeRecording.js"></script>
</body>
</html>
