<?php 
// блок инициализации
try {
	$pdoSet = new PDO('mysql:host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// код для "неубиваемой" базы данных
$sqlTM = "CREATE DATABASE IF NOT EXISTS bankDB;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE bankDB;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "CREATE TABLE IF NOT EXISTS individuals (id int(11) NOT NULL auto_increment, text text NOT NULL, description text NOT NULL, keywords text NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных

if (isset($_POST['bt1'])) { // Изменение проверки на POST
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $secondName = $_POST["secondName"];
    $passport = $_POST["passport"];
    $inn = $_POST["inn"];
    $snils = $_POST["snils"];
    $driverLicense = $_POST["driverLicense"];
    $additionalDocs = $_POST["additionalDocs"];
    $notes = $_POST["notes"];

    try {
        $sqlTM = "INSERT INTO individuals (firstName, lastName, secondName, passport, inn, snils, driverLicense, additionalDocs, notes) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdoSet->prepare($sqlTM);

        // Привязка параметров
        $stmt->bindParam(1, $firstName);
        $stmt->bindParam(2, $lastName);
        $stmt->bindParam(3, $secondName);
        $stmt->bindParam(4, $passport);
        $stmt->bindParam(5, $inn);
        $stmt->bindParam(6, $snils);
        $stmt->bindParam(7, $driverLicense);
        $stmt->bindParam(8, $additionalDocs);
        $stmt->bindParam(9, $notes);
        
		$result = $stmt->execute(); 

		if ($result === false) { 
			$errorInfo = $stmt->errorInfo(); 
			echo "Ошибка базы данных: " . $errorInfo[2]; 
		} else {
			echo "Новая сущность успешно добавлена!";
		}
        
    } catch (PDOException $e) {
		if ($e->errorInfo[1] == 1062) { 
			echo "Ошибка: Эта запись уже существует.";
		} else {
			echo "Ошибка базы данных: " . $e->getMessage();
		}
	}
}




// начало вставки для UPDATE
if (isset($_POST['textId'])) {
    $textId = $_POST['textId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $secondName = $_POST['secondName'];
    $passport = $_POST['passport'];
    $inn = $_POST['inn'];
    $snils = $_POST['snils'];
    $driverLicense = $_POST['driverLicense'];
    $additionalDocs = $_POST['additionalDocs'];
    $notes = $_POST['notes'];

    $sqlTM = "UPDATE individuals SET firstName='$firstName', lastName='$lastName', secondName='$secondName', passport='$passport', inn='$inn', snils='$snils', driverLicense='$driverLicense', additionalDocs='$additionalDocs', notes='$notes' WHERE id = $textId";

    try {
        $stmt = $pdoSet->query($sqlTM);
        if (!$stmt) {
            throw new Exception($pdoSet->errorInfo()[2]);
        } else {
            echo "Сущность успешно обновлена";
        }
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
// конец вставки для UPDATE

// начало вставки для DELETE
if (isset($_GET['delid'])) {
	$sqlTM = "DELETE FROM individuals WHERE id = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE


	$sqlTM="SELECT * FROM individuals WHERE id>0 ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
//echo $sqlTM;
	$stmt = $pdoSet->query($sqlTM);
	$resultMF = $stmt->fetchAll();
	
//var_dump($resultMF);
?>
