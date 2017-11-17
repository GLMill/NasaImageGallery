

        <div id='container-fluid'>
            <header>
                <h3>DATE:</h3><input type="text"  id='datepicker' class='small'>
                <button id="active">go</button>
                <button id="next">></button>
                <button id="back"><</button>
            </header>

           
            <?php  
                    if($_SESSION){
                        // write turn this into a hidden form
                
                        echo "<form id='save_image_forms'>
                                <input type='text' name='inputTitle' id='inputTitle'>
                                <input type='text' name='inputDateTitle' id='inputDateTitle' >
                                <input type='text' name='inputExplanation' id='inputExplanation' >
                                <input type='submit' value='Save'>
                            </form>";
                    }?>
            <div id="canvas">
                
                <img id="photo" width="250px"/>
                <iframe id="video" type="text/html" width="640" height="385" frameborder="0"></iframe>
            </div><!--- closing canvas body for image or video-->
            <div id='left_side_bar'>
                    <h1 id="title"></h1>
            </div>
            
            <div id="text">
                <h1 id="dateTitle"></h1>
                <p id="apod_explaination"></p>
            </div><!--- closing text-->          
        </div><!-- end of a container -->