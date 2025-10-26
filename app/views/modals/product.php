<div id="toast-container"></div>
<div class="modal">
  <audio id="notifSound" src="<?= base_url();?>public/resources/notif.mp3" preload="auto"></audio>

  <!-- Add Product Card -->
  <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl overflow-hidden transform hover:shadow-2xl transition duration-300">
    <!-- Header -->
    <div class="p-5 sm:p-6 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
      <div class="flex items-center">
        <div class="p-2.5 bg-primary-slate text-white rounded-full mr-3 shadow-md">
          <i class="fas fa-boxes text-lg"></i>
        </div>
        <div>
          <h2 class="text-lg sm:text-xl font-extrabold text-primary-slate tracking-tight uppercase">Add New Product</h2>
          <p class="text-sm text-gray-500 mt-0.5">Product details & unique identification.</p>
        </div>
      </div>
      <button onclick="window.location.href='index.html'" class="close-btn text-2xl font-bold focus:outline-none">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-5 sm:p-6">
      <div id="modal-alert-container" class="mb-3"></div>

      <form id="addProductForm">
        <!-- Product Name -->
        <div class="mb-4">
          <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-2">
            Product Name <span class="text-danger-red text-lg">*</span>
          </label>
          <div class="input-wrapper">
            <input type="text" id="product_name" name="product_name" class="form-input-field w-full px-4 py-2.5 text-gray-800 focus:ring-1 focus:ring-primary-slate" placeholder="e.g., Ergonomic Wireless Mouse" required>
            <i class="fas fa-tag input-icon"></i>
          </div>
        </div>

        <!-- Category -->
        <div class="mb-4">
          <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
            Category <span class="text-danger-red text-lg">*</span>
          </label>
          <div class="input-wrapper">
            <select id="category" name="category" class="form-select-field w-full px-4 py-2.5 text-gray-800 focus:ring-1 focus:ring-primary-slate appearance-none" required>
              <option value="" disabled selected>Select a product category</option>
              <option>Keyboard</option>
              <option>Mouse</option>
              <option>Controller</option>
              <option>Speaker</option>
              <option>Mousepad</option>
              <option>Headphone</option>
            </select>
            <i class="fas fa-layer-group input-icon"></i>
            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none z-10"></i>
          </div>
        </div>

        <!-- Unit Price -->
        <div class="mb-4">
          <label for="unit_price" class="block text-sm font-semibold text-gray-700 mb-2">
            Unit Price (PHP) <span class="text-danger-red text-lg">*</span>
          </label>
          <div class="input-wrapper">
            <input type="number" id="unit_price" name="unit_price" step="0.01" min="0.01" class="form-input-field w-full px-4 py-2.5 text-gray-800 focus:ring-1 focus:ring-primary-slate" placeholder="0.00" required>
            <i class="fas fa-peso-sign input-icon"></i>
          </div>
        </div>

        <!-- Barcode / SKU -->
        <div class="mb-4">
          <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">Barcode / SKU (Optional)</label>
          <div class="input-wrapper">
            <input type="text" id="product_id" name="product_id" class="form-input-field w-full px-4 py-2.5 text-gray-800 focus:ring-1 focus:ring-primary-slate" placeholder="Scan or enter unique product code">
            <i class="fas fa-barcode input-icon"></i>
          </div>
          <p class="text-xs text-gray-500 mt-1 ml-1">If left blank, a system-generated ID will be assigned.</p>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="p-5 sm:p-6 flex flex-col sm:flex-row justify-end gap-3 border-t border-gray-100 bg-gray-50">
      <button type="button" onclick="window.location.href='index.html'" class="font-semibold text-primary-slate hover:bg-gray-200 px-4 py-2.5 rounded-lg transition duration-150 ease-in-out">
        <i class="fas fa-times-circle mr-2"></i> Cancel
      </button>

      <button type="submit" form="addProductForm" id="saveProductBtn" class="bg-primary-slate text-white font-semibold hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 px-4 py-2.5 rounded-lg transition duration-150 ease-in-out shadow-md hover:shadow-lg">
        <i class="fas fa-save mr-2"></i> Save Product
      </button>
    </div>
  </div>
</div>