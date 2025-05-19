// Hamburger toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const icon = hamburger.querySelector('i');

    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-times');
    });

    // Section navigation
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.report-section');
      sections.forEach(sec => sec.classList.remove('active'));
      document.getElementById(sectionId).classList.add('active');
    }

    // Chart.js Charts
    const trendsChart = new Chart(document.getElementById('trendsChart'), {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
          label: 'Spending',
          data: [400, 350, 500, 450, 600],
          borderColor: 'blue',
          fill: false
        }]
      }
    });

    const incomeExpenseChart = new Chart(document.getElementById('incomeExpenseChart'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [
          {
            label: 'Income',
            data: [1000, 1100, 1200, 1150, 1300],
            backgroundColor: 'green'
          },
          {
            label: 'Expense',
            data: [800, 900, 950, 880, 1000],
            backgroundColor: 'red'
          }
        ]
      }
    });

    const netWorthChart = new Chart(document.getElementById('netWorthChart'), {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
          label: 'Net Worth',
          data: [5000, 5200, 5400, 5600, 5800],
          borderColor: 'purple',
          fill: false
        }]
      }
    });

    // Export chart as image
    function exportChart(chartId) {
      const chart = document.getElementById(chartId);
      const link = document.createElement('a');
      link.href = chart.toDataURL();
      link.download = `${chartId}.png`;
      link.click();
    }