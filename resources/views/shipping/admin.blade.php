@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="margin-top: 38px;">Data Pengiriman (Admin)</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Pengirim</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($shippings as $i => $shipping)
                    <tr id="row-{{ $i }}">
                        <td class="py-3">{{ $i + 1 }}</td>
                        <td class="py-3">{{ $shipping->name }}</td>
                        <td class="py-3">{{ $shipping->address }}, {{ $shipping->city }}, {{ $shipping->region }}</td>
                        <td class="py-3">
                            <span class="badge status-text 
                                @if($shipping->status == 'Dikirim') bg-primary 
                                @elseif($shipping->status == 'Sampai') bg-success 
                                @else bg-warning text-dark @endif" 
                                id="status-{{ $i }}">
                                {{ strtoupper($shipping->status) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showDetailModal(
                                    '{{ $shipping->name }}',
                                    '{{ $shipping->address }}, {{ $shipping->city }}, {{ $shipping->region }}',
                                    '{{ $i }}',
                                    '{{ $shipping->id }}'
                                )">
                                Konfirmasi
                            </button>
                        </td>
                    </tr>
                @endforeach
                @if(count($shippings) == 0)
                    <tr>
                        <td class="py-3" colspan="5" class="text-center">Belum ada data pengiriman.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Pengiriman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b>Nama:</b> <span id="modalName"></span></p>
        <p><b>Alamat:</b> <span id="modalAddress"></span></p>
        <p><b>Status:</b> <span id="modalStatus"></span></p>
        <div class="mt-3">
          <label><b>Pilih Status Pengiriman:</b></label>
          <select id="selectStatus" class="form-select">
            <option value="Proses Pengiriman">Proses Pengiriman</option>
            <option value="Dikirim">Dikirim</option>
            <option value="Sampai">Sampai</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveStatusBtn" data-row="" data-id="">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

{{-- Script Section --}}
<script>
    function showDetailModal(name, address, rowId, shippingId) {
        document.getElementById('modalName').textContent = name;
        document.getElementById('modalAddress').textContent = address;
        let badge = document.getElementById('status-' + rowId);
        document.getElementById('modalStatus').textContent = badge.innerText.trim();
        document.getElementById('selectStatus').value = badge.innerText.trim();
        document.getElementById('saveStatusBtn').setAttribute('data-row', rowId);
        document.getElementById('saveStatusBtn').setAttribute('data-id', shippingId);
        var myModal = new bootstrap.Modal(document.getElementById('detailModal'));
        myModal.show();
    }

    document.getElementById('saveStatusBtn').onclick = function() {
        let rowId = this.getAttribute('data-row');
        let shippingId = this.getAttribute('data-id');
        let selectedStatus = document.getElementById('selectStatus').value;
        // AJAX update ke backend
        fetch('{{ route('shipping.updateStatusAjax') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: shippingId, status: selectedStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let badge = document.getElementById('status-' + rowId);
                badge.innerText = selectedStatus.toUpperCase();
                badge.className = 'badge status-text';
                if(selectedStatus === "Dikirim") badge.classList.add('bg-primary');
                else if(selectedStatus === "Sampai") badge.classList.add('bg-success');
                else badge.classList.add('bg-warning', 'text-dark');
            }
            // Tutup modal
            var modalEl = document.getElementById('detailModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        });
    }
</script>
@endsection
