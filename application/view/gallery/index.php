

        <div id='container-fluid'>
            <header>
                <h3>DATE:</h3><input type="text"  id='datepicker' class='small'>
                <button id="active">go</button>
                <button id="next">></button>
                <button id="back"><</button>
            </header>

           

            <div id="canvas">
                <?php  
                    if($_SESSION){
                        echo "<button id='save'>Save</button>";
                    }?>
                <img id="photo" width="250px"/>
                <iframe id="video" type="text/html" width="640" height="385" frameborder="0"></iframe>
            </div><!--- closing canvas body for image or video-->
            <div id='left_side_bar'>
                    <h1 id="title"></h1>
            </div>
            
            <div id="text">
                <h1 id="dateTitle"></h1>
                <p id="apod_explaination"></p>
                <p id="copyright"></p>
            </div><!--- closing text-->

            <div id='mostLiked'>
                    <h2> Cosmos Picks: </h2>
                    <!-- creating the search function -->
                   <input type='text' id='picksSearch' value='pickSearch' class='small' />
                   <div class='masonry'>
                        <!-- needs to add the posts here-->
                        <?php echo $usersSaves ?>
                   </div>
                
            </div>



            
        </div><!-- end of a container -->