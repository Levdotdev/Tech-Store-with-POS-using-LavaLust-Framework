
    <div id="modal-delete-confirm" class="modal-overlay hidden">
        <form id="delete-form" method="post" action="<?=site_url('applicant/reject'); ?>">
        <div class="modal-content">
            <div class="modal-header"><h2>Reject Applicant</h2><button type="button" class="modal-close-btn" onclick="closeModal('modal-delete-confirm')">&times;</button></div>
            <div class="modal-body"><p style="color:var(--clr-danger)"><strong>Warning:</strong> Are you sure you want to decline access to this user?</p></div>
            <div class="modal-footer">
                <button type="button" class="action-btn modal-cancel-btn" onclick="closeModal('modal-delete-confirm')">Cancel</button>
                <button class="action-btn delete-btn" onclick="handleFormSubmit('modal-delete-confirm', 'Applicant deleted.', 'error')">Delete</button>
            </div>
        </div>
        </form>
    </div>