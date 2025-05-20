// Helper: check if value is a positive number
function isPositiveNumber(value) {
  return !isNaN(value) && Number(value) >= 0;
}

// Validate Paycheck Log form
function validatePaycheck() {
  let payee = document.querySelector('#paycheck input[name="payee"]').value.trim();
  let amount = document.querySelector('#paycheck input[name="amount"]').value;
  let date = document.querySelector('#paycheck input[name="date"]').value;

  if (payee === '') {
    alert('Payee name cannot be empty.');
    return false;
  }
  if (!isPositiveNumber(amount)) {
    alert('Amount must be a positive number.');
    return false;
  }
  if (!date) {
    alert('Date is required.');
    return false;
  }
  return true;
}

// Validate Recurring Income form
function validateRecurring() {
  let source = document.querySelector('#recurring input[name="source"]').value.trim();
  let amount = document.querySelector('#recurring input[name="amount"]').value;
  let frequency = document.querySelector('#recurring select[name="frequency"]').value;

  const validFreq = ['Monthly', 'Bi-Weekly', 'Weekly'];

  if (source === '') {
    alert('Source cannot be empty.');
    return false;
  }
  if (!isPositiveNumber(amount)) {
    alert('Amount must be a positive number.');
    return false;
  }
  if (!validFreq.includes(frequency)) {
    alert('Please select a valid frequency.');
    return false;
  }
  return true;
}

// Validate Side Hustle form
function validateSide() {
  let desc = document.querySelector('#sidehustle input[name="desc"]').value.trim();
  let amount = document.querySelector('#sidehustle input[name="amount"]').value;
  let date = document.querySelector('#sidehustle input[name="date"]').value;

  if (desc === '') {
    alert('Description cannot be empty.');
    return false;
  }
  if (!isPositiveNumber(amount)) {
    alert('Amount must be a positive number.');
    return false;
  }
  if (!date) {
    alert('Date is required.');
    return false;
  }
  return true;
}

// Tab switching logic
const tabs = document.querySelectorAll('nav.tabs button');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    const target = tab.getAttribute('data-tab');
    tabContents.forEach(tc => {
      if (tc.id === target) {
        tc.classList.add('active');
      } else {
        tc.classList.remove('active');
      }
    });
  });
});
