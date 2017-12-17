<?php 

	// NB : I think the connect class should be included in class.php. You would also need to make minor changes
	// accordingly.

	include('class/connect.php');
	session_start();
	/*include('class/sessioncheck.php');*/
	include('class.php');

	$core= Core::getInstance();
	$c = new master;

	// insert feedback into the database

	if(isset($_POST['f_submit'])){

		$f = new feedback;

		$f->set_feedback($core);

	}

	if(isset($_POST['cat']) && isset($_POST['dept'])){


		$d = trim($_POST['dept']);
		$cat = trim($_POST['cat']);

	}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FEEDBACK SYSTEM</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        
    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">FBS | Bahona College</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<span class="li-text">
								 Feedback System of
							</span> 
							<a href="#"><strong>BAHONA COLLEGE</strong></a> 
							<span class="li-text">
								<i class="fa fa-user"></i> ( <?php echo $_SESSION['user']; ?> )
							</span> 
							<span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a> 
								<a href="#"><i class="fa fa-twitter"></i></a> 
								<a href="#"><i class="fa fa-envelope"></i></a> 
								
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Feedback</strong> System of Bahona College</h1>
                            <div class="description">
                            	<p><b>
	                            <?php 

	                            		$n = new master;
	                            		$r = $n->get_cat_name($cat);
	                            		echo $r[0][1];

	                             ?></b>
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        	
                        	<div class="col-sm-6 col-sm-offset-3 form-box">
							<form role="form" action="" method="post" class="registration-form">
								<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3><b><?php echo $r[0][1]; ?></b></h3>
		                            		<p>Please read the instructions carefully</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-key"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                        <!-- <p>Instructions for submitting the forms</p>
				                        <p>1. Press the options for selecting it </p>
				                        <p>2. Click next to got the next slide</p>
				                        <p>3. You can come back to the previous one</p>
				                        <p>4. Final submit can't be reverted</p>
				                        <p>5. Only sone submission is allowed</p> -->
				                        <button type="button" class="btn btn-next">Enter</button>
				                    </div>
			                    </fieldset>
                        		
                        		
							<?php
								$k=0;

								$r = $c->get_questions_by_id($cat);
								for($i=0;$i<sizeof($r);$i++){

							?>

                        		<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Question <?php echo $i+1; ?> of <?php echo sizeof($r); ?></h3>
		                            		<p><b><?php echo $r[$i][3]; ?></b></p>
		                            		<p><b><?php echo $r[$i][4]; ?></b></p>

				                    		<input type="hidden" value="<?php echo $r[$i][0]; ?>" name="q_<?php echo $i+1; ?>" >

		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-check"></i>
		                        		</div>
		                            </div>

		                            <div class="form-bottom" >
		                            <?php

				              			$r1 = $c->get_teachers_by_id($d);
				              			for($j=0;$j<sizeof($r1);$j++){

				              		 ?>
		                            <div class="form-group">
				                    		<label for="t_name"><?php echo $r1[$j][2]; $t=$r1[$j][0]; ?></label>
				                    		<input type="hidden" value="<?php echo $t; ?>" name="t_<?php echo $i+1; ?>_<?php echo $j+1; ?>" >

				                    </div>
				                    <div class="form-group" align="center">
										<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-primary active">
										
										<input name="r_<?php echo $i+1; ?>_<?php echo $j+1; ?>" type="radio" id="r_<?php echo $r[$i][0]; ?>_<?php echo $r1[$j][0]; ?>_1" value="A" autocomplete="off" checked> Very Good
										
										</label>

										<label class="btn btn-primary">
										<input name="r_<?php echo $i+1; ?>_<?php echo $j+1; ?>" type="radio" id="r_<?php echo $r[$i][0]; ?>_<?php echo $r1[$j][0]; ?>_2" value="B" autocomplete="off"> Good
										</label>
										
										<label class="btn btn-primary">
										<input name="r_<?php echo $i+1; ?>_<?php echo $j+1; ?>" type="radio" id="r_<?php echo $r[$i][0]; ?>_<?php echo $r1[$j][0]; ?>_3" value="C" autocomplete="off"> Satisfactory
										</label>
										
										<label class="btn btn-primary">
										<input name="r_<?php echo $i+1; ?>_<?php echo $j+1; ?>" type="radio" id="r_<?php echo $r[$i][0]; ?>_<?php echo $r1[$j][0]; ?>_4" value="D" autocomplete="off"> Below Average
										</label>
										
										</div>
									</div>
									
				                        <?php 

				                    		}

				                    	?>
				                        
				                       
				                        <button type="button" class="btn btn-previous">Previous</button>
				                        <button type="button" class="btn btn-next">Next</button>
				                    </div>
			                    </fieldset>
			                    <?php 

			                    	}

			                    ?>

			                    
			                  
			                    
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Final Submit</h3>
		                            		<p></p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-warning"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                    	<p>Submit the values finally. You cannot revert this process.</p>
				                        <button type="button" class="btn btn-previous">Previous</button>
				                        <button type="submit" name="f_submit" class="btn">Final Submit</button>
				                    </div>
			                    </fieldset>
		                    
			                    <input type="hidden" name="size1" value="<?php echo sizeof($r); ?>" >
			                    <input type="hidden" name="size2" value="<?php echo sizeof($r1); ?>" >

		                    </form>
		                    
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>


<script type="text/javascript">
	

	function 

</script>