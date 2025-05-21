// Navbar toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const icon = hamburger.querySelector('i');
    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-times');
    });
    // Section switch
    function showScreen(id) {
      document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');
    }

    // Loan functions
    function addLoan() {
      const name = document.getElementById('loanName').value.trim();
      const amount = parseFloat(document.getElementById('loanAmount').value);
      const rate = parseFloat(document.getElementById('loanRate').value);
      if (name && amount > 0 && rate >= 0) {
        const div = document.createElement('div');
        div.className = 'loan-box';
        div.textContent = `${name} – $${amount.toFixed(2)} @ ${rate}% APR`;
        document.getElementById('loanList').appendChild(div);
        ['loanName','loanAmount','loanRate'].forEach(id=>document.getElementById(id).value='');
      }
    }

    function calculatePayoff() {
      const P = parseFloat(document.getElementById('amount').value);
      const r = parseFloat(document.getElementById('rate').value)/100/12;
      const m = parseFloat(document.getElementById('payment').value);
      if (P>0 && r>0 && m>0) {
        const months = Math.log(m/(m-P*r))/Math.log(1+r);
        const years = months/12;
        document.getElementById('payoffResult').textContent =
          `~${Math.ceil(months)} months (${years.toFixed(1)} yrs)`;
      } else {
        document.getElementById('payoffResult').textContent = "Fill all fields correctly.";
      }
    }

    function analyzeInterest() {
      const loan = parseFloat(document.getElementById('iaAmount').value);
      const apr = parseFloat(document.getElementById('iaRate').value)/100;
      const years = parseFloat(document.getElementById('iaTerm').value);
      if (loan>0 && apr>0 && years>0) {
        const totalInterest = loan*apr*years;
        const totalCost = loan+totalInterest;
        document.getElementById('interestResult').textContent =
          `Interest: $${totalInterest.toFixed(2)} | Total: $${totalCost.toFixed(2)}`;
      } else {
        document.getElementById('interestResult').textContent = "Enter valid values.";
      }
    }