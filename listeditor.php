<?php
include('include/bootstrap.php');
include('include/methods/functions.php');
include('include/process/connect_process.php');


$userID = $_SESSION['userID'];

$listID = $_GET['listID'];

$title = getTitle($listID);

$user = getUsername($userID);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  <script src="assets/js/editor.js"></script>
  <script src='assets/js/searchbar.js'></script>
  </head>
  <body>
  
<div class="row">
	<div class="col-6">
		<div class="row">
            <div class="w-100 p-3 text-white text-center" id="listtitle"><?php echo $title ?> </div>
        </div>
<div class="modal" id="myModalTwo">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-inline" onsubmit="changetitle()" method="GET" name="titleform">
				<input type="text" class="form-control" name="newtitle">
				<input type="hidden" id="listID" value="<?php echo $listID?>" name="listID">
					<div class="input-group-append">
						<input type="submit" class="btn btn-success">
					</div>
		
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
                <div class="col-12">
				<div class="row">
                        <div class="w-100 p-3 text-white text-center"><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModalTwo">
				Change Title
			</button></div>
                    </div>
                    <table id="table" class="table table-striped table-dark table-bordered">
					<thead>
                    <tr>
                    <th style="width:5%; text-align: center;" scope="col">#</th>
                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col">Runtime</th>
                    <th style="width:10%; text-align: center;" scope="col">Rating</th>
					<td style="text-align: center;">Remove</td>
                    </tr>
					</thead>
                    <tbody>
                        <?php 
						$co = 0;
						$length = returnOrder($listID);
						$check = fetchMovies($listID);
	
						while($row = $check->fetch_array())//gå igenom alla resultat
						{	
						$id = $row['movieID'];					
						$order=orderInList($id);
	
						$rating = setRating($id,$userID);
	
						$co = $co + 1;
						$thumbs = "thumbs" . $co;
						$remove = "remove" . $co;
						$content = file_get_contents("http://www.omdbapi.com/?i=$id&apikey=d476b9c2");
						$arr = json_decode($content);
						?>

					<tr style="line-height: 70px;cursor:pointer;" id="<?php echo $co ?>" onclick="swapitems(this.id)">
					<input type="hidden" id="movie<?php echo $co?>" value="<?php echo $arr->imdbID ?>">
					
					<td  id="order<?php echo $co?>" style="text-align: center;" ><?php echo $co ?></td>
					<td><img src="<?php echo $arr-> Poster ?>" style="max-height:9.8vh"/></td>
					<td><?php echo $arr-> Title ?></td>
					<td style="text-align: center;"><?php echo $arr-> Year ?></td>
					<td style="text-align: center;"><?php echo $arr-> Runtime ?></td>
					
		
		
					<?php
					if($rating == "1"):
					?>
					<td style="text-align: center;"><img src="assets/img/ratings/thumbs_up.png" id="<?php echo $thumbs?>" style="height:30px;" onclick="thumbs(<?php echo $co?>)"/></td>
					<?php
					elseif($rating == "2"):
					?>
					<td style="text-align: center;"><img src="assets/img/ratings/thumbs_down.png" id="<?php echo $thumbs?>" style="height:30px;"onclick="thumbs(<?php echo $co?>)"/></td>
					<?php
					elseif($rating =="0"):
					?>
					<td style="text-align: center;"><img src="assets/img/ratings/no_rating.png" id="<?php echo $thumbs?>" style="height:30px;"onclick="thumbs(<?php echo $co?>)"/></td>
					<?php endif;?>
					<td style="text-align: center;"><img src="http://www.clker.com/cliparts/Z/Z/S/Y/S/w/red-circle-cross-transparent-background.svg" style="height:30px;" id="<?php echo $remove?>" onclick="removemovie(<?php echo $co?>)"/></td>
					</tr>
					<?php
					}
					?>
					
					
                    </tbody>
					</table>
                    
                </div>

	</div>	  

	<div class="col-6">
		<form class="form-inline" action="" method="GET" id="search_form">
               <i class="fas fa-search" aria-hidden="true"></i>
			   <input type="hidden" id="listID" value="<?php echo $listID?>" name="listID">
               <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Search"
                   aria-label="Search">
		</form>
		<?php
				if(isset($_GET['title']))
				{
				?>
				
				<div class="col-12" style="margin-top:40px;">
                    <div class="row">
                        <div class="w-100 p-3 text-white text-center">Add To List</div>
                    </div>
                    <table id="table" class="table table-striped table-dark table-bordered">
					<thead>
                    <tr>

                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col"></th>
                    </tr>
					</thead>
                    <tbody>

						<?php
						$hold = $_GET['title'];
						$title = str_replace(" ", "+",$hold);
						$content = file_get_contents("http://www.omdbapi.com/?s=$title&apikey=2c66b43f");
						$arr = json_decode($content);
						
						if($arr -> Response == "False" )
						{
						?>
							<div class="card">
								<h1 class="card-title">Nothing Found</h1>
							</div>			
						<?php
						}
						else
						{	
						?>
							<?php
							foreach($arr -> Search as $test)
							{
							?>
							
							<tr style="line-height: 70px;cursor:pointer;" id="<?php echo $test->imdbID ?>" onclick="add(this.id)">
							<td><img src="<?php echo $test-> Poster ?>" style="max-height:9.8vh"/></td>
							<td><?php echo $test-> Title ?></td>
							<td style="text-align: center;"><?php echo $test-> Year ?></td>
							<td style="text-align: center;"><img src="https://proxy.duckduckgo.com/iu/?u=http%3A%2F%2Fpngimg.com%2Fuploads%2Fplus%2Fplus_PNG26.png&f=1" style="height:50px;float:right;"/></td>
							<?php
							}
						}
						?>
					</div>
				<?php
				}
				?>
	</div>
</div>

	
</div>
</body>
</html>
