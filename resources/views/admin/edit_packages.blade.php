@extends('admin.layout.structure')
@section('content')

<main class="col-md-10 ms-sm-auto px-4">

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">

                <h3 class="mb-3">Edit Package</h3>

                <form method="post" action="{{ url('/edit_packages/' . $package->id) }}" enctype="multipart/form-data">
@csrf
                    <!-- CATEGORY -->
                   

                    <!-- PACKAGE NAME -->
                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" name="package_name"
                               value="<?= htmlspecialchars($package->package_name) ?>"
                               class="form-control" required>
                    </div>

                    <!-- PRICE -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price"
                               value="<?= $package->price ?>"
                               class="form-control" required>
                    </div>

                    <!-- MAX CATALOGUES -->
                    <div class="mb-3">
                        <label class="form-label">Maximum Catalogues</label>
                        <input type="number" name="max_catelogues"  
                               value="<?= $package->max_catelogues ?>"
                               class="form-control" >
                    </div>   

                    
                    <!-- DESCRIPTION -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required><?= htmlspecialchars($package->description) ?></textarea>
                    </div>

                    <!-- BUTTONS -->
                    <button type="submit" name="update" class="btn btn-primary">
                        Update Package
                    </button>

                    <a href="package_management" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>

</main>
