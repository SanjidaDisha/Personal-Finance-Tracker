function showScreen(id) {
      document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(id).classList.add('active');
    }

    document.getElementById("bankForm").addEventListener("submit", function(e) {
      e.preventDefault();
      alert("Bank account connected successfully!");
      this.reset();
    });

    function resolveError() {
      const bank = document.getElementById("bankFix").value;
      alert(`Reconnected to ${bank} successfully!`);
      document.getElementById("newPassword").value = '';
    }