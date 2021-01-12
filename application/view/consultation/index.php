<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Consultations</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark  mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Consultations</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo URL ?>consultations/create" class="btn btn-neutral">New</a>
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
                    <h3 class="mb-0">Consultations list</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Patient</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Appointment</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php if (isset($consultations)) {
                                foreach ($consultations as $consultation) {?>
                                    <tr>
                                        <td>
                                            <?php echo $consultation->patient->last_name ?>
                                            <?php echo $consultation->patient->first_name ?>
                                        </td>
                                        <td>
                                            <?php echo $consultation->type ?>
                                        </td>
                                        <td>
                                            <?php echo strtoupper($consultation->date) ?>
                                        </td>
                                        <td>
                                            <?php echo $consultation->appointment ?>
                                        </td>
                                        <td>
                                            <?php echo $consultation->price ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="<?php echo URL.'consultations/edit/'.$consultation->id ?>">Edit</a>
                                                    <a class="dropdown-item" href="<?php echo URL.'consultations/delete/'.$consultation->id ?>">Delete</a>
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
