<!DOCTYPE html>
<html>
	<head>
		<title>Редактирование таблицы на PHP, JavaScript</title>
		<meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
        <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="style/pract.css" />
	</head>
	<body>
		<div class="center">

		<h1><a href=".">Редактирование таблицы на JavaScript, PHP</a></h1>
		<button class="btMenu"><a href="."><img src="image/home.ico" alt="Главная" title="Перейти на главную страницу" class="btMenuImg" /></a></button>
		<button class="btMenu"><a href="print.php" target="_blank"><img src="image/print.ico" alt="Печать" title="Напечатать страницу" class="btMenuImg" /></a></button>

<!-- НАЧАЛО формы для добавления ВСПЛЫВАЮЩАЯ СТРОКА -->
<button class="btMenu" id="addView" onclick="alerted();"><img src="image/add.ico" alt="Добавить" title="Добавить 1 строку" class="btMenuImg" /></button>
<script type="text/javascript">
    function alerted() {
        if (addForm.style.display != 'block') {
            addForm.style.display = 'block';
        } else {
            addForm.style.display = 'none';
        }
    }
</script>
<form action="index.php" id="addForm" method="post"> <!-- Изменение метода на POST -->
    <br /><hr /><br />
    <table>
        <tr>
            <td><input type="text" name="firstName" id="firstName" placeholder="Имя" required /></td>
            <td><input type="text" name="lastName" id="lastName" placeholder="Фамилия" required /></td>
            <td><input type="text" name="secondName" id="secondName" placeholder="Отчество" required /></td>
            <td><input type="text" name="passport" id="passport" placeholder="Паспорт" required /></td>
            <td><input type="text" name="inn" id="inn" placeholder="ИНН" required /></td>
            <td><input type="text" name="snils" id="snils" placeholder="СНИЛС" required /></td>
            <td><input type="text" name="driverLicense" id="driverLicense" placeholder="Водительское удостоверение" required /></td>
            <td><input type="text" name="additionalDocs" id="additionalDocs" placeholder="Дополнительные документы" required /></td>
            <td><input type="text" name="notes" id="notes" placeholder="Примечания" required /></td>
            <td><input type="submit" name="bt1" value="Добавить" class="bt" /></td>
        </tr>
    </table>
    <p style="font-size:12px;"><i>(в базу <b>bankDB</b>, таблицу <b>individual</b> в MySQL)</i></p>
    <hr />
</form>
<!-- КОНЕЦ формы для добавления ВСПЛЫВАЮЩАЯ СТРОКА -->



		<br /><br />
		<?php 
			include "db.php";

			?><table class='tView1'><?php
			for($iC=0; $iC<Count($resultMF); $iC++) {
				?><tr><?php
				
				$iCountLine = floor(Count($resultMF[$iC])/2);
				for($iR = 0; $iR < $iCountLine; $iR++) {
		// добавить 1 строку кода для UPDATE
					?><td><a href="#" class="js-open-modal" data-modal="1" id="id<?php echo $iR .'_'. $resultMF[$iC][0];?>"><?php echo $resultMF[$iC][$iR];?></a></td><?php
				}
		// добавить 1 строку кода для UPDATE
				?><td style="width:20px;" title="Отредактировать"><a href="#" class="js-open-modal" data-modal="1" id="id<?php echo $iR .'_'. $resultMF[$iC][0];?>"><img src="image/edit.ico" style="height:20px;width:20px;"></a></td>
				<td style="width:20px;" title="Добавить файлы"><a href="practUpload/index.php?id=<?php echo $resultMF[$iC][0]; ?>"><img src="image/files.ico" style="height:20px;width:20px;"></a></td>
				<td style="width:20px;" title="Удалить"><a href="index.php?delid=<?php echo $resultMF[$iC][0]; ?>"><img src="image/delete.ico" style="height:20px;width:20px;"></a></td><?php
				?></tr><?php
			}

			?></table><?php

		?>


<!-- НАЧАЛО модального окна -->
<link rel="stylesheet" href="style/modal.css" />
<div class="modal" data-modal="1">
   <!--   Svg иконка для закрытия окна  -->
   <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
   <p class="modal__title"><b>Отредактировать строку</b><br /></p>
   <form action="index.php" method="post">   
   <input type="hidden" name="textId" id="textId" value="" />
   <br /><i>Имя:</i> <input type="edit" name="firstName" id="textEd1" value="" /><br />
   <br /><i>Фамилия:</i> <input type="edit" name="lastName" id="textEd2" value="" /><br />
   <br /><i>Отчество:</i> <input type="edit" name="secondName" id="textEd3" value="" /><br />
   <br /><i>Паспорт:</i> <input type="edit" name="passport" id="textEd4" value="" /><br />
   <br /><i>ИНН:</i> <input type="edit" name="inn" id="textEd5" value="" /><br />
   <br /><i>СНИЛС:</i> <input type="edit" name="snils" id="textEd6" value="" /><br />
   <br /><i>Водительское удостоверение:</i> <input type="edit" name="driverLicense" id="textEd7" value="" /><br />
   <br /><i>Дополнительные документы:</i> <input type="edit" name="additionalDocs" id="textEd8" value="" /><br />
   <br /><i>Примечания:</i> <input type="edit" name="notes" id="textEd9" value="" /><br />
   <br /><a href="practUpload/index.php?id=error" id="aId" target="_blank" class="bt">Добавить файлы</a>
   <input type="submit" name="bt2" value="Отредактировать" class="bt" />
   </form>
</div>
<!-- Подложка под модальным окном -->
<div class="overlay js-overlay-modal"></div>
<!-- Дополнительный скрипт --> 
<script src="script/modal.js"></script>
<!-- КОНЕЦ модального окна -->

	 
		</div>
		
	</body>
</html>