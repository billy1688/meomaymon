import * as bootstrap from 'bootstrap';
import Alpine from 'alpinejs';

window.bootstrap = bootstrap;
window.Alpine = Alpine;
Alpine.start();

// ===== Modal xác nhận xoá dùng chung (Azinalogi UI Standard v1) =====
// Form xoá gắn data-az-confirm-delete sẽ mở modal #az-confirm-delete-modal
// thay cho window.confirm(). Bấm nút "Xoá" đỏ trong modal mới gửi form thật.
let pendingDeleteForm = null;

document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-az-confirm-delete]');
    if (!form || form.dataset.confirmed === '1') {
        return;
    }

    const modalElement = document.getElementById('az-confirm-delete-modal');
    if (!modalElement) {
        return; // Trang không có modal dùng chung thì giữ hành vi submit thường.
    }

    event.preventDefault();
    pendingDeleteForm = form;
    bootstrap.Modal.getOrCreateInstance(modalElement).show();
});

document.addEventListener('click', (event) => {
    const confirmButton = event.target.closest('[data-az-confirm-delete-yes]');
    if (!confirmButton || !pendingDeleteForm) {
        return;
    }

    const form = pendingDeleteForm;
    pendingDeleteForm = null;
    form.dataset.confirmed = '1';
    form.submit();
});

// ===== Modal xác nhận dùng chung cho thao tác hệ trọng (không phải xoá) =====
// Form gắn data-az-confirm sẽ mở modal #az-confirm-modal thay cho
// window.confirm(). Tiêu đề / lời nhắn / nhãn nút đọc từ chính form:
// data-az-confirm-title, data-az-confirm-message, data-az-confirm-button,
// data-az-confirm-variant (class màu của nút xác nhận, mặc định btn-primary).
let pendingConfirmForm = null;

document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-az-confirm]');
    if (!form || form.dataset.confirmed === '1') {
        return;
    }

    const modalElement = document.getElementById('az-confirm-modal');
    if (!modalElement) {
        return; // Trang không có modal dùng chung thì giữ hành vi submit thường.
    }

    event.preventDefault();
    pendingConfirmForm = form;

    const titleSlot = modalElement.querySelector('[data-az-confirm-title-slot]');
    if (titleSlot && form.dataset.azConfirmTitle) {
        titleSlot.textContent = form.dataset.azConfirmTitle;
    }

    const messageSlot = modalElement.querySelector('[data-az-confirm-message-slot]');
    if (messageSlot && form.dataset.azConfirmMessage) {
        messageSlot.textContent = form.dataset.azConfirmMessage;
    }

    const yesButton = modalElement.querySelector('[data-az-confirm-yes]');
    if (yesButton) {
        yesButton.textContent = form.dataset.azConfirmButton || 'Đồng ý';
        yesButton.className = 'btn ' + (form.dataset.azConfirmVariant || 'btn-primary');
    }

    bootstrap.Modal.getOrCreateInstance(modalElement).show();
});

document.addEventListener('click', (event) => {
    const confirmButton = event.target.closest('[data-az-confirm-yes]');
    if (!confirmButton || !pendingConfirmForm) {
        return;
    }

    const form = pendingConfirmForm;
    pendingConfirmForm = null;
    form.dataset.confirmed = '1';
    form.submit();
});
