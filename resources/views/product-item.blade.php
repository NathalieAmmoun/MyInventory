<div class="container">

    <div class="row mt-5 justify-content-center">
        <div class="col-md-12">
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline" method="POST" action="/dashboard/product-items/{{ $productId }}">
                    @csrf
                    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductItemModal">
                    Add Product Item
                </button>
            </nav>
        </div>


        <div class="modal fade" id="addProductItemModal" tabindex="-1" role="dialog"
            aria-labelledby="addProductItemTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductItemLongTitle">Add Product Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" id="addItemsForm" enctype="multipart/form-data" style="display:none;">
                        @csrf</form>
                    <div id="addItems">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="productItemNumber">How many items do you want to input?</label>
                                <input type="number" class="form-control" id="productItemNumber" name="number"
                                    placeholder="number">
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="inputItemsNumber({{ $productId }})"
                                class="btn btn-primary">Confirm</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-right mt-5">
        <div class="col-md-4 offset-md-8 ">
            {{ $items->links() }}
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

    <div class="row justify-content-center mt-5">

        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Sold</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>{{ $item->serial_number }}</td>
                                <td><input type="checkbox" id="isSold{{ $item->id }}"
                                        @if ($item->is_sold) checked @endif
                                        onclick="toggleSold({{ $item->id }})"></td>

                                <td> <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-number="{{ $item->serial_number }}"
                                        data-url="/dashboard/product-items/update/{{ $item->id }}"
                                        data-target="#updateProductItemModal">

                                        <i class="fa-solid fa-pen-to-square"></i></button></td>
                                <td><button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-id="{{ $item->id }}"
                                        data-url="/dashboard/product-items/delete/{{ $item->id }}"
                                        data-target="#deleteModal"><i class="fa-solid fa-trash-can"></i></button></td>
                            </tr>
                            </a>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>

    </div>
    <div class="modal fade" id="updateProductItemModal" tabindex="-1" role="dialog"
        aria-labelledby="updateProductItemTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductItemLongTitle">Update Product Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateProductItemForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="serialNumber">Serial Number</label>
                            <input type="text" class="form-control" id="serialNumber" name="serial_number"
                                placeholder="ABCD123">

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
