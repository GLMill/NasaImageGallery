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

    $('#save').on('click',function(){
        var saved = new DataModel();
        var title = $('#title').val();
        var img= $('#photo').val();
        var date= $('#dateTitle').val();
        var details = $('#apod_explaination').val();
        saved.addToPosts(title,img, date, details);
    })
    
    });  // end of document