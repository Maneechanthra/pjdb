<?php
    session_start();
    require('../config.php');
    print_r( $_POST );

    $selected_stady_plan = $_POST['stady_plan'];
    if( $selected_stady_plan == -1 ){
        $selected_stady_plan = $_POST['other_stady_plan'];
    }    

    // CHECK existing record
    $sql_query = " SELECT * FROM applications,education_student WHERE National_id = '".$_SESSION['National_id']."'";
    $result = $mysqli->query($sql_query);
    $record_number = mysqli_num_rows( $result );
    // print( $record_number );

    unset($_SESSION['app_data3']);

    if( $record_number == 1 ){
        $update_sql = " UPDATE education_student SET  stady_plan = '".$selected_stady_plan."',
                                         edu_qualification =  '".$_POST['edu_qualification']."',
                                         School_name =  '".$_POST['School_name']."',
                                         Province_of_school =  '".$_POST['Ref_prov_id']."',
                                         Major_id =  '".$_POST['major']."',
                                         gpax =  '".$_POST['gpax']."'
                                
                                         

                                        WHERE National_id = '".$_SESSION['National_id']."' ;";
        echo $update_sql;
        $mysqli->query($update_sql);

        
        $personal_data2 = $result->fetch_assoc();
        $_SESSION['app_data3'] = $personal_data2;
        $_SESSION['National_id'] = $personal_data['National_id'];   

    }
    else{
        $insert_sql = " INSERT INTO education_student (National_id, edu_qualification, School_name, gpax, stady_plan, Province_of_school,`Major_id`) 
                        VALUES ('".$_SESSION['National_id']."','".$_POST['edu_qualification']."', '".$_POST['School_name']."', '".$_POST['gpax']."', '".$selected_stady_plan."', '".$_POST['Ref_prov_id']."','".$_POST['major']."' ) ";
        
        $mysqli->query($insert_sql);

        
        $personal_data2 = $result->fetch_assoc();
        $_SESSION['app_data3'] = $personal_data2;
        $_SESSION['National_id'] = $personal_data['National_id'];   

    }

    header("Location: ../views/print.php");

?>