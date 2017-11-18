class Image{
    
    
    constructor(){
        this.current= new Date();
        //console.log(this.current);
        this.buildDate(this.current);
    }
    
    buildDate(current){
        var day = current.getUTCDate();
        var month = current.getUTCMonth()+1;
        var year = current.getUTCFullYear();
        var toSearch =year+"-"+month+"-"+day;
        this.request(toSearch);
    }
    
    search(date){
        //var date = $('#datepicker').val(); 
        date=date.split("/");
        var day=date[1];
        var month=date[0];
        var year=date[2];
        // seeing if a value exists if not defaulting to current date
        //buiding date to then request
        var toSearch=year+"-"+month+"-"+day;
        this.request(toSearch);
        // resetting date object
        year = parseInt(year);
        month = (parseInt(month)-1);
        day = parseInt(day);
        //console.log('bfore set date'+ this.current);
        this.current.setFullYear(year,month,day);
        //console.log('search makes current'+ this.current);
    }
    
    forward(){
        this.current.setDate(this.current.getDate()+1);
        //console.log("this bit is  "+ typeof current);
        this.buildDate(this.current);
    }
    
    backward(){
        this.current.setDate(this.current.getDate()-1);
        //console.log("this bit is  "+ typeof current);
        this.buildDate(this.current);
    }
    
    
    request(toSearch){
  
        $.ajax({
            url:'https://api.nasa.gov/planetary/apod?api_key=AJOQvjXy8pcTBkSMMSKrihU28PnuX9GbC8MXSQiI',
            data:{
                hd:true,
                date:toSearch,
            },
            
            error: function(){
                
                $("#canvas").html('<p>Oh dear... something went wrong </p>');
            },
    
            beforeSend:function(){
                $('#canvas').addClass('loading');
            },
            success : function(data){
                if(data.media_type == "video") {
                    $("#photo").css("display", "none"); 
                    $("#video").attr("src", data.url);
                  }
                  else {
                    $("#video").css("display", "none"); 
                    $("#photo").attr("src", data.url);
                  }
                /* These are available but not used*/
                $("#reqObject").text('https://api.nasa.gov/planetary/apod?api_key=AJOQvjXy8pcTBkSMMSKrihU28PnuX9GbC8MXSQiI');
                $("#returnObject").text(JSON.stringify(data, null, 4));  
                

                //Adding to view
                $("#apod_explaination").text(data.explanation);         
                $("#title").text(data.title);
                
                toSearch=toSearch.split("-");
                var day=toSearch[2];
                var month=toSearch[1];
                var year=toSearch[0];
                toSearch =day+"-"+month+"-"+year;
                $('#dateTitle').text(toSearch);

                // adding to hidden form for save function
                
                var title = data.title;
                console.log(title);
                var explanation = data.explanation;
                $("#inputTitle").val(title);
                $("#inputDateTitle").val(toSearch);
                $("#inputExplanation").val(explanation);

             },
             //by default requests are sent by GET 
             type: 'GET',
        })
    }; // ajax request over
  };
    
    
    