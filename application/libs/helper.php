<?php

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     *
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     * @author Panique
     */
    static public function debugPDO(string $raw_sql, array $parameters): string
    {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);

        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        */

        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    static public function uploadFile($file): string
    {
        $target_dir = ROOT;
        $fileType = strtolower(pathinfo($file["tmp_name"], PATHINFO_EXTENSION));
        $target_relative_path = "public/uploads/" . uniqid(substr(basename($file["name"]), 1, 30)) . $fileType;
        $target_file = $target_dir . $target_relative_path;

        $check =  getimagesize($file["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if (!$uploadOk == 0) {
            move_uploaded_file($file["tmp_name"], $target_file);
        }

        return $target_relative_path;
    }

}
