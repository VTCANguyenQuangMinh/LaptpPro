<?php
       include 'inc/header.php';
 ?>

 <div class="main">
    <div class="content">
	    <div class="content_top">
    		<div class="heading">
    		<h3>Tất cả sản phẩm</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
		<div class="border">
                <?php
                    try{
                        
						$pagerows = 1;
                        
						$record = $product->getNumberOfproduct();

                        if($record>$pagerows)
                        {
                            $pages = ceil($record/$pagerows);
                            
                        }else{
                            $pages = 1;
                        }

                        if(isset($_GET["s"]) && is_numeric($_GET["s"]))
                        {
                            $start = htmlspecialchars($_GET["s"]);
                        }else{
                            $start = 0;
                        }

                        $productPagin = $product->getAllproduct($start, $pagerows);
                        
                        if($productPagin)
                        {
                            echo "<div class='section group1'>";
                            while($result = $productPagin->fetch_assoc())
                            {
                                
                                $Pdname = substr($result['productName'],  0, 40);
                                ?>
                                <div class="grid_1_of_4 images_1_of_4">
                                    <a href="details.php?proid=<?php echo $result['productId'] ?>">
                                        <div>
                                            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
                                        </div>

                                        <div class="hdiv1">
                                            <h2><?php echo $Pdname ?></h2>
                                        </div>

                                        <div class="hdiv">
                                        <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
                                        </div>

                                        <div class="hdiv">
                                        <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VND" ?></span></p>
                                        </div>

                                    </a>
                                </div>
                                <?php
                            }
                            echo "</div>";
                        }

                        if($pages>=1)
                        {
                            
                            $current_page = round(($start/$pagerows)+1);
                            $echoString = "<div class='text-right'>";
                            if($current_page > 2)
                            {
                                $echoString .= "<a href='products.php?s=" . ($start-2*$pagerows)."'><button ><</button></a>";
                            }
                            if($current_page > 1)
                            {
                                $echoString .= "<a href='products.php?s=" . ($start-$pagerows)."'><button class='currenBtn1'>". ($current_page-1) ."</button></a>";
                            }
                            
                            $echoString .= "<button class='currenBtn'>" . $current_page . "</button>";
                            if($current_page <$pages)
                            {
                                $echoString .= "<a href='products.php?s=" . ($start+$pagerows)."'><button class='currenBtn1'>". ($current_page+1) ."</button></a>";
                            }
                            if($current_page < $pages-1)
                            {
                                $echoString .= "<a href='products.php?s=" . ($start+2*$pagerows) . "'><button >></button></a>";
                            }
                            $echoString .= "</div>";
                            echo $echoString;
                        }

                    }catch(Exception $e)
                    {
                        echo "An exception occured. Message: " . $e->message();
                    }
                ?>
            </div>
		</div>
    </div>
 </div>
 <?php
      include 'inc/footer.php';
?>