<div id="modal-import-csv" class="modal-overlay hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Import Inventory CSV</h2>
            <button class="modal-close-btn" onclick="closeModal('modal-import-csv')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="import-csv-form" action="<?= site_url('inventory/update-csv'); ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="csv_file" accept=".csv" required>
                <p>Only product IDs that exist in the system will be updated.</p>
                <div class="modal-footer">
                    <button type="button" class="action-btn modal-cancel-btn" onclick="closeModal('modal-import-csv')">Cancel</button>
                    <button type="submit" class="action-btn primary-btn">Import CSV</button>
                </div>
            </form>
        </div>
    </div>
</div>
