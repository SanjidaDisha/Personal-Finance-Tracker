<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Not logged in, redirect to signin page
    header('Location:../view/signin.php');
    exit;
}
$username = htmlspecialchars($_SESSION['username'] ?? 'User'); // fallback username
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Debt Tracking - Finance Tracker</title>

  <!-- Font Awesome for hamburger icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="../assets/debt-tracking.css"> <!-- Link to CSS -->
</head>
<body>

  <!-- Responsive Navbar -->
  <header class="navbar">
    <div class="logo">FinanceTracker</div>
    <nav class="nav-links" id="navLinks">
      <a href="landing-page.php">Home</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="Profile management.php">Profile</a>
      <a href="savings-goals.php">Savings</a>
      <a href="debt-tracking.php">Debt</a>
      <a href="tax-categories.php">Tax</a>
      <a href="account-linking.php">Accounts</a>
      <a href="reports.php">Reports</a>
      <a href="../controller/Logout.php">Logout</a> <!-- Corrected Logout link -->
    </nav>
    <div class="hamburger" id="hamburger"><i class="fas fa-bars"></i></div>
  </header>

  <h1>Debt Tracking</h1>

  <div class="nav-buttons">
    <button onclick="showScreen('dashboard')">Loan Dashboard</button>
    <button onclick="showScreen('calculator')">Payoff Calculator</button>
    <button onclick="showScreen('analyzer')">Interest Analyzer</button>
  </div>

  <!-- Loan Dashboard -->
  <div id="dashboard" class="section active">
    <h2>Loan Dashboard</h2>
    <form method="POST" action="../controller/debt-trackingcontroller.php" onsubmit="return validateLoanForm();">
    <label>Loan Type</label>
    <input type="text" id="loanName" placeholder="e.g. Car Loan">
    <label>Amount ($)</label>
    <input type="number" id="loanAmount" placeholder="e.g. 10000">
    <label>APR (%)</label>
    <input type="number" id="loanRate" placeholder="e.g. 5">
    <button class="add-btn" onclick="addLoan()">Add Loan</button>
</form>
    <div id="loanList"></div>
  </div>

  <!-- Payoff Calculator -->
  <div id="calculator" class="section">
    <h2>Payoff Calculator</h2>
    <label>Loan Amount ($)</label>
    <input type="number" id="amount" placeholder="e.g. 10000">
    <label>APR (%)</label>
    <input type="number" id="rate" placeholder="e.g. 5">
    <label>Monthly Payment ($)</label>
    <input type="number" id="payment" placeholder="e.g. 250">
    <button onclick="calculatePayoff()">Calculate</button>
    <div id="payoffResult" class="result"></div>
    <button class="add-btn" onclick="showScreen('dashboard')">← Back to Dashboard</button>
  </div>

  <!-- Interest Analyzer -->
  <div id="analyzer" class="section">
    <h2>Interest Analyzer</h2>
    <label>Total Loan Amount ($)</label>
    <input type="number" id="iaAmount" placeholder="e.g. 20000">
    <label>APR (%)</label>
    <input type="number" id="iaRate" placeholder="e.g. 4.5">
    <label>Term (years)</label>
    <input type="number" id="iaTerm" placeholder="e.g. 5">
    <button onclick="analyzeInterest()">Analyze</button>
    <div id="interestResult" class="result"></div>
    <button class="add-btn" onclick="showScreen('dashboard')">← Back to Dashboard</button>
  </div>
<?php
  if (!empty($_SESSION['debt_errors'])) {
    foreach ($_SESSION['debt_errors'] as $error) {
      echo "<p style='color:red;'>$error</p>";
    }
    unset($_SESSION['debt_errors']);
  }
  if (!empty($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
  }
?>
    <script src="../assets/debt-tracking.js"></script> <!-- Link to JS -->
</body>
</html>
