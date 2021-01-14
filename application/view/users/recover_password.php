<!-- Page content -->
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        Type your new  password
                    </div>
                    <form role="form" method="post">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" name="password" placeholder="Password" type="password"
                                       aria-label="password" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
                            <input type="hidden" name="email" value="<?php echo $_GET['email'] ?>">
                            <button name="submit" type="submit" value="submit" class="btn btn-primary my-4">change
                                password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
