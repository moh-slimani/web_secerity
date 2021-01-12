<?php

class Messages
{
    public static function setMsg($text, $type = "success")
    {
        if ($type == 'error') {
            $_SESSION['errorMsg'] = $text;
        } else {
            $_SESSION['successMsg'] = $text;
        }
    }

    public static function display()
    {
        if (isset($_SESSION['errorMsg'])) {
            $error = $_SESSION['errorMsg'];
            $message = <<<EOD
<script>
$.notify({
    // options
    message: '$error'
}, {
    type: 'danger',
    allow_dismiss: true,
    newest_on_top: false,
    placement: {
        from: 'top',
        align: 'right'
    },
    offset: 20
})
</script>
EOD;
            echo $message;
            unset($_SESSION['errorMsg']);
        }

        if (isset($_SESSION['successMsg'])) {
            $success = $_SESSION['successMsg'];
            $message = <<<EOD
<script>
$.notify({
    // options
    message: '$success'
}, {
    type: 'success',
    allow_dismiss: true,
    newest_on_top: false,
    placement: {
        from: 'top',
        align: 'right'
    },
    offset: 20
})
</script>
EOD;
            echo $message;
            unset($_SESSION['successMsg']);
        }
    }
}
