@extends('pages.mainprofile')

@section('content_profile')
<div class="p-2 mt-4 col-md-9">

    <div class="address-card">
        <div class="d-flex justify-content-between align-items-center">
            <h3>My Addresses</h3>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                <i class="fas fa-plus"></i> Add New Address
            </button>

        </div>
        @foreach ($addresses as $address)
        <div class="p-2 mt-4 col-md-9">
            <h6>
                {{$address->name}}
                <span class="text-muted m-2">{{$address->phone}}</span>
            </h6>
            <p>{{$address->address_detail}}<br>
                {{$address->address}}
            </p>
            <span class="default-label">Default</span>
            <div class="d-flex justify-content-end">
                <a href="#" class="me-3" data-bs-toggle="modal" data-bs-target="#updateAddressModal"
                    onclick="setAddressData('{{$address->id}}', '{{$address->name}}', '{{$address->phone}}', '{{$address->address}}', '{{$address->address_detail}}')">
                    Update
                </a>
                <button class="btn btn-outline-secondary btn-sm">Set as Default</button>
            </div>
        </div>
        @endforeach


    </div>

    <!-- Modal update Address -->
    <!-- Modal -->
    <div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAddressModalLabel">Update Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('address.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="address-id" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="address_detail" class="form-label">Detailed Address</label>
                            <textarea class="form-control" id="address_detail" name="address_detail" rows="2" required></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" id="is_default" name="is_default" class="form-check-input">
                            <label for="is_default" class="form-check-label">Set as Default Address</label>
                        </div>
                        <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add new address form -->
                    <form action="{{route('createAddress')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Detailed Address</label>
                            <textarea class="form-control" id="address_detail" name="address_detail" rows="2" required></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" id="is_default" name="is_default" class="form-check-input">
                            <label for="is_default" class="form-check-label">Set as Default Address</label>
                        </div>
                        <button type="button" class="btn btn-danger m-2" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap CSS -->

    <!-- Bootstrap Bundle JS (includes Popper) -->
</div>
@endsection

@section('footer')
<script>
    function setAddressData(id, name, phone, address, addressDetail) {
        // Set data into modal fields
        document.getElementById('address-id').value = id;
        document.getElementById('name').value = name;
        document.getElementById('phone').value = phone;
        document.getElementById('address').value = address;
        document.getElementById('address_detail').value = addressDetail;
    }
</script>
@endsection