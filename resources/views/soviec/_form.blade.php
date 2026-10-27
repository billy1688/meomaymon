{{-- Form dòng sổ việc ngoài dùng chung cho tạo mới / sửa. Biến: $entry --}}
<div class="mb-3">
    <label for="work_date" class="form-label">Ngày *</label>
    <input type="date" id="work_date" name="work_date" class="form-control @error('work_date') is-invalid @enderror"
           value="{{ old('work_date', $entry->work_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
    @error('work_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">Tên việc *</label>
    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $entry->title) }}" required
           placeholder="Ví dụ: Làm trang web giới thiệu cho shop A">
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="client" class="form-label">Khách</label>
    <input type="text" id="client" name="client" class="form-control @error('client') is-invalid @enderror"
           value="{{ old('client', $entry->client) }}"
           placeholder="Tên khách / shop (chỉ ghi trong backend, không hiện công khai)">
    @error('client') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Số tiền (đồng) *</label>
    <input type="number" id="amount" name="amount" min="0" step="1" class="form-control @error('amount') is-invalid @enderror"
           value="{{ old('amount', $entry->amount) }}" required
           placeholder="Ví dụ: 1900000">
    <div class="form-text">Ghi số nguyên đồng, không dấu chấm/phẩy. Chỉ tính vào tổng thu khi trạng thái là Đã thu.</div>
    @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Trạng thái *</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
        @foreach(\App\Models\WorkLedgerEntry::STATUSES as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $entry->status) === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <div class="form-text">Đã thu = tiền đã thật về tay, dòng này sẽ hiện lên Sổ công khai ở trang chủ.</div>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="note" class="form-label">Ghi chú</label>
    <textarea id="note" name="note" rows="3"
              class="form-control @error('note') is-invalid @enderror"
              placeholder="Ghi chú thêm về việc này (gói nào, đã giao tới đâu...)">{{ old('note', $entry->note) }}</textarea>
    @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
