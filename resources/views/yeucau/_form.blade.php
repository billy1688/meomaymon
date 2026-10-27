{{-- Form yêu cầu việc dùng chung cho tạo mới / sửa. Biến: $jobRequest --}}
<div class="mb-3">
    <label for="name" class="form-label">Họ tên người gửi *</label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $jobRequest->name) }}" required
           placeholder="Ví dụ: Chị Lan — shop quần áo">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="contact" class="form-label">Cách liên hệ *</label>
    <input type="text" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror"
           value="{{ old('contact', $jobRequest->contact) }}" required
           placeholder="Số điện thoại / Zalo / email của khách">
    @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="content" class="form-label">Nội dung việc *</label>
    <textarea id="content" name="content" rows="5"
              class="form-control @error('content') is-invalid @enderror" required
              placeholder="Khách cần làm gì? Càng cụ thể càng dễ báo giá.">{{ old('content', $jobRequest->content) }}</textarea>
    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Trạng thái *</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
        @foreach(\App\Models\JobRequest::STATUSES as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $jobRequest->status) === $value)>{{ $label }}</option>
        @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
