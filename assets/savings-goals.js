function showScreen(id) {
      document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');
    }

    function addGoal() {
      const name = document.getElementById('newGoalName').value;
      const target = +document.getElementById('newGoalTarget').value;
      const saved = +document.getElementById('newGoalSaved').value;
      const due = document.getElementById('newGoalDate').value;

      if (!name || !target || isNaN(saved)) return;

      const percent = Math.min(100, (saved / target * 100).toFixed(1));
      const goalDiv = document.createElement('div');
      goalDiv.className = 'goal-card';
      goalDiv.innerHTML = `
        <button class="delete-btn" onclick="this.parentElement.remove()">X</button>
        <strong>${name}</strong><br>
        Saved: $${saved} / $${target} (${percent}%)<br>
        Due: ${due}<br>
        <div class="goal-bar"><div class="goal-bar-fill" style="width:${percent}%"></div></div>
      `;
      document.getElementById('goalList').appendChild(goalDiv);

      document.getElementById('newGoalName').value = '';
      document.getElementById('newGoalTarget').value = '';
      document.getElementById('newGoalSaved').value = '';
      document.getElementById('newGoalDate').value = '';
    }

    function estimateGoalDate() {
      const target = +document.getElementById('planTarget').value;
      const amount = +document.getElementById('planAmount').value;
      const freq = +document.getElementById('planFreq').value;

      if (!target || !amount || !freq) return;
      const totalDays = Math.ceil((target / amount) * freq);
      const endDate = new Date();
      endDate.setDate(endDate.getDate() + totalDays);

      document.getElementById('planResult').textContent =
        `Estimated goal completion date: ${endDate.toDateString()}`;
    }

    function addMilestone() {
      const text = document.getElementById('milestoneText').value;
      const date = document.getElementById('milestoneDate').value;
      if (!text || !date) return;

      const div = document.createElement('div');
      div.className = 'milestone';
      div.innerHTML = `
        <button class="delete-btn" onclick="this.parentElement.remove()">X</button>
        <strong>${text}</strong><br>
        🎉 Achieved on ${date}
      `;
      document.getElementById('milestoneList').appendChild(div);

      document.getElementById('milestoneText').value = '';
      document.getElementById('milestoneDate').value = '';
    }

    // Hamburger toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const icon = hamburger.querySelector('i');

    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-times');
    });