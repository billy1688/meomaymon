{{-- Modal xác nhận xoá dùng chung — Azinalogi UI Standard v1.
     Đặt một lần ở cuối trang có form xoá gắn data-az-confirm-delete. --}}
<div class="modal fade" id="az-confirm-delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xoá</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                Bạn chắc chắn muốn xoá mục này? Thao tác xoá không khôi phục lại được.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" data-az-confirm-delete-yes data-bs-dismiss="modal">Xoá</button>
            </div>
        </div>
    </div>
</div>
