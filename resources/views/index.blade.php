<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
</head>
<body>
    <!--Add Name Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addModalLabel">Add Name</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addForm">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h1>Cache Crud</h1>

            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Name
            </button>
        </div>
    </div>
    <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#addForm').submit(function (e) {
                e.preventDefault();

                var name = $('#name').val();

                $.ajax({
                    url: "{{ route('name.store') }}",
                    type: "POST",
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Name added successfully!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            $('#addModal').modal('hide');
                            $('#name').val('');
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while adding the name.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                    }
                });

            });

        });
    </script>
</body>
</html>
