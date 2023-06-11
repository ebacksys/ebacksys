<div>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select wire:model="selectedProductId">
                        <option value="">-- Select a Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->id }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <div class="col-4">
                        <input type="text" wire:model.defer="name" id="name" class="form-control mb-2"  />
                    </div>
                </td>
                <td>
                    <div class="col-4">
                        <input type="text" wire:model.defer="price" id="price" class="form-control mb-2"  />
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
   
</div>
