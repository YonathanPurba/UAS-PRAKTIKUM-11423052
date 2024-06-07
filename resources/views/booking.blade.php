<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #f8f9fa;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content {
            padding-top: 100px;
        }

        .table {
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .modal-content {
            border-radius: 10px;
        }

        .btn-info {
            background-color: #007bff;
            border: none;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    @include('navbar')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lapangan</th>
                                    <th>Harga Lapangan</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $lok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lok->namaLapangan }}</td>
                                        <td>{{ $lok->hargaLapangan }}</td>
                                        <td>{{ $lok->lokasi->namaLokasi }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="openBookingModal('{{ $lok->id }}', '{{ $lok->namaLapangan }}')">Pesan
                                                Lapangan</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Pesan Lapangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pemesan" class="form-label">Nama Pemesan:</label>
                            <input type="text" class="form-control" id="nama_pemesan" name="namaPemesan" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP:</label>
                            <input type="text" class="form-control" id="no_hp" name="noHp" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi:</label>
                            <select class="form-select" id="lokasi" name="lokasi">
                                @foreach ($lokasi as $lok)
                                    <option value="{{ $lok->id }}">{{ $lok->namaLokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lapangan" class="form-label">Lapangan:</label>
                            <select class="form-select" id="lapangan" name="lapangan">
                                @foreach ($lapangan as $lok)
                                    <option value="{{ $lok->id }}">{{ $lok->namaLapangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai:</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktuMulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai:</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktuSelesai" required onchange="calculatePrice()">
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga:</label>
                            <input type="text" class="form-control" id="total_harga" name="hargaTotal" readonly>
                        </div>
                        <input type="hidden" id="lapangan_id" name="lapangan_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitBooking()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="assets/js/main.js"></script>

    <!-- Custom JS -->
    <script>
        const pricePerHour = 55000;

        function openBookingModal(lapanganId, namaLapangan) {
            @if (Auth::check())
                $('#lapangan_id').val(lapanganId);
                $('#bookingModalLabel').text('Pesan Lapangan: ' + namaLapangan);
                $('#bookingModal').modal('show');
            @else
                window.location.href = "/user/login";
            @endif
        }

        function calculatePrice() {
            const startTime = new Date($('#waktu_mulai').val());
            const endTime = new Date($('#waktu_selesai').val());
            const durationInHours = (endTime - startTime) / (1000 * 60 * 60);

            if (durationInHours > 0) {
                const totalPrice = durationInHours * pricePerHour;
                $('#total_harga').val(totalPrice); // Use numeric value
            } else {
                $('#total_harga').val('');
            }
        }

        function submitBooking() {
            $('#bookingForm').submit();
        }
    </script>
</body>

</html>