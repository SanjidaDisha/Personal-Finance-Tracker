// expenseCategories.js

document.addEventListener('DOMContentLoaded', () => {
  let categoryForm = document.getElementById('category-form');
  let categoryListDiv = document.getElementById('category-list');
  let categoryMessageDiv = document.getElementById('category-message');

  let ruleForm = document.getElementById('rule-form');
  let ruleListDiv = document.getElementById('rule-list');
  let ruleMessageDiv = document.getElementById('rule-message');

  let transactionForm = document.getElementById('transaction-form');
  let taggingResultDiv = document.getElementById('tagging-result');

  // Elements inside category form
  let categoryNameInput = document.getElementById('category-name');
  let categoryLimitInput = document.getElementById('category-limit');

  // Elements inside rule form
  let ruleKeywordInput = document.getElementById('rule-keyword');
  let ruleCategorySelect = document.getElementById('rule-category');

  // Elements inside transaction form
  let transactionDescriptionInput = document.getElementById('transaction-description');

  // CLIENT-SIDE VALIDATION FOR CATEGORY FORM
  categoryForm.addEventListener('submit', (e) => {
    let valid = true;
    categoryMessageDiv.textContent = '';

    if (categoryNameInput.value.trim() === '') {
      categoryMessageDiv.textContent = 'Category name is required.';
      valid = false;
    } else if (categoryNameInput.value.length > 30) {
      categoryMessageDiv.textContent = 'Category name max length is 30 characters.';
      valid = false;
    }

    let limitVal = parseFloat(categoryLimitInput.value);
    if (isNaN(limitVal) || limitVal < 0) {
      categoryMessageDiv.textContent = 'Monthly limit must be a positive number.';
      valid = false;
    }

    if (!valid) e.preventDefault();
  });

  // CLIENT-SIDE VALIDATION FOR RULE FORM
  ruleForm.addEventListener('submit', (e) => {
    ruleMessageDiv.textContent = '';
    let valid = true;

    if (ruleKeywordInput.value.trim() === '') {
      ruleMessageDiv.textContent = 'Keyword is required.';
      valid = false;
    } else if (ruleKeywordInput.value.length > 50) {
      ruleMessageDiv.textContent = 'Keyword max length is 50 characters.';
      valid = false;
    }

    if (ruleCategorySelect.value === '') {
      ruleMessageDiv.textContent = 'Please select a category.';
      valid = false;
    }

    if (!valid) e.preventDefault();
  });

  // CLIENT-SIDE VALIDATION FOR TRANSACTION FORM
  transactionForm.addEventListener('submit', (e) => {
    taggingResultDiv.textContent = '';
    let valid = true;

    if (transactionDescriptionInput.value.trim() === '') {
      taggingResultDiv.textContent = 'Transaction description is required.';
      valid = false;
    } else if (transactionDescriptionInput.value.length > 100) {
      taggingResultDiv.textContent = 'Description max length is 100 characters.';
      valid = false;
    }

    if (!valid) e.preventDefault();
  });

  // Function to populate rule-category select options (if needed)
  function updateRuleCategoryOptions() {
    while (ruleCategorySelect.options.length > 1) {
      ruleCategorySelect.remove(1);
    }
    // Categories should be rendered by PHP on page load.
  }

  updateRuleCategoryOptions();
});
