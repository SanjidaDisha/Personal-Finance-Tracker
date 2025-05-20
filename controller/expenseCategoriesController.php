<?php
session_start();

// Redirect to signin if not logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../view/signin.php');
    exit;
}

// Initialize session arrays if not set
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
}
if (!isset($_SESSION['rules'])) {
    $_SESSION['rules'] = [];
}
if (!isset($_SESSION['transactions'])) {
    $_SESSION['transactions'] = [];
}

// Initialize message variables
$categoryMessage = '';
$ruleMessage = '';
$transactionMessage = '';

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Helper to recalc monthly spending per category for current month
function calculateMonthlySpending() {
    $monthlySpending = [];
    $currentMonth = date('Y-m');
    foreach ($_SESSION['transactions'] as $transaction) {
        if (strpos($transaction['date'], $currentMonth) === 0) {
            $cat = $transaction['category'];
            if (!isset($monthlySpending[$cat])) {
                $monthlySpending[$cat] = 0;
            }
            $monthlySpending[$cat] += $transaction['amount'];
        }
    }
    return $monthlySpending;
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_category':
            $name = sanitize($_POST['category_name'] ?? '');
            $limit = $_POST['category_limit'] ?? '';

            if ($name === '') {
                $categoryMessage = 'Category name is required.';
                break;
            }
            if (!is_numeric($limit) || $limit < 0) {
                $categoryMessage = 'Monthly limit must be a positive number.';
                break;
            }
            // Check for duplicates
            foreach ($_SESSION['categories'] as $cat) {
                if (strtolower($cat['name']) === strtolower($name)) {
                    $categoryMessage = 'Category name already exists.';
                    break 2;
                }
            }
            $_SESSION['categories'][] = [
                'name' => $name,
                'limit' => (float)$limit,
            ];
            $categoryMessage = 'Category added successfully.';
            break;

        case 'delete_category':
            $index = intval($_POST['index'] ?? -1);
            if (isset($_SESSION['categories'][$index])) {
                $deletedCat = $_SESSION['categories'][$index]['name'];
                // Remove category
                array_splice($_SESSION['categories'], $index, 1);
                // Remove rules related to this category
                $_SESSION['rules'] = array_filter($_SESSION['rules'], fn($r) => $r['category'] !== $deletedCat);
                // Also could remove transactions tagged with this category or leave as is
                $categoryMessage = 'Category deleted.';
            } else {
                $categoryMessage = 'Invalid category index.';
            }
            break;

        case 'add_rule':
            $keyword = sanitize($_POST['rule_keyword'] ?? '');
            $category = sanitize($_POST['rule_category'] ?? '');

            if ($keyword === '') {
                $ruleMessage = 'Keyword is required.';
                break;
            }
            if ($category === '') {
                $ruleMessage = 'Please select a category.';
                break;
            }
            // Check category exists
            $catExists = false;
            foreach ($_SESSION['categories'] as $cat) {
                if ($cat['name'] === $category) {
                    $catExists = true;
                    break;
                }
            }
            if (!$catExists) {
                $ruleMessage = 'Selected category does not exist.';
                break;
            }
            // Check for duplicate keyword rule
            foreach ($_SESSION['rules'] as $rule) {
                if (strtolower($rule['keyword']) === strtolower($keyword)) {
                    $ruleMessage = 'Rule with this keyword already exists.';
                    break 2;
                }
            }
            $_SESSION['rules'][] = [
                'keyword' => $keyword,
                'category' => $category,
            ];
            $ruleMessage = 'Rule added successfully.';
            break;

        case 'delete_rule':
            $index = intval($_POST['index'] ?? -1);
            if (isset($_SESSION['rules'][$index])) {
                array_splice($_SESSION['rules'], $index, 1);
                $ruleMessage = 'Rule deleted.';
            } else {
                $ruleMessage = 'Invalid rule index.';
            }
            break;

        case 'tag_transaction':
            $desc = sanitize($_POST['transaction_description'] ?? '');
            if ($desc === '') {
                $transactionMessage = 'Transaction description is required.';
                break;
            }

            // Auto-categorize by keyword rules (case-insensitive substring match)
            $assignedCategory = null;
            foreach ($_SESSION['rules'] as $rule) {
                if (stripos($desc, $rule['keyword']) !== false) {
                    $assignedCategory = $rule['category'];
                    break;
                }
            }

            if ($assignedCategory === null) {
                $transactionMessage = 'No matching category found for this transaction.';
                break;
            }

            // For demo, let's assume amount 0 (since no input)
            // You can add an amount field if needed.
            $amount = 0;

            // Add transaction with current date and assigned category
            $_SESSION['transactions'][] = [
                'description' => $desc,
                'category' => $assignedCategory,
                'amount' => $amount,
                'date' => date('Y-m-d'),
            ];

            // Check spending against limit
            $monthlySpending = calculateMonthlySpending();
            $categoryLimit = 0;
            foreach ($_SESSION['categories'] as $cat) {
                if ($cat['name'] === $assignedCategory) {
                    $categoryLimit = $cat['limit'];
                    break;
                }
            }
            $currentSpend = $monthlySpending[$assignedCategory] ?? 0;
            if ($currentSpend > $categoryLimit && $categoryLimit > 0) {
                $transactionMessage = "Transaction tagged to '{$assignedCategory}'. Warning: Monthly limit exceeded!";
            } else {
                $transactionMessage = "Transaction tagged to '{$assignedCategory}'.";
            }
            break;

        default:
            // unknown action or GET request
            break;
    }
}
