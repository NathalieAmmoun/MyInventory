<div class="container">

    <div class="row mt-5 justify-content-center">
        <div class="col-md-2 offset-md-10 ">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductTypeModal">
                Add Product Type
            </button>
            <div class="modal fade" id="addProductTypeModal" tabindex="-1" role="dialog"
                aria-labelledby="addProductTypeTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductTypeLongTitle">Add Product Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="/dashboard/product-types/add" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="productTypeImage">Upload product type image</label>
                                        <input type="file" class="form-control-file" name="image"
                                            id="productTypeImage">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="productTypeName">Name</label>
                                    <input type="text" class="form-control" id="productTypeName" name="name"
                                        placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="productDescription">Description</label>
                                    <textarea name="description" class="form-control" id="productDescription" rows="3"></textarea>
                                </div>

                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-right mt-5">
        <div class="col-md-4 offset-md-8 ">
            {{ $productTypes->links() }}
        </div>
    </div>
    <div class="row justify-content-right mt-5">

        @if (session('success'))
            <div class="alert  alert-success alert-dismissible fade show" style="margin-top:5px;">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert  alert-danger alert-dismissible fade show" style="margin-top:5px;">
                <strong> {{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="row justify-content-center mt-1">

        <div class="col-md-7">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Count</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productTypes as $product)
                            <tr  >
                                <td class="clickable-row" data-href="/dashboard/product-items/{{ $product->id }}">{{ $product->id }}</td>
                                <td class="clickable-row" data-href="/dashboard/product-items/{{ $product->id }}"><img src="{{ url($product->image) }}" height="50" width="50" />
                                </td>
                                <td class="clickable-row" data-href="/dashboard/product-items/{{ $product->id }}">{{ $product->name }}</td>
                                <td class="clickable-row" data-href="/dashboard/product-items/{{ $product->id }}">{{ $product->description }}</td>
                                <td class="clickable-row" data-href="/dashboard/product-items/{{ $product->id }}">{{ $product->items->where('is_sold', 0)->count() }}</td>
                                <td> <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-description="{{ $product->description }}"
                                        data-url="/dashboard/product-types/update/{{ $product->id }}"
                                        data-target="#updateProductTypeModal">

                                        <i class="fa-solid fa-pen-to-square"></i></button></td>
                                <td><button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-id="{{ $product->id }}"
                                        data-url="/dashboard/product-types/delete/{{ $product->id }}"
                                        data-target="#deleteModal"><i class="fa-solid fa-trash-can"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <div class="modal fade" id="updateProductTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="updateProductTypeTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductTypeLongTitle">Update Product Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateProductTypeForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="productTypeImage">Upload product type image
                                    (optional)</label>
                                <input type="file" class="form-control-file" name="image"
                                    id="productTypeImage">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="productName">Name</label>
                            <input type="text" class="form-control" id="productName" name="name"
                                placeholder="name">
                            <input type="hidden" name="product_id" id="productTypeId">
                        </div>
                        <div class="form-group">
                            <label for="productDesc">Description</label>
                            <textarea name="description" class="form-control" id="productDesc" rows="3"></textarea>
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
