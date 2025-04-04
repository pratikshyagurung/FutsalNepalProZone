@extends('futsal_owner.inc.main')

@section('container')

@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <h1>All Bookings</h1>
    <p>List of all bookings will be displayed here.</p>
    <div class="table-container">    
        <table class="table table-secondary table-hover table-bordered table-sm table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Event ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total Price</th>
                    {{-- <th scope="col">Total Hour</th> --}}
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventbookings as $booking)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $booking->User_ID }}</td>
                        <td>{{ $booking->Event_ID }}</td>
                        <td>{{ $booking->Date }}</td>
                        <td>{{ $booking->TotalPrice }}</td>
                        <td>{{ $booking->Status }}</td>
                       
                        <td>
    
                            <!-- Delete Button to Open Modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $booking->id }}">
                                Delete
                            </button>
    
                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-center">
                                        <!-- Header -->
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title fw-bold">⚠ Booking Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
    
                                        <!-- Body -->
                                        <div class="modal-body">
                                            <p class="fs-5">Are you sure you want to delete this booking? </p>
                                        </div>
    
                                        <!-- Footer -->
                                        {{-- <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary px-4"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4 fw-bold">Delete</button>
                                            </form>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
