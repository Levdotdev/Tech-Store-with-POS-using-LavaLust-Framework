<div class="modal fade" id="productScanModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-bold text-2xl">SCAN PRODUCT BARCODE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="post" action="process_barcode.php" enctype="multipart/form-data" style="background-color:transparent; border:0;">
          
          <!-- Hidden ID Field -->
          <input type="hidden" name="product_id" id="product_id">

          <!-- Barcode Scan Input -->
          <div class="form-group mb-3">
            <label for="barcodeInput" class="form-label">Scan Product Barcode:</label>
            <div class="input-group">
              <input type="text" name="barcodeInput" id="barcodeInput" 
                     class="form-control" 
                     placeholder="Scan barcode here..." 
                     autofocus autocomplete="off"
                     oninput="handleBarcodeScan(this)">
              <span class="input-group-text">
                <i class="fas fa-barcode"></i>
              </span>
            </div>
          </div>

          <!-- Optional: Display scanned product name -->
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" id="productName" class="form-control" readonly placeholder="Product will appear here">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Example function to auto-submit when barcode is detected
  function handleBarcodeScan(input) {
    const barcode = input.value.trim();
    if (barcode.length > 0) {
      document.getElementById('product_id').value = barcode;
      input.form.submit(); // Automatically submits form
    }
  }
</script>
