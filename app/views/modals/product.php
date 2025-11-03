<!-- Add Product Modal (hidden by default) -->
<div id="addProductOverlay" aria-hidden="true" class="">
  <div class="add-product-card" role="dialog" aria-modal="true" aria-labelledby="ap-title">
    <!-- Header -->
    <div class="ap-header">
      <div class="left">
        <div class="ap-badge"><i class="fas fa-boxes"></i></div>
        <div class="ap-title">
          <h2 id="ap-title">Add New Product</h2>
          <p>Product details & unique identification.</p>
        </div>
      </div>
      <div>
        <button class="ap-close" aria-label="Close" onclick="closeAddProductModal()">&times;</button>
      </div>
    </div>

    <!-- Body -->
    <div class="ap-body">
      <div id="modal-alert-container" aria-live="polite"></div>

      <form id="addProductForm" method="post" action="<?=site_url('create'); ?>" autocomplete="off">
        <div class="form-row">
          <label for="product_name">Product Name</label>
          <div class="input-wrapper">
            <input id="product_name" name="product_name" class="form-input-field" placeholder="Enter product name" required>
            <i class="fas fa-tag input-icon" aria-hidden="true"></i>
          </div>
        </div>

        <div class="form-row">
          <label for="category">Category</label>
          <div class="input-wrapper">
            <select id="category" name="category" class="form-select-field" required>
              <option value="" disabled selected>Select a product category</option>
              <option>Keyboard</option>
              <option>Mouse</option>
              <option>Controller</option>
              <option>Speaker</option>
              <option>Mousepad</option>
              <option>Headphone</option>
            </select>
            <i class="fas fa-layer-group input-icon" aria-hidden="true"></i>
            <i class="fas fa-chevron-down chev" aria-hidden="true"></i>
          </div>
        </div>

        <div class="form-row">
          <label for="unit_price">Unit Price (PHP)</label>
          <div class="input-wrapper">
            <input id="unit_price" name="unit_price" type="number" step="0.01" min="0.01" class="form-input-field" placeholder="0.00" required>
            <i class="fas fa-peso-sign input-icon" aria-hidden="true"></i>
          </div>
        </div>

        <div class="form-row">
          <label for="product_id">Barcode</label>
          <div class="input-wrapper">
            <input id="product_id" name="product_id" class="form-input-field" placeholder="Scan unique product code" oninput="this.form.submit()">
            <i class="fas fa-barcode input-icon" aria-hidden="true"></i>
          </div>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="ap-footer">
      <button type="button" class="btn ghost" onclick="closeAddProductModal()">
        <i class="fas fa-times-circle" style="margin-right:8px"></i> Cancel
      </button>
      <button type="submit" form="addProductForm" id="saveProductBtn" class="btn primary">
        <i class="fas fa-save" style="margin-right:10px"></i> Save Product
      </button>
    </div>
  </div>
</div>

<!-- Toast container + audio (use your base_url resource) -->
<div id="toast-container" aria-live="polite"></div>
<audio id="notifSound" src="<?= base_url();?>public/resources/notif.mp3" preload="auto"></audio>
