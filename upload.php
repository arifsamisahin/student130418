<?php

  require_once 'core/init.php';

if($_POST) {


    $valid = array('success' => false, 'messages' => array());

    $name = $_POST['fullName'];

    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $url = 'uploads/' . uniqid(rand()) . '.' . $type;

    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {

                // insert into database
                $sql = "INSERT INTO student (s_id, s_image) VALUES ('$name', '$url')";

                if($connect->query($sql) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Uploaded";
                }
                else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }

                $connect->close();

            }
            else {
                $valid['success'] = false;
                $valid['messages'] = "Error while uploading";
            }
        }
    }

    echo json_encode($valid);

    // upload the file
}
