$(document).ready(function(){
    
    
    $( function() {
        $( "#datepicker" ).datepicker();
      });
    
    var View= new Image(); 
    
    $('#active').on('click',function(){
        var date = $('#datepicker').val();
        View.search(date);
    })
    
    $('#next').on('click',function(){
        View.forward();
    })
    
    $('#back').on('click',function(){
        View.backward();
    })

    


    $('#save_image_form').on('submit', function(event){
           
            var title = $('#inputTitle').val();
            var dateTitle =  $('#inputDateTitle').val();
            var explanation =  $('#inputExplanation').val();
           
          url += "/member/save";
          console.log(url);

          var dataString = 'title='+ title 
          + '&dateTitle='+ dateTitle;

          console.log(typeof dataString);

          $.ajax({
              url         : url,
              data        : dataString,
              type        : 'POST',
              datatype : text,
              success    : function(data){
                
                 var  data = JSON.parse(data);
            console.log('i did as i was told!');
            },
              error: function(result){
                console.log('helloe i failed'+result);
            },
          });
       
  });













    });  // end of document