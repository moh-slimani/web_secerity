<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Results</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>payments">Results</a></li>
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
                            <h3 class="mb-0">New Results</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-patient_id">Patient</label>
                                        <select class="form-control" name="patient_id" id="input-patient_id" required>
                                            <option selected disabled value="">Select a patient</option>
                                            <?php if (!empty($patients)) {
                                                foreach ($patients as $patient) { ?>
                                                    <option value="<?php echo $patient->id ?>">
                                                        <?php echo $patient->first_name ?>
                                                        <?php echo $patient->last_name ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-analysis_id">Analysis</label>
                                        <select class="form-control" name="analysis_id" id="input-analysis_id" required>
                                            <option selected disabled value="">Select a Analysis</option>
                                            <?php if (!empty($analyses)) {
                                                foreach ($analyses as $analysis) { ?>
                                                    <option value="<?php echo $analysis->id ?>">
                                                        <?php echo $analysis->designation ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-date">Date</label>
                                        <input type="text" id="input-date" name="date"
                                               class="form-control datepicker"
                                               value="<?php echo date('Y-m-d') ?>"
                                               placeholder="Date" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-value">Value</label>
                                        <input type="text" id="input-value" name="value"
                                               class="form-control"
                                               placeholder="value" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-description">Description</label>
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
