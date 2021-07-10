<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <input wire:model.debounce.500ms="search" class="form-control" type="text"
                           placeholder="Enter name...">
                </div>
                <div class="d-flex justify-content-end col-6">
                    <a wire:click.prevent="create" href="#" class="btn btn-primary">Add new product</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="fw-bold">{{$loop->iteration}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{Str::limit($product->description,20,'...')}}</td>
                        <td>${{$product->price}}</td>
                        <td class="text-center">
                            <a href="#"
                               wire:click.prevent="edit('{{ Hashids::connection('product')->encode($product->id) }}')"
                               class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td class="text-center">
                            <button
                                wire:click.prevent="$emit('areYouSure','{{ Hashids::connection('product')->encode($product->id) }}')"
                                type="button" class="btn btn-danger btn-sm">Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-danger text-center">Product not found!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
    <div class="modal" tabindex="-1" @if ($showModal) style="display:block" @endif>
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $productID ? 'Edit Product' : 'Add New Product' }}</h5>
                        <button wire:click="close" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" wire:model.lazy="product.name" class="form-control" id="nameInput">
                            @error('product.name') <span class="fw-bold text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Description</label>
                            <input type="text" wire:model.lazy="product.description" class="form-control"
                                   id="descriptionInput">
                            @error('product.description') <span
                                class="fw-bold text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="priceInput" class="form-label">Price</label>
                            <input type="number" wire:model.lazy="product.price" class="form-control" id="priceInput">
                            @error('product.price') <span class="fw-bold text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary">{{ $productID ? 'Save Changes' : 'Save' }}</button>
                        <button wire:click="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        /*
        Livewire.on('validation-errors', param => {
            console.log(param);
        });
        */
        Livewire.on('productNotFound', function () {
            alertify.error('Product not found!');
        });
        Livewire.on('productSaved', function () {
            alertify.success('Product has been added!');
        });
        Livewire.on('productUpdated', function () {
            alertify.success('Product has been updated!');
        });
        Livewire.on('productDeleted', function () {
            alertify.success('Product has been deleted!');
        });
        Livewire.on('areYouSure', productID => {
            alertify.confirm("You are about to delete a product!", "Are You Sure?", function () {
                    Livewire.emit('deleteProduct', productID);
                },
                function () {
                    alertify.error('Cancel');
                });
        })
    </script>
@endpush


