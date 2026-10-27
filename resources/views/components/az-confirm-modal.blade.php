{{-- Modal xác nhận dùng chung cho thao tác hệ trọng không phải xoá
     (Azinalogi UI Standard v1). Đặt một lần ở cuối trang có form gắn
     data-az-confirm; tiêu đề / lời nhắn / nhãn nút lấy từ các thuộc
     tính data-az-confirm-title / -message / -button / -variant của
     chính form đó. --}}
<div class="modal fade" id="az-confirm-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-az-confirm-title-slot>Xác nhận</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body" data-az-confirm-message-slot>
                Bạn chắc chắn muốn thực hiện thao tác này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" data-az-confirm-yes data-bs-dismiss="modal">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
