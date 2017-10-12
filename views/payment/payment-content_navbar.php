<section class="content-header navbar_header">
	<div>
		 <nav class="navbar navbar-static-top navbar_content" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-branch-menu">
            <ul class="nav navbar-nav">
                
              <li class="">
                <a href="<?=DNADMIN?>/app/EventApp/<?=$event_ID?>/"> <i class="fa fa-home"></i> Home </a>
              </li>
              <li class="">
                <a href="<?=DNADMIN?>/app/EventApp/5/participant-finder"> <i class="fa fa-search"></i> Advanced Filter </a>
              </li>
                <?php  if($session_user_data->groups == 'Admin'){?>
              
                <?php }?>
                <?php  if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'Admin-User' || $session_user_data->groups == 'Super-Admin-User' || $session_user_data->groups == 'OGS-User'){?>
              
                <?php }?>
                
            </ul>
          </div>
        </nav>
	</div>
</section>