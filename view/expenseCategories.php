<?php
// Include controller logic for session + POST handling
require_once('../controller/expenseCategoriesController.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Expense Categories - FinanceTracker</title>
  <link rel="stylesheet" href="../assets/expenseCategories.css" />
</head>
<body>
  <header class="navbar">
    <div class="logo">FinanceTracker</div>
    <div class="user">
      <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['email']); ?>!</span>

      <form method="post" action="../controller/logout.php" style="display:inline;">
        <button type="submit">Logout</button>
      </form>
    </div>
  </header>

  <main class="container">
    <h1>Expense Categories</h1>

    <!-- Category Manager -->
    <section class="category-section">
      <h2>Add New Category</h2>
      <form method="post" id="category-form" novalidate>
        <input type="hidden" name="action" value="add_category" />
        <label for="category-name">Category Name:</label>
        <input
          type="text"
          id="category-name"
          name="category_name"
          required
          maxlength="30"
          pattern=".{1,30}"
          title="1 to 30 characters"
        />
        
        <label for="category-limit">Monthly Limit (₹):</label>
        <input
          type="number"
          id="category-limit"
          name="category_limit"
          min="0"
          step="0.01"
          required
        />

        <button type="submit">Add Category</button>
      </form>
      <div id="category-message" class="message"><?php echo $categoryMessage; ?></div>
      
      <h3>Existing Categories</h3>
      <div id="category-list">
        <?php if (empty($_SESSION['categories'])): ?>
          <p>No categories added yet.</p>
        <?php else: ?>
          <?php foreach ($_SESSION['categories'] as $i => $cat): ?>
            <div class="category-item">
              <div>
                <strong class="category-name"><?php echo htmlspecialchars($cat['name']); ?></strong><br />
                <small>Limit: ₹<?php echo number_format($cat['limit'], 2); ?></small>
              </div>
              <form method="post" style="display:inline;">
                <input type="hidden" name="action" value="delete_category" />
                <input type="hidden" name="index" value="<?php echo $i; ?>" />
                <button type="submit" onclick="return confirm('Delete this category?')">Delete</button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <hr />

    <!-- Custom Rule Creator -->
    <section class="rule-section">
      <h2>Create Custom Rule</h2>
      <form method="post" id="rule-form" novalidate>
        <input type="hidden" name="action" value="add_rule" />
        <label for="rule-keyword">Keyword:</label>
        <input
          type="text"
          id="rule-keyword"
          name="rule_keyword"
          required
          maxlength="50"
          pattern=".{1,50}"
          title="1 to 50 characters"
        />
        
        <label for="rule-category">Assign Category:</label>
        <select id="rule-category" name="rule_category" required>
          <option value="">--Select Category--</option>
          <?php foreach ($_SESSION['categories'] as $cat): ?>
            <option value="<?php echo htmlspecialchars($cat['name']); ?>">
              <?php echo htmlspecialchars($cat['name']); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <button type="submit">Add Rule</button>
      </form>
      <div id="rule-message" class="message"><?php echo $ruleMessage; ?></div>
      
      <h3>Existing Rules</h3>
      <div id="rule-list">
        <?php if (empty($_SESSION['rules'])): ?>
          <p>No rules defined yet.</p>
        <?php else: ?>
          <?php foreach ($_SESSION['rules'] as $i => $rule): ?>
            <div class="rule-item">
              <div>
                <strong>Keyword:</strong> <?php echo htmlspecialchars($rule['keyword']); ?><br />
                <small>Category: <?php echo htmlspecialchars($rule['category']); ?></small>
              </div>
              <form method="post" style="display:inline;">
                <input type="hidden" name="action" value="delete_rule" />
                <input type="hidden" name="index" value="<?php echo $i; ?>" />
                <button type="submit" onclick="return confirm('Delete this rule?')">Delete</button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <hr />

    <!-- Transaction Tagger -->
    <section class="transaction-section">
      <h2>Tag Transaction</h2>
      <form method="post" id="transaction-form" novalidate>
        <input type="hidden" name="action" value="tag_transaction" />
        <label for="transaction-description">Transaction Description:</label>
        <input
          type="text"
          id="transaction-description"
          name="transaction_description"
          required
          maxlength="100"
          pattern=".{1,100}"
          title="1 to 100 characters"
        />

        <button type="submit">Tag Transaction</button>
      </form>
      <div id="tagging-result" class="message"><?php echo $transactionMessage; ?></div>
    </section>
  </main>

  <script src="../assets/expenseCategories.js"></script>
</body>
</html>
