<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Export Data - FinanceTracker</title>
    <link rel="stylesheet" href="../assets/export.css">
</head>
<body>
    <header>
        <div class="logo">FinanceTracker</div>
        <div class="user">
     <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['email']); ?>!</span>

      <form method="POST" action="../signout.php" style="display:inline;">
        <button type="submit" class="profile-btn">Logout 👤</button>
      </form>
    </div>
    </header>

    <nav class="tabs">
        <button class="active" data-tab="wizard">Export Wizard</button>
        <button data-tab="selector">Format Selector</button>
        <button data-tab="archive">Archive Manager</button>
    </nav>

    <main>
        <section id="wizard" class="tab-content active">
            <div class="card">
                <h2>Export Wizard</h2>

                <?php if (!empty($errors)): ?>
                    <div class="error"><?= implode("<br>", $errors) ?></div>
                <?php elseif ($success): ?>
                    <div class="success"><?= $success ?></div>
                <?php endif; ?>

                <form id="export-form" method="POST" action="../controller/exportController.php">
                    <label for="export-type">Select Export Type</label>
                    <select id="export-type" name="export-type" required>
                        <option value="">Choose an option</option>
                        <option value="csv">CSV</option>
                        <option value="pdf">PDF</option>
                        <option value="qbo">QBO</option>
                    </select>
                    <div class="error" id="type-error">Please select an export type.</div>

                    <label for="backup-schedule">Schedule Automatic Backup</label>
                    <select id="backup-schedule" name="backup-schedule">
                        <option value="none">None</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>

                    <label for="encrypt">Encrypt Export?</label>
                    <select id="encrypt" name="encrypt">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>

                    <button type="submit">Download</button>
                </form>
            </div>
        </section>

        <section id="selector" class="tab-content">
            <div class="card">
                <h2>Format Selector</h2>
                <p>Choose format for export to suit your needs: CSV for spreadsheets, PDF for reports, QBO for QuickBooks.</p>
            </div>
        </section>

        <section id="archive" class="tab-content">
            <div class="card">
                <h2>Archive Manager</h2>
                <div class="file"><strong>export_april.csv.enc</strong> — <a href="#">Download</a> | <a href="#">Delete</a></div>
                <div class="file"><strong>income_backup.pdf</strong> — <a href="#">Download</a> | <a href="#">Delete</a></div>
            </div>
        </section>
    </main>

    <script src="../assets/export.js"></script>
</body>
</html>
