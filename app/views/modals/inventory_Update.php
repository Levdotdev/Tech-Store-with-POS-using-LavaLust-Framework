<div id="modal-record-stock" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="modal-header"><h2>Record Stock Entry</h2><button class="modal-close-btn" onclick="closeModal('modal-record-stock')">&times;</button></div>
            <div class="modal-body">
                <div class="form-group"><label>Product</label><div class="input-group"><i class="fas fa-box"></i><input type="text" placeholder="Scan Barcode or Search"></div></div>
                <div class="form-group"><label>Quantity Added</label><div class="input-group"><input type="number" placeholder="0"></div></div>
            </div>
            <div class="modal-footer">
                <button class="action-btn modal-cancel-btn" onclick="closeModal('modal-record-stock')">Cancel</button>
                <button class="action-btn primary-btn" onclick="handleFormSubmit('modal-record-stock', 'Stock updated successfully!')">Add Stock</button>
            </div>
        </div>
    </div>  