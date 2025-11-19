<div id="modal-add-product" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="modal-header"><h2>Add New Product</h2><button class="modal-close-btn" onclick="closeModal('modal-add-product')">&times;</button></div>
            <div class="modal-body">
                <form id="form-add-product">
                    <div class="form-group">
                        <label>Product Name <span style="color:var(--clr-danger)">*</span></label>
                        <div class="input-group"><i class="fas fa-tag"></i><input type="text" required placeholder="e.g. Wireless Mouse"></div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Category</label>
                            <div class="input-group"><i class="fas fa-layer-group"></i><input type="text" placeholder="Electronics"></div>
                        </div>
                        <div class="form-group">
                            <label>Unit Price (₱)</label>
                            <div class="input-group"><i class="fas fa-peso-sign"></i><input type="number" required placeholder="0.00"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Barcode (Optional)</label>
                        <div class="input-group"><i class="fas fa-barcode"></i><input type="text" placeholder="Scan or type"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="action-btn modal-cancel-btn" onclick="closeModal('modal-add-product')">Cancel</button>
                <button class="action-btn primary-btn" onclick="handleFormSubmit('modal-add-product', 'Product added successfully!')">Save Product</button>
            </div>
        </div>
    </div>