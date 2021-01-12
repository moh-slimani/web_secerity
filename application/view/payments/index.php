<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Results</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark  mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Results</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo URL ?>results/create" class="btn btn-neutral">New</a>
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
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Results list</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Patient</th>
                                <th scope="col">analysis</th>
                                <th scope="col">value</th>
                                <th scope="col">norm</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php if (isset($results)) {
                                foreach ($results as $result) {?>
                                    <tr>
                                        <td>
                                            <?php echo $result->patient->last_name ?>
                                            <?php echo $result->patient->first_name ?>
                                        </td>
                                        <td>
                                            <?php echo $result->analysis->designation ?>
                                        </td>
                                        <td>
                                            <?php echo $result->analysis->min_value ?> /
                                            <?php echo $result->analysis->max_value ?>
                                        </td>
                                        <td>
                                            <?php echo strtoupper($result->value) ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="<?php echo URL.'results/edit/'.$result->id ?>">Edit</a>
                                                    <a class="dropdown-item" href="<?php echo URL.'results/delete/'.$result->id ?>">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                </div>
            </div>
        </div>
    </div>
</div>
