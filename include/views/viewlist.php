<html>
        <body>
            <div class="container-fluid">
                <div class="row flex" style="height: calc(90vh - 2px)">
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <div class="row">
                        <br>

                        <div class=col-12>
                            <div class=row d-flex align-items-center style="padding-top: 10px; line-height: 60px;">
                               <?php
						$recentlists = fetchRecentLists($userID);
						
						while($row = $recentlists->fetch_array())//gå igenom alla resultat
						{
							$listnameloop = $row['name'];
							$idloop = $row['listID'];
							$link = "list.php?listID=$idloop";
							?>
                    <div class=col-12 d-flex style="border: 1px solid black; background-color: #333; height: 60px; color: white;"><?php echo $listnameloop?><span style="float: right"><a href="<?php echo $link?>">View</a></span></div>
						<?php
						}
						?>
                    
                </div>
            </div>
        </body>
    </html>
