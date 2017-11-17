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

    


    $('#save_image_forms').on('submit', function(event){
        
       
           
            var title = $('#inputTitle').val();
            var dateTitle =  $('#inputDateTitle').val();
            var explanation =  $('#inputExplanation').val();
           
          

          var dataString = 'title='+ title 
          + '&dateTitle='+ dateTitle + 
          '&explanation='+ explanation ;

           
          $.ajax({
              url         : url + "member/save",
              data        : dataString,
              type        : 'POST',
              success     : function(data){
                                
                    var  data = JSON.parse(data);
                      
                    /* $('.edit-profile-section').hide('slow')
                     $('.user-details').show('slow');
                      
                   
                      $('#'+user_id).find('#upi').html("<img class='profile-img' src='"+url+'images/'+data["profile_image"]+"' />");
                      $('#'+user_id).find('#ufn').html(data["firstname"]);
                      $('#'+user_id).find('#uln').html(data["lastname"]);
                      $('#'+user_id).find('#ue').html(data["email"]);
                      $('#'+user_id).find('#ujd').html(data["joining_date"]);
                      $('#'+user_id).find('#ur').html(data["role"]);
                      $('#'+user_id).find('#us').html(data["status"]);*/
            
             
              }
          });
       
  });













    });  // end of document