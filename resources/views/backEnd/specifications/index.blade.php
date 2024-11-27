@extends('backEnd.layouts.master')
@section('title')
    Specifications
@endsection
@section('page-title')
    Specifications
@endsection
@section('body')
<body>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Specifications</h4>
                <table class="table" id="specificationsTable">
                    <thead>
                        <tr>
                            <th>Specification</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="specificationsList">
                        @foreach($specifications as $specification)
                            <tr data-id="{{ $specification->id }}" class="specification-row">
                                <td class="specification-item">
                                    <span class="specification-label">{{ $specification->item }}</span>
                                    <input type="text" class="form-control specification-input" value="{{ $specification->item }}" style="display:none;">
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-item">Edit</button>
                                    <button class="btn btn-success btn-sm save-item" style="display:none;">Save</button>
                                    <button class="btn btn-danger btn-sm delete-item">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary" id="addSpecificationBtn">Add Specification</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('build/js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Add new specification row
    $('#addSpecificationBtn').click(function () {
        const newRow = `
            <tr data-id="new">
                <td class="specification-item">
                    <input type="text" class="form-control specification-input" value="" placeholder="Enter specification">
                </td>
                <td>
                    <button class="btn btn-success btn-sm save-item">Save</button>
                    <button class="btn btn-danger btn-sm delete-item">Delete</button>
                </td>
            </tr>
        `;
        $('#specificationsList').append(newRow);
    });

    // Edit specification
    $(document).on('click', '.edit-item', function () {
        const row = $(this).closest('tr');
        row.find('.specification-label').hide();
        row.find('.specification-input').show();
        row.find('.save-item').show();
        row.find('.edit-item').hide();
    });

    // Save updated specification
    $(document).on('click', '.save-item', function () {
        const row = $(this).closest('tr');
        const id = row.data('id');
        const item = row.find('.specification-input').val();

        if (item) {
            saveSpecification(id, item, row);
        } else {
            showNotification('Specification cannot be empty.', 'error');
        }
    });

    // Save or update specification in the database
    function saveSpecification(id, item, row) {
        $.ajax({
            url: id === 'new' ? "{{ route('specifications.store') }}" : "{{ route('specifications.update') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                item: item
            },
            success: function (response) {
                if (id === 'new') {
                    row.data('id', response.id);  // Store the ID for the new specification
                    // Add the newly saved item to the table dynamically
                    row.find('.specification-input').hide();
                    row.find('.specification-label').text(item).show();
                    row.find('.save-item').hide();
                    row.find('.edit-item').show();

                    // Reload the page after saving the new specification
                    window.location.reload();  // Reload to reflect the new specification
                    // Display success notification
                    showNotification('Specification saved successfully!', 'success');
                } else {
                    // Update existing item
                    row.find('.specification-input').hide();
                    row.find('.specification-label').text(item).show();
                    row.find('.save-item').hide();
                    row.find('.edit-item').show();

                    // Display success notification
                    showNotification('Specification updated successfully!', 'success');
                }
            },
            error: function () {
                showNotification('Error saving specification.', 'error');
            }
        });
    }

    // Delete specification via AJAX
    $(document).on('click', '.delete-item', function () {
        const row = $(this).closest('tr');
        const id = row.data('id');

        if (id === 'new') {
            // Directly remove if it's a new specification without a database entry
            row.fadeOut(500, function () {
                $(this).remove();
            });
            showNotification('Specification deleted successfully!', 'success');
        } else {
            // Proceed with AJAX request for existing specification
            $.ajax({
                url: "{{ route('specifications.destroy') }}",
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function () {
                    row.fadeOut(500, function () {
                        $(this).remove();  // Remove row after animation
                    });
                    showNotification('Specification deleted successfully!', 'success');
                },
                error: function () {
                    showNotification('Error deleting specification.', 'error');
                }
            });
        }
    });

    // Show notification with effect
    function showNotification(message, type) {
        const notification = $('<div class="notification ' + type + '">' + message + '</div>');
        $('body').append(notification);
        notification.fadeIn(300).delay(2000).fadeOut(300, function () {
            $(this).remove();
        });
    }
});
</script>

<style>
    .notification {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        display: none;
    }

    .notification.success {
        background-color: green;
    }

    .notification.error {
        background-color: red;
    }
</style>
@endsection
