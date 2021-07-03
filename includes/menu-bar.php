<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">            
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="active dropdown yamm-fw">
				<a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
				
			</li>
              <?php $sql=mysqli_query($con,"select id,categoryName from category limit 6");
                    while($row=mysqli_fetch_array($sql))
                        {
                            ?>

			<li class="dropdown yamm">
				<a href="category.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a>
			
			</li>
			<?php } ?>         
        

			
		</ul><!-- /.navbar-nav -->
        <ul class="search-d">
            <div class="search-area">
                <form class="form-inline" name="search" method="post" action="search-result.php">
                        <input class="form-control mr-sm-2" type="search" name="product" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0 sr" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>               
        </ul>
        
        
        
        
		<div class="clearfix"></div>	     
        
            
        <!-- ==== SEARCH AREA : END ==== -->	
        <!-- /.top-search-holder -->
                    
	</div>
</div>


            </div>
        </div>
    </div>
</div>