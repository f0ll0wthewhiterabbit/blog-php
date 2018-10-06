<?php

	include_once 'functions.php';

	$id = $_GET['id'] ?? null;

	if ($id === null) {
		echo 'Ошибка 404, не передано название';
	} elseif (!checkTitle($id)) {
		echo 'Ошибка 404. Введены недопустимые символы';
	} else {
		$sql = sprintf("SELECT * FROM %s WHERE `id`=:id", DB_TABLE);
		$query = db_query($sql, [
			'id' => $id
		]);
		$post = $query->fetch(PDO::FETCH_ASSOC);

		if (!$post) {
			echo 'Ошибка 404. Нет такой статьи!';
		} else {
			echo nl2br($post['content']);
		}
	}