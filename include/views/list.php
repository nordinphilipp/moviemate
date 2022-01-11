<?php
		
		$userID = ($_SESSION['userID']);
		$userinfo = fetchUser($userID);
		$listID = $_GET['listID'];
		$editLink = "listeditor.php?listID=$listID";
		$deleteLink = "delete_list.php?listID=$listID";
		$title = getTitle($listID);
		
?>   

   <html>
        <body>
            <div class="container-fluid">
                <div class="row flex" style="height: calc(90vh - 2px)">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="w-100 p-3 text-white text-center" id="listtitle"><?php echo $title ?> - a list by <a href="<?php echo $profilelink?>"style="color:white;"><?php echo $userinfo['username'] ?></a></div>
                        </div>
					<!-- Verktygsrad för ägare/admin -->
					<div class="row">
                        <div class="toolbar">
							<div class="toolbarbutton"><a href="<?php echo $editLink ?>">Edit</a></div>
							<div class="toolbarbutton"><a href="<?php echo $deleteLink ?>">Delete</a></div>
						</div>
                    </div>
                    <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                    <th style="width:5%; text-align: center;" scope="col">#</th>
                    <th style="width:5%; text-align: center;" scope="col"></th>
                    <th style="width:60%;" scope="col">Title</th>
                    <th style="width:10%; text-align: center;" scope="col">Year</th>
                    <th style="width:10%; text-align: center;" scope="col">Runtime</th>
                    <!--<th style="width:10%; text-align: center;" scope="col">Watched</th>-->
                    <th style="width:10%; text-align: center;" scope="col">Rating</th>
                    </tr>
                </thead>
                    <tbody>
                         <?php
						 $co = 0;
						$list = fetchMovies($listID);
						$length = returnOrder($listID);
						
						while($row = $list->fetch_array())//gå igenom alla resultat
						{
							$movie = $row['movieID'];
							$order = orderInlLst($movie);
							
							$rating = setRating($movie,$userID);
								
							$co = $co + 1;
							$thumbs = "thumbs" . $co;
							$content = file_get_contents("http://www.omdbapi.com/?i=$movie&apikey=d476b9c2");
							$arr = json_decode($content);
							?>
							<tr style="line-height: 75px;">
                            <th style="text-align: center;" scope="row"><?php echo $order ?></th>
                            <td><!-- Poster frÃ¥n API/Placeholder--><img src="<?php echo $arr-> Poster ?>" style="max-height:70px"/></td>
                            <td><a style="color:white;" href="moviepage.php?id=<?php echo $arr -> imdbID?>"><?php echo $arr-> Title ?></a></td>
                            <td style="text-align: center;"><?php echo $arr-> Year ?></td>
                            <td style="text-align: center;"><?php echo $arr-> Runtime ?></td>
                            <!--<td style="text-align: center;">Yes</td>-->
                             <?php
							if($rating == "1")
							{
							?>
							<td style="text-align: center;"><img src="assets/img/ratings/thumbs_up.png" style="height:30px;"/></td>							
							<?php
							}
							elseif($rating == "2")
							{
							?>
							<td style="text-align: center;"><img src="assets/img/ratings/thumbs_down.png" style="height:30px;"/></td>
							<?php
							}
							elseif($rating =="0")
							{
							?>
							<td style="text-align: center;"><img src="assets/img/ratings/no_rating.png" style="height:30px;"/></td>
							<?php
							}
							?>
                        </tr>
						<?php
						}
						?>
	
                    </tbody>
            </table>
                    
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
                        <br>

            </div>
        </body>
    </html>
