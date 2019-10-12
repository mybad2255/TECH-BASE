<html>
  <head>
  <title>mission_5-1</title>
  </head>
  <body>
    <?php
	$dsn = 'データベース名';
		$user = 'ユーザー名';
		$password = 'パスワード';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
		." ("
		. "id INT AUTO_INCREMENT PRIMARY KEY,"
		. "name char(32),"
		. "comment TEXT"
		.");";
		$stmt = $pdo->query($sql);
	if (isset($_POST['send1'])) {
		if(!empty($_POST['name'])){
			if(!empty($_POST['comment'])){
				if(!empty($_POST['pass1'])){
					if($_POST['pass1'] !="pass"){
					echo "パスワードが違います。";
					}
				}
				else{
				echo "パスワードを入力してください。"."<br>";
				}
			}
			else{
			echo "コメントを入力してください。"."<br>";
			}
		}
		else{
		echo "名前を入力してください。"."<br>";
		}
	}
	if (isset($_POST['send2'])) {
		if(!empty($_POST['deletenumber'])){
			if(!empty($_POST['pass2'])){
				if($_POST['pass2'] !="pass"){
				echo "パスワードが違います。";
				}
			}
			else{
			echo "パスワードを入力してください。"."<br>";
			}
		}
		else{
		echo "削除対象番号を入力してください。"."<br>";
		}
	}
	if (isset($_POST['send3'])) {
		if(!empty($_POST['editnumber'])){
			if(!empty($_POST['pass3'])){
				if($_POST['pass3'] =="pass"){
				$editnumber = $_POST['editnumber'];
				$sql = 'SELECT * FROM tbtest';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
					foreach ($results as $row){
						if($row['id'] == $editnumber){
						$editname = $row['name'];
						$editcomment = $row['comment'];
						}
					}
				}
				else{
				echo "パスワードが違います。";
				}
			}
			else{
			echo "パスワードを入力してください。"."<br>";
			}
		}
		else{
		echo "編集対象番号を入力してください。"."<br>";
		}
	}
    ?>
  <form action="mission_5-1.php" method="post">
    <input type="text" name="name" size="40" placeholder="名前" value="<?php if(!empty($editname)){echo $editname;} ?>"><br>
    <input type="text" name="comment" size="40" placeholder="コメント" value="<?php if(!empty($editcomment)){echo $editcomment;} ?>"><br>
    <input type="hidden" name="edit" size="40" value="<?php if(!empty($editnumber)){echo $editnumber;} ?>">
    <input type="password" name="pass1" size="40" placeholder="パスワード" >
    <input type="submit" name="send1" value="送信"><br>
    <br>
    <input type="text" name="deletenumber" size="40" placeholder="削除対象番号" ><br>
    <input type="password" name="pass2" size="40" placeholder="パスワード" >
    <input type="submit" name="send2" value="削除"><br>
    <br>
    <input type="text" name="editnumber" size="40" placeholder="編集対象番号" ><br>
    <input type="password" name="pass3" size="40" placeholder="パスワード" >
    <input type="submit" name="send3" value="編集">
   </form>
	<?php
	$dsn = 'mysql:dbname=tb210507db;host=localhost';
		$user = 'tb-210507';
		$password = 'shu5M52Zk3';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
		." ("
		. "id INT AUTO_INCREMENT PRIMARY KEY,"
		. "name char(32),"
		. "comment TEXT"
		.");";
		$stmt = $pdo->query($sql);
	if (isset($_POST['send1'])) {
		if(!empty($_POST['name'])){
			if(!empty($_POST['comment'])){
				if(!empty($_POST['pass1'])){
					if($_POST['pass1'] =="pass"){
						if(empty($_POST['edit'])){
						$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
						$sql -> bindParam(':name', $name, PDO::PARAM_STR);
						$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
						$name = $_POST['name'];
						$comment = $_POST['comment'];
						$pass1 = $_POST['pass1'];
						$sql -> execute();
						$sql = 'SELECT * FROM tbtest';
						$stmt = $pdo->query($sql);
						$results = $stmt->fetchAll();
							foreach ($results as $row){
							echo $row['id'].',';
							echo $row['name'].',';
							echo $row['comment'].'<br>';
							echo "<hr>";
							}
						}
						else{
						$id = $_POST['edit'];
						$name = $_POST['name'];
						$comment = $_POST['comment'];
						$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':name', $name, PDO::PARAM_STR);
						$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
						$stmt->bindParam(':id', $id, PDO::PARAM_INT);
						$stmt->execute();
						$sql = 'SELECT * FROM tbtest';
						$stmt = $pdo->query($sql);
						$results = $stmt->fetchAll();
							foreach ($results as $row){
							echo $row['id'].',';
							echo $row['name'].',';
							echo $row['comment'].'<br>';
							echo "<hr>";
							}
						}
					}
					else{
					$sql = 'SELECT * FROM tbtest';
					$stmt = $pdo->query($sql);
					$results = $stmt->fetchAll();
						foreach ($results as $row){
						echo $row['id'].',';
						echo $row['name'].',';
						echo $row['comment'].'<br>';
						echo "<hr>";
						}
					}
				}
				else{
				$sql = 'SELECT * FROM tbtest';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
					foreach ($results as $row){	
					echo $row['id'].',';
					echo $row['name'].',';
					echo $row['comment'].'<br>';
					echo "<hr>";
					}
				}
			}
			else{
			$sql = 'SELECT * FROM tbtest';
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll();
				foreach ($results as $row){	
				echo $row['id'].',';
				echo $row['name'].',';
				echo $row['comment'].'<br>';
				echo "<hr>";
				}
			}
		}
		else{
		$sql = 'SELECT * FROM tbtest';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
			foreach ($results as $row){	
			echo $row['id'].',';
			echo $row['name'].',';
			echo $row['comment'].'<br>';
			echo "<hr>";
			}
		}
	}
	if (isset($_POST['send2'])) {
		if(!empty($_POST['deletenumber'])){
			if(!empty($_POST['pass2'])){
				if($_POST['pass2'] =="pass"){
				$id = $_POST['deletenumber'];
				$sql = 'delete from tbtest where id=:id';
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				$sql = 'SELECT * FROM tbtest';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
					foreach ($results as $row){	
					echo $row['id'].',';
					echo $row['name'].',';
					echo $row['comment'].'<br>';
					echo "<hr>";
					}
				}
				else{
				$sql = 'SELECT * FROM tbtest';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
					foreach ($results as $row){	
					echo $row['id'].',';
					echo $row['name'].',';
					echo $row['comment'].'<br>';
					echo "<hr>";
					}
				}
			}
			else{
			$sql = 'SELECT * FROM tbtest';
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll();
				foreach ($results as $row){	
				echo $row['id'].',';
				echo $row['name'].',';
				echo $row['comment'].'<br>';
				echo "<hr>";
				}
			}
		}
		else{
		$sql = 'SELECT * FROM tbtest';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
			foreach ($results as $row){	
			echo $row['id'].',';
			echo $row['name'].',';
			echo $row['comment'].'<br>';
			echo "<hr>";
			}
		}
	}
	if (isset($_POST['send3'])) {
		if(!empty($_POST['editnumber'])){
			if(!empty($_POST['pass3'])){
			$sql = 'SELECT * FROM tbtest';
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll();
				foreach ($results as $row){	
				echo $row['id'].',';
				echo $row['name'].',';
				echo $row['comment'].'<br>';
				echo "<hr>";
				}
			}
			else{
			$sql = 'SELECT * FROM tbtest';
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll();
				foreach ($results as $row){
				echo $row['id'].',';
				echo $row['name'].',';
				echo $row['comment'].'<br>';
				echo "<hr>";
				}
			}
		}
		else{
		$sql = 'SELECT * FROM tbtest';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
			foreach ($results as $row){
			echo $row['id'].',';
			echo $row['name'].',';
			echo $row['comment'].'<br>';
			echo "<hr>";
			}
		}
	}
	?>
  </body>
</html>