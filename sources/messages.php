<html>
	<head>
		<title>Messagerie</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=0.7">
		<!-- CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- <link rel="stylesheet" type="text/css" href="../css/formulaire/form.css"> -->
        <link href="../css/style.css" rel="stylesheet">
		<!--===============================================================================================-->
		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<!-- MON SCRIPT -->
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/messagerie/messages.js"></script>
		<!-- BOOTSTRAP -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
		<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>

		<!--===============================================================================================-->
    </head>
    

<body class="message">
    <main class="ie-stickyFooter">
        <div id="page">
            <div id="header_content">    
                <?php include('header.php');
                	if(!isset($_SESSION['login']))
                    {
                        header('location: connexion.php');
                    }
                ?>
            </div>
            <div id="content">
            	<div class="aucun_message d-none">
            		<div class="shadow">
	            		<h3>Bienvenue sur votre Messagerie</h3>
	            		<p>Cette messagerie permet de communiquer avec les autres utilisateurs</p>
	            		<img style="margin-top: 50px; margin-bottom: 100px;" src="../img/images_site/messagerie_vide.jpg" width="650">
	            	</div>
            	</div>
            	<div class="bloc_message d-none">
					<h3 class=" text-center">Messages</h3>
					<div class="messaging">
					    <div class="inbox_msg">
					        <div class="inbox_people">
					         	<div class="headind_srch">
					            	<div class="recent_heading">
					              		<h4>Récent</h4>
					            	</div>
					            	<div class="srch_bar">
					              		<div class="stylish-input-group">
					                		<input type="text" class="search-bar"  placeholder="Search" >
					                		<span class="input-group-addon">
					                		<button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
					                		</span> 
					                	</div>
					            	</div>
					          	</div>
					            <!-- LISTE DU CHAT -->	
					          	<div class="inbox_chat">
						            <!-- <div class="chat_list active_chat">
						              <div class="chat_people">
						                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						                <div class="chat_ib">
						                  <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
						                  <p>Test, which is a new approach to have all solutions 
						                    astrology under one roof.</p>
						                </div>
						              </div>
						            </div> -->
						            <!-- <div class="chat_list">
						              <div class="chat_people">
						                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						                <div class="chat_ib">
						                  <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
						                  <p>Test, which is a new approach to have all solutions 
						                    astrology under one roof.</p>
						                </div>
						              </div>
						            </div> -->
					          	</div>
					            <!-- LISTE DU CHAT -->
					        </div>
					        <div class="mesgs">
					         	<div class="msg_history">
						            <div class="incoming_msg">
						             	<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						              	<div class="received_msg">
						                	<div class="received_withd_msg">
						                  		<p>Test which is a new approach to have all
						                    	solutions</p>
						                  		<span class="time_date"> 11:01 AM    |    June 9</span>
						                  	</div>
						              	</div>
						            </div>
						            <div class="outgoing_msg">
						              <div class="sent_msg">
						                <p>Test which is a new approach to have all
						                  solutions</p>
						                <span class="time_date"> 11:01 AM    |    June 9</span> </div>
						            </div>
					          	</div>
					        <div class="type_msg">
					            <div class="input_msg_write">
					             	<input type="text" class="write_msg" placeholder="Type a message" />
					              	<button class="msg_send_btn" type="button">
					              		<svg class="bi bi-cursor-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									 	<path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
										</svg>
					              	</button>
					            </div>
					        </div>
					        </div>
					    </div>
    				</div>
            	</div>
            </div>
	        <div id="footer">
	            <?php include('footer.php');?>
	        </div>
        </div>
    </main>
</body>
</html>