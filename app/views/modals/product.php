<div class="modal fade" id="addProduct" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title font-bold text-2xl">ADD NEW PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="post" action="<?=site_url('create'); ?>" enctype="multipart/form-data" style="background-color:transparent; border:0;">

          <!-- Product Name -->
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <div class="input-group">
              <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" required>
              <span class="input-group-text"><i class="fas fa-tag"></i></span>
            </div>
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label class="form-label">Category</label>
            <div class="input-group">
              <select name="category" id="category" class="form-select" required>
                <option value="" disabled selected>Select category</option>
                <option value="Keyboard">Keyboard</option>
                <option value="Mouse">Mouse</option>
                <option value="Controller">Controller</option>
                <option value="Speaker">Speaker</option>
                <option value="Mousepad"></option>
                <option value="Headphone"></option>
              </select>
              <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
            </div>
          </div>

          <!-- Unit Price -->
          <div class="mb-3">
            <label class="form-label">Unit Price (₱)</label>
            <div class="input-group">
              <input type="number" name="unit_price" id="unit_price" class="form-control" step="0.01" placeholder="Enter unit price" required>
              <span class="input-group-text"><i class="fas fa-peso-sign"></i></span>
            </div>
          </div>

        <div class="form-group">
            <label for="product_id">Barcode</label>
            <input type="text" name="product_id" id="product_id" autofocus autocomplete="off" class="form-control" oninput="this.form.submit()">
        </div>
        </form>
      </div>
    </div>
  </div>
</div>