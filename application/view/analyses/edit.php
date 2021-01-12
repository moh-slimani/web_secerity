<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Analyses</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>analyses">Analyses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Analysis : <?php echo $analysis->designation ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-designation">Designation</label>
                                        <input type="text" id="input-designation" name="designation" class="form-control"
                                               value="<?php echo $analysis->designation ?>"
                                               placeholder="designation" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-min_value">Min Value</label>
                                        <input type="text" id="input-min_value" name="min_value"
                                               class="form-control"
                                               value="<?php echo $analysis->min_value ?>"
                                               placeholder="min_value">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-max_value">Max Value</label>
                                        <input type="text" id="input-max_value" name="max_value"
                                               class="form-control"
                                               value="<?php echo $analysis->max_value ?>"
                                               placeholder="max_value">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-price">price</label>
                                        <input type="number" id="input-price" name="price"
                                               class="form-control"
                                               value="<?php echo $analysis->price ?>"
                                               placeholder="price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <input class="btn btn-primary" type="submit" name="submit" value="submit" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
