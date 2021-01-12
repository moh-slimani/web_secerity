<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Consultations</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>consultations">Consultations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New</li>
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
                            <h3 class="mb-0">New Consultation</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-type">Type</label>
                                        <input type="text" id="input-type" name="type" class="form-control"
                                               placeholder="Type" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-date">Date</label>
                                        <input type="text" id="input-date" name="date"
                                               class="form-control datepicker"
                                               value="<?php echo date('Y-m-d') ?>"
                                               placeholder="Date" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-appointment">Appointment</label>
                                        <input type="text" id="input-appointment" name="appointment"
                                               class="form-control datepicker"
                                               placeholder="appointment">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-price">price</label>
                                        <input type="number" id="input-price" name="price"
                                               class="form-control"
                                               placeholder="price" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="input-sex">Patient</label>
                                        <select class="form-control" name="patient_id" id="input-sex" required>
                                            <option selected disabled value="">Select a patient</option>
                                            <?php foreach ($patients as $patient) { ?>
                                                <option value="<?php echo $patient->id ?>">
                                                    <?php echo $patient->first_name ?>
                                                    <?php echo $patient->last_name ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-description">Descirption</label>
                                        <textarea class="form-control" id="input-description"
                                                  name="description"
                                                  rows="3"></textarea>
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
