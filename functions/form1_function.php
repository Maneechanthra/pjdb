<?php
    session_start();
    require('../config.php');
    print_r( $_POST );

    $selected_religion = $_POST['Religion'];
    if( $selected_religion == -1 ){
        $selected_religion = $_POST['other_religion'];
    }    
    $selected_ethnicity = $_POST['Ethnicity'];
    if( $selected_ethnicity == -1 ){
        $selected_ethnicity = $_POST['other_ethnicity'];
    }    

    $selected_nationality = $_POST['Nationality'];
    if( $selected_nationality == -1 ){
        $selected_nationality = $_POST['other_nationality'];
    }    

    // CHECK existing record
    $sql_query = " SELECT * FROM `applications` WHERE `National_id` = '".$_SESSION['National_id']."' AND `Tcas_round` = ".$_SESSION['Tcas_round']." ;  ";
    $result = $mysqli->query($sql_query);
    $record_number = mysqli_num_rows( $result );


    $sql_query2 = " SELECT * FROM `education_student` WHERE `National_id` = '".$_SESSION['National_id']."' ; ";
    // echo $sql_query;

    $result2 = $mysqli->query($sql_query2);
    $record_number2 = mysqli_num_rows( $result2 );

    // print( $record_number );

    unset($_SESSION['app_data2']);

    if($record_number == 1){
        $update_sql = " UPDATE `applications` SET `Prefix_th` = '".$_POST['Prefix_th']."',
                                        `Firstname_th` = '".$_POST['Firstname_th']."',
                                        `Lastname_th` = '".$_POST['Lastname_th']."',
                                        `Prefix_en` = '".$_POST['Prefix_en']."',
                                        `Firstname_en` = '".$_POST['Firstname_en']."',
                                        `Lastname_en` = '".$_POST['Lastname_en']."',
                                        `Birth_date` =  '".$_POST['Birth_date']."',
                                        `Religion` = '".$selected_religion."', 
                                        `Ethnicity` = '".$selected_ethnicity."', 
                                        `Nationality` = '".$selected_nationality."', 
                                        `Province` = '".$_POST['Ref_prov_id']."',
                                        `District` = '".$_POST['Ref_dist_id']."',
                                        `Sub_district` = '".$_POST['Ref_subdist_id']."',
                                        `Home_no` = '".$_POST['Home_no']."',
                                        `Village_no` = '".$_POST['Village_no']."',
                                        `Street` = '".$_POST['Street']."',
                                        `Postal_Code` = '".$_POST['Postal_Code']."',
                                        `Telephone_number` = '".$_POST['Telephone_number']."',
                                        `Home_number` = '".$_POST['Home_number']."',
                                        `Email` = '".$_POST['Email']."',
                                        `Parents_occupation` = '".$_POST['Parents_occupation']."',
                                        `Income_parents` = '".$_POST['Income_parents']."'
                                        WHERE National_id = '".$_SESSION['National_id']."' ;";
        echo $update_sql;
        $mysqli->query($update_sql);

        $personal_data2 = $result2->fetch_assoc();
        $_SESSION['app_data2'] = $personal_data2;
       // $_SESSION['National_id'] = $personal_data['National_id'];        
        $_SESSION['edu_qualification'] = $personal_data['edu_qualification'];

    }
    else{
        $insert_sql = " INSERT INTO `applications` (`National_id`, `Tcas_round`, `Prefix_th`, `Firstname_th`, `Lastname_th`, `Prefix_en`, `Firstname_en`, `Lastname_en`, `Birth_date`, `Religion`, `Ethnicity`, `Nationality`, `Home_no`, `Village_no`, `Street`, `Postal_Code`, `Telephone_number`, `Home_number`, `Email`, `Parents_occupation`, `Income_parents`, `Province`, `District`, `Sub_district`) 
                        VALUES ('".$_SESSION['National_id']."', '".$_SESSION['Tcas_round']."', '".$_POST['Prefix_th']."', '".$_POST['Firstname_th']."', '".$_POST['Lastname_th']."', '".$_POST['Prefix_en']."', '".$_POST['Firstname_en']."', '".$_POST['Lastname_en']."', '".$_POST['Birth_date']."', '".$selected_religion."', '".$selected_ethnicity."', '".$selected_nationality."', '".$_POST['Home_no']."', '".$_POST['Village_no']."', '".$_POST['Street']."', '".$_POST['Postal_Code']."', '".$_POST['Telephone_number']."', '".$_POST['Home_number']."', '".$_POST['Email']."', '".$_POST['Parents_occupation']."', '".$_POST['Income_parents']."', '".$_POST['Ref_prov_id']."', '".$_POST['Ref_dist_id']."', '".$_POST['Ref_subdist_id']."') ";
        
        $mysqli->query($insert_sql);

        
        $personal_data2 = $result2->fetch_assoc();
        $_SESSION['app_data2'] = $personal_data2;
        //$_SESSION['National_id'] = $personal_data['National_id'];        
        $_SESSION['edu_qualification'] = $personal_data['edu_qualification'];
    }

    header("Location: ../views/major.php");

?>