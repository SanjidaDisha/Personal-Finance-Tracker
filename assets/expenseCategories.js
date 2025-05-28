let categoryTable;

$(document).ready(function() {
  categoryTable = $('#categoryTable').DataTable({
    ajax: {
      url: '../controller/getCategories.php',
      dataSrc: function(json) {
        if (!json.success) {
          alert(json.message || 'Failed to load categories');
          return [];
        }
        return json.data.map(cat => {
          const spent = parseFloat(cat.spent) || 0;
          const limit = parseFloat(cat.monthly_limit);
          const progressPercent = Math.min((spent / limit) * 100, 100).toFixed(2);

          let progressColor = '#00aa00'; // Green
          if (spent >= limit) progressColor = '#ff4444'; // Red
          else if (spent >= limit * 0.8) progressColor = '#ffaa00'; // Orange

          const progressBar = `
            <div style="background:#eee; border-radius:4px; width:100%; height:15px;">
              <div style="width:${progressPercent}%; background-color:${progressColor}; height:100%; border-radius:4px;"></div>
            </div>
          `;

          return [
            cat.name,
            limit.toFixed(2),
            spent.toFixed(2),
            progressBar
          ];
        });
      }
    },
    columns: [
      { title: "Name" },
      { title: "Monthly Limit ($)" },
      { title: "Spent ($)" },
      { title: "Progress", orderable: false }
    ]
  });
});





function saveCategory() {
  const categoryName = document.getElementById("categoryName").value;
  const monthlyLimit = document.getElementById("monthlyLimit").value;


  const formData = new FormData();
  formData.append('action', 'saveCategory');
  formData.append('categoryName', categoryName);
  formData.append('monthlyLimit', monthlyLimit);

  fetch('../controller/expenseCategoriesController.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert(data.message);
          console.log("Json data:" + JSON.stringify(data, null, 2));

          document.getElementById("categoryName").value = '';
          document.getElementById("monthlyLimit").value = '';

      // Reload DataTable
      categoryTable.ajax.reload(null, false); // false to keep paging

      } else {
          alert(data.message);
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert("An error occurred while saving category.");
  });
}

