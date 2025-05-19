// Navbar toggle for mobile
    function toggleNav() {
      const nav = document.getElementById("topNav");
      nav.className = nav.className === "topnav" ? "topnav responsive" : "topnav";
    }

    // Deduction logic
    let deductions = [];

    function showScreen(id) {
      document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(id).classList.add('active');

      if (id === 'summary') updateSummary();
    }

    function addDeduction() {
      const name = document.getElementById('deductionName').value.trim();
      const amount = parseFloat(document.getElementById('deductionAmount').value);

      if (name && amount > 0) {
        deductions.push({ name, amount });
        document.getElementById('deductionName').value = '';
        document.getElementById('deductionAmount').value = '';
        updateDeductionList();
      }
    }

    function updateDeductionList() {
      const list = document.getElementById('deductionList');
      list.innerHTML = '';
      deductions.forEach((d, i) => {
        const div = document.createElement('div');
        div.className = 'item';
        div.textContent = `${d.name} — $${d.amount.toFixed(2)}`;
        list.appendChild(div);
      });
    }

    function updateSummary() {
      const list = document.getElementById('summaryList');
      const totalDiv = document.getElementById('totalSummary');
      list.innerHTML = '';
      let total = 0;

      deductions.forEach(d => {
        const div = document.createElement('div');
        div.className = 'item';
        div.textContent = `${d.name}: $${d.amount.toFixed(2)}`;
        list.appendChild(div);
        total += d.amount;
      });

      totalDiv.textContent = `Total Deductible: $${total.toFixed(2)}`;
    }

    function exportData() {
      const output = deductions.map(d => `${d.name}: $${d.amount.toFixed(2)}`).join('\n');
      document.getElementById('exportBox').value = output || 'No deductions to export.';
    }