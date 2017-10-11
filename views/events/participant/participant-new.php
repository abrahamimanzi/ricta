<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
            <a href="<?=DNADMIN?>/app/EventApp/home"><i class="fa fa-book fa-lg pink-col"></i></a> <small> <i class="fa fa-angle-double-right"></i> </small>
					<?=$event_data->name;?>
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
				<form action="#" method="get" class="mainsearch-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
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
                <a href="<?=DNADMIN?>/app/EventApp/<?=$event_ID?>/"> <i class="fa fa-home"></i> Route </a>
              </li>
              <!-- New activities Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Participants
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="<?=DNADMIN?>/app/EventApp/<?=$event_ID?>/participant-new">
                          <i class="fa fa-plus text-blue"></i>New participant
                        </a>
                      </li><!-- end notification -->
                      <li><!-- start notification -->
                        <a href="<?=DNADMIN?>/app/EventApp/<?=$event_ID?>/participant-list">
                            <i class="fa fa-bars text-blue"></i>All participants
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                </ul>
              </li>
                
            </ul>
          </div>
        </nav>
	</div>
</section>

<!-- Main content -->
<section class="content">
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-10 col-md-8">
              <form method="post" class="form-horizontal">
                 <!--RECENT NEW PARTICIPANT -->
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 10px 25px 10px 25px; ">
                        <fieldset class="panel-reg">
                            <?php include 'form-new.php';?>
                        </fieldset>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="webToken" value="56">
                    <input type="hidden" name="request" value="participant-new">
                    <input type="hidden" name="participant-event_id" value="<?=$event_data->ID?>">
                    <input type="hidden" name="participant-company_id" value="<?=$company_data->ID?>">
                    <div class="box-footer clearfix">
                        <a href="<?=DNADMIN?>/app/EventApp/home" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-info btn-flat pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                  <!--END NEW PARTICIPANT-->
              </form>
          </div>
          <div class="col-sm-1 col-md-2"></div>
<!--
          <div class="col-sm-2 col-md-4">
               <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Notifications</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list list-unstyled">
                            <li><span class="label label-default" >New Task</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Pending</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Tasks</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >New Task</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Pending</span> Lorem ipsum number 2<hr></li>
                            <li><span class="label label-default" >Tasks</span> Lorem ipsum number 2<hr></li>
                        </ul>
                    </div>
                </div>
          </div>
-->
	  </div><!-- /.row -->
    
	  <div class="row">
		<div class="col-md-8 col-xs-12">
           
		</div><!-- ./col -->
		<div class="col-md-4 col-xs-12">
           
		</div><!-- ./col -->
	  </div><!-- /.row -->
    
</section>