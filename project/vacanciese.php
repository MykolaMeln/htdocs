<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {


        $st = 'Not Available';
        $stmt = $pdo->prepare('UPDATE vacancies SET StateOfVacancy = :state WHERE ID_Vacancy = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->bindParam(':state', $st, PDO::PARAM_STR);

        $stmt->execute();

        $stmt2 = $pdo->prepare('SELECT * FROM vacancies WHERE ID_Vacancy = :id');
        $stmt2->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt2->execute();

        $vacancy = $stmt2->fetch();

        $stmt3 = $pdo->prepare('SELECT * FROM employers WHERE ID_Employer = :id');
        $stmt3->bindParam(':id', $vacancy['ID_Employer'], PDO::PARAM_INT);
        $stmt3->execute();

        $employer = $stmt3->fetch();

        $res = 'Working in '.$employer['NameCompany'].' !';
        $stmt4 = $pdo->prepare('UPDATE employees SET Result = :result WHERE ID_User = :id');
        $stmt4->bindParam(':id', $_SESSION['session_id'], PDO::PARAM_INT);
        $stmt4->bindParam(':result', $res, PDO::PARAM_STR);
        $stmt4->execute();

        $stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
        $stmt->bindParam(':id', $_SESSION['session_id'], PDO::PARAM_INT);
        $stmt->execute();

        $employee = $stmt->fetch();

        $stmt = $pdo->prepare('SELECT * FROM employeedata WHERE ID_Employee = :id');
        $stmt->bindParam(':id', $employee['ID_Employee'], PDO::PARAM_INT);
        $stmt->execute();

        $employeed = $stmt->fetch();

      /*  ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "projectemploymentoffice@gmail.com";
        $to = $employeed['Email'];
        $subject = "Vacancy in Employment Office";
        $message = "Your request has been accepted";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "The email message was sent.";*/

        header('Location: resume.php');
} else {
    exit('No ID specified!');
}
?>
