<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Patients</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo URL ?>patients">Patients</a></li>
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
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
                <img src="<?php echo URL ?>img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="<?php echo $patient->picture ?  URL . $patient->picture : URL . 'img/placeholder-profile.png' ?>"
                                     alt="..."
                                     width="140"
                                     height="140"
                                     class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                            </div>
                        </div>
                    </div>
                    <div class="">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Patient : <?php echo $patient->last_name ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first_name">First Name</label>
                                        <input type="text" id="input-first_name" name="first_name" class="form-control"
                                               placeholder="first name" required
                                               value="<?php echo $patient->first_name ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last_name">Last Name</label>
                                        <input type="text" id="input-last_name" name="last_name" class="form-control"
                                               placeholder="last name" required
                                               value="<?php echo $patient->last_name ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="input-sex">Sex</label>
                                        <select class="form-control" name="sex" id="input-sex" required>
                                            <option disabled value="">Select sexe</option>
                                            <option value="m" <?php echo $patient->sex == 'm' ? 'selected' : '' ?>>M
                                            </option>
                                            <option value="f" <?php echo $patient->sex == 'f' ? 'selected' : '' ?>>F
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-civility">Civility</label>
                                        <input type="text" id="input-civility" name="civility" class="form-control"
                                               placeholder="civility" required value="<?php echo $patient->civility ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input id="input-address" class="form-control" placeholder="Home Address"
                                               name="address" type="text" required
                                               value="<?php echo $patient->address ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="customFileLang">Select picture</label>
                                        <input type="file" class="custom-file-input"
                                               placeholder="Select a picture"
                                               id="customFileLang" name="picture">
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
