<?php

 class master{

		function get_questions_by_id($c){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM q_master WHERE cat_id=:c LIMIT 4";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->bindParam(':c',$c,PDO::PARAM_INT);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->q_id;
			$r[$i][1]=$row->cat_id;
			$r[$i][2]=$row->scat_id;
			$r[$i][3]=$row->qe;
			$r[$i][4]=$row->qa;
			$i++;}	
			return $r;
		
		}
		function get_teachers_by_id($c){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM teacher_master WHERE d_id=:c";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->bindParam(':c',$c,PDO::PARAM_INT);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->t_id;
			$r[$i][1]=$row->d_id;
			$r[$i][2]=$row->name;
			$r[$i][3]=$row->desg;
			$r[$i][4]=$row->address;
			$r[$i][5]=$row->phn;
			$r[$i][6]=$row->email;
			$i++;}	
			return $r;
		
		}
		function get_stream(){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM stream";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->id;
			$r[$i][1]=$row->stream;
			$i++;}	
			$count=$stmt1->rowCount();
			return $r;
		
		}
		function get_department($n){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM department WHERE s_id=:s";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->bindParam(':s',$n,PDO::PARAM_INT);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->d_id;
			$r[$i][1]=$row->d_name;
			$r[$i][2]=$row->s_id;
			$i++;}	
			$count=$stmt1->rowCount();
			return $r;
		
		}
		function get_subject($c_id,$s_id){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM subject_master WHERE c_id=:c_id AND s_id=:s_id";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->bindParam(':c_id',$c_id,PDO::PARAM_INT);
			$stmt1->bindParam(':s_id',$s_id,PDO::PARAM_INT);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->id;
			/*$r[$i][1]=$row->c_id;
			$r[$i][2]=$row->s_id;*/
			$r[$i][3]=$row->sname;
			$r[$i][4]=$row->scode;
			$i++;}	
			$count=$stmt1->rowCount();
			return $r;
		
		}

		function get_cat(){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM category";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->cat_id;
			$r[$i][1]=$row->cat_name;
			$r[$i][2]=$row->cat_des;
			$i++;}	
			$count=$stmt1->rowCount();
			return $r;
		
		}

		function get_cat_name($n){
			$core=Core::getInstance();
			$r[]= array();$i=0;$count=0;
			$q="SELECT * FROM category WHERE cat_id=:c";
			$stmt1=$core->dbh->prepare($q);
			$stmt1->bindParam(':c',$n,PDO::PARAM_INT);
			$stmt1->execute();
			$count=$stmt1->rowCount();
			while($row=$stmt1->fetchObject()){
			$r[$i][0]=$row->cat_id;
			$r[$i][1]=$row->cat_name;
			$r[$i][2]=$row->cat_des;
			$i++;}	
			$count=$stmt1->rowCount();
			return $r;
		
		}

}

class feedback{

	function set_feedback($core){

		$r=$_POST['size1'];
		$r1=$_POST['size2'];

		$flag = 0;

		for ($i=0; $i < $r ; $i++) {

			for ($j=0; $j < $r1 ; $j++) { 

				$q_id = $_POST["q_".($i+1)];

				$t_id = $_POST["t_".($i+1)."_".($j+1)];

				$ratng = $_POST["r_".($i+1)."_".($j+1)];

				$q = "insert into feed( q_id,t_id,rating ) values(:q_id,:t_id,:ratng)";

				$stmt = $core->dbh->prepare($q);
				$stmt->bindParam(':q_id',$q_id,PDO::PARAM_STR);
				$stmt->bindParam(':t_id',$t_id,PDO::PARAM_STR);
				$stmt->bindParam(':ratng',$ratng,PDO::PARAM_STR);

				if(!$stmt->execute()){

					echo "<script>alert(1);</script>";
					$err = $stmt->errorInfo();

					die($err[2]);

				}

			}

		}

		// NB : Show this message on a different page instead with a button to the details.php page .

		echo "<script>

				alert('Thank you for your valuable feedback');
				window.location.href='details.php';

			  </script>";

	}

} 


?>